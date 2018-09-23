@extends('layouts.appBlackNav')

@section('content')
@include('includes/loginLogout')

<div class="container" style="margin-top: 200px">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                  @if(count($data['user']->dogs) > 0)
                    <table class="table table-striped">
                      <tr>
                        <th>Dogs</th>
                        <?php
                          $dogNumber = 0;
                          // $numberOfBreeds = count($user->dogs);
                          // $poslednjiPage = (double)$numberOfBreeds / 6;
                          // $page = 1;
                          // echo $poslednjiPage . '<br>';
                          // if(!($numberOfBreeds % 6 == 0)){
                          //   // $page++;
                          //   $page = intval($numberOfBreeds / 6) + 1; 
                          // }else{
                          //   $page = $numberOfBreeds / 6;
                          // }
                          $page = 1;
                        ?>
                        <th></th>
                        <th></th>
                      </tr>
                      @foreach($data['dogs']->sortByDesc('id') as $dog)
                      <?php
                          $dogNumber++;
                          if($dogNumber > 6){
                            $page++;
                            $dogNumber = 1;
                          }
                          // posle sestog page postaje 2 
                        ?>
                      @if($dog->user_id == $data['user']->id)
                      <tr>
                        <td><a href="{{url('/dogs')}}/{{$dog->id}}?page=<?php echo $page; ?>">{{$dog->breed}}</a></td>
                        <td><a href="{{url('/dogs')}}/{{$dog->id}}/edit" class="btn btn-default">Edit</a></td>
                        <td><a class="btn btn-danger" data-popup-open="popup-1<?php echo $dog->id; ?>" href="#">Delete</a></td>                      
                      </tr>
                      <div class="popup" data-popup="popup-1<?php echo $dog->id; ?>">
                          <div class="popup-inner">
                            {!! Form::open(['action' => ['DogsController@destroy', $dog->id], 'method' => 'post']) !!}
                              {{Form::hidden('_method', 'DELETE')}}
                              <h3>Are you sure you want to delete "{{$dog->breed}}" ?</h3>
                              {{Form::submit('Yes', ['class' => 'btn btn-danger'])}}
                              <a data-popup-close="popup-1<?php echo $dog->id; ?>" class="btn btn-default" href="#">No</a>
                            {!! Form::close() !!}                    
                            <a class="popup-close" data-popup-close="popup-1<?php echo $dog->id; ?>" href="#">x</a>
                          </div>
                      </div>
                      @endif
                      @endforeach
                    </table>
                  @else
                    <p>You have no breeds.</p>  
                  @endif
                  @if(count($data['user']->comments) > 0)
                  <table class="table table-striped">
                    <tr>
                      <th>Comments</th>
                      <th></th>
                      <th></th>
                    </tr>
                    @foreach($data['user']->comments as $comment)
                    <tr>
                      <td><a>{{$comment->content}}</a></td>
                      <td><a class="btn btn-danger" data-popup-open="popup-1<?php echo $comment->id; ?>" href="#">Delete</a></td>
                    </tr>
                    <div class="popup" data-popup="popup-1<?php echo $comment->id; ?>">
                      <div class="popup-inner">
                        {!! Form::open(['action' => ['CommentsController@destroy', $comment->dog_id, $comment->id], 'method' => 'post']) !!}
                          {{Form::hidden('_method', 'DELETE')}}
                          <h3>Are you sure you want to delete "{{$comment->content}}" ?</h3>
                          {{Form::submit('Yes', ['class' => 'btn btn-danger'])}}
                          <a data-popup-close="popup-1<?php echo $comment->id; ?>" class="btn btn-default" href="#">No</a>
                        {!! Form::close() !!}                    
                        <a class="popup-close" data-popup-close="popup-1<?php echo $comment->id; ?>" href="#">x</a>
                      </div>
                    </div>
                    @endforeach
                  </table>
                  @else
                    <p>You have no comments.</p>
                  @endif
                  @if(count($data['user']->likes) > 0)
                  <table class="table table-striped">
                    <tr>
                      <th>Liked Comments</th>
                      <th></th>
                      <th></th>
                    </tr>
                    @foreach($data['user']->likes as $like)
                    <tr>
                      <td><a>{{$like->comment->content}}</a></td>
                      <td>
                        <a class="btn-like" data-popup-open="popup-1<?php echo $like->id ?>" href="#">{{count($like->comment->likes)}} <span class="fa fa-heart liked" aria-hidden="true"></span></a>
                      </td>              
                    </tr>
                    <div class="popup" data-popup="popup-1<?php echo $like->id; ?>">
                        <div class="popup-inner">
                          {!! Form::open(['action' => ['LikesController@index', $like->comment->dog_id, $like->comment_id], 'method' => 'post', 'id' => 'like-form' . $like->comment_id]) !!}
                            {{Form::hidden('user_id', Auth::user()->id)}}
                            <h3>Are you sure you want to dislike comment "{{$like->comment->content}}" ?</h3>
                            {{Form::submit('Yes', ['class' => 'btn btn-danger'])}}
                            <a data-popup-close="popup-1<?php echo $like->id; ?>" class="btn btn-default" href="#">No</a>
                          {!! Form::close() !!}                    
                          <a class="popup-close" data-popup-close="popup-1<?php echo $like->id; ?>" href="#">x</a>
                        </div>
                      </div>
                    @endforeach
                  </table>
                  @else
                    <p>You didn't like any comment.</p>
                  @endif           
                </div>
            </div>
        </div>
    </div>
</div>




@endsection
