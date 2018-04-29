		$(document).ready(function() {
     $('.msg_box').hide();   //hide the user messag tabl
		});


    //click on the chat head to hide the chat body
		$(document).on('click', '.chat_head', function(event) {
			event.preventDefault();
			//  alert("close was clicekd");
			$('.chat_body').slideToggle(400);
		})

   //click on the message head to hide the message body
		$(document).on('click', '.msg_head', function(event)
		{
			$('.msg_body').slideToggle();
		})

    //click on the message button to hide the mekssage body;
		$(document).on('click', '#msg-btn', function(event)
		{
			 event.preventDefault();
			 $('.msg_box').hide();
		})

		// $(document).on('click', '.user', function(event){
		// 	var username = $(this).html();
		// 	 $('.msg_box').show();
		// 	 $('#msg_name').html(username);
		// 	 var chat_reciever = $(this).attr('uid');
		// 	 $('.msg_input').attr('cid', chat_reciever);
			
		// })


		//add a click down event to the msg_input

		// $(document).on('keydown', '.msg_input', function(event){
		// 	 if(event.which === 13){
		// 		 var msg_content = $('.msg_input').val();

		// 			if(msg_content != ''){
  //           $('.msg_body').append('<div class="msg_b">'+ msg_content +'</div>')
		// 				$('.msg_input').val('');
		// 				$('.msg_body')
		// 			} //append to the to the class_b stuff
		// 	 } //this shows we need to send the message asap now ;
		// })