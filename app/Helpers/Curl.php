<?php
    namespace App\Helpers;
    
    use GuzzleHttp\Client;
    use Request;

    class Curl {

        public static function statMaintenance()
        {
            return 0;
        }   


        public static function endpoint()
        {
            $str = 'https://apiwebphada.kejagungri.info/api';//config('app.api');
            return $str;
        }   


        public static function frontUrl()
        {
            $str = config('app.cms');
            return $str;
        }

        public static function landingUrl() {
            $str = URL::to('/');
            return $str;
        }

        public static function requestPost($url, $param)
        {
            $client = new Client();

            $res = $client->request('POST', $url, [
                'form_params'     => $param,
                'connect_timeout' => 10,
                'headers'         => [
                    'X-api-key' => 'webphada'
                ],
            ]);
            
            if($res->getStatusCode() == 200) {
                return json_decode($res->getBody());
            }
            else {
                return json_decode('{"status": false, "message": "Kesalahan koneksi internal", "data": "[]"}');
            }
        }

        public static function requestGet($url)
        {
            $client = new Client();
            $res = $client->request('GET', $url, [
                'headers'         => [
                    'X-api-key' => 'webphada'
                ],
            ]);
            
            if($res->getStatusCode() == 200) {
                return json_decode($res->getBody());
            }
            else {
                return json_decode('{"status": false, "message": "Kesalahan koneksi internal", "data": "[]"}');
            }
        }

        public static function getClientIps()
        {
            return Request::ip(); 

            foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
                if (array_key_exists($key, $_SERVER) === true){
                    foreach (explode(',', $_SERVER[$key]) as $ip){
                        $ip = trim($ip); // just to be safe
                        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
                            return $ip;
                        }
                    }
                }
            }

            return request()->ip(); 
        } 

        public static function getAccesssNavigationMenu($slug) {
            $access = array();
            $uri = Curl::endpoint();
            $url = $uri .'/'.'v1/menu-access';
            $param = array('slug' => $slug);
            $res = Curl::requestPost($url, $param);

            if($res->status == true) {
                $access  = $res->data;
            }
            else {
                $access = "[]";
            }

            return $access; 
        }
    }
