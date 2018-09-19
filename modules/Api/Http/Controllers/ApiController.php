<?php

namespace Modules\Api\Http\Controllers;

use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Illuminate\Http\Response as Res;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

abstract class ApiController extends Controller
{

    private $generalErrors = array(
        0 => 'Lỗi không xác định',
        101 => 'Phải sử dụng phương thức POST',
        102 => 'Phải sử dụng phương thức GET',
        103 => 'Không tồn tại tham số: "{PARAMETER}"',
        104 => 'Tham số: "{PARAMETER}", rỗng',
        105 => 'Sai chữ ký',
        106 => 'Data Not Found',
        107 => 'Parameter not null',
        108 => 'Authentication failed',
        404 => 'Có lỗi xảy ra'
    );

    protected $secretKey = 'Ja20w1eFR0jM3OAqOBrbpaxUunSN7ESE';

    protected $statusCode = Res::HTTP_OK;

    public function __construct()
    {

    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    public function checkKeySign(Request $request)
    {
        $params = $request->all();
        if ($params == null) {
            return $this->respondWithError(107);
        }
        if (!$request->sign) {
            return $this->respondWithError(105);
        }
        $i = 1;
        $string_sign = '';
        if ($params != null && !empty($params)) {
            unset($params['/' . $request->path()]);
            unset($params['_']);
            ksort($params);
            foreach ($params as $key => $value) {
                if ($key != 'sign') {
                    if ($i == 1) {
                        $string_sign .= $value;
                    } else {
                        $string_sign .= '|' . $value;
                    }
                    $i++;
                }

            }
        }

        $sign = sha1($string_sign . '|' . $this->secretKey);
        if ($sign != $request->sign) {
            return $this->respondWithError(105);
        }
    }

    public function respondData($errorCode, $message, $data = null)
    {
        $this->setStatusCode(Res::HTTP_OK);
        return $this->respond([
            'error_code' => $errorCode,
            'message' => $message,
            'data' => $data
        ]);

    }

    public function respondWithError($error = null, $parameter = null, $value = null)
    {
        if (is_array($parameter)) {
            $parameter = explode(', ', $parameter);
        }
        if (is_array($value)) {
            $value = explode(', ', $value);
        }
        $error = $this->getError($error, $parameter, $value, null);
        $this->setStatusCode(Res::HTTP_CREATED);
        return $this->respond([
            'error_code' => $error['id'],
            'message' => $error['message'],
            'status' => 'Failed',
        ]);
    }

    public function respond($data, $headers = [])
    {
        return \Response::json($data, $this->getStatusCode(), $headers);
    }

    public function getError($error = null, $parameter = null, $value = null)
    {

        if ($error == null) {
            $error = 0;
        }
        $errorString = $this->generalErrors[$error];

        if ($parameter !== null) {
            $errorString = str_replace('{PARAMETER}', $parameter, $errorString);
        }

        if ($value !== null) {
            $errorString = str_replace('{VALUE}', $value, $errorString);
        }
        return array('id' => $error, 'message' => $errorString);
    }

    public function getIPAddress()
    {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if (getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if (getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if (getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if (getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if (getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

    public function response($success = false, $message = null, $data = [])
    {
        return response()->json([
            'success' => $success,
            'message' => $message,
            'data' => $data
        ]);
    }

}

