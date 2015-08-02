<?php

namespace App\Http\Controllers;

use App\Post;
use Carbon\Carbon;

use App\Http\Requests;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::where('published_at', '<=', Carbon::now())
            ->orderBy('published_at', 'desc')
            // call the blog.php helper file for pagination
            ->paginate(config('blog.posts_per_page'));

        return view('blog.index', compact('posts'));
    }



    public function showPost($slug)
    {
        /* Adding a dynamic 'where' to your Eloquent query
          whereSlug() is the same as -> Results in ...WHERE `slug` = 'slug'...
        */
        $post = Post::whereSlug($slug)->firstOrFail();

        return view('blog.post')->withPost($post);
    }
}