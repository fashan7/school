<?php
class mail
{
	public static function sendMail()
	{
		$to = 'vino2420@gmail.com';
		$subject = 'Feed back';
		$message = file_get_contents('https://www.google.lk/');
		// $content = file_get_contents($message);
		$headers  = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=UTF-8\r\n";
		$headers .= "From: no-reply@admin.com\r\n";

		
		if(mail($to, $subject, $message, $headers))
		{
			echo "Success..!";
		}
		else
		{
			echo "Failure..!";
		}
	}
}