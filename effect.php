<!doctype html>
<html>
	<head>
		<script type="text/javascript" src="social-styles/js/jquery-1.9.1.min.js"></script>
     <script src="social-styles/js/jquery.easing.1.3.js"></script>
     <style>
   
     .container{
     	border-radius:5px ;
     	border:2px solid #ccc;
     }
     .items{
     	border-bottom:1px solid #1abc9c;
     }
     .red {
     	color:red;
     }
     </style>

     <script>
     
     $(document).on('click','#start', function(e)
     {

         function setT(){
     		$(this).toggleClass('red');
     	}
     
     	$('p.items').each(function(index , object)
     	{

     		console.log("yea that is the index: " + index);
     		setTimeout(3000, setT())
     		// $(this).toggleClass('red');
     		// $(this).animate({marginLeft: '40px'}, 1000, 'easeOutBounce')

     	})


     	
     })

     </script>
	</head>
	<body>
		
	<div class='container'>
		<p class="items">Hacker Moshood</p>
        <p class="items">Hacker Lnrea </p>
        <p class='items'>Amosun the governor </p>
        <p class="items">Computer Nerd </p>
	</div>
    
    <button type="submit" id="start">Start </button>
	</body>
</html>