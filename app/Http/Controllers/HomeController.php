<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Carbon\Carbon;
use App\Helpers\Curl;
use App\Helpers\Status;
use Session;

class HomeController extends Controller
{
    private $title = "Beranda";
    private $subtitle = "";
    private $version  = "1.2.1";

    public function index($slug="")
    {
        $slug = config('app.slug');
        if($slug != "") {
            $uri = Curl::endpoint();
            $url = $uri .'/'.'v1/get-home';
            
            $param = array(
                'slug'    => $slug,
                'version' => $this->version
            );

            $res = Curl::requestPost($url, $param);
            
            if($res->status == true) {
                $info = $res->data->info;
                
                $data['banner']     = $res->data->banner; 
                $data['unit']       = $res->data->unit;
                $data['infografis'] = $res->data->infografis; 
                $data['service']    = $res->data->service;
                $data['news']       = $res->data->news; 
                $data['slug']       = $slug;
                $data['title']      = $this->title;
                $data['subtitle']   = $this->subtitle;
                $data['pattern']    = $info->profile->satker_pattern;
                $data['is_cover']   = $info->profile->is_cover;
                $data['background'] = $info->profile->satker_background;
                $data['overlay']    = $info->profile->satker_overlay;

                $berita = array();
                foreach($res->data->news as $r) {
                    $berita[] = array(
                        "id"        => $r->id,
                        "title"     => $r->title,
                        "date"      => $r->date,
                        "category"  => $r->category,
                        "titile"    => $r->titile,
                        "text_in"   => $r->text_in,
                        "text_en"   => $r->text_en,
                        "size"      => $r->size,
                        "image"     => $r->image,
                        "path"      => $r->path,
                        "view"      => $r->view,
                        "satker"    => $r->satker
                    );
                }

                $data['berita'] = $berita;

                Session::put('meta_url', url()->full());
                Session::put('meta_title', config('app.name') .' | '. (($this->subtitle != "")? $this->subtitle : $this->title));
                Session::put('meta_description', Status::str_ellipsis($info->profile->satker_description, 156));
                
                return view('home', $data, compact('info'));
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
