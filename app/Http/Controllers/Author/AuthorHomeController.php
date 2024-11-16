<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthorHomeController extends Controller
{
    public function index()
    {
        $total_news = Post::where('author_id',Auth::user()->id)->count();
        return view('author.home', compact('total_news'));
    }
}
