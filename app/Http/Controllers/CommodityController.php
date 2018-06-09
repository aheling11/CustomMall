<?php

namespace App\Http\Controllers;

use App\Commodity;
use Illuminate\Http\Request;

class CommodityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
        return Commodity::findOrFail($id);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $Commodity = new Commodity();
        $Commodity->tag_ids = json_encode($request->input('tag_ids'), true);
        $Commodity->title = $request->input('title');
        $Commodity->desc = $request->input('desc');
        $Commodity->pic_ids = json_encode($request->input('pic_ids'), true);
        $Commodity->price = $request->input('price');
        $Commodity->count = $request->input('count');
        $Commodity->is_auctioneer = $request->input('is_auctioneer');
        $Commodity->user_id = $request->input('user')->id;
        $Commodity->save();
        return $Commodity;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
        return Commodity::all();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        //
        if ($request->input('user')->id !== $request->input('user_id')) {
            return new Response([
                'code' => -1,
                'message' => '没有权限',
                'data' => null
            ]);
        }
        $Commodity = Commodity::findOrFail($id);
        if ($request->has('tag_ids')) {
            $Commodity->tag_ids = json_encode($request->input('tag_ids'), true);
        }
        if ($request->has('title')) {
            $Commodity->title = $request->input('title');
        }
        if ($request->has('desc')) {
            $Commodity->desc = $request->input('desc');
        }
        if ($request->has('pic_ids')) {
            $Commodity->pic_ids = json_encode($request->input('pic_ids'), true);
        }
        if ($request->has('price')) {
            $Commodity->price = $request->input('price');
        }
        if ($request->has('count')) {
            $Commodity->count = $request->input('count');
        }
        if ($request->has('is_auctioneer')) {
            $Commodity->is_auctioneer = $request->input('is_auctioneer');
        }
        $Commodity->save();
        return $Commodity;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        return Commodity::destroy($id);
    }
}
