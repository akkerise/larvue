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
     * Login
     */
    const NORMAL_ACCESS_TOKEN = '8df5229af85e2bf2c9d345f204535d3f052ae7523';

    const FACEBOOK_API_KEY = 'K-A179883-U00000-BXQJVG-23753BBFDC1A61E2';

    public static function login()
    {
        return "https://api.appota.com/user/login?access_token=" . self::NORMAL_ACCESS_TOKEN . "&lang=vi";
    }

    public static function userInfo()
    {
        return "https://api.appota.com/game/get_user_info";
    }

    public static function facebook()
    {
        return "https://api.gamota.com/game/login_facebook?api_key=" . self::FACEBOOK_API_KEY . "&lang=vi";
    }
}