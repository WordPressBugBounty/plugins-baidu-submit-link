<?php
if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

global $wpdb;

delete_option('bsl_option');
delete_option('bsl_version');
delete_option('wb_bsl_ver');
delete_option('wb_bsl_promote');
delete_option('wb_bsl_check_all');
delete_option('bsl_yandex_token');
delete_option('bsl_yandex_error');
delete_option('bsl_google_jwt_token');
delete_option('bsl_bing_updateCrawlStats');
delete_option('wb_idx_data_updated');

$ver = get_option('wb_bsl_ver', 0);
if ($ver) {
    delete_option('wb_bsl_cnf_' . $ver);
}

$wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}wb_bsl_day");
$wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}wb_bsl_log");
$wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}wb_bsl_stats");

wp_clear_scheduled_hook('baidu_push_url_cron_action_v3');
wp_clear_scheduled_hook('baidu_push_url_cron_action_v4');
wp_clear_scheduled_hook('bsl_check_all_404_url');
wp_clear_scheduled_hook('bsl_single_push_url');
