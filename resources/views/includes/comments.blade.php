@if(session('createdComment'))
  <div class="alert alert-success comment-message" style="display: none;">{!! session('createdComment') !!}  <i class="fa fa-check" aria-hidden="true"></i></div>
  <script>
    // $('.login-logout-message').delay(200).fadeIn(400);
    $(document).ready(function(){
        $(".comment-message").animate({right: '3rem', opacity:"show"}, 1500);
        $('.comment-message').delay(5000).fadeOut(400);
    });
  </script>
@endif

@if(session('updatedComment'))
  <div class="alert alert-success comment-edit-message" style="display: none;">{!! session('updatedComment') !!}  <i class="fa fa-check" aria-hidden="true"></i></div>
  <script>
    // $('.login-logout-message').delay(200).fadeIn(400);
    $(document).ready(function(){
        $(".comment-edit-message").animate({right: '3rem', opacity:"show"}, 1500);
        $('.comment-edit-message').delay(5000).fadeOut(400);
    });
  </script>
@endif

@if(session('deletedComment'))
  <div class="alert alert-success comment-edit-message" style="display: none;">{!! session('deletedComment') !!}  <i class="fa fa-check" aria-hidden="true"></i></div>
  <script>
    // $('.login-logout-message').delay(200).fadeIn(400);
    $(document).ready(function(){
        $(".comment-edit-message").animate({right: '3rem', opacity:"show"}, 1500);
        $('.comment-edit-message').delay(5000).fadeOut(400);
    });
  </script>
@endif

@if(session('likedComment'))
  <div class="alert alert-success comment-edit-message" style="display: none;">{!! session('likedComment') !!}  <i class="fa fa-check" aria-hidden="true"></i></div>
  <script>
    // $('.login-logout-message').delay(200).fadeIn(400);
    $(document).ready(function(){
        $(".comment-edit-message").animate({right: '3rem', opacity:"show"}, 1500);
        $('.comment-edit-message').delay(5000).fadeOut(400);
    });
  </script>
@endif

@if(session('dislikedComment'))
  <div class="alert alert-success comment-edit-message" style="display: none;">{!! session('dislikedComment') !!}  <i class="fa fa-check" aria-hidden="true"></i></div>
  <script>
    // $('.login-logout-message').delay(200).fadeIn(400);
    $(document).ready(function(){
        $(".comment-edit-message").animate({right: '3rem', opacity:"show"}, 1500);
        $('.comment-edit-message').delay(5000).fadeOut(400);
    });
  </script>
@endif

@if(count($errors) > 0)
<div class="alert alert-danger comment-message" style="display: none;">
  @foreach($errors->all() as $error)
    <p class="p-error">{{$error}} <i class="fa fa-minus-circle" aria-hidden="true"></i></p>
  @endforeach
  
</div>
<script>
    // $('.login-logout-message').delay(200).fadeIn(400);
    $(document).ready(function(){
        $(".comment-message").animate({right: '3rem', opacity:"show"}, 1500);
        $('.comment-message').delay(15000).fadeOut(400);
    });
</script>
@endif
