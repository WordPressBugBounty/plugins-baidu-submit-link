<?php

/**
 * 快速推送
 * Class WB_BSL_Daily
 */

class WB_BSL_Daily extends WB_BSL_Base
{


    public static function init(){

        //add_action('edit_post',array(__CLASS__,'bsl_edit_post'),91,2);
        //add_action('wp_insert_post',array(__CLASS__,'bsl_edit_post'),91,3);
        //insert
        //add_action('wp_insert_post',array(__CLASS__,'bsl_insert_post'),91,3);
        //update
        //add_action('post_updated',array(__CLASS__,'bsl_updated_post'),91,3);
        //publish
        //add_action('wp_after_insert_post',array(__CLASS__,'bsl_updated_post'),91,4);

        add_action('wp_insert_post', [__CLASS__,'wb_push_post'], 91, 2);

        //wb push
        add_action('wb_push_post',array(__CLASS__,'bsl_edit_post'),91,3);
    }

    public static function get_remain(){
        // global $wpdb;
        $db = self::db();

        $t = $db->prefix.'wb_bsl_day';
        $remain = 10;
        $ymd = current_time('Y-m-d');
        $row = $db->get_row("SELECT id,remain,limited FROM $t  WHERE ymd='$ymd' AND `type`=1");
        if($row ){
            $remain = intval($row->remain);
        }

        return $remain;
    }

    public static function update_remain($num){

        // global $wpdb;
        $db = self::db();
        $t = $db->prefix.'wb_bsl_day';

        $num = intval($num);

        $ymd = current_time('Y-m-d');
        $row = $db->get_row($db->prepare("SELECT * FROM $t WHERE ymd=%s AND `type`=1 ",$ymd));
        if($row){
            if($row->limited>0){
                $db->query($db->prepare("UPDATE $t SET remain=%d WHERE id=%d",$num,$row->id));
            }else{
                $db->query($db->prepare("UPDATE $t SET remain=%d,limited=%d WHERE id=%d",$num,$num+1,$row->id));
            }
        }else{
            $d = array(
                'ymd'=>$ymd,
                'limited'=>$num + 1,
                'remain' => $num,
                'type'=>1
            );
            $db->insert($t,$d);
        }
    }

    //新增
    public static function bsl_insert_post($post_id,$post,$update)
    {
        if($update){
            return;
        }
        self::bsl_edit_post($post_id,$post,$update);
    }

    //更新
    public static function bsl_updated_post($post_id, $post, $update, $post_before)
    {
        if(WB_BSL_Conf::cnf('old_post_push')){
            if($post->post_date > $post_before->post_date){
                return;
            }
        }

        self::bsl_edit_post($post_id,$post,$update);
    }

    public static function bsl_edit_post($post_id,$post,$update=true){
        WB_BSL_Utils::run_log('快速收录','收录推送');
        //revision
        if(wp_is_post_revision($post)){
            return;
        }

        if(!get_option('wb_bsl_ver',0)){
            return;
        }

        $disable_push = get_post_meta($post_id,'wb_bsl_daily_push',true);
        if($disable_push){
            return;
        }

        static $post_ids = array();
        do{
            if(isset($post_ids[$post_id]))return;
            $post_ids[$post_id] = 1;

            $daily_active = WB_BSL_Conf::cnf('daily_active');
            if(!$daily_active){
                break;
            }
            $api = WB_BSL_Conf::cnf('daily_api');

            if(!$api){
                break;
            }

            if(!WB_BSL_Conf::check_post_type($post)){
                return;
            }

            if(WB_BSL_Conf::cnf('old_post_push') && (strtotime($post->post_date) < (current_time('U') - 86400))){
                return;
            }

            $remain = self::get_remain();


            if(!$remain || $remain <1){
                break;
            }
            $type  = 2;
            $log = WB_BSL_Utils::push_log($post_id,$type);
            if($log && $log->push_status == 1){
                break;
            }

            if($log && current_time('timestamp') - strtotime($log->create_date) < 600){
                break;
            }

            $post_url = get_permalink($post);
            if(!preg_match('#^https?://#',$post_url)){
                $post_url = home_url($post_url);
            }
            $url = array(
                $post_url,
            );
            WB_BSL_Utils::run_log('快速收录，推送url：','收录推送');
            WB_BSL_Utils::run_log($post_url,'收录推送');
            $ret = WB_BSL_Baidu::daily_push($url);
            WB_BSL_Utils::run_log('推送结果【'.$ret['desc'].'】','收录推送');

            WB_BSL_Utils::add_push_log($type,$post_id,$post_url,$ret);

            if(!$ret['code'] && isset($ret['data']) && isset($ret['data']['remain_daily'])){
                self::update_remain($ret['data']['remain_daily']);
            }


        }while(false);
    }





}