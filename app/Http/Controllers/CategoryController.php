<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected function index(){
        $cat=Category::all();
        return response()->json($cat,200);
    }
    protected function store(Request $request){
        Category::create($request->all());
    }

}
