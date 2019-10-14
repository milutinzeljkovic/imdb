<?php

namespace App\Services;

interface IMovieService 
{
    function addMovie($movie);
    function deleteMovie($movie);
    function updateMovie($movie,$values);
}