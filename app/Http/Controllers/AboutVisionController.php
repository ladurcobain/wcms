<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Helpers\Curl;
use App\Helpers\Dbase;
use App\Helpers\Status;
use Session;

class AboutVisionController extends Controller
{
    private $title = "Tentang Kami";
    private $subtitle = "Visi & Misi";
    private $acc_menu = 26;

    public function index($slug="")
    {
        $slug = config('app.slug');
        if($slug != "") {
            $access = Curl::getAccesssNavigationMenu($slug);
            if($access != "[]") {
                if (in_array($this->acc_menu, $access)) {
                    $uri = Curl::endpoint();
                    $url = $uri .'/'.'v1/get-about-vision';
                    $param = array(
                        'slug' => $slug,
                        'ip'   => Curl::getClientIps()
                    );
                    
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
                        
                        Session::put('meta_url', url()->full());
                        Session::put('meta_title', config('app.name') .' | '. (($this->subtitle != "")? $this->subtitle : $this->title));
                        Session::put('meta_description', Status::str_ellipsis($info->profile->satker_description, 156));
                        
                        return view('about.vision', $data, compact('info'));
                    }
                    else {
                        return redirect('/');  
                    }  
                }
                else {
                    return redirect('/');  
                }  
            }
            else {
                return redirect('/');  
            }    
        }
        else {
            return redirect('/');
        }
    }
}