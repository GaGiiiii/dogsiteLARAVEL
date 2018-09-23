{{-- @if (session()->has('flash_notification.success')) <div class="alert alert-success">{!! session('flash_notification.success') !!}</div>
@endif --}}

@if(session('flash_notification_login'))
  <div class="alert alert-success login-logout-message" style="display: none;">{!! session('flash_notification_login') !!} <i class="fa fa-check" aria-hidden="true"></i></div>
  <script>
    // $('.login-logout-message').delay(200).fadeIn(400);
    $(document).ready(function(){
        $(".login-logout-message").animate({right: '2rem', opacity:"show"}, 1500);
        $('.login-logout-message').delay(5000).fadeOut(400);
    });
  </script>
@endif

@if(session('flash_notification_logout'))
  <div class="alert alert-success login-logout-message" style="display: none;">{!! session('flash_notification_logout') !!} <i class="fa fa-check" aria-hidden="true"></i></div>
  <script>
    // $('.login-logout-message').delay(200).fadeIn(400);
    $(document).ready(function(){
        $(".login-logout-message").animate({right: '2rem', opacity:"show"}, 1500);
        $('.login-logout-message').delay(5000).fadeOut(400);
    });
  </script>
@endif

@if(session('userRegister'))
  <div class="alert alert-success register-message" style="display: none;">{!! session('userRegister') !!}</div>
  <script>
    // $('.login-logout-message').delay(200).fadeIn(400);
    $(document).ready(function(){
        $(".register-message").animate({right: '2rem', opacity:"show"}, 1500);
        $('.register-message').delay(5000).fadeOut(400);
    });
  </script>
@endif
