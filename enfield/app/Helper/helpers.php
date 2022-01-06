<?php

use Illuminate\Support\Facades\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Categories;

/**
 * get initials of a string
 */
if (!function_exists('initials')) {
    /**
     * Get initials of a string
     * @param $string
     * @param string $glue
     * @return string
     */
    function initials($string, $glue = ' ')
    {
        $ret = [];
        $exploded = explode(' ', $string);

        if (is_array($exploded)) {
            foreach ($exploded as $word) {
                $ret[] = strtoupper($word[0]);
            }
            return implode($glue, $ret);
        }

        return $string;

    }
}

function isActiveRoute($route, $output = "active")
{
    if (Route::currentRouteName() == $route) {
        return $output;
    }

}

function getCurrentTimezoneTime($date)
{
    if(!\Session::has('riders_admin_timezone')){
        \Session::put('riders_admin_timezone', 'Asia/Kolkata');
    }
    $timezone = \Session::get('riders_admin_timezone');
    $date = Carbon::createFromFormat('Y-m-d H:i:s', $date, 'UTC')
    ->setTimezone($timezone);
    return date("jS M Y g:i A", strtotime($date));
}

function getUTCTimezoneTime($date)
{
    if(!\Session::has('riders_admin_timezone')){
        \Session::put('riders_admin_timezone', 'Asia/Kolkata');
    }
    $timezone = \Session::get('riders_admin_timezone');
    $date = Carbon::createFromFormat('Y-m-d H:i:s', $date, $timezone)
    ->setTimezone('UTC');
    return date("Y-m-d H:i:s", strtotime($date));
}

function areActiveRoutes(array $routes, $output = "active")
{
    foreach ($routes as $route) {
        if (Route::currentRouteName() == $route) {
            return $output;
        }

    }
}

function areActiveDynamicRoutes(array $routes, $output = "active")
{
    foreach ($routes as $route) {
        if (strpos(Request::url(), $route) !== false) {
            return $output;
        }

    }
}

function checkEmail($email) {
    $find1 = strpos($email, '@');
    $find2 = strpos($email, '.');
    return ($find1 !== false && $find2 !== false && $find2 > $find1);
 }
