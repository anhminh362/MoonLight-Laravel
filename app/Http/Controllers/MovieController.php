<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    protected function index(){
        $movie=Movie::all();
        return response()->json(['movie'=>$movie],200);
    }
    protected function show($id){
        $movie=Movie::find($id);
        return $movie;
    }
    protected function update(Request $request,$id){

//        $validatedData = $request->validate([
//            'name' => 'required',
//            'avatar' => 'required',
//            'county' => 'required',
//            'description' => 'required',
//        ]);
        $movie=Movie::find($id);
        $movie->name=$request->input('name');
        $movie->avatar=$request->input('avatar');
        $movie->county=$request->input('county');
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
