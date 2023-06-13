<?php

namespace App\Http\Controllers;

use App\Models\MovieCat;
use Illuminate\Http\Request;

class MovieCatController extends Controller
{
    protected function index(){
        $cats=MovieCat::all();
        return response()->json(['movieCat'=>$cats],200);
    }
    protected function show(string $id){
        $cats = MovieCat::with('movie')->where('movie_id', $id)->get();
        return response()->json([
            'movieCat'=>$cats
        ],200);
    }
    protected function store(Request $request){
        MovieCat::create($request->all());
    }
}
