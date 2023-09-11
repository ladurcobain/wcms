<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Helpers\Curl;
use App\Helpers\Dbase;
use App\Helpers\Status;
use Session;

class ConferenceAnnouncementController extends Controller
{
    private $title = "Siaran Pers";
    private $subtitle = "Pengumuman";
    private $acc_menu = 42;
    private $news_category = "Pengumuman";

    public function index($slug="")
    {
        $slug = config('app.slug');
        if($slug != "") {
            $access = Curl::getAccesssNavigationMenu($slug);
            if($access != "[]") {
                if (in_array($this->acc_menu, $access)) {
                    $page = request()->has('page') ? request('page') : 1;
                    $perPage = request()->has('per_page') ? request('per_page') : 10;
                    $offset = ($page * $perPage) - $perPage;
                    
                    $uri = Curl::endpoint();
                    $url = $uri .'/'.'v1/get-conference-news';
                    $param = array(
                        'ip'       => Curl::getClientIps(),
                        'limit'    => $perPage,
                        'offset'   => $offset,
                        'category' => $this->news_category,
                        'slug'     => $slug
                    );

                    $res = Curl::requestPost($url, $param);
                    
                    if($res->status == true) {
                        $info = $res->data->info; 
                        $newCollection = collect($res->data->list);
                        $results =  new LengthAwarePaginator(
                            $newCollection,
                            $res->data->total,
                            $perPage,
                            $page,
                            ['path' => request()->url()]
                        );
                        
                        $data['slug']       = $slug;
                        $data['title']      = $this->title;
                        $data['subtitle']   = $this->subtitle;
                        $data['pattern']    = $info->profile->satker_pattern;
                        $data['is_cover']   = $info->profile->is_cover;
                        $data['background'] = $info->profile->satker_background;
                        
                        Session::put('meta_url', url()->full());
                        Session::put('meta_title', config('app.name') .' | '. (($this->subtitle != "")? $this->subtitle : $this->title));
                        Session::put('meta_description', Status::str_ellipsis($info->profile->satker_description, 156));
                        
                        return view('conference.announcement.index', $data, compact('info', 'results'));
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

    public function read($id="")
    {
        $slug = config('app.slug');
        $access = Curl::getAccesssNavigationMenu($slug);
        if($access != "[]") {
            if (in_array($this->acc_menu, $access)) {
                if($id != "") {
                    $uri = Curl::endpoint();
                    $url = $uri .'/'.'v1/read-conference-news/'. $slug .'/@'. $id .'&more';
                    $res = Curl::requestGet($url);
                }
                
                if($res->status == true) {
                    $info = $res->data->info; 
                    $data['read'] = $res->data->read; 
                    
                    $data['slug']       = $slug;
                    $data['title']      = $this->title;
                    $data['subtitle']   = $this->subtitle;
                    $data['pattern']    = $info->profile->satker_pattern;
                    $data['is_cover']   = $info->profile->is_cover;
                    $data['background'] = $info->profile->satker_background;

                    Session::put('meta_url', url()->full());
                    Session::put('meta_title', config('app.name') .' | '. (($this->subtitle != "")? $this->subtitle : $this->title));
                    Session::put('meta_keyword', Status::str_ellipsis($data['read']->title, 155));
                    Session::put('meta_description', Status::str_ellipsis($data['read']->text_in, 245));
                    
                    $headline = array();
                    if (in_array(41, $access)) {
                        $uri = Curl::endpoint();
                        $url = $uri .'/'.'v1/get-conference-news-headline';
                        $param = array(
                            'ip'       => Curl::getClientIps(),
                            'limit'    => 10,
                            'offset'   => 0,
                            'slug'     => $slug,
                            'id'       => $id,
                        );

                        $res = Curl::requestPost($url, $param);
                        if($res->status == true) {
                            $headline = $res->data->list;
                        }
                    }
                    
                    $uri = Curl::endpoint();
                    $url = $uri .'/'.'v1/get-conference-news-other';
                    $param = array(
                        'ip'       => Curl::getClientIps(),
                        'limit'    => 10,
                        'offset'   => 0,
                        'slug'     => $slug,
                        'id'       => $id,
                    );

                    $res = Curl::requestPost($url, $param);
                    
                    $other = array();
                    if($res->status == true) {
                        $other = $res->data->list;
                    }
                    
                    $data['headline'] = $headline;
                    $data['other'] = $other;

                    return view('conference.announcement.read', $data, compact('info'));
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