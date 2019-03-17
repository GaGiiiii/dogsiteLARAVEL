// ********************** FUNCTIONS ************************

  function displayLikedCommentLikesFromDatabase(commentId){

    var currentCommentId = commentId;

    $.ajax({
      url: "../server/process.php",
      type: "POST",
      async: false,
      data: {
        "displayLikes-comment": 1,
        "commentId": currentCommentId
      },
      success: function(dataDisplayCommentLikes){
        $("#display-likes-comment" + parseInt(currentCommentId)).html(" " + dataDisplayCommentLikes);
      }
    });

  }



  function displayDislikedCommentDislikesFromDatabase(commentId){

    var currentCommentId = commentId;

    $.ajax({
      url: "../server/process.php",
      type: "POST",
      async: false,
      data: {
        "displayDislikes-comment": 1,
        "commentId": currentCommentId
      },
      success: function(dataDisplayCommentDislikes){
        $("#display-dislikes-comment" + parseInt(currentCommentId)).html(" " + dataDisplayCommentDislikes);
      }
    });

  }


  function displayLikesFromDatabase(){
    var breedId = $("#hidden-liked-disliked-breed-id").val();
    $.ajax({
      url: "../server/process.php",
      type: "POST",
      async: false,
      data: {
        "displayLikes": 1,
        "breedId": breedId
      },
      success: function(dataDisplayLikes){
        $("#display-likes").html(dataDisplayLikes);
        // alert(dataDisplayLikes);
      }
    });
  }

  function displayDislikesFromDatabase(){
    var breedId = $("#hidden-liked-disliked-breed-id").val();
    $.ajax({
      url: "../server/process.php",
      type: "POST",
      async: false,
      data: {
        "displayDislikes": 1,
        "breedId": breedId
      },
      success: function(dataDisplayDislikes){
        $("#display-dislikes").html(dataDisplayDislikes);
      }
    });
  }


   // ********************** CARD FLIP START ************************

  function rotateCard(btn){
      var $card = $(btn).closest('.card-container');
      console.log($card);
      if($card.hasClass('hover')){
          $card.removeClass('hover');
      } else {
          $card.addClass('hover');
      }
  }

  // ********************** CARD FLIP END ************************  


  // ********************** FUNCTIONS END ************************  








// ********************** LIKE START ************************

  $(document).ready(function(){

    if($("#scroll-comment-id").val()){

      var scrollCommentId = $("#scroll-comment-id").val();

      $('html, body').animate({
        scrollTop: $('#comment' + scrollCommentId).offset().top - 100
      }, 1500);

      $("#comment" + scrollCommentId).addClass("highlight");
      $("#comment" + scrollCommentId + " hr").remove();

      // setTimeout(function(){   //calls click event after a certain time
      //    $("#comment" + scrollCommentId).removeClass("highlight");
      // }, 5000);

    }


    $("#like").click(function(e){
    	e.preventDefault();
    	// AKO U HTML KORISTIMO FORMU MORA OVO !!!!
      var numberOfLikes = $("#hidden-likes").val();
      var breedId = $("#hidden-liked-disliked-breed-id").val();
      var userId = $("#hidden-user-id").val();
      var type = "like";
      // alert(numberOfLikes);
      // alert(breedId);

      $.ajax({
        url: "../server/process.php",
        type: "post",
        async: false,
        data: {
          "liked": 1,
          "numberOfLikes": numberOfLikes,
          "breedId": breedId,
          "userId": userId,
          "type": type
        },
        success: function(dataLikes){
          displayLikesFromDatabase();
          // $("button#like i").toggleClass("liked");
          // alert(dataLikes);
          if(dataLikes){
            $("button#like i").addClass("liked");
          }else{
            $("button#like i").removeClass("liked");
          }
        }
      });

    });

    $("#dislike").click(function(e){
    	e.preventDefault();
    	// AKO U HTML KORISTIMO FORMU MORA OVAKO
      var numberOfDislikes = $("#hidden-dislikes").val();
      var breedId = $("#hidden-liked-disliked-breed-id").val();
      var userId = $("#hidden-user-id").val();
      var type = "dislike";
      // alert(numberOfDislikes);

      $.ajax({
        url: "../server/process.php",
        type: "post",
        async: false,
        data: {
          "disliked": 1,
          "numberOfDislikes": numberOfDislikes,
          "breedId": breedId,
          "userId": userId,
          "type": type
        },
        success: function(dataDislikes){
          displayDislikesFromDatabase();
          // $("button#dislike i").toggleClass("disliked");
          if(dataDislikes){
            $("button#dislike i").addClass("disliked");
          }else{
            $("button#dislike i").removeClass("disliked");
          }
        }
      });

    });

  });


  // ********************** LIKE END ************************

  // ********************** LIKE COMMENT START ************************

  $(document).ready(function(){
      
    $(".like-comment-input").click(function(e){
      // AKO U HTML KORISTIMO FORMU MORA OVO !!!!
      e.preventDefault();  

      var currentCommentId = this.name.substring(12); 
      var numberOfLikes = $("#hidden-likes-comment" + parseInt(currentCommentId)).val();
      var userId = $("#hidden-user-id").val();
      var type = "like";

      $.ajax({
        url: "../server/process.php",
        type: "post",
        async: false,
        data: {
          "liked-comment": 1,
          "numberOfLikes-comment": numberOfLikes,
          "commentId": currentCommentId,
          "userId": userId,
          "type": type
        },
        success: function(dataLikes){
          displayLikedCommentLikesFromDatabase(currentCommentId);
          if(dataLikes){
            $("button#like-comment" + currentCommentId + " i").addClass("liked");
          }else{
            $("button#like-comment" + currentCommentId + " i").removeClass("liked");
          }
        }
      });

    });

    $(".dislike-comment-input").click(function(e){
      // AKO U HTML KORISTIMO FORMU MORA OVAKO
      e.preventDefault();
      
      var currentCommentId = this.name.substring(15);
      var numberOfDislikes = $("#hidden-dislikes-comment" + parseInt(currentCommentId)).val();
      var userId = $("#hidden-user-id").val();
      var type = "dislike";

      $.ajax({
        url: "../server/process.php",
        type: "post",
        async: false,
        data: {
          "disliked-comment": 1,
          "numberOfDislikes": numberOfDislikes,
          "commentId": currentCommentId,
          "userId": userId,
          "type": type
        },
        success: function(dataDislikes){
          displayDislikedCommentDislikesFromDatabase(currentCommentId);
          if(dataDislikes){
            $("button#dislike-comment" + currentCommentId + " i").addClass("disliked");
          }else{
            $("button#dislike-comment" + currentCommentId + " i").removeClass("disliked");
          }
        }
      });

    });

  });

  // ********************** LIKE COMMENT END ************************

// ********************** COMMENT CHECK START ************************

$("#add-comment-form").submit(function(e){
  
  // e.preventDefault();

  var error = "";

  var commentContent = $("#comment-content").val();

  if(commentContent == ""){
    error += "Comment field is required."
  }

  if(error != ""){
    $("#missing-comment-error").html("<i class='fa fa-times-circle'></i> " + error);
    return false;
  }else{
    // $("form").unbind("submit").submit();
    return true;
  }

});

// ********************** EDIT ************************

$('.aga').click(function(){
  var z = this.name;

  $("#edit-comment-form" + parseInt(z)).submit(function(e){



    // e.preventDefault();

    var error = "";

    var commentContent = $("#comment-edit-content" + parseInt(z)).val();

    if(commentContent == ""){
      error += "Comment field is required."
    }

    if(error != ""){
      $("#missing-edit-comment-error" + parseInt(z)).html("<i class='fa fa-times-circle'></i> " + error);
      return false;
    }else{
      // $("form").unbind("submit").submit();
      return true;
    }

  }); 
});


// ********************** COMMENT CHECK END ************************



if ($('#back-to-top').length) {
    var scrollTrigger = 100, // px
        backToTop = function () {
            var scrollTop = $(window).scrollTop();
            if (scrollTop > scrollTrigger) {
                $('#back-to-top').addClass('show');
            } else {
                $('#back-to-top').removeClass('show');
            }
        };
    backToTop();
    $(window).on('scroll', function () {
        backToTop();
    });
    $('#back-to-top').on('click', function (e) {
        e.preventDefault();
        $('html,body').animate({
            scrollTop: 0
        }, 700);
    });
}







