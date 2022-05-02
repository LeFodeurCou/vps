<?php


	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

	require_once 'vendor/phpmailer/phpmailer/src/Exception.php';
	require_once 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
	require_once 'vendor/phpmailer/phpmailer/src/SMTP.php';

	//Load Composer's autoloader
	require_once 'vendor/autoload.php';

	if (file_exists('settings/realSettings.php'))
		require_once 'settings/realSettings.php';
	else
		require_once 'settings/defaultSettings.php';

	function sendMail()
	{
		$json = [
			'action'	=>	'/v1/send/mail',
			'success'	=>	false,
		];

		if ("false" == ($_POST['honeypot'] ?? "true"))
		{
			$json['success'] = true;
			$json['data'] = $_POST;
			$json['mailSent'] = mail(
				'lefodeurcou@gmail.com',
				'Contact from lefodeurcou.fr',
				$_POST['name'] . ' ' . $_POST['mail'] . ' ' . $_POST['msg']
			);

			$mail = new PHPMailer(true);

			try {
				//Server settings
				$mail->IsSMTP();
				$mail->SMTPDebug = 0;
				$mail->SMTPAuth = true;
				$mail->SMTPSecure = 'ssl';
				$mail->Host = __MAIL_HOST__;
				$mail->Port = __MAIL_PORT__;
				$mail->Username = __MAIL_USERNAME__;  
				$mail->Password = __MAIL_PASSWORD__;           
				$mail->SetFrom($_POST['mail'], $_POST['name']);
				$mail->Subject = 'Contact Portfolio ' . $_POST['name'];
				$mail->Body = $_POST['msg'];
				$mail->AddAddress(__MAIL_TO__);
				$mail->addReplyTo($_POST['mail'], $_POST['name']);
				$mail->Send();
				echo 'Message has been sent';
			} catch (Exception $e) {
				echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
			}
		}

		header('Content-Type: application/json');
		echo json_encode($json);
	}

?>