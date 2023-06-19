<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    protected function index(){
        $movie=Movie::all();
        return response()->json($movie,200);
    }
    protected function show($id){
        $movie=Movie::find($id);
        return $movie;
    }
    protected function store(Request $request){
        Movie::create($request->all());
    }
    protected function update(Request $request,$id){
        $movie=Movie::find($id);
        $movie->name=$request->input('name');
        $movie->avatar=$request->input('avatar');
        $movie->country=$request->input('country');
        $movie->description=$request->input('description');
        $movie->age_limits=$request->input('age_limits');
        $movie->trailer=$request->input('trailer');
        $movie->save();
    }
    protected  function destroy($id){
        $movie=Movie::find($id);
        $movie->delete();
    }
}
