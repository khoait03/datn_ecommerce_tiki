<?php

namespace App\Http\Controllers;

use App\Models\CategoryPost;
use App\Models\Post;


class CategoryPostController extends Controller
{
    public function postByCategory($id)
    {
        $categoryAll = CategoryPost::all();

        $category = CategoryPost::find($id);

        $postByCategory = Post::with('user')
            ->where('category_post_id', '=', $category->id)
            ->latest()
            ->limit(9)
            ->get();


        return view('layouts.post-by-category', [
            'categoryAll' => $categoryAll,
            'category' => $category,
            'postByCategory' => $postByCategory,
        ]);
    }
}
