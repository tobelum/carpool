<?php
     include_once("adb.php");
     
     /**
	*Variables used in all the functions for Patients
	*@param int blogid
	*@param string firstname
	*@param string lastname
	*@param string title
	*@param date eventdate
	*@param time eventtime
	*@param string place
	*@param string blogtext
	*/

class blogs extends adb{
     function blogs(){

     }

     function newBlog($firstname='none',$lastname='none',$title='none',$eventdate='none',$eventtime='none', $place='none',$blogtext='none'){
    
          $strQuery = "insert into blog set firstname = '$firstname',
                                          lastname='$lastname',
                                           title = '$title',
                                           eventdate = '$eventdate',
                                           eventtime = '$eventtime',
                                           place = '$place',
                                           blogtext = '$blogtext'
                                           ";
          return $this->query ($strQuery);
     }

     function getBlogs($filter=false){

        $strQuery = "select blogid, firstname, lastname, title, eventdate, eventtime, place, blogtext from blog"; 
               if($filter!=false){
                    $strQuery=$strQuery . " where $filter";

          }
               return $this->query($strQuery);
  

     }

   }
