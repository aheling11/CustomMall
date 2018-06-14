<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        //
        $email = $request->input('email');
        $password = $request->input('password');

        if (empty($email) || empty($password)) {
            return [
                'code' => 65535,
                'msg' => '参数缺失',
                'data' => []
            ];
        }

        $user = DB::table('users')->where('email', $email)->first();

        if (empty($user)) {
            return [
                'code' => 1,
                'token' => '',
                'message' => '请检查账号 或 密码 是否正确',
                'data' => []
            ];
        }

        if (Hash::check($password, $user->password)) {
            $user->token = md5(time() . 'quandouguo');
            DB::table('users')
                ->where([
                    ['email', '=', $email]
                ])
                ->update(['token' => $user->token]);

            return [
                'code' => 0,
                'token' => $user->token,
                'message' => 'success',
                'data' => $user
            ];
        }

        return [
            'code' => 1,
            'token' => '',
            'message' => '请检查账号 或 密码 是否正确',
            'data' => []
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $confirm_password = $request->input('confirm_password');

        if (empty($name) || empty($email) || empty($password) || empty($confirm_password)) {
            return [
                'code' => 65535,
                'msg' => '参数缺失',
                'data' => []
            ];
        }

        if ($password != $confirm_password) {
            return [
                'code' => -1,
                'msg' => '$password $confirm_password  不同',
                'data' => []
            ];
        }

        $user = DB::table('users')->where('email', $email)->first();

        if (!empty($user)) {
            return [
                'code' => 1,
                'msg' => '已注册',
                'data' => []
            ];
        }

        DB::insert(
            [
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password)
            ]
        );

        return [
            'code' => 0,
            'msg' => '成功',
            'data' => []
        ];

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        return User::destroy($id);
    }
}
