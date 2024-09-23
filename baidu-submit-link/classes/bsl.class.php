<?php


class WB_BSL_Base
{

    public static function error($msg,$mod='')
    {
        WB_BSL_Utils::run_err($msg,$mod);
    }

    public static function info($msg,$mod='')
    {
        WB_BSL_Utils::run_log($msg,$mod);
    }

    public static function db()
    {
        static $db = null;
        if($db){
            return $db;
        }
        $db = $GLOBALS['wpdb'];
        if($db instanceof wpdb){
            return $db;
        }
        return $db;
    }
    public static function param($key, $default = '', $type = 'p'){
        if('p' === $type){
            if(isset($_POST[$key])){
                return $_POST[$key];
            }
            return $default;
        } else if ('g' === $type){
            if(isset($_GET[$key])){
                return $_GET[$key];
            }
            return $default;
        }
        if(isset($_POST[$key])){
            return $_POST[$key];
        }
        if(isset($_GET[$key])){
            return $_GET[$key];
        }
        return $default;
    }

    public static function ajax_resp($ret)
    {
        header('content-type:text/json;charset=utf-8');
        echo wp_json_encode($ret);
        exit();
    }

    public static function wb_push_post($post_id,$post)
    {
        if(wp_is_post_revision($post) || $post->post_status !== 'publish'){
            return;
        }
        if(!get_option('wb_bsl_ver',0)){
            return;
        }
        if(!wp_next_scheduled('bsl_single_push_url',[ $post_id ])){
            wp_schedule_single_event(current_time('U',1)+30,'bsl_single_push_url',[ $post_id ]);
        }

    }
}