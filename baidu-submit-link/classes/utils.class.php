<?php


/**
 * 插件工具类
 * Class WB_BSL_Utils
 */
class WB_BSL_Utils extends WB_BSL_Base
{
    public static $debug = false;

    public static function txt_log($msg){

        if(!self::$debug){
            return;
        }
        $num = func_num_args();
        if($num>1){
            $msg = wp_json_encode(func_get_args());
        }else if(is_array($msg)){
            $msg = wp_json_encode($msg);
        }

        error_log('['.current_time('mysql').']'.$msg."\n",3,__DIR__.'/#log/'.current_time('Ym').'.log');
    }


    public static function run_log($msg,$mod='')
    {

        if(is_array($msg)){
            $msg = wp_json_encode($msg);
        }

        if($mod){
            $msg = '['.$mod.'] '.$msg;
        }

        error_log('['.current_time('mysql').'] '.$msg."\n",3,__DIR__.'/#log/running.log');
    }

    public static function run_err($msg,$mod='')
    {

        if(is_array($msg)){
            $msg = wp_json_encode($msg);
        }

        if($mod){
            $msg = '['.$mod.'] '.$msg;
        }

        error_log('['.current_time('mysql').'] '.$msg."\n",3,__DIR__.'/#log/error.log');
    }


    public static function push_log($post_id,$type){

        // global $wpdb;
        $db = self::db();
        $t = $db->prefix.'wb_bsl_log';
        //$type=>[3=>'强推,主动推送',4=>'自动推送',1=>'主动推送'，2=>'快速收录',10=>'bing自动',11=>'bing手动'

        $row = $db->get_row($db->prepare("SELECT a.* FROM {$db->prefix}wb_bsl_log a WHERE a.post_id=%d AND a.type=%d ORDER BY  create_date DESC LIMIT 1",$post_id,$type));

        return $row;
    }

    public static function clean_log($type)
    {
        // global $wpdb;

        $db = self::db();
        if($type==100) {//all baidu
            $db->query("DELETE FROM {$db->prefix}wb_bsl_log WHERE `type` IN(1,2,3)");
        }else if($type==101){//all bing
            $db->query("DELETE FROM {$db->prefix}wb_bsl_log WHERE `type` IN(10,11)");
        }else if($type==102) {//all other
            $db->query("DELETE FROM {$db->prefix}wb_bsl_log WHERE `type` IN(20,21,22,32,33)");
        }else if($type == 103){//all google
            $db->query("DELETE FROM {$db->prefix}wb_bsl_log WHERE `type` IN(30,31)");
        }else{
            $db->query($db->prepare("DELETE FROM {$db->prefix}wb_bsl_log WHERE `type`=%d",$type));
        }


    }

    public static function schedule_clean_log()
    {
        // global $wpdb;
        $db = self::db();

        $day = (int)WB_BSL_Conf::cnf('log_day',7);
        if(!$day){
            $day = 7;
        }
        $db->query($db->prepare("DELETE FROM {$db->prefix}wb_bsl_log WHERE create_date < DATE_ADD(NOW(),INTERVAL -%d DAY)", $day));
    }


    public static function add_push_log($type,$post_id,$url,$result){
       // global $wpdb;
        $db = self::db();
       $t = $db->prefix.'wb_bsl_log';
       $push_status = 0;

       if(!$result['code']){
           $push_status = 1;
           if(isset($result['data']) && isset($result['data']['success']) && $result['data']['success'] < 1){
               $push_status = 0;
           }
       }

       $data = isset($result['data']) && $result['data']?wp_json_encode($result['data']):$result['desc'];

       $d = array(
           'post_id'=>$post_id,
           'post_url'=>$url,
           'push_status'=>$push_status,
           'index_status'=>0,
           'create_date'=>current_time('mysql'),
           'type'=>$type,
           'result'=>$data,
       );

       if($db->insert($t,$d)){
           $d['id'] = $db->insert_id;
       }


       do_action('wb_bsl_add_push_log',$d);

    }

    /**
     * 更新post meta
     * @param $post_id
     * @param $key
     * @param $value
     */
    public static function update_meta_row($post_id,$key,$value){
        // global $wpdb;

        $db = self::db();
        $row = $db->get_row($db->prepare("SELECT * FROM $db->postmeta WHERE meta_key=%s AND post_id=%d ORDER BY meta_id DESC LIMIT 1",$key,$post_id));
        if($row){
            $db->query($db->prepare("UPDATE $db->postmeta SET meta_value=%s WHERE meta_id=%d",$value,$row->meta_id));
        }else{
            $db->query($db->prepare("INSERT INTO $db->postmeta(`post_id`, `meta_key`, `meta_value`) VALUES(%d,%s,%s)",$post_id,$key,$value));
        }
    }

    public static function delete_post_meta($post_id,$key){
        // global $wpdb;
        $db = self::db();
        $db->query($db->prepare("DELETE FROM $db->postmeta WHERE meta_key=%s AND post_id=%d",$key,$post_id));

    }



    public static function create_wb_table($set_up,$sql){

        // global $wpdb;


        if(empty($set_up)){
            return;
        }
        $db = self::db();


        $charset_collate = $db->get_charset_collate();



        $sql = str_replace('`wp_wb_','`'.$db->prefix.'wb_',$sql);
        $sql = str_replace('ENGINE=InnoDB', $charset_collate , $sql);



        $sql_rows = explode('-- row split --',$sql);

        foreach($sql_rows as $create_ddl){

            if(preg_match('#`'.$db->prefix.'(wb_bsl.*?)`\s+\(#',$create_ddl,$match)){
                if(in_array($match[1],$set_up)){
                    $db->query($create_ddl);
                }
            }
        }
    }



}