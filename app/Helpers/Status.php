<?php

namespace App\Helpers;

class Status
{
    public static function generateStar($val)
    {
        $string = '';
        $string .= '<div class="stars-wrapper">';

        if($val >= 5) {
            $string .= '<i class="fas fa-star" style="color: orange;"></i>';
            $string .= '<i class="fas fa-star" style="color: orange;"></i>';
            $string .= '<i class="fas fa-star" style="color: orange;"></i>';
            $string .= '<i class="fas fa-star" style="color: orange;"></i>';
            $string .= '<i class="fas fa-star" style="color: orange;"></i>';
        } 
        else if(($val >= 4.5) && ($val < 5)) {
            $string .= '<i class="fas fa-star" style="color: orange;"></i>';
            $string .= '<i class="fas fa-star" style="color: orange;"></i>';
            $string .= '<i class="fas fa-star" style="color: orange;"></i>';
            $string .= '<i class="fas fa-star" style="color: orange;"></i>';
            $string .= '<i class="fas fa-star-half" style="color: orange;"></i>';
        }  
        else if(($val >= 4) && ($val < 4.5)) {
            $string .= '<i class="fas fa-star" style="color: orange;"></i>';
            $string .= '<i class="fas fa-star" style="color: orange;"></i>';
            $string .= '<i class="fas fa-star" style="color: orange;"></i>';
            $string .= '<i class="fas fa-star" style="color: orange;"></i>';
            $string .= '<i class="fas fa-star"></i>';
        } 
        else if(($val >= 3.5) && ($val < 4)) {
            $string .= '<i class="fas fa-star" style="color: orange;"></i>';
            $string .= '<i class="fas fa-star" style="color: orange;"></i>';
            $string .= '<i class="fas fa-star" style="color: orange;"></i>';
            $string .= '<i class="fas fa-star-half" style="color: orange;"></i>';
            $string .= '<i class="fas fa-star"></i>';
        }    
        else if(($val >= 3) && ($val < 3.5)) {
            $string .= '<i class="fas fa-star" style="color: orange;"></i>';
            $string .= '<i class="fas fa-star" style="color: orange;"></i>';
            $string .= '<i class="fas fa-star" style="color: orange;"></i>';
            $string .= '<i class="fas fa-star"></i>';
            $string .= '<i class="fas fa-star"></i>';
        } 
        else if(($val >= 2.5) && ($val < 3)) {
            $string .= '<i class="fas fa-star" style="color: orange;"></i>';
            $string .= '<i class="fas fa-star" style="color: orange;"></i>';
            $string .= '<i class="fas fa-star-half" style="color: orange;"></i>';
            $string .= '<i class="fas fa-star"></i>';
            $string .= '<i class="fas fa-star"></i>';
        }  
        else if(($val >= 2) && ($val < 2.5)) {
            $string .= '<i class="fas fa-star" style="color: orange;"></i>';
            $string .= '<i class="fas fa-star" style="color: orange;"></i>';
            $string .= '<i class="fas fa-star"></i>';
            $string .= '<i class="fas fa-star"></i>';
            $string .= '<i class="fas fa-star"></i>';
        } 
        else if(($val >= 1.5) && ($val < 2)) {
            $string .= '<i class="fas fa-star" style="color: orange;"></i>';
            $string .= '<i class="fas fa-star-half" style="color: orange;"></i>';
            $string .= '<i class="fas fa-star"></i>';
            $string .= '<i class="fas fa-star"></i>';
            $string .= '<i class="fas fa-star"></i>';
        }
        else if(($val >= 1) && ($val < 1.5)) {
            $string .= '<i class="fas fa-star" style="color: orange;"></i>';
            $string .= '<i class="fas fa-star"></i>';
            $string .= '<i class="fas fa-star"></i>';
            $string .= '<i class="fas fa-star"></i>';
            $string .= '<i class="fas fa-star"></i>';
        } 
        else if(($val >= 0.5) && ($val < 1)) {
            $string .= '<i class="fas fa-star-half" style="color: orange;"></i>';
            $string .= '<i class="fas fa-star"></i>';
            $string .= '<i class="fas fa-star"></i>';
            $string .= '<i class="fas fa-star"></i>';
            $string .= '<i class="fas fa-star"></i>';
        }
        else {
            $string .= '<i class="fas fa-star"></i>';
            $string .= '<i class="fas fa-star"></i>';
            $string .= '<i class="fas fa-star"></i>';
            $string .= '<i class="fas fa-star"></i>';
            $string .= '<i class="fas fa-star"></i>';
        }

        $string .= '</div>';
        return $string;
    }

    public static function generateColor($val) {
        switch($val) {
            case 1 : 
                $string = "#734ba9";
            break;
            case 2 : 
                $string = "#2baab1";
            break;
            case 3 : 
                $string = "#0088cc";
            break;
            case 4 : 
                $string = "#e2a917";
            break;
            case 5 : 
                $string = "#e36159";
            break;
            default : 
                $string = "#EA4C89";
            break;
        }

        return $string;
    }

    public static function convertHtmlToText($str) {
        $str = strip_tags($str);
        $str = utf8_decode($str);
        $str = str_replace("&nbsp;", " ", $str);
        $str = preg_replace('/\s+/', ' ',$str);
        $str = trim($str);

        return $str;
    }

    public static function str_ellipsis($text, $length) {
        $text = strtolower($text);
        $text = Status::convertHtmlToText($text);
        if(strlen($text) > $length) {
            $str = substr($text, 0, $length) ." ...";
        }
        else {
            $str = $text;
        }

        return $str;
    }

    public static function medsosIcon($value) {
        switch($value) {
            case 1 :
                $string = '<i class="fab fa-facebook-f"></i>';
            break;
            case 2 :
                $string = '<i class="fab fa-twitter"></i>';
            break;
            case 3 :
                $string = '<i class="fab fa-instagram"></i>';
            break;
            case 4 :
                $string = '<i class="fab fa-youtube"></i>';
            break;
            case 5 :
                $string = '<i class="fab fa-linkedin"></i>';
            break;
            
            default :
                $string = '<i class="fab fa-facebook-f"></i>';
            break;
        }
        
        return $string;
    }

    public static function medsosName($value) {
        switch($value) {
            case 1 :
                $string = 'Facebook';
            break;
            case 2 :
                $string = 'Twitter';
            break;
            case 3 :
                $string = 'Instagram';
            break;
            case 4 :
                $string = 'Youtube';
            break;
            case 5 :
                $string = 'Linkedin';
            break;
            
            default :
                $string = 'Facebook';
            break;
        }

        return $string;
    }

    public static function medsosType($value) {
        switch($value) {
            case 'Facebook' :
                $string = '1';
            break;
            case 'Twitter' :
                $string = '2';
            break;
            case 'Instagram' :
                $string = '3';
            break;
            case 'Youtube' :
                $string = '4';
            break;
            case 'Linkedin' :
                $string = '5';
            break;
            
            default :
                $string = '1';
            break;
        }

        $icon = Status::medsosIcon($string);
        return $icon;
    }
}
