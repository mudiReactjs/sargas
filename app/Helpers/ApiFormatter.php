<?php

namespace App\Helpers;

use App\Http\Resources\ProductCollection;

class ApiFormatter {


    public static function getResponse($code, $method)
    {
        $result = [];

        if ($code == 200 and $method == 'get') {
            $result['success'] = true;
            $result['code'] = $code;
            $result['message'] = 'Data successfuly retrieve';
        } elseif($code == 201 && $method == 'post') {
            $result['success'] = true;
            $result['code'] = $code;
            $result['message'] = 'Data successfuly created';
        } elseif($code == 201 && $method == 'patch') {
            $result['success'] = true;
            $result['code'] = $code;
            $result['message'] = 'Data successfuly updated';
        } elseif($code == 200 && $method == 'delete') {
            $result['success'] = true;
            $result['code'] = $code;
            $result['message'] = 'Data successfuly deleted';
        }  else {
            $result['success'] = false;
            $result['code'] = $code;
        }

        return $result;

    }


}
