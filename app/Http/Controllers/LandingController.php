<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Helpers\Curl;
use App\Helpers\Dbase;
use App\Helpers\Status;
use Session;

class LandingController extends Controller
{
    private $title = "KEJAKSAAN REPUBLIK INDONESIA";
    private $subtitle = "";

    public function index($slug= "")
    {
        $slug = config('app.slug');
        if($slug != "") {
            $uri = Curl::endpoint();
            $url = $uri .'/'.'v1/get-sitemap';
            $param = array('slug' => $slug);
            $res = Curl::requestPost($url, $param);
            
            if($res->status == true) {
                $info = $res->data->info; 
                $data['list'] = $res->data->list; 
                
                $data['slug']       = $slug;
                $data['title']      = $this->title;
                $data['subtitle']   = $this->subtitle;
                $data['pattern']    = $info->profile->satker_pattern;
                $data['is_cover']   = $info->profile->is_cover;
                $data['background'] = $info->profile->satker_background;
                $data['overlay']    = $info->profile->satker_overlay;

                Session::put('meta_url', url()->full());
                Session::put('meta_title', (($this->title != "")? $this->title : $this->title));
                Session::put('meta_keyword', Status::str_ellipsis($info->profile->satker_name, 155));
                Session::put('meta_description', Status::str_ellipsis($info->profile->satker_description, 245));

                return view('sitemap', $data, compact('info'));
            }
            else {
                return redirect('/');  
            }
        }
        else {
            $uri = Curl::endpoint();
            $url = $uri .'/'.'active/get-satker';
            $res = Curl::requestGet($url);

            if($res->status == true) {
                $data['status']  = $res->status;
                $data['message'] = $res->message;
                $data['list']    = $res->data; 
            }
            else {
                $data['list'] = array(); 
                
                Session::flash('alrt', 'error');    
                Session::flash('msgs', $res->message);   
            }

            $data['slug']       = "";
            $data['title']      = $this->title;
            $data['subtitle']   = $this->subtitle;
            $data['pattern']    = "";
            $data['background'] = "";
            Session::put('meta_url', url()->full());
            Session::put('meta_title', (($this->title != "")? $this->title : $this->title));

            $uri = Curl::endpoint();
            $url = $uri .'/'.'config/preference/get-single';
            $param = array('preference_id' => 1);
            $res = Curl::requestPost($url, $param);
            
            if($res->status == true) {
                
                $meta_keyword     = $res->data->preference_appname;
                $meta_description = $res->data->preference_appdescription;
                $meta_image       = Curl::frontUrl() .'storage/assets/uploads/preference/'. $res->data->preference_appicon;
                
                Session::put('meta_image', $meta_image);
                Session::put('meta_keyword', Status::str_ellipsis($meta_keyword, 155));
                Session::put('meta_description', Status::str_ellipsis($meta_description, 245));
            }
            else {
                Session::put('meta_keyword', (($this->title != "")? $this->title : $this->title));
                Session::put('meta_description', (($this->title != "")? $this->title : $this->title));
            }

            return view('index', $data);
        }
    }
}
