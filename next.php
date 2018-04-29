<?php
include('header.php');
?>

<script type="text/javascript">
$('document').ready(function()
{

 // console.log(form);
//call the greeting js to greet the user !
  $.amaran({
        'theme'     :'user blue',
        'content'   :{
            img:'./social_img/developer.jpg',
            user:'Administrator',
            message:'Welcome to Palsbook! We connect you with Friends & family,'
        },
        'position'  :'top right',
        'outEffect' :'slideTop',
        'delay': 4000,
        'closeOnClick':true,
        'closeButton':true,
        'sticky': true,
    });

//end of te greeetign function

var uploadbtn = $('#imageSubmit');
var fileinput = $('#imageInput');
var formsubmit = $('#imageinputSubmit');
var loader = $('#loader');
var output = $('#picFrame');
var form = $('form');
var homeNext = $('#homeNext');
homeNext.hide();
uploadbtn.click(function(e)
{
   fileinput.click();
})

fileinput.change(function(e)
{
    var value = $(this).val();
    if(value != ''){
      formsubmit.click()
    }
    else{
      e.preventDefault();
    }
})
formsubmit.click(function(e)
{
    form.ajaxForm({

      beforeSend: function(){

        loader.show();
        $('#imageinputSubmit').attr('disabled','disabled');
      },
      success: function(result){
        // $('#picFrame').result();
        output.html(result);
        loader.hide();
        form.resetForm();
        formsubmit.removeAttr('disabled');
        uploadbtn.hide();
        homeNext.show();
      },

      error: function(err){
        output.html("Error: " + err);
       formsubmit.removeAttr('disabled');
       console.log(err);
      },

    })


})
})

</script>

<style>
  body{
    background-color:#fff !important;
  }
  #nextWrapper{
    /*background-color:#1abc9c;*/
    margin-top:100px;
  }
  #wellHeader, #imageSubmit{
    background:rgb(0,0,15);
  }
  #logoutlink{
     color:#fff;
  }
  #imageinputSubmit, #loader{
    display:none;
  }
  #homeNext{
    background-color:#3498db;
    color:#fff;
  }
</style>

<div class="container" id="nextWrapper">

<div class="navbar navbar-fixed-top" id="nextHeader">

   <div class="container">
    <button class="navbar-toggle" data-target=".navbar-responsive-collapse"
    data-toggle="collapse" type="button">
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
    </button>
    <a href="logout.php" id="logoutlink">Logout </a>
   </div>
</div>

<!-- the page container -->
<div class="MyContainer">
  <div id="nextContainer">
    <div class="well" id="wellHeader">Select Your Profile Photo or
    <strong><a href="home.php" style="color:#fff"> SKIP </a> </strong>
     &nbsp;
    </div> <!--end of wellHeader -->

     <center>
     <span id="loader" style="display:none"><img src="social_img/loader.gif" height="16" width="16">Loading...</span>
     <div id="picFrame"></div><!--end of the #picframe -->
      <form class="form" method="post" action="action.php" enctype="multipart/form-data">
          <input type="file" id="imageInput" accept="image/*" name="images"/>
          <input type="submit" name="imageSubmit" id="imageinputSubmit" value="upload"/>
      </form>
          <button type="" class="btn btn-success" name="imageSubmit" id="imageSubmit">
            Upload
          </button>
       <a class="btn btn-success" href="home.php"id="homeNext">Home </a>
      </center>

</div><!--end of nextContainer-->
</div><!--end of myContainer -->

<?php

include('footer.php');
?>
