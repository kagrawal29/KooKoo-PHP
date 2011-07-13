<?php
//Description:Sample Code implementing usage of conference dynamically
require_once("response.php");//response.php is the kookoo xml preparation class file
$r = new Response();
$confno =array(1234,3424); // declaration of array
if($_REQUEST['event']== "NewCall" || $_SESSION['next_goto']=='restart') 
{

    $collectInput = New CollectDtmf();
	$collectInput->addPlayText('please enter the conference number followed by hash',3);
	$collectInput->setMaxDigits('4'); //max inputs to be allowed
	$collectInput->setTimeOut('4000');  //maxtimeout if caller not give any inputs
	$collectInput->setTermChar('#');  
	$r->addCollectDtmf($collectInput);
    $_SESSION['next_goto']='conference';

}
else if($_SESSION['next_goto']=='conference')
{
     if($_REQUEST['data']=="")
     {
         $r->addPlayText("You have not given any input");
         $_SESSION['next_goto']='restart';
      }
     else if($_REQUEST['data']==$confno[0])
     {
         $r->addPlayText("Please be online while we connect you. Thank you");
	     $r->addConference($confno[0]); 
      }
    else
    {
    $r->addPlayText("Your input has been not matched with any our conference numbers");
    }


}
$r->send();
?> 