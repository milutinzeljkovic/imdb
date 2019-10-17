<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovieReactionRequest;
use Illuminate\Support\Facades\Auth;

use App\Reaction;
use App\Movie;
use App\ReactionType;
use Illuminate\Http\Request;

class ReactionController extends Controller
{
    public function index()
    {
        return Reaction::all();
    }

    public function storeReaction(MovieReactionRequest $request)
    {
       return Reaction::updateOrCreate(
           array_merge(
                ['movie_id' => $request->validated()['movie_id']],
                ['user_id' => Auth::id()]),
                ['reaction' => $request->validated()['reaction_id']]
            );
    }

    public function getReactionCount(Request $request)
    {
        $reactionId = $request->query('reaction');
        $movieId = $request->query('movie');

        $count = Reaction::query()->where('reaction', 'like', '%'.$reactionId.'%')
            ->where('movie_id', 'like', '%'.$movieId.'%')
            ->groupBy('movie_id')->count();
        
        return $count;
    }




}
