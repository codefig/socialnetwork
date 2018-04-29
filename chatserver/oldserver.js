var io = require('socket.io').listen(4444);
var async = require('async');
var mysql = require('mysql');


var userslist = [];
var all_users = {}
var allUsersid  = [];
var socklist = [];
var name_id_list = {}

//create the connection cursor
var con = mysql.createConnection({
	host: 'localhost',
	user : 'root',
	password : '',
	database : 'social'
});


//connect the cursor to the connection

con.connect(function(err, status){
	if(err){
		throw err;
	}

	else{
       console.log("connection successful");
	}
})

io.sockets.on('connection', function(clientsocket)
{
	console.log("new user has just connected");
    
    //need to check if the user is already in the online list before
	clientsocket.on('new-user', function(data, callback)
	{
		var userid = data.id;
		var username = data.name;
        
     
		if(userslist.indexOf(userid) != -1){
          
          callback(false); //the user already exist

		} //that shows the user already exist;

		else{
           //this shows the user is new , then addd him up
          callback(true);
          clientsocket.nickid = userid;
          name_id_list[clientsocket.nickid] = username;
          userslist.push(clientsocket.nickid);
          // io.sockets.emit('online-users', [userslist, name_id_list])
          updateNicknames();
		}       

	});


   function updateNicknames(){
      io.sockets.emit('online-users', [userslist, name_id_list])
   }

	clientsocket.on('disconnnect', function(data)
	{
		//check if the user has a nickid set already ;
		if(!socket.nickid) return;

		//then remove the name from the array 
     
     // delete userslist[socket.nickid];
	 userslist.splice(userslist.indexOf(socket.nickid), 1)
	 updateNicknames();
	})







})




//old client script

  <script>

  var html = "";
  var clientsock = io.connect("http://127.0.0.1:4444");
  var lusername = $('#userDetails').attr('uname'),
      luserid  = $('#userDetails').attr('uid');

  var udata  = {id: luserid , name: lusername};

  //send the 
  clientsock.emit('new-user', udata, function(data){
   
   if(data)
   {

   }
   else{
    //do nothing to him because he is online before 
    alert("sorry u are already on the chat network ");
   }

  });


  clientsock.on('online-users', function(datajson)
  {
    var userslist = datajson[0]; //normal array format []
    var name_id_list = datajson[1]; //json object format {}
    
    var onlinelength = userslist.length;

    for(var i = 0; i<userslist.length; i++){

        html += "<div class='user'>" + userslist[i] +"</div>"; 
    }

    alert(html);
    $('.chat_body').html(html);
    $('#onlineCount').html(onlinelength);
    
  })





  </script>