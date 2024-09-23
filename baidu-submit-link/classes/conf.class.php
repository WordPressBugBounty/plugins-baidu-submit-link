<?php

/**
 * 插件配置
 * Class WB_BSL_Conf
 */

class WB_BSL_Conf extends WB_BSL_Base
{

    public static $debug = false;

    public static $name = 'bsl_pack';
    public static $optionName = 'bsl_option';

    public static $db_ver = 14;

    public static $default_conf = array(
        //base
        'post_type'=>array('post'),
        'check_404'=>0,
        'in_bd_active'=>1,
        'log_day'=>7,
        //baidu
        'token'=>'',
        'pc_active'=>0,
        'pc_active2'=>0,
        'bdauto'=>0,
        'daily_active'=>0,
        //bing
        'bing_key'=>'',
        'bing_auto'=>0,
        'bing_manual'=>0,
        //360
        'qh_active'=>0,
        'qhjs'=>'',
        'qh_batch'=>0,

        //byte
        'byte_active'=>0,
        'byte_js'=>'',
        'byte_batch'=>0,
        //sm
        'sm_active'=>0,
        'sm_api'=>'',
        //google
        'google'=>0,
        'google_key'=>'',
        //indexnow
        'indexnow'=>0,
        'indexnow_key'=>'',
        'indexnow_type' => array(),
        //yandex
        'yandex'=>0,
        'yandex_id'=>'',
        'yandex_pwd'=>'',

        //site
        'site_google' => 0,
        'site_bing' => 0,


        //
        'app_active'=>0,
        'app_id'=>'',
        'app_token'=>'',
        'daily_api'=>'',
        'use_daily'=>0,

        //
        'old_post_push'=>1,
        'auto_check_in_baidu'=>1


    );

    public static function load_conf()
    {
        $_push_cnf = get_option(self::$optionName,array());
        if(!is_array($_push_cnf)){
            $_push_cnf = array();
        }

        if(isset($_push_cnf['daily_api']) && isset($_push_cnf['token'])){
            if(!$_push_cnf['token'] && $_push_cnf['daily_api']){
                $_push_cnf['token'] = $_push_cnf['daily_api'];
            }
        }
        if(!isset($_push_cnf['pc_active'])){
            $_push_cnf['pc_active'] = 0;
        }

        $api = '';
        do{
            if(!isset($_push_cnf['token']) || !$_push_cnf['token']){
                break;
            }
            $token = $_push_cnf['token'];
            if(preg_match('#^https?://#',$token)){
                $url = wp_parse_url($token);
                if($url['host'] != 'data.zz.baidu.com'){
                    break;
                }
                parse_str($url['query'],$param);
                if(!isset($param['token'])){
                    break;
                }
                $api = 'http://data.zz.baidu.com/urls?';
                if(isset($param['site']) && $param['site']){
                    $api .='site='.$param['site'].'&';
                }
                $api .= 'token='.$param['token'];
                //!isset() ||
            }else{
                $api = 'http://data.zz.baidu.com/urls?site='.home_url().'&token='.$token.'';
            }

        }while(0);

        $_push_cnf['token'] = $api;
        $_push_cnf['daily_api'] = $api?$api.'&type=daily':'';

        if(!$api){
            $_push_cnf['pc_active'] = 0;
            $_push_cnf['daily_active'] = 0;
        }


        if(isset($_push_cnf['qhjs']) && $_push_cnf['qhjs']){
            $_push_cnf['qh_active'] = 1;
        }

        $_push_cnf = array_merge(self::$default_conf,$_push_cnf);

        if(empty($_push_cnf['indexnow_key'])){
            $_push_cnf['indexnow_key'] = md5(AUTH_KEY.home_url());
        }

        return $_push_cnf;
    }

    public static function cnf($key,$default=null){
        static $_push_cnf = array();
        if(!$_push_cnf){
            $_push_cnf = self::load_conf();
        }

        if(null === $key){
            return $_push_cnf;
        }
        if(isset($_push_cnf[$key])){
            return $_push_cnf[$key];
        }

        return $default;

    }

    public static function  array_sanitize_text_field($value)
    {
        if(is_array($value)){
            foreach($value as $k=>$v){
                $value[$k] = self::array_sanitize_text_field($v);
            }
            return $value;
        }else{
            return sanitize_text_field($value);
        }
    }

    public static function update_cnf()
    {
        $opt = self::param('opt');
        if(empty($opt) || !is_array($opt)){
            return;
        }

        $opt = self::array_sanitize_text_field($opt);
        if(isset($opt['token'])){
            $opt['token'] = trim($opt['token']);
        }

        $btoa = 0;
        if(isset($opt['btoa']) && $opt['btoa']){
            $btoa = 1;
        }
        foreach(['byte_js','google_key','qhjs'] as $f){
            if(isset($opt[$f])){
                if($btoa){
                    $opt[$f] = base64_decode($opt[$f]);
                }else{
                    $opt[$f] = stripslashes($opt[$f]);
                }
            }
        }


        if(isset($opt['daily_api'])){
            //$opt['daily_api'] = '';
            unset($opt['daily_api']);
        }
        if(isset($opt['qhjs'])){
            //stripslashes
            $opt['qhjs'] = trim(($opt['qhjs']));
            $opt['qh_active'] = $opt['qhjs']?1:0;
        }
        if(isset($opt['google_key']) && $opt['google_key']){
            //stripslashes
            $opt['google_key'] = trim(($opt['google_key']));
        }

        if(isset($opt['qh_active']) && $opt['qh_active']){
            $opt['qh_batch'] = isset($opt['qh_batch']) && $opt['qh_batch'] ?1:0;
        }else{
            $opt['qh_batch'] = 0;
        }
        if(isset($opt['byte_js'])){
            //stripslashes
            $opt['byte_js'] = trim(($opt['byte_js']));
            $opt['byte_active'] = $opt['byte_js']?1:0;
        }
        if(isset($opt['byte_active']) && $opt['byte_active']){
            $opt['byte_batch'] = isset($opt['byte_batch']) && $opt['byte_batch'] ?1:0;
        }else{
            $opt['byte_batch'] = 0;
        }
        if(isset($opt['sm_api']) && $opt['sm_api']){
            $opt['sm_active'] = 1;
        }else{
            $opt['sm_active'] = 0;
        }

        $opt_data = self::cnf(null);
        foreach($opt_data as $k=>$v){
            if(isset($opt[$k])){
                $opt_data[$k] = $opt[$k];
                continue;
            }
            unset($opt_data[$k]);
        }

        update_option( self::$optionName, $opt_data );
    }

    public static function extend_conf(&$cnf,$conf){
        if(is_array($conf))foreach($conf as  $k=>$v){
            if(!isset($cnf[$k])){
                $cnf[$k] = $v;
            }else if(is_array($v)){
                if(!is_array($cnf[$k])){
                    $cnf[$k] = array();
                }
                self::extend_conf($cnf[$k],$v);
            }
        }
    }


    public static function check_post_type($post){

        if($post->post_status != 'publish'){
            return false;
        }

        if($post->post_password != ''){
            return false;
        }

        $post_types = self::cnf('post_type',array('post'));

        if(empty($post_types))$post_types = array('post');

        if(!in_array($post->post_type,$post_types)){
            return false;
        }
        return true;
    }



    public static function setup_db(){
        // global $wpdb;

        $db = self::db();

        $wb_tables = explode(',','wb_bsl_day,wb_bsl_log,wb_bsl_stats');

        //数据表
        $tables = $db->get_col("SHOW TABLES LIKE '".$db->prefix."wb_bsl_%'");

        $set_up = array();
        foreach ($wb_tables as $table){
            if(in_array($db->prefix.$table,$tables)){
                continue;
            }

            $set_up[] = $table;
        }

        if(empty($set_up)){
            return;
        }

        WB_BSL_Utils::create_wb_table($set_up,self::install_sql());


        update_option('wb_bsl_db_ver',self::$db_ver,false);


    }

    public static function update_db_14()
    {
        if(!is_admin()){
            return;
        }
        $db_ver = (int)get_option('wb_bsl_db_ver',0);
        if(!$db_ver){
            return;
        }
        if($db_ver >= 14){
            return;
        }

        // global $wpdb;
        $db = self::db();
        $error = $db->suppress_errors();
        $db->query($db->prepare("ALTER TABLE `{$db->prefix}wb_bsl_stats` 
                ADD `num11` int(10) UNSIGNED NOT NULL DEFAULT '0' AFTER `num10`,
                ADD `num12` int(10) UNSIGNED NOT NULL DEFAULT '0' AFTER `num11`,
                ADD `num13` int(10) UNSIGNED NOT NULL DEFAULT '0' AFTER `num12`,
                ADD `num14` int(10) UNSIGNED NOT NULL DEFAULT '0' AFTER `num13`,
                ADD `num15` int(10) UNSIGNED NOT NULL DEFAULT '0' AFTER `num14`,
                ADD `num16` int(10) UNSIGNED NOT NULL DEFAULT '0' AFTER `num15`,
                ADD `num17` int(10) UNSIGNED NOT NULL DEFAULT '0' AFTER `num16`,
                ADD `num18` int(10) UNSIGNED NOT NULL DEFAULT '0' AFTER `num17`,
                ADD `num19` int(10) UNSIGNED NOT NULL DEFAULT '0' AFTER `num18`,
                ADD `num20` int(10) UNSIGNED NOT NULL DEFAULT %s AFTER `num19`", '0'));
        $db->suppress_errors($error);
        update_option('wb_bsl_db_ver',14,false);
    }

    public static function update_db_13()
    {
        if(!is_admin()){
            return;
        }
        $db_ver = (int)get_option('wb_bsl_db_ver',0);
        if(!$db_ver){
            return;
        }
        if($db_ver >= 13){
            return;
        }

        // global $wpdb;
        $db = self::db();

        $error = $db->suppress_errors();

        $db->query($db->prepare("ALTER TABLE `{$db->prefix}wb_bsl_stats` 
                ADD `num9` int(10) UNSIGNED NOT NULL DEFAULT '0' AFTER `num8`,
                ADD `num10` int(10) UNSIGNED NOT NULL DEFAULT %s AFTER `num9`", '0'));
        $db->suppress_errors($error);
        update_option('wb_bsl_db_ver',13,false);
    }

    public static function upgrade_db_12()
    {
        $db_ver = (int)get_option('wb_bsl_db_ver',0);
        if($db_ver<12){
            self::setup_db();
        }
    }

    public static function upgrade_v3_conf(&$err=''){

        do{
            $siteurl = get_option('siteurl');
            if(!$siteurl){
                $siteurl = home_url();
            }

            $host = wp_parse_url($siteurl,PHP_URL_HOST);

            $param = array(
                'code'=>get_option('wb_bsl_ver',0),
                'host'=>$host,
                'ver'=>'bsl-pro',
            );

            if(!$param['code']){
                $err = '升级异常，请稍后再试。';
                break;
            }

            $http = wp_remote_post('https://www.wbolt.com/wb-api/v1/update',array('sslverify'=>false,'body'=>$param,'headers'=>array('referer'=>home_url()),));
            if(is_wp_error($http)){
                $err = '升级异常，请稍后再试。[1000]['.$http->get_error_message().']';
                break;
            }

            if($http['response']['code']!=200){
                $err = '升级异常，请稍后再试。[1001]['.$http['response']['code'].']';
                break;
            }

            $body = $http['body'];

            if(empty($body)){
                $err = '升级异常，请稍后再试。[1002]';
                break;
            }

            $data = json_decode($body,true);

            if(empty($data)){
                $err = '升级异常，请稍后再试。[1003]';
                break;
            }
            if(empty($data['data'])){
                $err = '升级异常，请稍后再试。[1004]';
                break;
            }
            if($data['code']){
                $err = '升级异常，请稍后再试。['.$data['data'].']';
                break;
            }

            update_option('wb_bsl_cnf_'.$data['v'],$data['data'],false);

            return true;

        }while(false);

        return false;
    }


    public static function check_tb_exists(){
        // global $wpdb;


        $db = self::db();
        $wb_tables = explode(',','wb_bsl_day,wb_bsl_log');

        //数据表
        $tables = $db->get_col("SHOW TABLES LIKE '".$db->prefix."wb_bsl_%'");

        return count($wb_tables) == count($tables);
    }




    public static function install_sql(){
        $sql =  'CREATE TABLE IF NOT EXISTS `wp_wb_bsl_day` (
                  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
                  `ymd` date NOT NULL,
                  `all_in` int(10) UNSIGNED NOT NULL DEFAULT \'0\',
                  `new_in` int(10) UNSIGNED NOT NULL DEFAULT \'0\',
                  `not_in` int(10) UNSIGNED NOT NULL DEFAULT \'0\',
                  `day_in` int(10) UNSIGNED NOT NULL DEFAULT \'0\',
                  `week_in` int(10) UNSIGNED NOT NULL DEFAULT \'0\',
                  `month_in` int(10) UNSIGNED NOT NULL DEFAULT \'0\',
                  `limited` int(10) UNSIGNED NOT NULL DEFAULT \'0\',
                  `remain` int(10) UNSIGNED NOT NULL DEFAULT \'0\',
                  `type` tinyint(3) UNSIGNED NOT NULL DEFAULT \'1\',
                  PRIMARY KEY (`id`),
                  KEY `ymd` (`ymd`)
                ) ENGINE=InnoDB;
                -- row split --
                CREATE TABLE IF NOT EXISTS `wp_wb_bsl_log` (
                  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                  `post_id` bigint(20) UNSIGNED NOT NULL,
                  `post_url` varchar(256) DEFAULT NULL,
                  `push_status` tinyint(4) NOT NULL,
                  `index_status` tinyint(4) NOT NULL,
                  `create_date` datetime DEFAULT NULL,
                  `type` tinyint(4) NOT NULL DEFAULT \'1\',
                  `result` text,
                  PRIMARY KEY (`id`),
                  KEY `post_id` (`post_id`,`type`),
                  KEY `push_status` (`push_status`,`type`),
                  KEY `index_status` (`index_status`)
                ) ENGINE=InnoDB;
                -- row split --
                CREATE TABLE IF NOT EXISTS `wp_wb_bsl_stats` (
                  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
                  `ymd` date NOT NULL,
                  `num1` int(10) UNSIGNED NOT NULL DEFAULT \'0\',
                  `num2` int(10) UNSIGNED NOT NULL DEFAULT \'0\',
                  `num3` int(10) UNSIGNED NOT NULL DEFAULT \'0\',
                  `num4` int(10) UNSIGNED NOT NULL DEFAULT \'0\',
                  `num5` int(10) UNSIGNED NOT NULL DEFAULT \'0\',
                  `num6` int(10) UNSIGNED NOT NULL DEFAULT \'0\',
                  `num7` int(10) UNSIGNED NOT NULL DEFAULT \'0\',
                  `num8` int(10) UNSIGNED NOT NULL DEFAULT \'0\',
                  `num9` int(10) UNSIGNED NOT NULL DEFAULT \'0\',
                  `num10` int(10) UNSIGNED NOT NULL DEFAULT \'0\',
                  `num11` int(10) UNSIGNED NOT NULL DEFAULT \'0\',
                  `num12` int(10) UNSIGNED NOT NULL DEFAULT \'0\',
                  `num13` int(10) UNSIGNED NOT NULL DEFAULT \'0\',
                  `num14` int(10) UNSIGNED NOT NULL DEFAULT \'0\',
                  `num15` int(10) UNSIGNED NOT NULL DEFAULT \'0\',
                  `num16` int(10) UNSIGNED NOT NULL DEFAULT \'0\',
                  `num17` int(10) UNSIGNED NOT NULL DEFAULT \'0\',
                  `num18` int(10) UNSIGNED NOT NULL DEFAULT \'0\',
                  `num19` int(10) UNSIGNED NOT NULL DEFAULT \'0\',
                  `num20` int(10) UNSIGNED NOT NULL DEFAULT \'0\',
                  `type` tinyint(3) UNSIGNED NOT NULL DEFAULT \'1\',
                  PRIMARY KEY (`id`),
                  KEY `ymd` (`ymd`),
                  KEY `type` (`type`)
                ) ENGINE=InnoDB;
                ';

        return $sql;

    }


}