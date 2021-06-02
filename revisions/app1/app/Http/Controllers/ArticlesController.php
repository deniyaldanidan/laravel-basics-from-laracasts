<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models;


class ArticlesController extends Controller
{
    public function show($article)
    {
        return view('articles.show', [
            'article'=> Models\Article::find($article)
        ]);
    }

    public function all()
    {
        $articles = Models\Article::paginate(3);
        return view('articles.all', [
            'articles'=>$articles,
            'current'=>$articles->currentPage(),
            'npages'=>$articles->lastPage(),
            'next'=>$articles->nextPageUrl()?$articles->nextPageUrl():'',
            'previous'=>$articles->previousPageUrl()?$articles->previousPageUrl():''
        ]);
    }
}
