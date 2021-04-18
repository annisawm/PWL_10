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

    public function edit($id)
    {
        $article = Article::find($id);
        return view('articles.edit', ['article' => $article]);
    }

    public function update(Request $request, $id)
    {
        $article = Article::find($id);

        $article->title = $request->title;
        $article->content = $request->content;

        if($article->featured_image && file_exists(storage_path('app/public/' . $article->featured_image))) {
            \Storage::delete('public/' . $article->featured_image);
        }
        $image_name = $request->file('image')->store('images', 'public');
        $article->featured_image = $image_name;

        $article->save();
        return 'Artikel berhasil diubah';
    }

    public function destroy(Article $article)
    {
        //
    }
}
