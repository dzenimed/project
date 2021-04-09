<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once dirname(__FILE__)'/../vendor/autoload.php';

// Create the Transport
$transport = (new Swift_SmtpTransport('smtp.mailgun.org', 587))
  ->setUsername('postmaster@sandboxcfd6b95d13c64bc287e7c70bc008faea.mailgun.org')
  ->setPassword('d671654d46809f9f8e3ce424be6a6a7a-e687bab4-69f81cc2')
;

// Create the Mailer using your created Transport
$mailer = new Swift_Mailer($transport);

// Create a message
$message = (new Swift_Message('Wonderful Subject'))
  ->setFrom(['brad@sandboxcfd6b95d13c64bc287e7c70bc008faea.mailgun.org ' => 'Dzeni'])
  ->setTo(['dzenana.mededovic@gmail.com'])
  ->setBody('Here is the message itself')
  ;

// Send the message
$result = $mailer->send($message);
print_r($result);
?>
