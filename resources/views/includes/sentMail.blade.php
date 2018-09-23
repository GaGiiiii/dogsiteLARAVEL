@if(session('sentMail'))
    <script>
        $('html, body').animate({
            scrollTop: $("#contact").offset().top
        }, 1500);     
        $(".JSContactMessage").prepend('<div class="col-md-12 alert alert-success margin-bottom-6rem">{{session("sentMail")}} <i class="fa fa-check" aria-hidden="true"></i></div>');
    </script>   
@endif