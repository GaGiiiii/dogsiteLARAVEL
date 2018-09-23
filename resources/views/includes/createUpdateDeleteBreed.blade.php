@if(session('createdBreed'))
    <script>
        $('html, body').animate({
            scrollTop: $("#portfolio").offset().top
        }, 1500);     
        $(".JSMessage").append('<div class="alert alert-success margin-top-6rem">{{session("createdBreed")}} <i class="fa fa-check" aria-hidden="true"></i></div>');
    </script>   
@endif

@if(session('updatedBreed'))
    <script>
        $('html, body').animate({
            scrollTop: $("#portfolio").offset().top
        }, 1500);     
        $(".JSMessage").append('<div class="alert alert-success margin-top-6rem">{{session("updatedBreed")}} <i class="fa fa-check" aria-hidden="true"></i></div>');
    </script>
    {{-- open modal on breed update NOT FINISHED !!! --}}
{{-- 
    <script>
      $(window).on('load', function(){
          $('#myModal').modal('show');
      });
  </script> --}}
@endif

@if(session('deletedBreed'))
    <script>
        $('html, body').animate({
            scrollTop: $("#portfolio").offset().top
        }, 1500);     
        $(".JSMessage").append('<div class="alert alert-success margin-top-6rem">{{session("deletedBreed")}} <i class="fa fa-check" aria-hidden="true"></i></div>');
    </script>   
@endif