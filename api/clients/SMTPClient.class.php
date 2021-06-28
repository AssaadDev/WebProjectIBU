<?php
require_once dirname(__FILE__).'/../config.php';
require_once dirname(__FILE__).'/../../vendor/autoload.php';
require_once dirname(__FILE__).'/../dao/PatientDao.class.php'; // PatientDao.class.php'

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


class SMTPClient{


private $mailer;
protected $dao;

public function __construct() {

  $dao= new PatientDao(); // change

 $transport = (new Swift_SmtpTransport(Config::SMTP_HOST,Config::SMTP_PORT,Config::SMTP_ENCRYPTION))
   ->setUsername(Config::SMTP_USER)
   ->setPassword(Config::SMTP_PASSWORD);

 $this->mailer = new Swift_Mailer($transport);

}
public function send_register_user_token($user) {
  $message = (new Swift_Message('Confirmation of your account'))
    ->setFrom(['bandzosteam@gmail.com' => 'Coronavirus Assistant'])
    ->setTo([$user['Email']])
    ->setBody('Confirm your account by clicking the URL:http://localhost/cv19assistant/api/confirm/'.$user["token"]. ', password for your account is:'. $user["password"]);


  $this->mailer->send($message);
}
public function send_user_recovery_token($user) {
  $message = (new Swift_Message('Confirmation of your account'))
    ->setFrom(['bandzosteam@gmail.com' => 'Coronavirus Assistant'])
    ->setTo([$user['Email']])
    ->setBody('Recover your account with the token: http://localhost/cv19assistant/login.html?token=
'.$user["token"]);




  $this->mailer->send($message);
}

public function send_user_recovery_token2($user) {
  $message = (new Swift_Message('Confirmation of your account'))
    ->setFrom(['bandzosteam@gmail.com' => 'Coronavirus Assistant'])
    ->setTo([$user['Email']])
    ->setBody('Vaccine changed succesfully');




  $this->mailer->send($message);
}

public function send_user_info($number){


}



}









 ?>
