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
        'sitemap_push'=>1,
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
        'google_job_only'=>1,
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

        $had_google_job_only = array_key_exists('google_job_only', $_push_cnf);
        $had_google_on = !empty($_push_cnf['google']);

        $_push_cnf = array_merge(self::$default_conf,$_push_cnf);

        if(!$had_google_job_only && $had_google_on){
            $_push_cnf['google_job_only'] = 0;
        }

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
        if(isset($opt['sitemap_push'])){
            $opt['sitemap_push'] = ($opt['sitemap_push'] === '1' || $opt['sitemap_push'] === 1 || $opt['sitemap_push'] === true) ? 1 : 0;
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

        if(!$post || !is_object($post)){
            return false;
        }

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

    /**
     * Unified auto-push gate. Manual force-push may bypass ($manual=true) and must log that.
     *
     * @param WP_Post|object $post
     * @param string         $channel baidu|daily|bing|indexnow|google|yandex
     * @param bool           $manual
     * @return bool
     */
    public static function should_push($post, $channel = '', $manual = false)
    {
        $ok = true;

        if(!$post || !is_object($post)){
            $ok = false;
        } elseif(function_exists('wp_is_post_revision') && wp_is_post_revision($post)){
            $ok = false;
        } elseif($post->post_status !== 'publish'){
            $ok = false;
        } elseif($post->post_password !== ''){
            $ok = false;
        } elseif(in_array($post->post_type, array('attachment', 'nav_menu_item', 'revision'), true)){
            $ok = false;
        } elseif(!self::check_post_type($post)){
            $ok = false;
        } elseif(!$manual){
            if((string) get_option('blog_public', '1') === '0'){
                $ok = false;
            } elseif(self::post_is_noindex($post)){
                $ok = false;
            }
        }

        return (bool) apply_filters('bsl_should_push', $ok, $post, $channel, $manual);
    }

    public static function post_is_noindex($post)
    {
        if(!$post || empty($post->ID)){
            return false;
        }

        $yoast = get_post_meta($post->ID, '_yoast_wpseo_meta-robots-noindex', true);
        if((string) $yoast === '1'){
            return true;
        }

        $rank = get_post_meta($post->ID, 'rank_math_robots', true);
        if(is_array($rank) && in_array('noindex', $rank, true)){
            return true;
        }
        if(is_string($rank) && $rank !== '' && strpos($rank, 'noindex') !== false){
            return true;
        }

        if(class_exists('Smart_SEO_Tool_Admin') && method_exists('Smart_SEO_Tool_Admin', 'cnf')){
            $noindex = Smart_SEO_Tool_Admin::cnf('tdk.noindex');
            if(is_array($noindex) && !empty($noindex)){
                $type = 'post';
                if($post->post_type === 'page'){
                    $type = 'page';
                }
                if(in_array($type, $noindex, true) || in_array($post->post_type, $noindex, true)){
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * URL actually sent to search engines: canonical, same-host, no tracking/AMP/paged/feed.
     *
     * @param WP_Post|int $post
     * @return string empty if rejected
     */
    public static function push_url($post)
    {
        $url = '';
        if(function_exists('wp_get_canonical_url')){
            $url = wp_get_canonical_url($post);
        }
        if(!$url){
            $url = get_permalink($post);
        }
        if(!$url){
            return '';
        }
        if(!preg_match('#^https?://#i', $url)){
            $url = home_url($url);
        }

        $url = esc_url_raw($url);
        if(!$url || !preg_match('#^https?://#i', $url)){
            return '';
        }

        $parts = wp_parse_url($url);
        if(empty($parts['host'])){
            return '';
        }

        $site_host = wp_parse_url(home_url(), PHP_URL_HOST);
        $host_ok = (strcasecmp((string) $parts['host'], (string) $site_host) === 0);
        $host_ok = (bool) apply_filters('bsl_push_url_host_ok', $host_ok, $parts['host'], $site_host, $post);
        if(!$host_ok){
            return '';
        }

        $path = isset($parts['path']) ? $parts['path'] : '/';
        if(preg_match('#/page/\d+/?$#i', $path) || preg_match('#/(feed|amp)/?$#i', $path)){
            return '';
        }

        $query = array();
        if(!empty($parts['query'])){
            parse_str($parts['query'], $query);
        }
        if(isset($query['amp'])){
            return '';
        }
        foreach(array_keys($query) as $qk){
            $qk_l = strtolower((string) $qk);
            if(strpos($qk_l, 'utm_') === 0 || $qk_l === 'fbclid' || $qk_l === 'gclid'){
                unset($query[$qk]);
            }
        }

        $clean = $parts['scheme'] . '://' . $parts['host'];
        if(!empty($parts['port'])){
            $clean .= ':' . $parts['port'];
        }
        $clean .= $path;
        if(!empty($query)){
            $clean .= '?' . http_build_query($query);
        }

        $filtered = apply_filters('bsl_push_url', $clean, $post);
        if(!is_string($filtered) || $filtered === ''){
            return '';
        }
        $filtered = esc_url_raw($filtered);
        return preg_match('#^https?://#i', $filtered) ? $filtered : '';
    }

    public static function indexnow_covers($engine)
    {
        if(!self::cnf('indexnow')){
            return false;
        }
        $types = self::cnf('indexnow_type', array());
        if(!is_array($types)){
            return false;
        }
        return in_array($engine, $types, true);
    }

    public static function google_allows_post($post)
    {
        if(!self::cnf('google_job_only')){
            return true;
        }
        $types = apply_filters('bsl_google_post_types', array(
            'job_listing',
            'job',
            'jobs',
            'job_post',
            'job-listing',
            'awsm_job_openings',
        ));
        if(!is_array($types)){
            $types = array();
        }
        if($post && in_array($post->post_type, $types, true)){
            return true;
        }
        $hay = '';
        if($post){
            $hay .= (string) $post->post_title;
            $hay .= (string) $post->post_content;
            $hay .= (string) $post->post_excerpt;
        }
        if($hay !== '' && (stripos($hay, 'JobPosting') !== false || stripos($hay, 'BroadcastEvent') !== false)){
            return true;
        }
        return false;
    }

    public static function sst_active()
    {
        if(class_exists('Smart_SEO_Tool_Sitemap') || class_exists('Smart_SEO_Tool_Admin')){
            return true;
        }
        if(function_exists('is_plugin_active')){
            return is_plugin_active('smart-seo-tool/index.php');
        }
        return file_exists(WP_PLUGIN_DIR . '/smart-seo-tool/index.php') && defined('WB_SST_TD');
    }

    /**
     * @return array
     */
    public static function detect_sitemap()
    {
        $ret = array('url' => '', 'source' => '', 'sst' => 0);

        $filtered = apply_filters('bsl_sitemap_url', '');
        if(is_string($filtered) && $filtered !== ''){
            $ret['url'] = esc_url_raw($filtered);
            $ret['source'] = 'filter';
            return $ret;
        }

        if(self::sst_active()){
            $sst_on = true;
            if(class_exists('Smart_SEO_Tool_Admin') && method_exists('Smart_SEO_Tool_Admin', 'cnf')){
                $sst_on = (bool) Smart_SEO_Tool_Admin::cnf('sitemap_seo.active');
            }
            if($sst_on){
                $ret['url'] = home_url('/sitemap.xml');
                $ret['source'] = 'sst';
                $ret['sst'] = 1;
                return $ret;
            }
        }

        $candidates = array(
            home_url('/sitemap.xml'),
            home_url('/sitemaps.xml'),
            home_url('/sitemap_index.xml'),
            home_url('/wp-sitemap.xml'),
        );
        foreach($candidates as $site_map){
            $http = wp_remote_head($site_map, array(
                'timeout' => 8,
                'sslverify' => self::sslverify(),
                'redirection' => 2,
            ));
            if(wp_remote_retrieve_response_code($http) === 200){
                $ret['url'] = $site_map;
                $ret['source'] = 'head';
                return $ret;
            }
        }

        return $ret;
    }

    public static function translate_push_result($raw)
    {
        if($raw === null || $raw === ''){
            return '';
        }
        $text = is_string($raw) ? $raw : wp_json_encode($raw);
        $decoded = json_decode($text, true);
        if(is_array($decoded)){
            if(isset($decoded['message']) && is_string($decoded['message'])){
                $text = $decoded['message'];
            } elseif(isset($decoded['Message']) && is_string($decoded['Message'])){
                $text = $decoded['Message'];
            } elseif(isset($decoded['error']['message']) && is_string($decoded['error']['message'])){
                $text = $decoded['error']['message'];
            }
        }

        $map = array(
            'site error' => '站点未在站长平台验证',
            'empty content' => '未提交任何 URL',
            'only 2000 urls are allowed once' => '每次最多只能提交 2000 条链接',
            'over quota' => '超过每日配额，超配额后再提交无效',
            'token is not valid' => 'Token 错误',
            'not found' => '接口地址填写错误',
            'internal error, please try later' => '服务器偶然异常，通常重试就会成功',
            'URL received. IndexNow key validation pending.' => '已收到 URL，正在校验 IndexNow 密钥',
            'Invalid format' => 'IndexNow 请求格式无效',
            'In case of key not valid' => 'IndexNow 密钥无效（未找到密钥文件，或文件内容不匹配）',
            'In case of URLs which' => 'URL 不属于本站主机，或密钥与协议不一致',
            'Too Many Requests' => '请求过于频繁，被当作潜在垃圾提交',
            'Insufficient tokens for quota' => '已超出 Google Indexing API 配额',
            'Permission denied. Failed to verify the URL ownership.' => '未完成网址所有权验证，或正在更新不属于自己的网址',
            'Invalid attribute. \'url\' is not in standard URL format' => '提交的网址格式无效',
            'Missing attribute. \'url\' attribute is required.' => '请求未包含网址',
        );

        if(isset($map[$text])){
            return $map[$text];
        }
        $keys = array_keys($map);
        usort($keys, function ($a, $b) {
            return strlen($b) - strlen($a);
        });
        foreach($keys as $en){
            if(strlen($en) < 12){
                continue;
            }
            if(stripos($text, $en) !== false){
                return $map[$en];
            }
        }

        return $text;
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

            $http = wp_remote_post('https://www.wbolt.com/wb-api/v1/update',array('sslverify'=>self::sslverify(),'timeout'=>15,'body'=>$param,'headers'=>array('referer'=>home_url()),));
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