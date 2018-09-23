@if(count($dogs) > 0)
<?php $index = -1; ?>
@foreach($dogs as $dog)
  <?php $index++; ?>
  <div class="portfolio-modal modal fade dogid<?php echo $dog->id ?>" id="portfolioModal<?php echo $index; ?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="close-modal" data-dismiss="modal">
          <div class="lr">
            <div class="rl"></div>
          </div>
        </div>
        <div class="container">
          <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
              <div class="modal-body">
                <!-- Breed Details Go Here -->
                <h2 class="breed-name"><?php echo $dogs[$index]->breed; ?></h2>
                {{-- <img class="img-responsive img-centered" src="https://www.cesarsway.com/sites/newcesarsway/files/styles/large_article_preview/public/Common-dog-behaviors-explained.jpg?itok=FSzwbBoi" alt=""> --}}
                <img src="{{url('/uploads')}}/breed_images/{{$dog->breed_image}}" class="breed-image-modal" alt="{{url('/uploads')}}/breed_images/no_image.png">
                <ul class="list-inline">
                  <li>Date: <?php echo convert_date($dog->created_at); ?></li>
                  {{-- <li>Date: July 2014</li> --}}
                  <li>Author: <a href="{{url('/profile')}}/{{$dog->user->id}}">{{$dog->user->name}}</a></li>
                  @if($dog->created_at < $dog->updated_at)
                    <li>Updated: <?php echo convert_date_2($dog->updated_at); ?></li>
                  @endif
                  {{-- <li>Updated: Jan 2018</li> --}}
                  <li>{{count($dog->comments)}} Comments</li>
                </ul>
                <div class="breed-description-div">
                  <p class="breed-description">{!!$dogs[$index]->description!!}</p>
                </div>
                @if(!Auth::guest())
                  @if(Auth::user()->id == $dog->user->id)
                    <div class="breed-modal-btns">
                      <a href="{{url('/dogs')}}/{{$dog->id}}/edit" class="btn btn-default">Edit</a>
                      <a class="btn btn-danger" data-popup-open="popup-1" href="#">Delete</a>
                    </div>  
                  @endif  
                @endif               
                <section class="comments">
                  <h2 class="comments-heading">Comments</h2>
                  <div class="JSMessageComment"></div>
                  @foreach($dog->comments as $comment)
                    <article>
                      <a href="{{url('/profile')}}/{{$comment->user->id}}"><img class="profile-photo" src="https://en.gravatar.com/userimage/18343163/3fd908393aedf6423ec12cacec9a1f50.jpg?size=200"></a>  
                      <h4><a href="{{url('/profile')}}/{{$dog->user->id}}">{{$comment->user->name}}</a></h4>
                      <time>{{time_elapsed_string($comment->created_at)}}</time>
                      {{-- <time>5 months ago</time> --}}
                      @if(!Auth::guest())
                        {!! Form::open(['action' => ['LikesController@index', $dog->id, $comment->id], 'method' => 'post', 'id' => 'like-form' . $comment->id]) !!}
                          {{-- <like class="like-count" type="submit" role="button">10 <i class="fa fa-heart" aria-hidden="true"></i></like> --}}
                          {{-- {{Form::hidden('dog_id' . $comment->id, $dog->id)}} --}}
                          {{-- {{Form::hidden('comment_id', $comment->id)}} --}}

                          {{Form::hidden('user_id', Auth::user()->id)}}
                          @if(count($comment->likes) == 0)
                            <button type="submit" class="btn-like" id="comment{{$comment->id}}">{{count($comment->likes)}} <span class="fa fa-heart disliked" aria-hidden="true"></span></button>
                          @else
                            @foreach($comment->likes as $like)
                              @if($like->user_id == Auth::user()->id)
                                {{-- add class here --}}
                                <button type="submit" class="btn-like" id="comment{{$comment->id}}">{{count($comment->likes)}} <span class="fa fa-heart liked" aria-hidden="true"></span></button>
                                <?php break; ?>
                                @else
                                {{-- remove class here --}}
                                <button type="submit" class="btn-like" id="comment{{$comment->id}}">{{count($comment->likes)}} <span class="fa fa-heart" aria-hidden="true"></span></button>
                              @endif
                            @endforeach
                          @endif
                        {!! Form::close() !!}
                      @else
                        {{-- you need to login to like comments --}}
                        <button class="btn-like" data-popup-open="popup-like">{{count($comment->likes)}} <span class="fa fa-heart" aria-hidden="true"></span></button>
                      @endif
                      <p>{{$comment->content}}</p>
                      <p class="last-comment-edit">
                        <small>
                          @if($comment->created_at < $comment->updated_at)
                            Last edit: {{convert_date_2($comment->updated_at)}}
                          @endif
                        </small>
                      </p>
                      @if(!Auth::guest())
                        @if(Auth::user()->id == $comment->user->id)
                          <div class="comment-btns">
                            <a href="#collapseEdit{{$comment->id}}" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapse{{$comment->id}}" class="btn btn-default">Edit</a>
                            <a class="btn btn-danger" data-popup-open="popup{{$comment->id}}" href="#">Delete</a>
                          </div>
                          {{-- EDIT DIVS FOR COMMENTS --}}
                    
                          <div class="collapse" id="collapseEdit{{$comment->id}}">
                            <div class="well well-edit" style="border-left: 5px solid #ffbb33; margin-top: 15px;">
                              <h4>Edit your comment <i class="fa fa-pencil-square-o" aria-hidden="true"></i></h4>
                              {!! Form::open(['action' => ['CommentsController@update', $dog->id, $comment->id], 'method' => 'post']) !!}
                                {{Form::hidden('_method', 'PUT')}}
                                <div class="form-group">
                                  {{Form::text('', Auth::user()->name, ['class' => 'form-control', 'disabled' => 'true'])}}
                                </div>
                                <div class="form-group">
                                  {{Form::textarea('content', $comment->content, ['id' => 'comment-edit-content' . $comment->id, 'class' => 'form-control', 'placeholder' => 'Your comment text...', 'cols' => '70', 'rows' => '5', 'required' => 'true'])}}
                                </div>
                                {{-- {{Form::hidden('editcommentid', $comment->id)}} --}}
                                <div class="form-group">
                                  <button type="submit" class="btn btn-warning">Edit comment <span class="fa fa-comment" aria-hidden="true"></span></button>
                                </div>
                              {!! Form::close() !!}                    
                            </div>
                          </div>
                        @endif  
                      @endif                       
                    </article>

                    

                  @endforeach

                  <a role="button" class="btn btn-success" data-toggle="collapse" href="#collapseComment{{$dog->id}}" aria-expanded="false" aria-controls="collapseComment"><i class="fa fa-plus"></i> Add Comment</a>

                  <!--COMMENT SECTION START-->
                  <!--Setting up the add new comment button that is used for collapsing-->

                  <!--Collapse Add a comment form START-->
                  <div class="collapse" id="collapseComment{{$dog->id}}">
                    <div class="well comment-section-wrapper" style="border-left: 5px solid #00C851;">
                      @if(Auth::guest())
                      <!--If the user is not logged in, direct him to the login page-->
                      <h5>You need to login before you can comment. <a href="{{url('/login')}}">Click here</a> to go to the login page.</h5>
                      @endif
                      @if(!Auth::guest())
                      <!--If the user is logged in, show the new comment form-->
                      <h4>Write your comment <span class="fa fa-pencil" aria-hidden="true"></span></h4>
                      {!! Form::open(['action' => ['CommentsController@store', $dog->id], 'method' => 'post', 'id' => 'add-comment-form' . $dog->id]) !!}  
                        <div class="form-group">
                          {{-- <input class="form-control" type="text" disabled value="{{Auth::user()->name}}"> --}}
                          {{Form::text('', Auth::user()->name, ['class' => 'form-control', 'disabled' => 'true'])}}
                        </div>
                        <div class="form-group">
                          <div class="error-input missing-comment-error">
                            
                          </div>
                          {{-- <textarea class="form-control" id="comment-content{{$dog->id}}" name="commentcontent" placeholder="Write your comment..." form="add-comment-form" rows="5" cols="70"></textarea> --}}
                          {{Form::textarea('content', '', ['id' => 'message_input' . $dog->id, 'class' => 'form-control', 'placeholder' => 'Write your comment...', 'cols' => '70', 'rows' => '5', 'required' => 'true'])}}
                        </div>
                        {{Form::hidden('breedid', $dog->id)}}
                        {{Form::hidden('userid', Auth::user()->id)}}
                        <div class="form-group">
                          <button type="submit" class="btn btn-success">Comment <span class="fa fa-comment" aria-hidden="true"></span></button>
                          {{-- {{Form::submit('Comment', ['class' => 'btn btn-success btn-sm'])}} --}}
                        </div>
                        {!! Form::close() !!}<!-- // End form -->
                      @endif
                    </div>
                  </div>
                  <!--Collapse Add a comment form END-->
                </section>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    {{-- DELETE FOR COMMENTS --}}

    {{-- THIS MUST BE HERE INSIDE MODAL DIV NOT ANY OTHER DIV IT WON'T BE 100% WIDTH AND HEIGH OF MODAL THEN !!! --}}

    @foreach($dog->comments as $comment)
      <div class="popup" data-popup="popup{{$comment->id}}">
        <div class="popup-inner">
          {!! Form::open(['action' => ['CommentsController@destroy', $dog->id, $comment->id], 'method' => 'post']) !!}
            {{Form::hidden('_method', 'DELETE')}}
            <h3>Are you sure you want to delete "{{str_limit($comment->content, $limit = 20, $end = '...')}}" ?</h3>
            {{Form::submit('Yes', ['class' => 'btn btn-danger'])}}
            <a data-popup-close="popup{{$comment->id}}" class="btn btn-default" href="#">No</a>
          {!! Form::close() !!}                    
          <a class="popup-close" data-popup-close="popup{{$comment->id}}" href="#">x</a>
        </div>
      </div>
    @endforeach

    {{-- Modal For Delete Breed // https://inspirationalpixels.com/custom-popup-modal/ --}}


    <div class="popup" data-popup="popup-1">
      <div class="popup-inner">
        {!! Form::open(['action' => ['DogsController@destroy', $dog->id], 'method' => 'post']) !!}
          {{Form::hidden('_method', 'DELETE')}}
          <h3>Are you sure you want to delete "{{$dog->breed}}" ?</h3>
          {{Form::submit('Yes', ['class' => 'btn btn-danger'])}}
          <a data-popup-close="popup-1" class="btn btn-default" href="#">No</a>
        {!! Form::close() !!}                    
        <a class="popup-close" data-popup-close="popup-1" href="#">x</a>
      </div>
    </div>

    {{-- MODAL FOR LIKE COMMENT --}}

    <div class="popup" data-popup="popup-like">
      <div class="popup-inner">
        <h4>You need to login to like comments.</h4>
        <hr>
        <a class="btn btn-success" href="{{url('/login')}}">LOGIN</a>
        <a class="btn btn-default" href="{{url('/register')}}">REGISTER</a>
        <a class="popup-close" data-popup-close="popup-like" href="#">x</a>
      </div>
    </div>


  </div> <!-- SHOW MODAL CLOSE -->
@endforeach           
@endif