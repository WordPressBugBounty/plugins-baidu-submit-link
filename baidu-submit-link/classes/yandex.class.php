<?php


/**
 * Yandex推送
 * Class WB_BSL_Site
 */

class WB_BSL_Yandex extends WB_BSL_Base
{
    public static function init(){

        $cnf = WB_BSL_Conf::cnf(null);

        if(!$cnf['yandex'] || empty($cnf['yandex_id']) || empty($cnf['yandex_pwd'])){
            return;
        }

        add_action('admin_init', [__CLASS__, 'webmasterToken']);
        //add_action('wp_insert_post', [__CLASS__,'edit_post'], 91, 2);
        add_action('wp_insert_post', [__CLASS__,'wb_push_post'], 91, 2);
        add_action('wb_push_post', [__CLASS__,'edit_post'], 91, 2);
    }


    public static function webmasterToken()
    {
        $code = sanitize_text_field(self::param('code','','g'));
        $state = sanitize_text_field(self::param('','','g'));

        if(empty($code) || empty($state)){
            return;
        }
        if(!get_option('wb_bsl_ver',0)){
            return;
        }

        if('yandex-webmaster' !== $state){
            return;
        }
        $cnf = WB_BSL_Conf::cnf(null);
        $data = [
            'sslverify'=>false,
            'timeout'=>10,
        ];
        $data['body'] = [
            'grant_type'    => 'authorization_code',
            'code'          => $code,
            'client_id'     => $cnf['yandex_id'],
            'client_secret' => $cnf['yandex_pwd'],
        ];

        $http    = wp_remote_post( 'https://oauth.yandex.ru/token', $data );
        $error = '';
        do{
            if(is_wp_error($http)){
                self::error('Token API请求出错，'.$http->get_error_message(),'Yandex推送');
                $error = 'yandex get token error,'.$http->get_error_message();
                break;
            }
            $status_code = wp_remote_retrieve_response_code( $http );
            $body = wp_remote_retrieve_body( $http );
            $ret = [];
            if($body){
                $ret = json_decode($body,true);
            }
            if($status_code !== 200){
                $err = isset($ret['error_description']) ? $ret['error_description'] : 'yandex token error';
                self::error('获取Token出错，'.$err,'Yandex推送');
                $error = ($err).',http-code='.$status_code;
                break;
            }
            $yandex_token = [
                'access_token' => isset($ret['access_token']) ? trim($ret['access_token']) : '',
                'refresh_token' => isset($ret['refresh_token']) ? trim($ret['refresh_token']) : '',
                'expires_in' => isset($ret['expires_in']) ? ($ret['expires_in'] + current_time('U')) : 0,
                'user_id' => 0,
                'host_id' => [],
            ];

            if(empty($yandex_token['access_token']) || empty($yandex_token['expires_in'])){
                $error = 'yandex empty token ';
                self::error('获取Token出错，Token为空。 [help-0]','Yandex推送');
                break;
            }

            $yandex_token['user_id'] = self::webmasterUser($yandex_token['access_token']);
            if($yandex_token['user_id']){
                $yandex_token['host_id'] = self::webmasterHost($yandex_token['user_id'],$yandex_token['access_token']);
            }
            //$yandex_token['host_id'] = serialize($yandex_token['host_id']);
            update_option('bsl_yandex_token',$yandex_token,false);



        }while(0);

        update_option('bsl_yandex_error',$error,false);


        wp_safe_redirect(
            add_query_arg(
                'page',
                'wb_bsl#/setting-api',
                admin_url( 'admin.php' )
            )
        );
    }

    public static function webmasterUser($token)
    {
        $param = [
            'headers' => [
                'Authorization' => 'OAuth ' . $token,
                'Content-Type'  => 'application/json',
            ],
            'timeout' => 10,
            'sslverify' => false,
        ];

        $http    = wp_remote_get( 'https://api.webmaster.yandex.net/v4/user/', $param );
        $error = '';
        $user_id = 0;
        do{
            if(is_wp_error($http)){
                self::error('请求 webmaster API 出错，'.$http->get_error_message(),'Yandex推送');
                $error = 'yandex get user error,'.$http->get_error_message();
                break;
            }
            $status_code = wp_remote_retrieve_response_code( $http );
            $body = wp_remote_retrieve_body( $http );
            $ret = [];
            if($body){
                $ret = json_decode($body,true);
            }
            if($status_code !== 200){
                $err = isset($ret['error_message'])?$ret['error_message']:'yandex get user error';
                self::error('获取 webmaster 出错，'.$err,'Yandex推送');
                $error = ($err).',http-code='.$status_code;
                break;
            }
            $user_id = isset($ret['user_id']) ? $ret['user_id'] : 0;

        }while(0);

        update_option('bsl_yandex_error',$error,false);

        return $user_id;
    }

    public static function webmasterHost($user_id,$token)
    {
        $param = [
            'headers' => [
                'Authorization' => 'OAuth ' . $token,
                'Content-Type'  => 'application/json',
            ],
            'timeout' => 10,
            'sslverify' => false,
        ];

        $http    = wp_remote_get( sprintf( 'https://api.webmaster.yandex.net/v4/user/%d/hosts', $user_id ), $param );
        $error = '';
        $host = [];
        do{
            if(is_wp_error($http)){
                self::error('请求 webmaster host API 出错，'.$http->get_error_message(),'Yandex推送');
                $error = 'yandex get host error,'.$http->get_error_message();
                break;
            }
            $status_code = wp_remote_retrieve_response_code( $http );
            $body = wp_remote_retrieve_body( $http );
            $ret = [];
            if($body){
                $ret = json_decode($body,true);
            }
            if($status_code !== 200){
                $err = isset($ret['error_message'])?$ret['error_message']:'yandex get host error';
                self::error('获取 webmaster host 出错，'.$err,'Yandex推送');
                $error = ($err).',http-code='.$status_code;
                break;
            }

            $host = isset( $ret['hosts'] ) ? wp_list_pluck( $ret['hosts'], 'host_id' ) : [];

        }while(0);

        update_option('bsl_yandex_error',$error,false);

        return $host;
    }



    public static function edit_post($post_id,$post){
        self::info('yandex推送','收录推送');
        if(wp_is_post_revision($post)){
            return;
        }
        if(!get_option('wb_bsl_ver',0)){
            return;
        }
        if(!WB_BSL_Conf::check_post_type($post)){
            return;
        }

        do{
            $active = WB_BSL_Conf::cnf('yandex');
            if(!$active){
                break;
            }
            $token = get_option('bsl_yandex_token');
            if(!$token || !is_array($token)){
                break;
            }
            $post_url = get_permalink($post);
            if(!preg_match('#^https?://#',$post_url)){
                $post_url = home_url($post_url);
            }
            self::info('Yandex，推送url：','收录推送');
            self::info($post_url,'收录推送');
            $token_state = true;
            foreach(['access_token','user_id','host_id','expires_in'] as $f){
                if(!isset($token[$f]) || empty($token[$f])){
                    $token_state = false;
                    break;
                }
            }
            if(!$token_state){
                self::error('yandex token 错误，需更新token','Yandex推送');
                self::info('yandex token 错误，需更新token','收录推送');
                break;
            }
            if($token['expires_in'] < current_time('U')){
                self::error('yandex token 失效，需更新token','Yandex推送');
                self::info('yandex token 失效，需更新token','收录推送');
                break;
            }
            $yandex_host = $token['host_id'];
            if(empty($yandex_host) || !is_array($yandex_host)){
                self::error('yandex host id 为空，需要Yandex添加网站','Yandex推送');
                self::info('yandex host id 为空，需要Yandex添加网站','收录推送');
                break;
            }
            $host_id = $yandex_host[0];


            $type = 33;
            $log = WB_BSL_Utils::push_log($post_id,$type);
            if($log && $log->push_status == 1){
                self::info('已经推送过','收录推送');
                break;
            }

            if($log && current_time('timestamp') - strtotime($log->create_date) < 600){
                self::info('已经推送过','收录推送');
                break;
            }


            //webmaster ping
            $api_url = sprintf( 'https://api.webmaster.yandex.net/v4/user/%s/hosts/%s/recrawl/queue', $token['user_id'], $host_id );

            $param = array(
                'sslverify' => false,
                'timeout' => 10,
                'headers' => array(
                    'Authorization' => 'OAuth ' . $token['access_token'],
                    'Content-Type'  => 'application/json',
                ),
                'body'    => wp_json_encode(
                    array(
                        'url' => $post_url,
                    )
                ),
            );


            $ret = ['code'=>1,'desc'=>'fail'];
            do{
                $http    = wp_remote_post( $api_url, $param );
                if(is_wp_error($http)){
                    self::error('API请求出错，'.$http->get_error_message(),'Yandex推送');
                    $ret['desc'] = 'yandex ping error,'.$http->get_error_message();
                    break;
                }
                $status_code = wp_remote_retrieve_response_code( $http );
                $body = wp_remote_retrieve_body( $http );
                $data = [];
                if($body){
                    $data = json_decode( $body, true );
                }
                if(!preg_match('#^2\d+#',$status_code)){
                    $error = isset($data['error_message']) ? $data['error_message'] : 'yandex ping error';
                    $ret['desc'] = $error.',http-code='.$status_code;
                    self::error('推送出错，'.$error.' [help-0]','Yandex推送');
                    break;
                }
                $ret['code'] = 0;
                $ret['desc'] = 'success';

            }while(0);



            self::info('推送结果【'.$ret['desc'].'】','收录推送');

            WB_BSL_Utils::add_push_log($type,$post_id,$post_url,$ret);


        }while(false);


    }

}