<?php
/**
 * Created by PhpStorm.
 * User: DELL M4800
 * Date: 9/18/2018
 * Time: 4:55 PM
 */

namespace App\Common\Untils;


class AppotaAPI
{
    /*
     * Login normal
     */
    const NORMAL_API_KEY = '8df5229af85e2bf2c9d345f204535d3f052ae7523';

    public static function login()
    {
        return "https://api.appota.com/user/login?access_token=" . self::NORMAL_API_KEY . "&lang=vi";
    }

    public static function userInfo()
    {
        return "https://api.appota.com/game/get_user_info";
    }
}