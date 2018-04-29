<!doctype html>
<html lang='en'>
	<head>
		<link rel="stylesheet" href="social-styles/css/bootstrap.css"/>
		<link rel="stylesheet" href="social-styles/css/material.css" />
		<style>
           #container{
           	margin:25px;

           }
           #paymentBanner{
           	height:70px;
           	background-color:#16a085;
           	color:#fff;
           	padding:5px 5px 5px 12px;
           	border-radius:2px;
           }
           #paymentContainer{
           	height:500px;
           	border:2px solid #ccc;
           }
           h3{

           	font-size:25px !important;
           }
           a {
           	color:#3498db !important;
           }
           .data-badge{
           	background-color:#3498db !important;
           }

		</style>
	</head>
	<body>
		<div id="container">
			<div id="paymentBanner"><h3>Payment History</h3></div>
			<div id="paymentContainer">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>S/N </th>
							<th>Date </th>
							<th>Amount </th>
							<th>Transaction Details </th>
							<th>Reciever </th>
							<th> Client </th>
						</tr>
					</thead><!--end of the table head-->
					<tbody>
				
						<tr>
							<td>1</td>
							<td>2015-08-06</td>
							<td>$500</td>
							<td> Payment for the Anaemia Drug prescription <span class="mdl-badge" data-badge="S"></span></td>
							<td><a href=""><label class="profile">Dr. Toyin Aimakhu <span class="label label-danger">Dentist</span></label></a></td>
							<td><a href=""><label class="patient">Mrs. Tayo olowolagba <span class="label label-info">Patient </span></label></a></td>
						</tr>


						<tr>
							<td>2</td>
							<td>2015-08-06</td>
							<td>$500</td>
							<td> Payment for the Anaemia Drug prescription <span class="mdl-badge mdl-badge--overlap" data-badge="C"></td>
							<td><a href=""><label class="profile">Dr. Toyin Aimakhu <span class="label label-danger">Gynaecologist</span></label></a></td>
							<td><a href=""><label class="patient">Mrs. Tayo olowolagba <span class="label label-info">Patient</span></label></a></td>
						</tr>


						<tr>
							<td>3</td>
							<td>2015-08-06</td>
							<td>$500</td>
							<td> Payment for the Anaemia Drug prescription</td>
							<td><a href=""><label class="profile">Nurse Tobiloba <span class="label label-warning">Nurse</span></label></a></td>
							<td><a href=""><label class="patient">Mr Henry Townsend <span class="label label-info">Patient</span></label></a></td>
						</tr>

						<tr>
							<td>4</td>
							<td>2015-08-06</td>
							<td>$500</td>
							<td> Payment for the Anaemia Drug prescription</td>
							<td><a href=""><label class="profile">Nurse Tobiloba <span class="label label-danger">Surgeon</span></label></a></td>
							<td><a href=""><label class="patient">Mr Henry Townsend <span class="label label-info">Patient</span></label></a></td>
						</tr>

					
                       
                   

					</tbody>
				</table>
			</div>
		</div>
		<script type="text/javascript" src="social-styles/js/jquery-1.9.1.min.js"></script>
		<script type='text/javascript' src="social-styles/js/jquery.hovercard.min.js"></script>
		<script type="text/javascript" src="social-styles/js/material.js"></script>


		<script>
            var aboutDr = {
            	name : "Dr toyin",
            	link : "http://medslat.com/user/3",
            	bio : "He is the owner of the popular Heart Healed Hospital, Ikeja Lagos",
            	image  : "./templates/hacker.jpg",
            	// website : "http://medslat.com",
            	// email : "doctorj@medslat.com"
            };
            var aboutMrs = {
            	name : "Mrs Olowolagba",
            	link : "http://medslat.com/patients/3",
            	bio : "the woman that had amnesia and was healed by Doctore toyin",
            	image : "./templates/hacker.jpg"
            }

            $('.profile').hovercard(
            {
            	showCustomCard: true,
            	customCardJSON : aboutDr
            })
            $('.patient').hovercard(
            {
            	showCustomCard: true,
            	customCardJSON : aboutMrs,
            	showTwitterCard: true,
            	openOnTop: true,
            })

           





		</script>
	</body>
</html>
