$('document').ready(function(e)
{
	// alert("Now working with jquery");

	$('.chat_head').click(function(e)
	{
		$('.chat_body').slideToggle('slow');
	})


   $('.msg_head').click(function(e)
	{
		$('.msg_wrap').slideToggle('slow');
	})

   $('.close').click(function()
   {
   	  // alert("yea i was clicked")
   	  $('.msg_box').hide();
   })


   $('.user').click(function()
   {
   	  $('.msg_wrap').show();
   	  $('.msg_box').show();
   })

function checktab (){

console.log('checking for tab');

   $('.sidebar-name').click(function(w)
   {
      // w.preventDefault();s
     setTimeout(function()
      {
         alert("new chat tab launched");
         var minput = $('input.min');
         // console.log(minput.val());
         minput.keypress(function(e)
         {
            if(e.keyCode == 13)
            {
               var msg = minput.val();
               alert(msg);
               $("<div class='msg_b'>" + msg + "</div>").insertBefore(".ins");
               minput.val('');
            }
         })
      }, 1000);

   })
} 
//end of the chekctab function 



$('a.postedItem').click(function()
{
   alert("a link was clicked");
})
   
// $('a.ulink').click(function(e)
// {
//    alert("a client to chat with")
//    // e.preventDefault();
// })
   

   // $('textarea').keypress(function(e)
   // {
   // 	// $('.t_status').html("user is typing...");
   // 	 if(e.keyCode == 13)
   // 	 {
   // 	 	var msg = $(this).val();
   // 	 	$(this).val('');
   //       // $("<div class='msg_b'>" + msg + "</div>").insertBefore(".msg_insert");
   // 	 	$("<div class='msg_b'>" + msg + "</div>").insertBefore(".ins");
   // 	 	$('.msg_body').scrollTop($('.msg_body')[0].scrollHeight);
   // 	 }
   // })


   //  $('textarea').keypress(function(e)
   // {
   //    // $('.t_status').html("user is typing...");
   //     if(e.keyCode == 13)
   //     {
   //       var msg = $(this).val();
   //       $(this).val('');
   //       $("<div class='msg_b'>" + msg + "</div>").insertBefore(".msg_insert");
   //       $('.msg_body').scrollTop($('.msg_body')[0].scrollHeight);
   //     }
   // })



   
   $('textarea').keyup(function()
   {
   	  $('.t_status').html("")
   })


checktab();

})