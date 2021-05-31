<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestsController extends Controller
{
    public function show($id){
        $tests = [
            1 => "My-First-POST",
            2 => "My-Second-Post"
        ];
        
        if (! array_key_exists($id, $tests)) {
            abort(404, "Sorry not found");
        }
    
        return $tests[$id];
    }
}
