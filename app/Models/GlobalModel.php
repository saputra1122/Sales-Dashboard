<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class GlobalModel extends Model
{
    use HasFactory;

    protected static function nav_menus($index)
    {
        $menus = [
            (object) [
                'title' => 'Beranda',
                'nav_code' => 0,
            ],
            (object) [
                'title' => 'Setting',
                'nav_code' => 1,
            ],
        ];

        return $menus[$index];
    }

    protected function currencyFormatter($value)
    {

        $value = number_format($value, 0, '.', ',');
        return $value;
    }

    protected static function format_date_front($date)
    {
        $date = date('d F Y', strtotime($date));
        return $date;
    }

    protected static function format_date_back($date)
    {
        $date = date('Y-m-d', strtotime($date));
        return $date;
    }

    protected static function do_count_specific_key_value($value, $key, array $array)
    {
        $array = (array) json_decode(json_encode($array), true);
        $arr = array_filter($array, function ($var) use ($value, $key) {
            if ($value === $var[$key]) {
                return true;
            }
        });

        return count($arr);
    }

    protected static function difference_in_days($value)
    {
        $now_date = date('Y-m-d');

        $value = strtotime($value) - strtotime($now_date);

        $day = $value / 60 / 60 / 24;

        return $day;
    }

    protected static function overlayText($value)
    {
        $value = strlen($value) > 50 ? substr($value, 0, 50) . '...' : $value;

        return $value;
    }

    protected function search_array($array, $key, $needed)
    {
        $result = [];
        foreach ($array as $val) {
            if ($val[$key] == $needed) {
                $result[] = $val;
            }
        }

        return $result;
    }

    protected function setSession($key, $value)
    {
        if (Session::has($key)) {
            Session::forget($key);
        }

        Session::put($key, $value);
    }

    protected function getSession($key)
    {
        if (Session::has($key)) {
            return Session::get($key);
        }

        return null;
    }
}
