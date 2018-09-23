<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// BRINGING THE MODEL
use App\Like;
use response;

class LikesController extends Controller{
  
  public function index(Request $request, $dog_id, $comment_id){

    $like = Like::where(['user_id' => $request->input('user_id'), 'comment_id' => $comment_id]);

    if($like->exists()){
      // ALREADY LIKED COMMENT, DISLIKE NOW
      $like->delete();

      return redirect('/dogs/' . $dog_id)->with('dislikedComment', 'Comment Disliked.');
    }else{
      // LIKE COMMENT
      $like = new Like;
      $like->user_id = $request->input('user_id');
      $like->comment_id = $comment_id;
      $like->save();

      return redirect('/dogs/' . $dog_id)->with('likedComment', 'Comment Liked.');
    }

    // return response()->json($like);
  }
}
