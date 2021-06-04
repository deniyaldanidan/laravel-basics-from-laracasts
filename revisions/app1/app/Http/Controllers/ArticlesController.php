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
        $articles = Models\Article::latest()->paginate(4);
        if (request()->has('search')) {
            $sm = strval(request('search'));
            $articles = Models\Article::where('id','like',$sm.'%')->get();
            dd($articles);
        };
        return view('articles.all', [
            'articles'=>$articles,
            'current'=>$articles->currentPage(),
            'npages'=>$articles->lastPage(),
            'next'=>$articles->nextPageUrl()?$articles->nextPageUrl():'',
            'previous'=>$articles->previousPageUrl()?$articles->previousPageUrl():''
        ]);
    }

    #2 showOne
    public function show(Models\Article $article) # alternate for Article::findOrFail($article)
    {
        return view('articles.show', [
            'article'=> $article
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
        Models\Article::create($this->validatedAttributes());
        return redirect()->route('allarts');
    }
    #5 edit
    public function edit(Models\Article $article)
    {
        return view('articles.edit',[
            'article'=>$article
        ]);
    }
    #6 update
    public function update(Models\Article $article)
    {

        $article->update($this->validatedAttributes());
        return redirect()->route('showart',['article'=>$article->id]);
    }
    #7 delete
    public function delete(Models\Article $article){
        $article->delete();
        return redirect()->route('allarts');
    }

    protected function validatedAttributes(Type $var = null)
    {
        return request()->validate([
                'title'=>'required|min:3|max:199',
                'excerpt'=>'required|min:10|max:199',
                'body'=>'required|min:200'
                ]);
    }

}
