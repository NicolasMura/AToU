<?php



function authgMail($from, $namefrom, $to, $nameto, $subject, $message)
{

/*  your configuration here  */

$smtpServer = "tls://smtp.gmail.com"; //does not accept STARTTLS
$port = "465"; // try 587 if this fails
$timeout = "45"; //typical timeout. try 45 for slow servers
$username = "XXX@gmail.com"; //your gmail account
$password = "XXXX"; //the pass for your gmail
$localhost = $_SERVER['REMOTE_ADDR']; //requires a real ip
$newLine = "\r\n"; //var just for newlines




 
/*  you shouldn't need to mod anything else */

//connect to the host and port
$smtpConnect = fsockopen($smtpServer, $port, $errno, $errstr, $timeout);
//echo $errstr." - ".$errno;
$smtpResponse = fgets($smtpConnect, 4096);
if(empty($smtpConnect))
{
   $output = "Failed to connect: $smtpResponse";
   //echo $output;
   return $output;
}
else
{
   $logArray['connection'] = "Connected to: $smtpResponse";
  // echo "connection accepted<br>".$smtpResponse."<p />Continuing<p />";
}

//you have to say HELO again after TLS is started
   fputs($smtpConnect, "HELO $localhost". $newLine);
   $smtpResponse = fgets($smtpConnect, 4096);
   $logArray['heloresponse2'] = "$smtpResponse";
  
//request for auth login
fputs($smtpConnect,"AUTH LOGIN" . $newLine);
$smtpResponse = fgets($smtpConnect, 4096);
$logArray['authrequest'] = "$smtpResponse";

//send the username
fputs($smtpConnect, base64_encode($username) . $newLine);
$smtpResponse = fgets($smtpConnect, 4096);
$logArray['authusername'] = "$smtpResponse";

//send the password
fputs($smtpConnect, base64_encode($password) . $newLine);
$smtpResponse = fgets($smtpConnect, 4096);
$logArray['authpassword'] = "$smtpResponse";

//email from
fputs($smtpConnect, "MAIL FROM: <$from>" . $newLine);
$smtpResponse = fgets($smtpConnect, 4096);
$logArray['mailfromresponse'] = "$smtpResponse";

//email to
fputs($smtpConnect, "RCPT TO: <$to>" . $newLine);
$smtpResponse = fgets($smtpConnect, 4096);
$logArray['mailtoresponse'] = "$smtpResponse";

//the email
fputs($smtpConnect, "DATA" . $newLine);
$smtpResponse = fgets($smtpConnect, 4096);
$logArray['data1response'] = "$smtpResponse";

//construct headers
$headers = "MIME-Version: 1.0" . $newLine;
$headers .= "Content-type: text/html; charset=iso-8859-1" . $newLine;
$headers .= "To: $nameto <$to>" . $newLine;
$headers .= "From: $namefrom <$from>" . $newLine;

//observe the . after the newline, it signals the end of message
fputs($smtpConnect, "To: $to\r\nFrom: $from\r\nSubject: $subject\r\n$headers\r\n\r\n$message\r\n.\r\n");
$smtpResponse = fgets($smtpConnect, 4096);
$logArray['data2response'] = "$smtpResponse";

// say goodbye
fputs($smtpConnect,"QUIT" . $newLine);
$smtpResponse = fgets($smtpConnect, 4096);
$logArray['quitresponse'] = "$smtpResponse";
$logArray['quitcode'] = substr($smtpResponse,0,3);
fclose($smtpConnect);
//a return value of 221 in $retVal["quitcode"] is a success
return($logArray);
}

					/*
					
					require("../inc/fonctionMailGoogle.php");
if(isset($_POST['btn']))
{
		//Envoi d'un message avec le pwd
		$obj="Demande d'info";
		$mess="Bonjour, \r\n <br />Vous venez de recevoir une demande d'info : \r\n <br />";
		$mess.="-----------------------<br />"; 
		$mess.="Nom : ".$_POST['nom']." \r\n <br />"; 
		$mess.="Prénom : ".$_POST['prenom']." \r\n <br />"; 
		$mess.="Message : ".$_POST['message']." \r\n <br />"; 
		$mess.="-----------------------<br /> \r\n"; 
		$mess.="L'équipe FTL <br /> \r\n"; 
		
		$mailfrom=$_POST['email']; 
		$namefrom="EMETTEUR";
		$mailto="vincent-perez@hotmail.fr";	
		$nameto="DESTINATAIRE";			
					if(($mailto!="")&&($mailto!=NULL))	
					{
					authgMail($mailfrom, $namefrom, $mailto, $nameto, $obj, $mess);	
					//mail($destinataire,$obj,$mess,"From:".$email."\r\nReply-to:".$email."\r\nContent-type:text/html;charset=utf-8");
					echo "MESSAGE ".$mess."<br />";				
					//echo "ENVOI à ".$destinataire."<br />";	
					//header("Location:index.php");	
					}	
} // fin du test d'envoi du form
					
					*/

?>