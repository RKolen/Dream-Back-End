<?php

namespace App\Http\Controllers;

use App\Category;
use App\Game;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    
    public function index()
    {
        $categories = category::get();

        return view('categories', compact('categories'));
    }

    public function show(Category $category)
    {
        $categories = category::get();
        $games = $category->game()->Latest()->with('category.game')->get();

        return view('welcome', compact('games', 'categories'));
    }
}
