<?php

namespace App\Common\Gamota;

class RequestApi
{

    private static $_secretKey = 'Ja20w1eFR0jM3OAqOBrbpaxUunSN7ESE';

    public static function create($url, $params = array(), $method = "POST")
    {
        $fields = '';
        if (is_array($params) && $params) {
            foreach ($params as $key => $value) {
                if ($fields != '')
                    $fields .= '&';
                $fields .= $key . "=" . $value;
            }
            if ($method == 'GET')
                $url = $url . '?' . $fields;
        }
        $ch = curl_init($url);
        if ($method == 'POST') {
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        }
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

        $request_headers = array();
        curl_setopt($ch, CURLOPT_HTTPHEADER, $request_headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5); //Time out 5s
        curl_setopt($ch, CURLOPT_USERPWD, "h5gamota:developer");
        $result = curl_exec($ch);
        $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if (curl_error($ch))
            return false;
        if ($status != 200) {
            curl_close($ch);
            return false;
        }
        curl_close($ch);
        return $result;
    }

    public static function checkHttpStatus($url, $params = array(), $method = "POST")
    {
        $fields = '';
        if (is_array($params) && $params) {
            foreach ($params as $key => $value) {
                if ($fields != '')
                    $fields .= '&';
                $fields .= $key . "=" . $value;
            }
            if ($method == 'GET')
                $url = $url . '?' . $fields;
        }
        $ch = curl_init($url);
        if ($method == 'POST') {
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        }
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

        $request_headers = array();
        curl_setopt($ch, CURLOPT_HTTPHEADER, $request_headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5); //Time out 5s
        curl_setopt($ch, CURLOPT_USERPWD, "h5gamota:developer");
        $result = curl_exec($ch);

        $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        return $status;
    }

    public static function createSignature($api_params = array())
    {
        $i = 1;
        $signValue = '';
        if ($api_params != null && !empty($api_params)) {
            ksort($api_params);
            foreach ($api_params as $value) {
                if ($i == 1) {
                    $signValue = $value;
                } else {
                    $signValue .= '|' . $value;
                }
                $i++;
            }
        }
        $sign = sha1($signValue . '|' . self::$_secretKey);
        return $sign;
    }

}
