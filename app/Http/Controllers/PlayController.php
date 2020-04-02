<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Config;
use App\User;
use App\History;

class PlayController extends Controller
{
    /**
     * ゲーム画面
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $play_option = Config::get('play_option');
        return view('play', compact('play_option'));
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

        $is_pb = false;
        $score = $request->input('score');

        if (Auth::check()) {
            $user = Auth::user();
            $name = $user->name;
            if ($score > 0) {
                History::create([
                    'user_id' => $user->id,
                    'score' => $score,
                ]);
                if ($user->personal_best < $score) {
                    $user->personal_best = $score;
                    $user->save();
                    $is_pb = true;
                }
            }
            return view('result', compact('name', 'score', 'is_pb'));
        }
        if ($score > 0) {
            session([ 'score' => $score ]);
        }

        return view('result', compact('score'));
    }
}
