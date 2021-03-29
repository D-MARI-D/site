<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';

$mail = new PHPMailer(true);
$mail->CharSet = 'UTF-8';
$mail->setLanguage('ru', 'phpmailer/language/');
$mail->IsHTML(true);

//от кого письмо
$mail->setForm('https://d-mari-d.github.io/site/', 'Ваша помощь');
//кому отправить
$mail->addAddress('dubavaya.maria@mail.ru');
//номер телефона
$mail->Subject = 'Личные данные';

//Суммы ущерба
$amount = "до 100.000 руб";
if($_POST['amount'] == "2"){
   $amount = "от 100.000 до 300.000 руб";
}
if($_POST['amount'] == "3"){
   $amount = "свыше 300.000";
}

//тело письма
$body = '<h1>Личные данные клиента</h1>';

if(trim(!empty($_POST['name']))){
   $body.='<p><strong>Имя:</strong> '.$_POST['name'].'</p>';
}
if(trim(!empty($_POST['amount']))){
   $body.='<p><strong>Сумма:</strong> '.$amount.'</p>';
}
if(trim(!empty($_POST['tel']))){
   $body.='<p><strong>Номер:</strong> '.$_POST['tel'].'</p>';
}

 $mail->Body = $body;

 if (!$mail->send()) {
    $message = 'Ошибка';
 } else {
    $message = 'Данные отправлены!';
 }

 $response = ['message' => $message];

 header('Content-type: application/json');
echo json_encode($response);

?>