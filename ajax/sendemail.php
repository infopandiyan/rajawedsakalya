<?php
session_start();
ob_start();
date_default_timezone_set('UTC');

$datetime = date("Y-m-d H:i:s");

$dt = new DateTime($datetime);
$tz = new DateTimeZone('Asia/Kolkata'); // or whatever zone you're after

$dt->setTimezone($tz);
//echo $dt->format('Y-m-d g:i a');

/* Post Control*/
if($_POST){
	

//exit;
	/*Your Website Email*/
	$your_email = "infopandiyan@gmail.com";
    $email = 'Guest@email.com';
    $subject = 'Raja Weds Akalaya Web Messages';
	/*Form Post*/
	$name			= $_POST['name'];
	$email 			= $_POST['email']; 
	$phone			= $_POST['phone']; 
	$comments  		= $_POST['comments']; 
	
		
		/*Check the free space*/
		//if(!$name || !$email || !$phone || !$comments)
		if(!$name || !$comments)
		{

		?>
        <div class="alert alert-danger heading">Name and Message Required</div>	
		
		<?php
		}else{
			$data =  array('name' => $name, 'datetime' => $datetime, 'message'=> $comments);
			$myFile = "savedata.json";
			$inp = file_get_contents($myFile);
			$tempArray = json_decode($inp);
			array_push($tempArray, $data);
			$jsonData = json_encode($tempArray);
			file_put_contents($myFile, $jsonData);
			
			$finaldata = file_get_contents($myFile);
			//$jfo = json_decode($finaldata);
			
			//echo json_encode($jfo);  
			//print_r($jfo);
     // exit();
		/*foreach ($jfo as $post) {
		    echo $post->name;
		     echo $post->messsage;
		      echo $post->datetime;
		}*/



		$headers   = array();
		$headers[] = "MIME-Version: 1.0";
		$headers[] = "Content-type: text/plain; charset=utf-8";
		$headers[] = "From: $name <$email>"; // Sender name and email address
		$headers[] = "Reply-To: Recipient Name <$your_email>"; // Your site e-mail address
		$headers[] = "X-Mailer: PHP/".phpversion();
		
		mail($your_email, $subject, $comments, implode("\r\n", $headers));							 
						  
								  
		?>
        <div class="alert alert-success heading">Thank you. Your messsage saved.</div>	
		
		<?php
			}

	
	}else{
		?>
        <div class="alert alert-danger heading">Server Error</div>	
		
		<?php
		}
	
 ?>