<?php
     include_once("adb.php");
     
     /**
	*Variables used in all the functions for Patients
	*@param int userid User ID
	*@param string username username
	*@param string firstname first name
	*@param string lastname last name
	*@param string userpassword userpassword
	*@param enum usergender gender
	*@param date userdob date of birth
	*@param int userphone phone number
	*@param string useremail email address
	*/

class users extends adb{
     function users(){

     }

     function newUser($username='none',$firstname='none',$lastname='none',$userpassword='none',$usergender='none', $userdob='none',$userphone='none',$useremail='none'){
    
          $strQuery = "insert into user SET username = '$username',
                                           firstname = '$firstname',
                                           lastname = '$lastname',
                                           userpassword = '$userpassword',
                                           usergender = '$usergender',
                                           userdob = '$userdob',
                                           userphone = '$userphone',
                                           useremail = '$useremail'                                   
                                           ";
          return $this->query ($strQuery);
     }

     function getUser($username='none',$userpassword='none'){
          $strQuery="select userid from `user` where username='$username' & userpassword='$userpassword';";
          return $this->query($strQuery);
     }
   }
