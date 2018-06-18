<?php

namespace App\Http\Controllers;


use App\Bill;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\Auth;

class BillController extends Controller
{



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $Bill = new Bill();
        $Bill->commodity_id = json_encode($request->input('commodity_id'), true);
        $Bill->user_id = $request->input('user_id');
        $Bill->is_finished = $request->input('is_finished');
        $Bill->save();
        return $Bill;
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index($id)
    {
        $bill = Bill::findOrFail($id);
        $bill['user'] = $bill->user;
        $bill['commodity'] = $bill->commodity;
        return $bill;
    }
    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $bills = Bill::all();
        foreach ($bills as $key => $bill) {
            $bills[$key]['user'] = $bill->user;
            $bills[$key]['commodity'] = $bill->commodity;

        }
        return $bills;
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
        $Bill = Bill::findOrFail($id);

        if ($request->has('commodity_id')) {
            $Bill->commodity_id = $request->input('commodity_id');
        }
        if ($request->has('user_id')) {
            $Bill->user_id = $request->input('user_id');
        }
        if ($request->has('pic_ids')) {
            $Bill->is_finished = json_encode($request->input('is_finished'), true);
        }

        $Bill->save();
        return $Bill;
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
        return Bill::destroy($id);
    }

    public function list(Request $request)
    {
        $user_id = $request->input('user_id');

        return Bill::where('user_id',$user_id)
            ->get();
    }


}
