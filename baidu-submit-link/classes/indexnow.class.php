<?php

/**
 * Indexnow推送
 * Class WB_BSL_Inexnow
 */

class WB_BSL_Inexnow extends WB_BSL_Base
{
    public static function init(){

        $cnf = WB_BSL_Conf::cnf(null);

        if(!$cnf['indexnow'] || empty($cnf['indexnow_key'])){
            return;
        }
        add_action('parse_request',array(__CLASS__,'parse_request'));
        //add_action('wp_insert_post',array(__CLASS__,'edit_post'),91,2);
        add_action('wp_insert_post', [__CLASS__,'wb_push_post'], 91, 2);
        add_action('wb_push_post',array(__CLASS__,'edit_post'),91,2);

    }

    public static function parse_request($wp)
    {
        $cnf = WB_BSL_Conf::cnf(null);
        if ( $wp->request !== $cnf['indexnow_key'] . '.txt' ) {
            return;
        }
        if(!get_option('wb_bsl_ver',0)){
            return;
        }
        header( 'Content-Type: text/plain' );
        header( 'X-Robots-Tag: noindex' );
        status_header( 200 );
        echo esc_html( $cnf['indexnow_key'] );
        exit(0);

    }

    public static function edit_post($post_id,$post){
        WB_BSL_Utils::run_log('indexnow推送','收录推送');
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
            $active = WB_BSL_Conf::cnf('indexnow');
            if(!$active){
                break;
            }
            $key = WB_BSL_Conf::cnf('indexnow_key');
            if(!$key){
                break;
            }
            $search = WB_BSL_Conf::cnf('indexnow_type');
            if(empty($search) || !is_array($search)){
                break;
            }

            $type = 32;
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


            //https://api.indexnow.org/indexnow
            //https://www.bing.com/indexnow
            //https://search.seznam.cz/indexnow
            //https://yandex.com/indexnow
            $api_list = [
                'indexnow'=>'https://api.indexnow.org/indexnow',
                'bing'=>'https://www.bing.com/indexnow',
                'seznam'=>'https://search.seznam.cz/indexnow',
                'yandex'=>'https://yandex.com/indexnow',
            ];
            $errors = [];
            $fail = 1;
            foreach($search as $s){
                if(isset($api_list[$s])){
                    WB_BSL_Utils::run_log($s.'，推送url：','收录推送');
                    WB_BSL_Utils::run_log($post_url,'收录推送');
                    $state = self::push($key,$api_list[$s],$post_url);
                    if($state[0]){
                        $errors[$s] = $state[1];
                    }else{
                        $fail = 0;
                    }
                }
            }
            $ret = [
                'code'=>$fail,
                'desc' => $errors?implode('，',$errors):'success',
            ];

            WB_BSL_Utils::run_log('推送结果【'.$ret['desc'].'】','收录推送');

            WB_BSL_Utils::add_push_log($type,$post_id,$post_url,$ret);


        }while(false);

    }

    public static function push($key,$api,$post_url)
    {
        $args = array(
            'timeout' => 5,
            'sslverify' => false,
            'body'    => wp_json_encode(
                array(
                    'host'    => wp_parse_url( get_home_url(), PHP_URL_HOST ),
                    'key'     => $key,
                    'urlList' => array($post_url),
                )
            ),
            'headers' => [
                'Content-Type' => 'application/json',
            ],
        );

        $response    = wp_remote_post( $api, $args );
        if(is_wp_error($response)){
            self::error('接口请求失败，'.$response->get_error_message(),'Indexnow推送');
            return [1,$response->get_error_message()];
        }
        $status_code = wp_remote_retrieve_response_code( $response );
        if($status_code !== 200){
            /*$body = trim(wp_remote_retrieve_body( $response ));
            $data = [];
            if($body){
                $data = json_decode($body,true);
            }*/
            $msg  = [
                202=>'URL received. IndexNow key validation pending.',
                400=>'Invalid format',
                403=>'In case of key not valid (e.g. key not found, file found but key not in the file)',
                422=>'In case of URLs which don’t belong to the host or the key is not matching the schema in the protocol',
                429=>'Too Many Requests (potential Spam)',
            ];
            $err = $msg[$status_code] ? $msg[$status_code] : 'api error,response code['.$status_code.']';
            self::error($err,'Indexnow推送');
            return [1,$err];
        }

        return [0,'success'];
    }

}