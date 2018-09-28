<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// STORAGE FOR IMAGES
use Illuminate\Support\Facades\Storage;
// FILE FOR IMAGES
use Illuminate\Support\Facades\File;
// BRINGING THE MODEL
use App\Dog;
use App\Comment;
use App\Like;
// BRINGING THE DB LIBRARY IF WE DON'T WANT TO USE 
// ELOQUENT AND WE WANT DB QUERIES
use DB;

class DogsController extends Controller{

  public function __construct(){
    $this->middleware('auth', [
      'except' => ['index', 'show']
    ]);
  }
  
  public function index(){
    // $dogs = Dog::all();

    // $dog = Dog::where('breed', 'Labrador 2')->get();

    // $dogs = DB::select('SELECT * FROM dogs');

    // limit one post
    // $dogs = Dog::orderBy('id', 'desc')->take(1)->get();

    // $dogs = Dog::orderBy('id', 'desc')->get();

    $dogs = Dog::orderBy('id', 'desc')->paginate(6);
    return view('pages/index')->with('dogs', $dogs);
  }

  public function create(){
    return view('dogs/create');
  }

  public function store(Request $request){
    $this->validate($request, [
      'breed' => 'required',
      'description' => 'required|min:100',
      'breed_image' => 'image|nullable|max:2999'
    ]);

    // Handle Image Upload
    if($request->hasFile('breed_image')){
      // Get filename with the extension
      $fileNameWithExt = $request->file('breed_image')->getClientOriginalName();
      // Get just filename
      $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
      // Get just ext
      $extension = $request->file('breed_image')->getClientOriginalExtension();
      // Filename to store 
      $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
      // Upload Image 
      // $path = $request->file('breed_image')->storeAs('public/breed_images', $fileNameToStore);


      $file = $request->file('breed_image');
      Storage::disk('uploads')->put('breed_images/' . $fileNameToStore, File::get($file));
    }else{
      $fileNameToStore = 'noimage.jpg';
    }

    // Create Breed

    $breedName = $request->input('breed');
    $breedName = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $breedName);
    
    $breed = new Dog;
    $breed->breed = $breedName;
    $breed->description = $request->input('description');
    $breed->user_id = auth()->user()->id;
    $breed->breed_image = $fileNameToStore;
    $breed->save();

    return redirect('/')->with('createdBreed', 'Breed Created');
  }

  // We don't need show() since we
  // are using modals to display individual breeds
  // instead of RESTful routes.

  public function show($id){
    $dogs = Dog::orderBy('id', 'desc')->paginate(6);
    return view('pages/index')->with('dogs', $dogs);
  }

  public function edit($id){

    $dog = Dog::find($id);

    // Check for correct user
    if(auth()->user()->id !== $dog->user_id){
      return redirect('/dogs/' . $dog->id)->with('unauth', 'Unauthorized Page. <i class="fa fa-minus-circle" aria-hidden="true"></i>');
    }

    return view('dogs/edit')->with('dog', $dog);
  }

  public function update(Request $request, $id){
    $this->validate($request, [
      'breed' => 'required',
      'description' => 'required|min:100',
      'breed_image' => 'image|nullable|max:2999'
    ]);

    // Handle Image Upload
    if($request->hasFile('breed_image')){
      // Get filename with the extension
      $fileNameWithExt = $request->file('breed_image')->getClientOriginalName();
      // Get just filename
      $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
      // Get just ext
      $extension = $request->file('breed_image')->getClientOriginalExtension();
      // Filename to store 
      $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
      // Upload Image 
      // $path = $request->file('breed_image')->storeAs('public/breed_images', $fileNameToStore);


      $file = $request->file('breed_image');
      Storage::disk('uploads')->put('breed_images/' . $fileNameToStore, File::get($file));
    }else{
      $fileNameToStore = 'noimage.jpg';
    }

    // Update Breed

    $breedName = $request->input('breed');
    $breedName = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $breedName);

    
    $breed = Dog::find($id);
    $breed->breed = $breedName;
    $breed->description = $request->input('description');
    if($request->hasFile('breed_image')){
      Storage::disk('uploads')->delete('breed_images/' . $breed->breed_image);
      $breed->breed_image = $fileNameToStore;
    }
    $breed->save();

    return redirect('/')->with('updatedBreed', 'Breed Updated');
  }

  public function destroy($id){
    $dog = Dog::find($id);

    // Check for correct user
    if(auth()->user()->id !== $dog->user_id){
      return redirect('/dogs/' . $dog->id)->with('unauth', 'Unauthorized Page. <i class="fa fa-minus-circle" aria-hidden="true"></i>');
    }

    if($dog->breed_image != 'noimage.jpg'){
      // Delete the image 
      // Storage::delete('public/cover_images/' . $post->cover_image);
      Storage::disk('uploads')->delete('breed_images/' . $dog->breed_image);
    }

    $comments = Comment::where('dog_id', $id)->get();
    
    foreach($comments as $comment){
      Like::where('comment_id', $comment->id)->get()->each->delete();
      $comment->delete();
    }

    $dog->delete();

    return redirect('/')->with('deletedBreed', 'Breed Deleted');
  }
}
