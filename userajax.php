<?php
	if (!isset($_REQUEST['cmd'])) {
		echo '{"result": 0, "message": "Command not entered"}';
	}
	$command = $_REQUEST['cmd'];
	switch($command) {
		case 1:
		addUser();
		break;

		case 2:
		logUser();
		break;

		case 3:
		addRide();
		break;

		case 4:
		viewRides();
		break;
		
		case 5:
		viewRide();
		break; 

		case 6:
		joinRide();
		break;

		case 7:
		joinedRides();
		break;

		case 8:
		sharedRides();
		break;

		default:
		echo "wrong cmd";
		break;
	}

function addUser() {
	if (($_REQUEST['username']=="") || ($_REQUEST['firstname']=="") || ($_REQUEST['lastname']=="") || ($_REQUEST['password']=="")
		|| ($_REQUEST['gender']=="") || ($_REQUEST['dob']=="") || ($_REQUEST['phone']=="") || ($_REQUEST['email']=="")) {
		echo '{"result":0, "message": "All user information required was not given"}';
		return;
	}
	
	include_once("users.php");
	$obj = new users();
	$username = $_REQUEST['username'];
	$firstname = $_REQUEST['firstname'];
	$lastname = $_REQUEST['lastname'];
	$password = $_REQUEST['password'];
	$gender = $_REQUEST['gender'];
	$dob = $_REQUEST['dob'];
	$phone = $_REQUEST['phone'];
	$email = $_REQUEST['email'];
	
	$a = $obj->newUser($username,$firstname,$lastname,$password,$gender,$dob,$phone,$email);

	if (!$a) {
		echo '{"result":0 ,"message": "Could not add User"}';
	}
	
	else {
	 echo '{"result": 1, "message": "User sucessfully added for"}';	
	}
	
}

function logUser(){
	if (($_REQUEST['username']=="") || ($_REQUEST['password']=="")) {
		echo '{"result":0, "message": "All user information required was not given"}';
		return;
	}
	
	include_once("users.php");
	$obj = new users();
	$username = $_REQUEST['username'];
	$password = $_REQUEST['password'];
	
	$result = $obj->getUser($username,$password);

	if ($result==false) {
		echo '{"result":0 ,"message": "Could not log User"}';
	}
	
	else {
	 echo '{"result": 1, "message": "User sucessfully logged in"}';	
	}
}

function addRide() {
	if (($_REQUEST['firstname']=="") || ($_REQUEST['lastname']=="") || ($_REQUEST['origin']=="")
		|| ($_REQUEST['destination']=="") || ($_REQUEST['leavedate']=="") || ($_REQUEST['leavetime']=="") || ($_REQUEST['contribution']=="")
		|| ($_REQUEST['vehicletype']=="") || ($_REQUEST['vehiclemodel']=="") || ($_REQUEST['numseats']=="") || ($_REQUEST['lisencenum']=="")) {
		echo '{"result":0, "message": "All ride information required was not given"}';
		return;
	}
	
	include_once("ride.php");
	$obj = new ride();

	$firstname = $_REQUEST['firstname'];
	$lastname = $_REQUEST['lastname'];
	$origin = $_REQUEST['origin'];
	$destination = $_REQUEST['destination'];
	$leavedate = $_REQUEST['leavedate'];
	$leavetime = $_REQUEST['leavetime'];
	$contribution = $_REQUEST['contribution'];
	$vehicletype = $_REQUEST['vehicletype'];
	$vehiclemodel = $_REQUEST['vehiclemodel'];
	$numseats = $_REQUEST['numseats'];
	$lisencenum = $_REQUEST['lisencenum'];

	
	$a = $obj->newRide($firstname,$lastname,$origin,$destination,$leavedate,$leavetime,$contribution,$vehicletype,$vehiclemodel,$numseats,$lisencenum);

	if (!$a) {
		echo '{"result":0 ,"message": "Could not add Ride"}';
	}
	
	else {
	 echo '{"result": 1, "message": "Ride sucessfully created"}';	
	}
	
}

function viewRides() {
	
	include_once("ride.php");
	$obj = new ride();
	
	$a = $obj->getRides();

	if (!$a) {
		echo '{"result":0 ,"message": "Could not view Rides"}';
	}
	
	else {
		$row=$obj->fetch();
		echo '{"result":1,"pool":[';
		while($row){
			echo json_encode($row);

			$row=$obj->fetch();
			if($row!=false){
				echo ",";
			}
		}
		echo "]}";	
	}
	
}

function viewRide() {
	
	if (($_REQUEST['rideid']=="")) {
		echo '{"result":0, "message": "Ride Id was not given"}';
		return;
	}
	
	include_once("ride.php");
	$obj = new ride();
	$rideid = $_REQUEST['rideid'];

	$a = $obj->searchRide($rideid);

	if (!$a) {
		echo '{"result":0 ,"message": "Could not view Ride"}';
	}
	
	else {
		$row=$obj->fetch();
		echo '{"result":1,"pool":[';
		while($row){
			echo json_encode($row);

			$row=$obj->fetch();
			if($row!=false){
				echo ",";
			}
		}
		echo "]}";	
	}
	
}

function joinRide(){
	if (($_REQUEST['rideid']=="") || ($_REQUEST['numpeople']=="") || ($_REQUEST['isjoined']=="") || ($_REQUEST['seatsleft']=="")) {
		echo '{"result":0, "message": "Some information about ride is missing"}';
		return;
	}
	
	include_once("ride.php");
	$obj = new ride();
	$rideid = $_REQUEST['rideid'];
	$isjoined = $_REQUEST['isjoined'];
	$numpeople = $_REQUEST['numpeople'];
	$seatsleft = $_REQUEST['seatsleft'];

	if($isjoined==1){
		echo '{"result":0, "message": "You have already joined this ride"}';
		return;		
	}
	
	if($seatsleft==0){
		echo '{"result":0, "message": "This ride is full, please check another ride"}';
		return;		
	}
	$people=$numpeople+1;

	$result = $obj->joinRide($rideid,1,$people);

	if ($result==false) {
		echo '{"result":0 ,"message": "Could not join ride"}';
	}
	
	else {
	 echo '{"result": 1, "message": "Yaay, you have joined the ride"}';	
	}
}

function sharedRides() {
	
	include_once("ride.php");
	$obj = new ride();

	$a = $obj->sharedRide(1);

	if (!$a) {
		echo '{"result":0 ,"message": "There are no shared rides to display"}';
	}
	
	else {
		$row=$obj->fetch();
		echo '{"result":1,"pool":[';
		while($row){
			echo json_encode($row);

			$row=$obj->fetch();
			if($row!=false){
				echo ",";
			}
		}
		echo "]}";	
	}
	
}

function joinedRides() {
	
	include_once("ride.php");
	$obj = new ride();

	$a = $obj->joinedRide(1);

	if (!$a) {
		echo '{"result":0 ,"message": "There are no joined rides to display"}';
	}
	
	else {
		$row=$obj->fetch();
		echo '{"result":1,"pool":[';
		while($row){
			echo json_encode($row);

			$row=$obj->fetch();
			if($row!=false){
				echo ",";
			}
		}
		echo "]}";	
	}
	
}


?>