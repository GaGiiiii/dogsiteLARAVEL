<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// BRINGING THE MODEL
use App\Comment;
use App\Like;

class CommentsController extends Controller{

  // public function index(){

  // }

  // public function create(){

  // }

  public function store(Request $request){
    $this->validate($request, [
      'content' => 'required'
    ]);

    // Create Comment
    
    $comment = new Comment;
    $comment->user_id = $request->input('userid');
    $comment->dog_id = $request->input('breedid');
    $comment->content = $request->input('content');
    $comment->save();

    return redirect('/dogs/' . $comment->dog_id)->with('createdComment', 'Comment Added');
  }

  // public function show($id){
  //   return Dog::find($id);
  // }

  // public function edit($id){

  // }

  public function update(Request $request, $dogid, $id){
    $this->validate($request, [
      'content' => 'required'
    ]);

    // Update Comment

    $comment = Comment::find($id);
    $comment->content = $request->input('content');
    $comment->save();

    return redirect('/dogs/' . $comment->dog_id)->with('updatedComment', 'Comment Updated');
  }

  public function destroy($dogid, $id){
    $comment = Comment::find($id);

    // Check for correct user
    if(auth()->user()->id !== $comment->user_id){
      return redirect('/dogs/' . $comment->dog_id)->with('unauth', 'Unauthorized Page. <i class="fa fa-minus-circle" aria-hidden="true"></i>');
    }

    Like::where('comment_id', $id)->get()->each->delete();
    $comment->delete();

    return redirect('/dogs/' . $comment->dog_id)->with('deletedComment', 'Comment Deleted');
  }
}
