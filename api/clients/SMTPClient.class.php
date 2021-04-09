<?php
require_once dirname(__FILE__).'/../config.php';
require_once dirname(__FILE__).'/../../vendor/autoload.php';

class SMTPClient{

  private $mailer;

  public function __construct(){
    $transport = (new Swift_SmtpTransport(Config::SMTP_HOST, Config::SMTP_PORT, 'tls'))
      ->setUsername(Config::SMTP_USER)
      ->setPassword(Config::SMTP_PASSWORD);

    $this->mailer = new Swift_Mailer($transport);
  }

  public function send_register_user_token($user){
    $message = (new Swift_Message('Confirm your account'))
      ->setFrom(['dzeni@sandboxcfd6b95d13c64bc287e7c70bc008faea.mailgun.org' => 'RecipeBook'])
      ->setTo([$user['email']])
      ->setBody('Here is the confirmation link: http://localhost/recipeBook/api/users/confirm/'.$user['token']);

    $this->mailer->send($message);
  }

}


?>
