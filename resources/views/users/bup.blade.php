@extends('layouts.appBlackNav')

@section('content')
@include('includes/loginLogout')

<div class="container" style="margin-top: 200px">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">{{$user->name}}'s Dogs</div>
                <div class="panel-body">
                  @if(count($user->dogs) > 0)
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
                      @foreach($user->dogs->sortByDesc('id') as $dog)
                      <?php
                        $dogNumber++;
                        if($dogNumber > 6){
                          $page++;
                          $dogNumber = 1;
                        }
                        // posle sestog page postaje 2 
                      ?>
                      <tr>
                        <td><a href="{{url('/dogs')}}/{{$dog->id}}?page=<?php echo $page; ?>">{{$dog->breed}}</a></td>
                      </tr>
                      @endforeach
                    </table>
                  @else
                    <p>You have no breeds.</p>  
                  @endif                
                </div>
            </div>
        </div>
    </div>
</div>




@endsection
