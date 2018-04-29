var io = require('socket.io').listen(4444);
var async = require('async');
var mysql = require('mysql');



var onlineUsers = {}
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
	console.log("a new user is connected with me ");

   clientsocket.on('new-user', function(data, callback)
   {

   	   var uid = data.id;
   	    var username = data.name;

   	    clientsocket.id = uid;
   	    clientsocket.username = username;

   	  if(onlineUsers[clientsocket.id] === undefined)
   	  {
   	  	//the user is not online before
   	  	callback(true);
   	  	onlineUsers[clientsocket.id] = username;
   	  	io.sockets.emit('online-users', onlineUsers);
   	  }
   	  else
   	  {
   	  	callback(false);
   	  }
   })

   //when the user goes offline 

   clientsocket.on('disconnect', function(data){


   	//delet the id of the socket and name 

   	console.log(onlineUsers[clientsocket.id] + "has left");
   	delete onlineUsers[clientsocket.id];
   	//update the users tab that a user has left

   	io.sockets.emit('online-users', onlineUsers);
   })





clientsocket.on('new-message', function(msg_data, callback)
{
	var s = msg_data.send,
	    r = msg_data.recv,
	    msg = msg_data.msg,
	    whiteSpacePattern = /^\s*$/;

	if(whiteSpacePattern.test(msg)){
		callback(false); //user msg is empty;
		console.log("bad message or invalid");
	}
	else{
		 //user msg aint empty;
	 //query = "insert into messages set sender= recv="
	 console.log("sender: "+s + "recv: " + r + "msg: "+ msg);
		con.query("INSERT INTO messages SET sender="+ con.escape(s) + ",recv="+con.escape(r) + ", message="+con.escape(msg) + ", time=NOW()", function(err, row)
		{
			if(err){
				console.log(err.stack);
			}
			else{
				//no error 
				console.log("message inserted successfully");
				//then get the messages that had occured between the two parties before
   con.query("SELECT * FROM `messages` WHERE sender="+con.escape(s)+" and recv="+con.escape(r)+" UNION ALL select * from `messages` where sender="+con.escape(r)+" and recv="+con.escape(s)+" ORDER BY id", function(err, result)
   	{
   		if(err){
   			console.log(err.stack);
   		}
   		else{
   			callback(result);
   			console.log(result);
   		}

   	}); //end of the second query function 

			}
		})

	}
})

clientsocket.on('update-msg', function(msg_data, callback)
{
  //i need to resume back to this endk 

   var u_s = msg_data.send;
   var u_r  = msg_data.recv;

   if(u_s && u_r){
      // console.log("yea that is all set");
        con.query("SELECT * FROM `messages` WHERE sender="+con.escape(u_s)+" and recv="+con.escape(u_r)+" UNION ALL select * from `messages` where sender="+con.escape(u_r)+" and recv="+con.escape(u_s)+" ORDER BY id", function(err, result)
      {
         if(err){
            console.log("update message err : " + err.stack);
         }
         else{
            
            console.log("update message : " + result);
            callback(result); //the result of the message previous query
         }

      });

   }

   else{
      callback(false)
   }

})



// clientsocket.on('update-msg', function(data, callback){
// 	//this method call is tho update the message tab when the user 
// 	//clicks on the .user tab to send a message to his pal
// 	if(data){
// 		var s = data.send;
// 		var r = data.recv;
//         con.query("SELECT * FROM `messages` WHERE sender="+con.escape(s)+" and recv="+con.escape(r)+" UNION ALL select * from `messages` where sender="+con.escape(r)+" and recv="+con.escape(s)+" ORDER BY id", function(err, result){
//         	if(err){
//         		console.log(err.stack);
//         	}
//         	else{
//         		console.log(result);
//         		callback(result);
//         	}
//         }

// 	}
  
// })


}) //end brace for the io.sockets.emit parent 


