<?php
/**
 * Created by PhpStorm.
 * User: kilingzhang
 * Date: 2018/6/17
 * Time: 19:43
 */

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class FileController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function upload(Request $request)
    {
        //
        $files = $request->file();
        return ;
    }


}