$('document').ready(function()
{
	// alert("yea the page got loaded");


/************************************
/@below: function for updating comments
/@name : comment_updater
 @params : comment_value, comment_displayer, status_id
/************************************/

    var addplus = $('.add');
    addplus.click(function(e)
    {
    	
    	var rid = $(this).attr('rid');
    	var comment_value = $(this).prev();
    	var comment_displayer = $(this).parent().prev();
    	console.log(rid);

    	$.post('whatsupdate.php',
    	 {
    	 	task : 'comment',
    	 	post_id : rid,
    	 	comment_text : comment_value.val(),
    	 },
    	 function(comment_result)
    	 {
    	 	//display the output into the comment_displayer 
    	 	//and clear the input text contents ;
           comment_displayer.html(comment_result);
           comment_value.val('');
    	 });
  
    })

//EOL comment_updater






/************************************
/@below: function to preview ajaxify image
/@name : imagepreview
/************************************/
	var stText = $('#statusText');
	var stImage = $('#statusImage');
	var output = $('#preImage');
	var imgSubmit = $('#imageSubmit');
	var form = $('form');
	var post = $('#post');
    
    //empty the preImage container 
    output.html('');

	stImage.change(function()
	{
		console.log("the file was changed");
		imgSubmit.click();
	})
   
   imgSubmit.click(function(e)
   {
   	  form.ajaxForm({
   	  	beforeSend: function()
   	  	{},
   	  	success : function(result)
   	  	{
   	  		console.log(result);
   	  		output.html(result);
   	  	},
   	  	error : function(){}
   	  })
   })
//EOL imagepreview



/************************************
/@below : function to update the status
/         with some media content like image
/@param : stat_text
/@name : stat_update
/************************************/
   post.click(function(r)
   {
   	// console.log("that was the fucking pressed");
   	 var text = stText.val();
   	 if(output.html() == ''){
   	 	// console.log("that is true");
   	 	// console.log(text);
   	 	// console.log("that is true");

   	 	$.post('whatsupdate.php',
   	 		{
               task : 'i',
               text : text,
   	 		}, function(r)
   	 		{
                console.log(r);
                stText.val("");
   	 		})
   	 }
   	 else{

   	 // console.log(text);
     $.post('whatsupdate.php',
     	{
     		task : 'status',
     		text : text,
     	}, function(result)
     {
     	console.log(result);
     	output.html('');
     })
   	 	// console.log("not empty");
   	 }
      
   })




//doing for the status like 

/******************************************
/@below : function to increase likes for a 
/         certain status post 
/@params : userid, statusid
 @name : status_like
/*****************************************/
$('.liker').click(function(e)
{
 
  e.preventDefault();
  var userid = $(this).attr('mid');
  var statid = $(this).attr('pstid');
  var likedtext = $(this).html();
  // console.log(likedtext);
  if(likedtext != "Liked")
  {
    // console.log("Not Liked");
    $.post('whatsaction.php',
    {
      task : 'cmt_like',
      status_id : statid,
      userid : userid

    },function(liker_result)
  {
    console.log(liker_result);  
  })
  }
  else
  {
    // console.log("Already Liked");
    e.preventDefault();
  }

  
})
//EOL status_like

/****************************************************
/@below : function to insert increase number of likes 
/        certain comment
 @params : postid, commentid, userid
/*******************************/





})