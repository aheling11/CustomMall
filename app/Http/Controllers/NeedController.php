<?php

namespace App\Http\Controllers;


use App\Commodity;
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
        $Need->commodity_id = $request->input('commodity_id');
        $Need->price = $this->calPrice($Need->message);
        $Need->save();
        return $Need;

    }


    protected function calPrice($message)
    {
        $t = 500;
        $arr = ['Web开发','开发','网页','商城','游戏','小程序','管理','餐饮','娱乐','农业','旅游','网站','金融','区块链','H5','项目','应用','logo','优美','稳定','分布式','大数据','机器学习','人工智能','流畅','特色','吸引','流量','系统','网络','IOS','安卓','Android','android','交互','框架','整站'];

        for ($i=0; $i<sizeof($arr); $i++)
        {
            $pos = strpos($message, $arr[$i]);
            if ($pos!=false) {
                if ($i<floor(sizeof($arr)/3)) {
                    $t += 500;
                }
                if ($i>floor(sizeof($arr)/3) && $i<floor(sizeof($arr)/3*2)) {
                    $t += 1000;
                }
                if ($i>floor(sizeof($arr)/3*1) && $i<floor(sizeof($arr))) {
                    $t += 1500;
                }

            }
        }
        return $t;
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
        return Need::all();

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

        return Need::destroy($id);

    }

    public function l_ist(Request $request)
    {
        $commodity_id = $request->input('commodity_id');
        if ($commodity_id==null) {
            return Need::all();
        }
        return Need::where('commodity_id',$commodity_id)
            ->get();
    }

}
