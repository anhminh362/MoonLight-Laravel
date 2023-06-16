<?php

namespace App\Http\Controllers;

use App\Models\MovieCat;
use Illuminate\Http\Request;

class MovieCatController extends Controller
{
    protected function index(){
        $cats=MovieCat::all();
        return response()->json($cats,200);
    }
    protected function show(string $id){
        $cats = MovieCat::with('movie')->where('movie_id', $id)->get('cat_id');
        return response()->json($cats,200);
    }
    protected function store(Request $request):void{
        MovieCat::create($request->all());
    }

//    protected function destroy(string $id): void {
//        $movieCats = MovieCat::where('movie_id', $id)->get();
//
//        foreach ($movieCats as $movieCat) {
//            $movieCat->delete();
//        }
//    }
    protected function destroy(string $id): void {
        MovieCat::where('movie_id', $id)->delete();
    }
}
