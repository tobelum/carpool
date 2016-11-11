<?php
     include_once("adb.php");
     
     /**
	*Variables used in all the functions for Patients
	*@param int rideid ride ID
	*@param int ownerid owner ID
	*@param string origin origin
	*@param string destination destination
	*@param date leavedate leave date
	*@param time leavetime leave time
	*@param int contribution contribution
	*@param int numpeople number of people
  *@param string vehicletype
  *@param string vehiclemodel
  *@param int numseats
  *@param string lisencenum
	*/

class ride extends adb{
     function ride(){

     }

     function newRide($firstname='none',$lastname='none',$origin='none',$destination='none',$leavedate='none', $leavetime='none',$contribution='none',
      $vehicletype='none',$vehiclemodel='none', $numseats='none',$lisencenum='none'){
    
          $strQuery = "insert into ride set firstname = '$firstname',
                                          lastname='$lastname',
                                           origin = '$origin',
                                           destination = '$destination',
                                           leavedate = '$leavedate',
                                           leavetime = '$leavetime',
                                           contribution = '$contribution',
                                           vehicletype= '$vehicletype',
                                           vehiclemodel='$vehiclemodel',
                                           numseats='$numseats',
                                           lisencenum='$lisencenum'
                                           ";
          return $this->query ($strQuery);
     }

     function getRides($filter=false){

        $strQuery = "select rideid, firstname, lastname, origin, destination, leavedate, leavetime, contribution, numpeople, vehicletype, vehiclemodel, numseats, lisencenum, isJoined from ride"; 
               if($filter!=false){
                    $strQuery=$strQuery . " where $filter";

          }
               return $this->query($strQuery);
  

     }

    function sharedRide($text=false){
      $filter=false;
      if($text!=false){
        $filter=" isCreated = '$text' ";
      }
      
      return $this->getRides($filter);
      
    }

    function joinedRide($text=false){
      $filter=false;
      if($text!=false){
        $filter=" isJoined = '$text' ";
      }
      
      return $this->getRides($filter);
      
    }

    function joinRide($rideid='none',$isjoined='none',$people='none'){
      $strQuery = "update ride set isjoined=$isjoined, numpeople=$people where rideid='$rideid'";
      return $this->query($strQuery);
    }
     //function joinRide($u)

     // function getUser($username='none',$userpassword='none'){
     //      $strQuery="select * from user where username = '$username' and userpassword = '$userpassword';";
     //      return $this->query($strQuery);
     // }
   }
