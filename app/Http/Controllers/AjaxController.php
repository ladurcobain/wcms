<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Helpers\Curl;
use Session;

class AjaxController extends Controller
{

    public function set_flag($val)
    {
        Session::put('flag', $val);
        return true;
    }

    public function set_newsletter(Request $request)
    {
        $slug = config('app.slug');
        //$slug  = $request->slug;
        $email = $request->newsletterEmail;

        if (($slug != "") && ($email != "")) {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $uri = Curl::endpoint();
                $url = $uri . '/' . 'v1/set-newsletter';
                $param = array(
                    'slug'  => $slug,
                    'email' => $email
                );

                $res = Curl::requestPost($url, $param);

                $status  = $res->status;
                $message = $res->message;
            } else {
                $status  = false;
                $message = "Kesalahan format surel";
            }
        } else {
            $status  = false;
            $message = "Form isian harap di lengkapi";
        }

        $data = array(
            "status"  => $status,
            "message" => $message,
        );

        return $data;
    }

    public function set_contactus(Request $request)
    {
        $slug = config('app.slug');
        //$slug    = $request->slug;
        $name    = $request->name;
        $email   = $request->email;
        $subject = $request->subject;
        $message = $request->message;
        $module  = $request->module;

        if (($slug != "") && ($name != "") && ($email != "") && ($subject != "") && ($message != "")) {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $uri = Curl::endpoint();
                $url = $uri . '/' . 'v1/set-contactus';
                $param = array(
                    'slug'    => $slug,
                    'name'    => $name,
                    'email'   => $email,
                    'subject' => $subject,
                    'message' => $message
                );

                $res = Curl::requestPost($url, $param);

                $status  = 'success';
                $message = $res->message;
            } else {
                $status  = "error";
                $message = "Kesalahan format surel";
            }
        } else {
            $status  = "error";
            $message = "Form isian harap di lengkapi";
        }

        $data = array(
            "status"  => $status,
            "message" => $message,
        );

        Session::flash('alrt', $status);
        Session::flash('msgs', $res->message);

        if ($module == "home") {
            return redirect()->route('home.index');
        } else {
            return redirect()->route('contactus.index');
        }
    }

    public function set_rating(Request $request)
    {
        $slug = config('app.slug');
        //$slug        = $request->slug;
        $value       = $request->value;
        $description = $request->description;

        if ($slug != "") {
            $uri = Curl::endpoint();
            $url = $uri . '/' . 'v1/set-rating';
            $param = array(
                'slug'        => $slug,
                'ip'          => Curl::getClientIps(),
                'value'       => (($value == "") ? 0 : $value),
                'description' => $description,
            );

            $res = Curl::requestPost($url, $param);

            $status  = 'success';
            $message = $res->message;
        } else {
            $status  = "error";
            $message = "Form isian harap di lengkapi";
        }

        $data = array(
            "status"  => $status,
            "message" => $message,
        );

        return $data;
    }

    public function process_rating(Request $request)
    {
        $slug = config('app.slug');
        //$slug        = $request->slug;
        $value       = $request->value;
        $description = $request->description;

        if ($slug != "") {
            $uri = Curl::endpoint();
            $url = $uri . '/' . 'v1/set-rating';
            $param = array(
                'slug'        => $slug,
                'ip'          => Curl::getClientIps(),
                'value'       => (($value == "") ? 0 : $value),
                'description' => $description,
            );

            $res = Curl::requestPost($url, $param);

            $status  = 'success';
            $message = $res->message;
        } else {
            $status  = "error";
            $message = "Form isian harap di lengkapi";
        }

        $data = array(
            "status"  => $status,
            "message" => $message,
        );

        Session::flash('alrt', $status);
        Session::flash('msgs', $res->message);

        return redirect()->route('home.index');
    }
}
