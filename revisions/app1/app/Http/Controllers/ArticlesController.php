<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models;


class ArticlesController extends Controller
{
    #1 all
    public function index()
    {
        return view('home',[
            'articles'=>Models\Article::latest()->take(3)->get()
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

    #2 showOne
    public function show($article)
    {
        return view('articles.show', [
            'article'=> Models\Article::find($article)
        ]);
    }

    #3 create
    public function create()
    {
        return view('articles.create');
    }
    #4 store
    public function store()
    {
        dd(request()->all());
    }
    #5 edit
    #6 update
    #7 delete

}
