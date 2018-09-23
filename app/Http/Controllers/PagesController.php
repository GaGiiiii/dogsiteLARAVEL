<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller{
  
  public function index(){
    $title = "Welcome to Laravel.";

    // return view('pages/index', compact('title'));

    // how do we call it in view | variable
    return view('pages/index')->with('title', $title);
  }

  public function about(){
    $title = "About us.";
    return view('pages/about')->with('title', $title);
  }

  public function services(){
    $data = array(
      'title' => 'Our Services.',
      'services' => ['Web Design', 'Programming', 'SEO']
    );
    return view('pages/services')->with($data);
  }

  public function credits(){
    return view('pages/credits');
  }
}
