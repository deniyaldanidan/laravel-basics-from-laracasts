<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function showArticle($article_id)
    {
      $arti = Article::where('id', $article_id)->first();
      return view('articles.show', ['articles'=>$arti]);
    }

    public function allArticle()
    {
      $arti = Article::paginate(2);
      $total = $arti->total();
      $current = $arti->currentPage();

      return view('articles.all', [
        "articles" => $arti,
        "total" => $total,
        "current_page" => $current
      ]);
    }
}
