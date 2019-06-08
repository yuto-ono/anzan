<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\History;

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

        $score = $request->input('score');

        if (Auth::check()) {
            $user = Auth::user();
            $name = $user->name;
            History::create([
                'user_id' => $user->id,
                'score' => $score,
            ]);
        }
        else {
            session([ 'score' => $score ]);
        }

        return view('result', compact('name', 'score'));
    }
}
