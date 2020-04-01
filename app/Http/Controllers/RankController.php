<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\History;

class RankController extends Controller
{
    /**
     * ランキング
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $items_per_page = 10;

        $ranking_query = User::where('personal_best', '>', 0)
            ->orderBy('personal_best', 'desc');

        $ranking = $ranking_query->simplePaginate( $items_per_page );

        if ($ranking->isEmpty()) {
            abort(404);
        }

        $page = (int)$request->input('page', 1);

        if ($page === 1) {
            $rank = 1;
            $index = 0;
            $old_score = 0;
        }
        else {
            $old_score = $ranking->first()->personal_best;
            $rank = User::where('personal_best', '>', $old_score)->count();
            $rank++;
            $index = $items_per_page * ($page - 1);
        }

        foreach ($ranking as $player) {
            $index++;
            if ($player->personal_best !== $old_score) {
                $old_score = $player->personal_best;
                $rank = $index;
            }
            $player->rank = $rank;
        }

        if (Auth::check()) {
            $user = Auth::user();
            if ($user->personal_best) {
                $user_rank = User::where('personal_best', '>', $user->personal_best)->count();
                $user_rank++;
            }
            $ranking_count = $ranking_query->count();

            return view('rank', compact('ranking', 'user', 'user_rank','ranking_count'));
        }

        return view('rank', compact('ranking'));
    }
}
