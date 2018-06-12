<?php

namespace App\Http\Controllers;


use App\Need;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class NeedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index($id)
    {
        //
        return Need::findOrFail($id);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create(Request $request)
    {
        //
        $Need = new Need();
        $Need->message = $request->input('message');
        $Need->price = $request->input('price');
        $Need->commodity_id = $request->input('commodity_id');
        $Need->save();
        return $Need;

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show()
    {
        //
        return Need::all();

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id, Request $request)
    {
        //
//        if ($request->input('user')->id !== $request->input('user_id')) {
//            return new Response([
//                'code' => -1,
//                'message' => '没有权限',
//                'data' => null
//            ]);
//        }


        $Need = Need::findOrFail($id);
        if ($request->has('message')) {
            $Need->message = $request->input('message');
        }
        if ($request->has('price')) {
            $Need->price = $request->input('price');
        }
        if ($request->has('commodity_id')) {
            $Need->commodity_id = $request->input('commodity_id');
        }
        $Need->save();
        return $Need;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        return Need::destroy($id);

    }
}
