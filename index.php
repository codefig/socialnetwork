<?php 
include("header.php");

?>
<style>
  body{
    background-color:#fff !important;
  }
</style>
<!-- #####################################################################################################################################################################################-->
                    <div class="social-container">
         
                <div class="social-header">
                   
                    <div class="social-wrap">
                        
                    <div class="social-logo float-left">
                        Logo 
                    </div>
                    
                    <div class="social-option float-right">
                        
                       &nbsp;
                    </div>
                    
                    <br class="clear" />
                    </div>
            </div>
             <div class="social-content-wrapper addon" id="social-wrapper">
                 
                 <div class="social-slider float-left">
                     
                     <p class="social-get-started">
                        <h3 class="add-color">Palsbook</h3>
                             connect with your friends in little time ....
                     </p>
                    
                     <img src="social_img/slider1.png" border="0" />
                     <br/>
                  <span>Do you Have an Account Already ?  </span><a href="" id="loginlink">Login </a>
                 </div>
                 
                 <div class="social-signup float-right">
                 
                 <h2 id="ltitle"> Sign Up </h2>


                 <div id="loginContainer">
                   <!-- <form method="post" action="verify.php"> -->
                   <label>Email </label>
                   <input type="text" name="lemail" id="lemail" class="form-control"/>
                   <label>Password </label>
                   <input type="password" name="lpass" id="lpass" class="form-control">
                   <br/>
                   <!-- <input type="submit" id="lsubmit" name="lsubmit" class="form-control"> -->
                   <!-- </form> -->
                   <button class="btn btn-info" id="lbutton">Login </button>
                   <span>   or <a href="index.php">Signup</a></span><br/><br/>
                   <span id="loutput" style="color:red"></span>
                 </div>
                     
                     <div class="signup-wrap" id="signupContainer">
                <!--here is start of the signup form -->
                     <div>

              <form method="post" action="action.php" >
                         <div> 
                           <label for="fullname"> Full Name </label>
                         </div>
                     <div class="input-group">
   
  <input type="text" id="fullname" name="fullname" class="form-control" placeholder="Full Name" required="required" aria-describedby="basic-addon1">
  <br/><span id="fullnameerr"></span>
</div>
                     </div>
                     
                       <div class="signup">
                            <div> 
                           <label for="email"> E-mail </label>
                         </div>
                     <div class="input-group">
 
  <input type="text" id="semail" name="email" class="form-control" placeholder="email" aria-describedby="basic-addon1" required="required">
    <span id="emailerr"></span>
</div>
                     </div>
                     
                       <div class="signup">
                            <div> 
                                <label for="matricNo"> Matric No. <small><b>(optional)</b></small> </label>
                         </div>
                     <div class="input-group">

  <input type="text" id="matricno" name="matricno" class="form-control" placeholder="Matric No." aria-describedby="basic-addon1" required="required">
    <span id="matricerr"></span>
    </div>
                     </div>
                    


       <div class="signup">
           <div>
               <label for="password">password </label>
           </div>
           <div class="input-group">
               <input type="password" id="password" name="password" class="form-control" placeholder="password" aria-describedby="basic-addon1" required="required" >
                 <span id="passworderr"></span>
           </div>
       </div>



       <div class="signup">
           <div>
               <label for="cpassword">Confirm Password </label>
           </div>
           <div class="input-group">
               <input type='password' id="cpassword" class="form-control" placeholder="confirm password" aria-describedby="basic-addon1" required="required">
              <span id="cpasserr"></span>
           </div>
       </div>

                         <div class="signup">
                            <div> 
                                <label for="gender"> Gender</label>
                         </div>
                     <div class="input-group">

  <select class="form-control" name="gender" aria-describedby="basic-addon1" required="required" id="gender"> 
    <option value="0"> Gender </option>
      <option value="1">Male</option>
      <option value="2">Female</option>
                         </select>
                          <span id="gendererr"></span>
</div>
                     </div>
                        <br/>
                         <div id="errorOutput" style=""></div>

            <div>
              <input type="submit" name="signup" class="form-control"  id="signupsbmt" style="display:none"/>
            </div>


            </form>
                         <div class="signup">
                             <div>   <button class="btn btn-primary" type="submit" id="signupbtn"> Ready to go </button> &nbsp; <input type="checkbox" name="accept" value="terms"/> <small><b alt="terms">Accept terms &amp; conditions </b></small>
                                 &nbsp;<a> Click to View</a>
                          </div>
                     
                     </div>
                 </div>
            </div>
            
                 <br class="clear" />
            </div>

<script>
  $('document').ready(function(){
  
    var lmail = $('#lemail');
    var lpass  = $('#lpass');
    var lbutton = $('#lbutton');
    var loginoutput = $('#loutput');
  

  lbutton.click(function(e)
  {

    if(lmail.val() == '' || lpass.val() == '')
    {
      e.preventDefault();
      loginoutput.html("*Valid Inputs are required");
    }
    else{

       $.post('verify.php', 
      {
        task : 'login',
        user : lmail.val(),
        pass : lpass.val()
      }, function(result)
    {
      if(result == 1)
      {
        window.location = "http://localhost/socialnetwork/home.php";
      }
      else{
        console.log(result);
      loginoutput.html(result);
      }
    })
    }
   
  })
  })
</script>
<!-- ###################################################################################################################################################################################### -->
<?php

include('footer.php');



?>

