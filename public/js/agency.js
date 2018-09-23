(function($) {
    "use strict"; // Start of use strict

    /* ********************** THEME JS START ************************ */

    // jQuery for page scrolling feature - requires jQuery Easing plugin
    $('a.page-scroll').bind('click', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: ($($anchor.attr('href')).offset().top - 50)
        }, 1250, 'easeInOutExpo');
        event.preventDefault();
    });

    // Highlight the top nav as scrolling occurs
    $('body').scrollspy({
        target: '.navbar-fixed-top',
        offset: 51
    });

    // Closes the Responsive Menu on Menu Item Click
    // $('.navbar-collapse ul li a').click(function(){ 
    //         $('.navbar-toggle:visible').click();
    // });

    // Offset for Main Navigation
    $('#mainNav').affix({
        offset: {
            top: 100
        }
    });

    $(window).scroll(function() {
      var height = $(window).scrollTop();
      var distance = $('#portfolio').offset().top
  
      if(height  >= 100 && ($(window).scrollTop() <= distance - 55)) {
        $('#home').addClass('active');
      }else{
        $('#home').removeClass('active');
      }
    });

    /* ********************** THEME JS START ************************ */


    /* ********************** DELETE MODAL START ************************ */

    $(function() {
      //----- OPEN
      $('[data-popup-open]').on('click', function(e) {
        var targeted_popup_class = jQuery(this).attr('data-popup-open');
        $('[data-popup="' + targeted_popup_class + '"]').fadeIn(350);

        e.preventDefault();
      });
    
      //----- CLOSE
      $('[data-popup-close]').on('click', function(e) {
        var targeted_popup_class = jQuery(this).attr('data-popup-close');
        $('[data-popup="' + targeted_popup_class + '"]').fadeOut(350);
    
        e.preventDefault();
      });
    });

    /* ********************** DELETE MODAL END ************************ */


    /* ********************** REMOVE SCRIPT FORM CONTACT FORM START ************************ */


    $("#contactForm").submit(function(e){
            
      var name = $("#name").val();
      var email = $("#email").val();
      var phone = $("#phone").val();
      var message = $("#message").val();

      name = name.replace(/script/g, "THISISNOTASCRIPTREALLY");
      email = email.replace(/script/g, "THISISNOTASCRIPTREALLY");
      message = message.replace(/script/g, "THISISNOTASCRIPTREALLY");

      $("#name").val(name);
      $("#email").val(email);
      $("#message").val(message);

      return true;
    });

    /* ********************** REMOVE SCRIPT FROM CONTACT END ************************ */

    /* ********************** SHOW BREED FROM PROFILE PAGE REDIRECT START ************************ */

    $(window).on('load',function(){
      var pathname = window.location.pathname; // Returns path only
      //  var url      = window.location.href;     // Returns full URL
      // var origin   = window.location.origin;   // Returns base URL
      // alert(pathname)

      var url = $(location).attr('href');
      var parts = url.split("/");
      var last_part = parts[parts.length-1];

      
      var parts2 = last_part.split('?');
      var last_part2 = parts2[0];
      // alert(last_part2);

      if(pathname == '/dogs/' + last_part2){
        $('.dogid' + last_part2).modal('show');
      }
    });

    /* ********************** SHOW BREED FROM PROFILE PAGE REDIRECT END ************************ */







    // LIKES

    // $("button").click(function(){
    //   var str = this.id;
    //   var res = str.substring(7, str.length);

    //   $("#like-form" + parseInt(res)).submit(function(e){
    //     alert($('input[name=dog_id]').val());
    //     alert($('input[name=comment_id' + res + ']').val());
    //     alert('http://dogsite.test/dogs/' + $('input[name=dog_id]').val() + '/comments/' + $('input[name=comment_id]').val() + '/like');
    //   });
    // });

    // $('.btn-like').click(function(){
    //   // alert($('input[name=dog_id]').val());
    //   // alert($('input[name=comment_id]').val());
    //   // alert('http://dogsite.test/dogs/' + $('input[name=dog_id]').val() + '/comments/' + $('input[name=comment_id]').val() + '/like');
    //   // alert(this.id);
    //   $.ajax({
    //     type: 'POST',
    //     // url: 'http://dogsite.test/dogs/65/comments/35/like',
    //     url: 'http://dogsite.test/dogs/' + $('input[name=dog_id]').val() + '/comments/' + $('input[name=comment_id]').val() + '/like',
    //     data: {
    //       '_token': $('input[name=_token]').val(),
    //       'user_id': $('input[name=user_id]').val(),
    //       'dog_id': $('input[name=dog_id]').val(),
    //       'comment_id': $('input[name=comment_id]').val(),
    //     },
    //     success: function(data){
    //       if(data.errors){
    //         alert(url);
    //         console.log(data.errors);
    //       }else{
    //         alert(url);
    //         console.log('out');
    //       }
    //     },
    //   });
    //   // empty the fields
    // });

})(jQuery); // End of use strict

