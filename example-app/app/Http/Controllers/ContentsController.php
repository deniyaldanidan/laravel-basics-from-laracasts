<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContentsController extends Controller
{
    public function show($content)
    {
      return view("index", ["somethin" => $content]);
    }
};
