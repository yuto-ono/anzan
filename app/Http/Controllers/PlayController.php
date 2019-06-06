<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlayController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * ゲーム画面
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('play');
    }

    /**
     * 結果発表
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function result(Request $request)
    {
        if ( !$request->filled('score') ) {
            abort(400);
        }

        return view('result', $request->only('score'));
    }
}
