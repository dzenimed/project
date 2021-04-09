<?php
require_once dirname(__FILE__)'/../config.php';
require_once dirname(__FILE__)'/../../vendor/autoload.php';

class SMTPClient{

  private $mailer;

  public function __construct(){
    $transport = (new Swift_SmtpTransport(Config::SMTP_HOST, Config::SMTP_PORT))
      ->setUsername(Config::SMTP_USER)
      ->setPassword(Config::SMTP_PASSWORD);

    $this->mailer = new Swift_Mailer($transport);
  }

  public function send_register_user_token($user){
    $message = (new Swift_Message('Confirm your account'))
      ->setFrom(['dzenana.mededovic@stu.ibu.edu.ba' => 'RecipeBook'])
      ->setTo([$user['email']])
      ->setBody('Here is the confirmation link: http://localhost/recipeBook/api/users/confirm/'.$user['token']);

    $this->mailer->send($message);
  }

}



  // Create a message
  $message = (new Swift_Message('Wonderful Subject'))
    ->setFrom(['dzeni@sandboxcfd6b95d13c64bc287e7c70bc008faea.mailgun.org' => 'Dzeni'])
    ->setTo(['dzenana.mededovic@gmail.com'])
    ->setBody('Here is the message itself')
    ;

  // Send the message
  $result = $mailer->send($message);

?>
