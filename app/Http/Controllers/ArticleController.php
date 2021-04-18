<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {
        return view('articles.create');
    }

    public function store(Request $request)
    {
        if ($request->file('image')) {
            $image_name = $request->file('image')->store('images', 'public');
        }
        Article::create([
            'title'=> $request->title,
            'content'=> $request->content,
            'featured_image'=> $request->$image_name,
        ]);
        return 'Artikel berhasil disimpan';
    }

    public function show(Article $article)
    {
        //
    }

    public function edit(Article $article)
    {
        //
    }

    public function update(Request $request, Article $article)
    {
        //
    }

    public function destroy(Article $article)
    {
        //
    }
}
