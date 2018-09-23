@if(session('unauth'))
  <div class="alert alert-danger unauth-message" style="display: none;">{!! session('unauth') !!}</div>
  <script>
    // $('.unauth-message').delay(200).fadeIn(400);
    $(document).ready(function(){
        $(".unauth-message").animate({right: '3.5rem', opacity:"show"}, 1500);
        $('.unauth-message').delay(5000).fadeOut(400);
    });
  </script>
@endif
