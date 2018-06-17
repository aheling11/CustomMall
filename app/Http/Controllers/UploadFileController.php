<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Qcloud\Cos\Client;

class UploadFileController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $config = [
            'region' => env('COS_REGION'),
            'credentials' => [
                'appId' => env('COS_APPID'),
                'secretId' => env('COS_KEY'),
                'secretKey' => env('COS_SECRET')
            ]
        ];
        $cosClient = new Client($config);
        //上传文件


        //
        $img = $request->input(['uploaderFiles'], '');

        // 获取图片
        list($type, $data) = explode(',', $img);

        // 判断类型
        if (strstr($type, 'image/jpeg') != '') {
            $ext = '.jpg';
        } elseif (strstr($type, 'image/gif') != '') {
            $ext = '.gif';
        } elseif (strstr($type, 'image/png') != '') {
            $ext = '.png';
        }

        // 生成的文件名
        $name = time() . $ext;

        try {
            $result = $cosClient->upload(
            //bucket的命名规则为{name}-{appid} ，此处填写的存储桶名称必须为此格式
                $bucket = 'outsourcing-1256239514',
//                $bucket = 'outsourcing-wx-jingduo-1251794938',
                $key = $name,
                $body = base64_decode($data)
            );

            $img = $result->get("Location");
        } catch (\Exception $e) {
            return $e;
        }


        $res = array('img' => $img);
        return $res;
    }

}
