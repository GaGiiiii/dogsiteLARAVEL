@extends('layouts.appBlackNav')

@section('content')
@include('includes/loginLogout')

<div class="container" style="margin-top: 200px">
    <div class="row justify-content-center">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{$data['user']->name}}'s Dogs</div>
                <div class="panel-body">
                  @if(count($data['user']->dogs) > 0)
                    <table class="table table-striped">
                        <tr>
                          <th>Title</th>
                        </tr>
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
                          </tr>
                        @endif
                        @endforeach
                      </table>
                  @else
                    <p>{{$data['user']->name}} has no breeds.</p>  
                  @endif
                </div>
            </div>
        </div>

        <div class="col-md-8 col-md-offset-2">
          <div class="panel panel-default">
              <div class="panel-heading">{{$data['user']->name}}'s Comments</div>
              <div class="panel-body">
                @if(count($data['user']->comments) > 0)
                  <table class="table table-striped">
                      <tr>
                        <th>Title</th>
                      </tr>
                      @foreach($data['user']->comments as $comment)
                      <tr>
                        <td><a>{{$comment->content}}</a> on breed <a>{{$comment->dog['breed']}}</a></td>
                      </tr>
                      @endforeach
                    </table>
                @else
                  <p>{{$data['user']->name}} has no comments.</p>  
                @endif
              </div>
          </div>
      </div>

      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">Comments that {{$data['user']->name}} likes</div>
            <div class="panel-body">
              @if(count($data['user']->likes) > 0)
                <table class="table table-striped">
                    <tr>
                      <th>Title</th>
                    </tr>
                    @foreach($data['user']->likes as $like)
                    <tr>
                      <td><a>{{$like->comment['content']}}</a></td>
                    </tr>
                    @endforeach
                  </table>
              @else
                <p>{{$data['user']->name}} didn't like any comment.</p>  
              @endif
            </div>
        </div>
    </div>
  </div>
</div>




@endsection
