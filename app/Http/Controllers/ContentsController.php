<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Carbon\Carbon;
use App\Helpers\Curl;
use App\Helpers\Status;
use Session;

class ContentsController extends Controller
{
    private $title = "Pencarian";
    private $subtitle = "";

    public function index($slug="") {
		// unset session
		Session::forget('q');
        $slug = config('app.slug');
        if($slug != "") {
            return redirect()->route('contents.search', ['slug' => $slug]);
        }
        else {
            return redirect('/');
        }
	}

    public function search($slug="")
    {
        $q = Session::get('q');   
        $data['q'] = $q;
        
        if($slug != "") {
            $page = request()->has('page') ? request('page') : 1;
            $perPage = request()->has('per_page') ? request('per_page') : 10;
            $offset = ($page * $perPage) - $perPage;
            
            $uri = Curl::endpoint();
            $url = $uri .'/'.'v1/get-search';
            $param = array(
                'limit'   => $perPage,
                'offset'  => $offset,
                'slug'    => $slug,
                'keyword' => (($q == null)?"":$q),
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
                
                return view('search', $data, compact('info', 'results'));
            }
            else {
                return redirect('/');  
            }    
        }
        else {
            return redirect('/');
        }
    }

    public function filter(Request $request)
    {
        if($request->has('_token')) {
            $q = $request->q;
            Session::put('q', $q); 
            
            $slug = $request->slug;
            return redirect()->route('contents.search', ['slug' => $slug]);
        } else {
            return redirect()->route('contents.index');
        }
    }
}
