/*

My Custom JS
============

Author:  Alaran Moshood
Updated: July 25th 2015
Notes:	 Script file for the socialnetwork

*/
$('document').ready(function()
{


//************************************
//  href : comment and like disabling

var hlikes = $('a.like');
var hcomment = $('a.comment');
hcomment.click(function(e)
{
  e.preventDefault();
  // console.log("ya that was comment")
})
hlikes.click(function(e)
{
  e.preventDefault();
  // console.log("yea that is bad");
})
 //***********HOME.PHP**************
 //updating the comment in the cmt box

 var cmt_btn  = $('.add');
 cmt_btn.click(function(e)
 {
    var cmt_input = $(this).parent().prev();
    var post_id = $(this).attr('pid');
    var post_uid = $(this).attr('uid');
    var cmt_text = cmt_input.val();
    var cmt_container = $(this).parent().parent().prev().prev();

    if(cmt_text == ''){
      e.preventDefault();
    }
    else{
      $.post('commentaction.php',
        {
          task : 'cmt',
          cmt_text : cmt_text,
          post_id : post_id,
          poster : post_uid
        },
        function(cmt_result)
        {
          cmt_input.val('');
          cmt_container.html(cmt_result);


        })
    }
 })

 //end of the comment function
 //*******************************
   //index.php


   //hide the loginContainer;
   $('#loginContainer').hide();


   $('#loginlink').click(function(e)

   {
   	e.preventDefault();
   	$('#signupContainer').hide();
   	$('#loginContainer').show();
   	$('#ltitle').html("Login");
    $('#lsubmit').css('display','none');

   })

  var fname = $('#fullname');
  var semail = $('#semail');
  var matricno = $('#matricno');
  var passwd = $('#password');
  var cpasswd  = $('#cpassword');
  var gender = $('#gender');
  var signupbtn = $('#signupbtn');
  var errorOutput = $('#errorOutput');

  var singupsbmt = $('#signupsbmt');

  //hide the submit button
  $('#signupsbmt').hide();



    //errlist items

 var fnameerr = $('#fullnameerr');
 var emailerr = $('#emailerr');
 var matricerr = $("#matricerr");
 var passworderr  = $('#passworderr');
 var cpasserr  = $('#cpasserr');
 var gendererr = $('#gendererr');



//********************************
//validation for the signup submit
//
//******************************

signupbtn.click(function(e)
{
   var errlist = "";

   if(fname.val() == ""){
      errlist += "<li>Full name must not be Empty";
   }
   else if(!fname.val().match(/^[a-zA-Z]+\s[a-zA-Z]+$/)){
   	errlist += "<li>Please suplly a valid fullname</li>";
   }
   if(semail.val() == ""){
   	 errlist += "<li>Email Field Cannot be empty</li>";
   }
   else if(!semail.val().match(/^[a-zA-Z0-9\w]+_?[a-zA-Z0-9\w]@[a-zA-Z0-9]+\.[a-zA-Z]+$/)){
   	errlist += "<li>Valid Email is required</li>";
   }
   if(matricno.val() == ""){
   	errlist += "<li>Matric number should not be empty</li>";
   }
   else if(!matricno.val().match(/^[0-9]+$/)){
   	errlist += "<li>Invalid matriculation number</li>";
   }
   if(passwd.val() == ""){
   	errlist += "<li>Password is required</li>";
   }
   if(cpasswd.val() == ""){
   	 errlist += "<li>Confirm password must not be empty</li>";
   }
   else if(cpasswd.val() != passwd.val())
   {
   	errlist += "<li>password & confirm password mismatch</li>";
   }
   if(gender.val() == 0){
   	errlist += "<li>Please Select a valid gender!</li> ";
   }

   errorOutput.html(errlist);

    // console.log(errorOutput.html());
    if(errorOutput.html() == '')
    {
    	// console.log("yea thaas true man");

      //  signupsbmt.click();var singupsbmt = $('#signupsbmt');
      $('#signupsbmt').click();



    }
    else{
    	e.preventDefault();
    }
})



 //end of index.php scripts



	//script for settings.php
	//
	//
	$('#passpane').hide();
	$('#matricpane').hide();

	$('#editpass').click(function(e)
	{
		e.preventDefault();
       $('#namepane').hide();
       $('#matricpane').hide();
       $('#passpane').show();
	})

	$('#editname').click(function(e)
	{
		e.preventDefault();
		$('#passpane').hide();
    $('#matricpane').hide();
		$('#namepane').show();
	})

	$('#editmat').click(function(e)
	{
		e.preventDefault();
		$('#passpane').hide()
		$('#namepane').hide()
		$('#matricpane').show();
	})



  //SCRIPT TO PERFORM THE password change function
  //@home => settings.php
  var oldpass  = $('#oldpass');
  var npass = $('#npass');
  var cnpass = $('#cnpass');

  var psave = $('#updatepass');
  var passout = $('#cpassout');

  psave.click(function(e)
  {
    if(cnpass.val() != '' && cnpass.val() == npass.val() && oldpass.val() != '')
    {
      // console.log('Good form');
      $.post('action.php',
        {

        },function(p_result)
      {
         console.log(p_result);
      })
    }
    else{
      console.log("bad form");
    }
  })




//-------------------------------------------
//  HOME.PHP scripting the statusImage & status;
//
//--------------------------------------------


//this is meant for the status Image preview
var insertImage = $('#insertImage');
var imgUpload = $('#imgUpload');
var imgSubmit = $('#imgSubmit');
var preImageContainer = $('#preImageContainer');
var form = $('form');
var imgLoader = $('#homeLoader');

$('#insertImage').click(function(e)
{
   e.preventDefault();
   imgUpload.click();

})

imgUpload.change(function(e)
{
  var imgvalue = $(this).val();
  if(imgvalue != '')
  {
     imgSubmit.click();
  }
})

imgSubmit.click(function(e)
{
  form.ajaxForm({
    beforeSend: function()
    {
      imgLoader.show();  //show the loader.gif file
      imgSubmit.attr('disabled','disabled');
    },
    success: function(imgresult)
    {
      preImageContainer.html(imgresult);
      imgLoader.hide();
      form.resetForm();
      imgSubmit.removeAttr('disabled');
    },
    error : function(err)
    {
      preImageContainer.html("Error: " + err);
      imgSubmit.removeAttr('disabled');
      console.log(err);
    }
  })
})

//end of the scripts for the Preview Image function

//********************************
// scripting for the follow button
//

var addbtns = $('.addbtn');
addbtns.click(function(e)
{
var friendid = $(this).attr('uid');
var myid  = $(this).attr('mid');
$.post('follow.php',
{
   'task' : 'follow',
    'uid' : myid,
    'followid' : friendid
}, function(follow_result)
{
  console.log(follow_result);
})
})

//*****************************
// scripting for the updating of the status with
// te image with it
//
//*****************************

var updatebtn = $('#updatebtn');
var statuscont = $('#statusInput');
var preImagecont = $('#preImageContainer');
var userid = $('#updatebtn').attr('uid');

updatebtn.click(function(e)
{

  if(preImagecont.html() == '' && statuscont.val()=='')
  {
    // console.log("all is empty");
    e.preventDefault();
  }
  else if(preImagecont.html() == '' && statuscont.val() !='')
  {
    // console.log("preiamge only empty");
    //updating the status without any image
     $.post('statusaction.php',
      {
        task : 'i',
        status_text : statuscont.val(),
        userid : userid,
      } ,
     function(status_result)
     {
          // console.log(status_result);
          statuscont.val('');
          window.location = "http://localhost/socialnetwork/home.php";

     })
  }
  else if(statuscont.val() == '' && preImagecont.html() != '')
  {
    //updating the status with Image
    // console.log("statuscont only empty");

     $.post('statusaction.php',
      {
         task : 'u',
         userid: userid,
         status_text : statuscont.val(),
      }, function(st_img_result)
      {
         // console.log(st_img_result);
         statuscont.val('');
         preImagecont.html('');
          window.location = "http://localhost/socialnetwork/home.php";

      })
   // console.log("status only empty")
  }


//***********************************************
//  comment working status
}) //end of the updatebtn function

//status-like

$('.liker').click(function(e)
{
  e.preventDefault();
  var userid = $(this).attr('uid');
  var status_id = $(this).attr('stid');
  var liked_text = $(this).html();

  //check if the text is liked or not
  //then allow or disallow
  if(liked_text != "Liked")
  {
     $.post('statusaction.php',
      {
        task : 'likestatus',
        userid : userid,
        status_id : status_id
      }, function(result)
     {
         // console.log(result);
     })
  }
  else
  {
    e.preventDefault();
  }

})

/************************************
/@below: functon to incraset the like_count
         for a comment on a certain post
/@name : cmt_like
/************************************/

$('.like_cmt').click(function(e)
{
  e.preventDefault();
  var cmt_id = $(this).attr('cid');
  var post_id = $(this).attr('pid');
  var userid = $(this).parent().parent().parent().parent().prev().prev().children().last().attr('uid');

  if(cmt_id && userid && post_id)
  {
    $.post("statusaction.php",
      {
        task : 'like_cmt',
        userid : userid,
        cmt_id : cmt_id,
        post_id : post_id,
      },function(result)
    {
     console.log(result);
    })
  }
  else
   {
     e.preventDefault();
   }
})

//EOL cmt_like


/************************
/@below : hide all previousCmmment div elements
       unless see all is been clicked;
/@page : home.php
/************************/
$('.cmt_container').hide(); //hides all cmt_container
var show_comments = $('.s_all');
show_comments.click(function(e)
{
  e.preventDefault();
  var cmt_box = $(this).parent().parent().next().next();
   cmt_box.toggle();
})



/**********************************************
/@below : updates msgsusertab when msgItem is clicked
/
/***********************************************/
$('#typeMsg').hide();
var msger = $('.msger');
$('.msgUserTab').hide();
msger.click(function(e)
{
 $('.msgUserTab').show(); //show th3 message user tab
 $('#typeMsg').show(); //show th3 type message box 
 var msgdisplay = $('#userMsgContent');
  e.preventDefault();
  var receiver  = $(this).attr('uid');

  var receiver_id = $(this).attr('uid');


  var sender = $('#msgLeftPaneHead').attr('uid');
  var user = $(this).html();
  var myimage = $(this).parent().prev().attr('src');


  var utabPane = $('.msgUserTab');
  var tabimage =  utabPane.children().first().attr('src')
  var tab_name = utabPane.children().last().html();

 //change the name of the user on the tab
utabPane.children().last().html(user);
utabPane.children().first().attr('src',myimage);
utabPane.children().first().attr('uid',receiver);
utabPane.attr('uid',receiver_id);

// console.log("s:"+ sender + " r:"+receiver);
if(sender && receiver){
  // console.log("yea that was right");
  $.post('message_action.php',
    {
      task : "message",
      sender: sender,
      receiver : receiver
    },function(result)
  {
     console.log(result);
     msgdisplay.html(result);

  })
}

 })



/***************************************
/@below : function to send the message
/
/****************************************/

var sendbtn = $('#messageInputbtn');
var msgbox = $('#messageInput');

// sendbtn.click(function(e)
// {

//   var msgvalue = msgbox.val();
//   var sender = $('#msgLeftPaneHead').attr('uid');
//   // var receiver_id = $('.msgUserTabName').attr('uid');
//   var receiver = $('.msgUserTab').attr('uid');

  
//   if(msgvalue && sender) {
//     $.post('message_action.php',
//       {
//         task : 'i_msg',
//         msg : msgvalue,
//         sender :sender,
//         receiver : receiver
//       },function(result)
//     {
//       msgbox.val('');
//     $('#userMsgContent').load('message.php #userMsgContent')
 

//     })


//   }
//   else{
//     e.preventDefault();
//   }
// })
})

$(document).on('click','#messageInputbtn', function(msgresult)
{
  var msgbox = $('#messageInput')
  var msgvalue = msgbox.val();
  var sender = $('#msgLeftPaneHead').attr('uid');
  // var receiver_id = $('.msgUserTabName').attr('uid');
  var receiver = $('.msgUserTab').attr('uid');
  
  if(msgvalue && sender){

    $.ajax({
      method : "POST", 
      url : "message_action.php", 
      data : {task : 'i_msg', msg: msgvalue, sender: sender,receiver: receiver},
      beforeSend: function(e){
           msgbox.val('')
      },
      success: function(e){
        // $('#userMsgContent').load('message.php #userMsgContent');
      }
      , 

    })
  }

})





/************************************/
// TIMELINE.PHP
// @below : update profile image
/***********************************/


//what is neeeded on the socialnetwork
