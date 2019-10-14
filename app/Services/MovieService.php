<?php

namespace App\Services;
use App\Movie;
use App\Services\IMovieService;
use Illuminate\Support\Facades\Auth;

class MovieService implements IMovieService
{
    public function addMovie($movie)
    {
        $movie = Movie::create(array_merge($movie, ['user_id' => Auth::id()]));
        return $movie;
    }

    public function deleteMovie($movie)
    {
        return Movie::where('id',$movie->id)->delete();
    }

    public function updateMovie($movie,$values)
    {
        $movie->update($values);
        return Movie::where('user_id', Auth::id())->where('id',$movie->id)->get();
    }

}