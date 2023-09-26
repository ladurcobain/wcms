<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Helpers\Curl;
use App\Helpers\Dbase;
use App\Helpers\Status;
use Session;

class ArchiveRegulationController extends Controller
{
    private $title = "Arsip Pemberkasan";
    private $subtitle = "Peraturan";
    private $acc_menu = 51;

    public function index($slug="")
    {
        $slug = config('app.slug');
        if($slug != "") {
            $access = Curl::getAccesssNavigationMenu($slug);
            if($access != "[]") {
                if (in_array($this->acc_menu, $access)) {
                    $page = request()->has('page') ? request('page') : 1;
                    $perPage = request()->has('per_page') ? request('per_page') : 8;
                    $offset = ($page * $perPage) - $perPage;
                    
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => 'https://jdih.kejaksaan.go.id/api/apiwcms.php?page='.$page,
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'GET',
                        CURLOPT_HTTPHEADER => array(
                            'x-access-token: 38bf8bd945abb3df355a6d87c8a09102fa8076c076e5f917bac771407ff726b0',
                            'Cookie: PHPSESSID=90835468c22ce97ccdb53e24b80ebc47; _csrf=46bbea38a53a69f494ea6191b3b17a7cf2c9df7134c51556b7c2149a4913336ca%3A2%3A%7Bi%3A0%3Bs%3A5%3A%22_csrf%22%3Bi%3A1%3Bs%3A32%3A%22hiHyS0fffFHezVu4-w0Dv8GDPMGCykoW%22%3B%7D'
                        ),
                    ));

                    $response = curl_exec($curl);
                    $resp = json_decode($response); 
                    
                    $newCollection = collect($resp->data);
                    $results =  new LengthAwarePaginator(
                        $newCollection,
                        $resp->total,
                        $perPage,
                        $page,
                        ['path' => request()->url()]
                    );
                    
                    $data['slug']       = $slug;
                    $data['title']      = $this->title;
                    $data['subtitle']   = $this->subtitle;
                    
                    $uri = Curl::endpoint();
                    $url = $uri .'/'.'v1/get-sitemap';
                    $param = array('slug' => $slug);
                    $res = Curl::requestPost($url, $param);
                    
                    if($res->status == true) {
                        $info = $res->data->info; 

                        Session::put('meta_keyword', Status::str_ellipsis($info->profile->satker_name, 155));
                        Session::put('meta_description', Status::str_ellipsis($info->profile->satker_description, 245));

                        Session::put('meta_url', url()->full());
                        Session::put('meta_title', config('app.name') .' | '. (($this->subtitle != "")? $this->subtitle : $this->title));
                        
                        $data['pattern']    = $info->profile->satker_pattern;
                        $data['is_cover']   = $info->profile->is_cover;
                        $data['background'] = $info->profile->satker_background;
                        $data['overlay']    = $info->profile->satker_overlay;

                        return view('archive.regulation', $data, compact('info', 'results'));
                    }
                    else {
                        return redirect('/');  
                    }
                    

                    /*
                    $uri = Curl::endpoint();
                    $url = $uri .'/'.'v1/get-archive-regulation';
                    $param = array(
                        'ip'      => Curl::getClientIps(),
                        'limit'   => $perPage,
                        'offset'  => $offset,
                        'slug'    => $slug
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

                        Session::put('meta_url', url()->full());
                        Session::put('meta_title', config('app.name') .' | '. (($this->subtitle != "")? $this->subtitle : $this->title));
                        Session::put('meta_description', Status::str_ellipsis($info->profile->satker_description, 156));
                        
                        return view('archive.regulation', $data, compact('info', 'results'));
                    }
                    else {
                        return redirect('/');  
                    }  
                    */  
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
