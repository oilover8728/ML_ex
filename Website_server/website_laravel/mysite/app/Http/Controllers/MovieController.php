<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function insertMovie(Request $request){

        $new_movie = new Movie();
        $new_movie -> index_id = $request['index_id'];
        $new_movie -> userId = $request['userId'];
        $new_movie -> movieId = $request['movieId'];
        $new_movie -> rating = $request['rating'];
        $new_movie -> timestamp = $request['timestamp'];

        $new_movie->save();

        return response()->json("success",200);

    }

    public function listMovie(Request $request){
        $listMovie = Movie::all();
        $returnMovieList = array();
        if(count($listMovie) != 0){
            for($i=0;$i<count($listMovie);$i++){
                $aMovie=[
                    'id'=>$listMovie[$i]->id,
                    'index_id'=>$i,
                    'userId'=>$listMovie[$i]->userId,
                    'movieId'=>$listMovie[$i]->movieId,
                    'rating'=>$listMovie[$i]->rating,
                    'timestamp'=>$listMovie[$i]->timestamp,
                    'created_at'=>$listMovie[$i]->created_at->format('Y-m-d H:i:s'),
                ];
                array_push($returnMovieList, $aMovie);
            }
            $returnMovieList = array_reverse($returnMovieList);
        }
        return view('display',["movieList" => $returnMovieList]);
    }
}
