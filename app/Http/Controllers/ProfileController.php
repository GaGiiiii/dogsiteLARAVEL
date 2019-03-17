<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Dog;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
      $this->middleware('auth', [
        'except' => ['profile']
      ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
      $user_id = auth()->user()->id;
      $user = User::find($user_id);
      $dogs = Dog::all();
      $data = [
        'user' => $user,
        'dogs' => $dogs
      ];

      return view('profile')->with('data', $data);
    }

    public function profile($id){
      $user = User::find($id);
      $dogs = Dog::all();
      $data = [
        'user' => $user,
        'dogs' => $dogs
      ];
      
      return view('users/show')->with('data', $data);
    }
}
