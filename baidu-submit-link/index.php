<?php
/*
Plugin Name: 多合一搜索自动推送管理插件
Plugin URI: http://wordpress.org/plugins/baidu-submit-link/
Description: 多合一搜索自动推送管理插件（原百度搜索推送管理插件）是一款针对WP开发的功能非常强大的百度、Google、Bing、IndexNow、Yandex、神马和头条搜索引擎链接推送插件。协助站长将网站资源快速推送至百度、Bing、360等各大搜索引擎，有利于提升网站的搜索引擎收录效率；该插件还提供文章百度收录查询功能。
Author: 闪电博
Version: 4.2.11
Author URI: https://www.wbolt.com/
Requires PHP: 7.0.0
*/

if(!defined('ABSPATH')){
    return;
}

define('BSL_PATH',dirname(__FILE__));
define('BSL_BASE_FILE',__FILE__);
define('BSL_VERSION','4.2.11');
define('BSL_URL',plugin_dir_url(__FILE__));

require_once BSL_PATH.'/classes/bsl.class.php';
require_once BSL_PATH.'/classes/conf.class.php';
require_once BSL_PATH.'/classes/baidu.class.php';
require_once BSL_PATH.'/classes/utils.class.php';
require_once BSL_PATH.'/classes/cron.class.php';
require_once BSL_PATH.'/classes/site.class.php';
//require_once BSL_PATH.'/classes/app.class.php';
require_once BSL_PATH.'/classes/daily.class.php';
require_once BSL_PATH.'/classes/bing.class.php';
require_once BSL_PATH.'/classes/google.class.php';
require_once BSL_PATH.'/classes/indexnow.class.php';
require_once BSL_PATH.'/classes/yandex.class.php';
require_once BSL_PATH.'/classes/stats.class.php';
require_once BSL_PATH.'/classes/admin.class.php';

//new BSL_Admin();
BSL_Admin::init();
