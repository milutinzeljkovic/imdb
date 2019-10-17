<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovieReactionRequest;
use DB;

use App\Reaction;
use App\Movie;
use App\ReactionType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ReactionController extends Controller
{
    public function index()
    {
        return Reaction::all();
    }

    public function storeReaction(MovieReactionRequest $request)
    {
        $reaction = Reaction::updateOrCreate(
           array_merge(
                ['movie_id' => $request->validated()['movie_id']],
                ['user_id' => Auth::id()]),
                ['reaction' => $request->validated()['reaction_id']]
            );
        
        $movieId = $request->validated()['movie_id'];
        $reactions = Movie::find($movieId)->reactions->groupBy(function ($reaction) {
            return $reaction->reaction;
        });
        return $reactions;
    }

    public function getReactionCount(Request $request)
    {
        $movieId = $request->query('movie');

        $types = ReactionType::all();

        $reactions = Movie::find($movieId)->reactions->groupBy(function ($reaction) {
            return $reaction->reaction;
        });
        return $reactions;
       /* return $types->map(function($type) use ($reactions) {
            return [$type->reaction_name => $reactions[(string)($type->id)]];
        });*/

    }

    public function getMyReaction(Request $request)
    {
        $movieId = $request->query('movie');
        return Reaction::where('movie_id', $movieId)
        ->where('user_id', Auth::id())->get();
    }



}
