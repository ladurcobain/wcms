<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Helpers\Curl;
use App\Helpers\Dbase;
use App\Helpers\Status;
use Session;

class ArchivePhotoController extends Controller
{
    private $title = "Arsip Pemberkasan";
    private $subtitle = "Galeri Foto";
    private $acc_menu = 52;

    public function index($slug = "")
    {
        $slug = config('app.slug');
        if ($slug != "") {
            $access = Curl::getAccesssNavigationMenu($slug);
            if ($access != "[]") {
                if (in_array($this->acc_menu, $access)) {
                    $page = request()->has('page') ? request('page') : 1;
                    $perPage = request()->has('per_page') ? request('per_page') : 15;
                    $offset = ($page * $perPage) - $perPage;

                    $uri = Curl::endpoint();
                    $url = $uri . '/' . 'v1/get-archive-photo';
                    $param = array(
                        'ip'      => Curl::getClientIps(),
                        'limit'   => $perPage,
                        'offset'  => $offset,
                        'slug'    => $slug
                    );

                    $res = Curl::requestPost($url, $param);

                    if ($res->status == true) {
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
                        $data['overlay']    = $info->profile->satker_overlay;

                        Session::put('meta_url', url()->full());
                        Session::put('meta_title', config('app.name') . ' | ' . (($this->subtitle != "") ? $this->subtitle : $this->title));
                        Session::put('meta_description', Status::str_ellipsis($info->profile->satker_description, 156));

                        return view('archive.photo', $data, compact('info', 'results'));
                    } else {
                        return redirect('/');
                    }
                } else {
                    return redirect('/');
                }
            } else {
                return redirect('/');
            }
        } else {
            return redirect('/');
        }
    }
}
