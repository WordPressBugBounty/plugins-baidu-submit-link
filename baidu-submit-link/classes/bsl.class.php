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
        // ✅ 根据默认值类型自动净化输入
        $value = null;
        
        if ('p' === $type) {
            $value = $_POST[$key] ?? null;
        } else if ('g' === $type) {
            $value = $_GET[$key] ?? null;
        } else {
            $value = $_POST[$key] ?? ($_GET[$key] ?? null);
        }
        
        // 如果未设置，返回默认值
        if (null === $value) {
            return $default;
        }
        
        // ✅ 根据默认值类型进行净化
        if (is_string($default)) {
            // 字符串：使用sanitize_text_field()
            return sanitize_text_field((string) $value);
        }
        
        if (is_int($default)) {
            // 整数：转换为整数
            return (int) $value;
        }
        
        if (is_float($default)) {
            // 浮点数：转换为浮点数
            return (float) $value;
        }
        
        if (is_array($default)) {
            // 数组：递归净化
            if (!is_array($value)) {
                return $default;
            }
            return array_map(function($item) {
                if (is_array($item)) {
                    return array_map('sanitize_text_field', $item);
                }
                return sanitize_text_field((string) $item);
            }, $value);
        }
        
        if (is_bool($default)) {
            // 布尔值：转换为布尔值
            return (bool) $value;
        }
        
        // 默认：作为字符串净化
        return sanitize_text_field((string) $value);
    }

    public static function sslverify()
    {
        return (bool) apply_filters('bsl_sslverify', true);
    }

    public static function post_type_in($post_types = null)
    {
        if (empty($post_types) || !is_array($post_types)) {
            $post_types = WB_BSL_Conf::cnf('post_type', array('post'));
        }
        if (empty($post_types) || !is_array($post_types)) {
            $post_types = array('post');
        }
        $clean = array();
        foreach ($post_types as $type) {
            $type = sanitize_key((string) $type);
            if ('' !== $type) {
                $clean[] = $type;
            }
        }
        if (empty($clean)) {
            $clean = array('post');
        }
        return array(
            'in' => implode(',', array_fill(0, count($clean), '%s')),
            'values' => $clean,
        );
    }

    public static function ajax_resp($ret)
    {
        header('content-type:text/json;charset=utf-8');
        echo wp_json_encode($ret);
        wp_die();
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