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
        $pagecont = 4;
        $articles = Models\Article::latest()->paginate($pagecont);
        if (request()->has('search')) {
            $sm = strval(request('search'));
            $articles = Models\Article::where('title','like','%'.$sm.'%')->orWhere('excerpt','like','%'.$sm.'%')->latest()->paginate($pagecont);
        };
        if (request()->has('category')){
            return view('articles.all',[
                'articles'=>Models\Tag::where('name', request('category'))->firstorFail()->articles,
                'paginated'=>false
                ]);
        }
        return view('articles.all', [
            'articles'=>$articles,
            'current'=>$articles->currentPage(),
            'npages'=>$articles->lastPage(),
            'next'=>$articles->nextPageUrl()?$articles->nextPageUrl():'',
            'previous'=>$articles->previousPageUrl()?$articles->previousPageUrl():'',
            'paginated'=>true
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
        return view('articles.create',['tags'=>Models\Tag::all()]);
    }
    #4 store
    public function store()
    {
        #Models\Article::create($this->validatedAttributes());
        $this->validatedAttributes();
        $article = new Models\Article(request(['title', 'excerpt', 'body']));
        $article->user_id=1;
        $article->save();
        $article->tags()->attach(request('tags'));

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
                'body'=>'required|min:200',
                'tags'=>'exists:tags,id'
                ]);
    }

}
