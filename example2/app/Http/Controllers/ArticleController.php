<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function showArticle(Article $article)
    {
      // remember wildcard-name should mach up with the variable name
      //$arti = Article::find($article_id);
      return view('articles.show', ['articles'=>$article]);
    }

    public function allArticle()
    {
      $arti = Article::latest('updated_at')->paginate(3);
      $total = $arti->total();
      $current = $arti->currentPage();

      return view('articles.all', [
        "articles" => $arti,
        "total" => $total,
        "current_page" => $current
      ]);
    }

    public function create()
    {
      return view("articles.create");
    }

    public function store()
    {

/*
      request()->validate([
        "title"=>["required", 'min:3', 'max:100'],
        "excerpt"=>'required',
        'body'=>['required','min:10']
      ]);

      $article = new Article;
    //  dump(request()->all());
      $article->title = request('title');
      $article->excerpt = request('excerpt');
      $article->body = request('body');
      $article->save();
*/
      Article::create($this->validateArticle());

      return redirect(route('articles.all'));

    }

    public function editArticle(Article $article)
    {
      //$article = Article::findorFail($article_id);
      return view('articles.edit', ['article'=>$article]);
    }

    public function updateArticle(Article $article)
    {
/*
      request()->validate([
        "title"=>["required", 'min:3', 'max:100'],
        "excerpt"=>'required',
        'body'=>['required','min:10']
      ]);

    //  $article = Article::find($article_id);
    //  dump(request()->all());
      $article->title = request('title');
      $article->excerpt = request('excerpt');
      $article->body = request('body');
      $article->save();
*/

      $article->update($this->validateArticle());

      return redirect(route('articles.all'));

    }

    protected function validateArticle()
    {
      return request()->validate([
        "title"=>["required", 'min:3', 'max:100'],
        "excerpt"=>'required',
        'body'=>['required','min:10']
      ]);
    }

}
