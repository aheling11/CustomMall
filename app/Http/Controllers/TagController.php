<?php

namespace App\Http\Controllers;


use App\Commodity;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;


class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index($id)
    {
        //
        return Tag::findOrFail($id);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create(Request $request)
    {
        //
        $Tag = new Tag();

        $Tag->message = $request->input('message');

        $Tag->save();
        return $Tag;
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
        return Tag::all();

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
        if ($request->input('user')->id !== $request->input('user_id')) {
            return new Response([
                'code' => -1,
                'message' => '没有权限',
                'data' => null
            ]);
        }
        $Tag = Tag::findOrFail($id);

        if ($request->has('message')) {
            $Tag->message = $request->input('message');
        }

        $Tag->save();
        return $Tag;

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
        //
        return Tag::destroy($id);

    }


    /**
     * 查询某标签id下所有商品.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function allcommodities($id)
    {

        $all_commodities = DB::table('commodities')
            ->orderBy('updated_at','desc')
            ->get()
            ->toArray();
        $all_tag_commodites = array();

        $tags = DB::table('tags')
            ->get()
            ->toArray();
        $tags = json_decode(json_encode($tags), true);

        $users = DB::table('users')
            ->get()
            ->toArray();
        $users = json_decode(json_encode($users), true);

        foreach ($all_commodities as $key => $commodity_t) {


            $array = json_decode(json_encode($commodity_t), true);
            $array['tag_name'] = $tags[$id]['message'];
            //加入username进array
            $array['username'] = $users[$array['user_id']]['name'];

            $ids_array = json_decode($array['tag_ids']);
            //遍历一边ids_array，将id转化成名字
            $tag_id_names = array();

            foreach ($ids_array as $tag_id) {
                $tag_id_names[] = $tags[$tag_id-1]['message'];
            }
            $array['tag_ids_name'] = $tag_id_names;
            foreach ($ids_array as $tag_id) {
                if ($tag_id == $id) {

                    $all_tag_commodites[] = $array;
                }
            }
        }
        return $all_tag_commodites;

    }

    /**
     * 查询所有标签下的所有商品.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function alltagscommodities()
    {
        $result = array();
        $tags = DB::table('tags')
            ->get()
            ->toArray();
        $tags = json_decode(json_encode($tags), true);

        for ($i=0; $i<sizeof($tags); $i++)
        {
            $result[$i]['tag_name'] = $tags[$i]['message'];
            $result[$i]['details'] = $this->allcommodities($i);

        }
        return $result;
    }
}
