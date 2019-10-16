<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Movie;
use App\Http\Requests\MovieStoreRequest;
use DB;
use App;
use App\Services\IMovieService;

class MovieController extends Controller
{
    private $_movieService;

    public function __construct(IMovieService $movieService)
    {
        $this->_movieService = $movieService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $genre = $request->query('genre');
        $queryBuilder = Movie::query()
            ->with('genre');
        if ($genre != null )
        {
            $queryBuilder->whereHas('genre', function ($query) use ($genre) {
                $query->where('name', 'like', '%'.$genre.'%');
            })->toSql();;
        }
        
        return $queryBuilder->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MovieStoreRequest $request)
    {
        return $this->_movieService->addMovie($request->validated());
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Movie $movie)
    {
        return $movie;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MovieStoreRequest $request, Movie $movie)
    {
        $values = $request->validated();
        return $this->_movieService->updateMovie($movie,$values);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        return $this->_movieService->deleteMovie($movie);
    }
}
