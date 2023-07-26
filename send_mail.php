<?php

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require_once "phpmailer/Exception.php";
require_once "phpmailer/PHPMailer.php";
require_once "phpmailer/SMTP.php";





// ENVOIE EMAIL AVEC FICHIER JOIN ESSAIER EN PROD 

// if(isset($_POST['submit'])){
//     extract($_POST);

// $content_dir = "files/";
    
// $tmp_file = $_FILES['file']['tmp_name'];

// if(!is_uploaded_file($tmp_file)){
//     exit('ce fichier est introuvable');
// }
// $type_file = $_FILES['file']['type'];

// if(!strstr($type_file,'PDF') and !strstr($type_file,'pdf')){
//     exit("ce type de fichier n'est pas pris en charge");
// }
// $name_file = time().'pdf';

// if(!move_uploaded_file($tmp_file,$content_dir.$name_file)){
//     exit('impossible de copier ce fichier');
// }
// $mail = new PHPMailer(true);
//     //Destinataire
//     $mail-> addAddress("Renovate@outlook.fr");

//     // Expediteur
//     $mail -> setFrom($_POST['email']);

//     // Contenue
//     // $mail->Subject = $_POST['checkbox'];
//     $mail->Body = $_POST['message'];
//     $mail->addAttachment('files/'.$name_file);

//     // 
//     $mail->send();
    
//     echo "mail envoyer";
// }

// envoi du mail




// ENVOIE D4EMAIL EN LOCAL

$mail = new PHPMailer(true);
try
{
    // configuration
    $mail->SMTPDebug = SMTP::DEBUG_SERVER; // je veux des information de debug

    // config SMTP
    $mail->isSMTP();
    $mail->Host = "localhost";
    $mail->Port = 1025;

    // charset
    $mail->CharSet = "utf-8";

    //Destinataire
    $mail-> addAddress("Renovate@outlook.fr");

    // Expediteur
    $mail -> setFrom($_POST['email']);

    // Contenue
    // $mail->Subject = $_POST['checkbox'];
    $mail->Body = $_POST['message'];
    $mail->addAttachment($_F['files']);

    // 
    $mail->send($_POST['send']);
    
    echo "mail envoyer";
}
catch(Exception){
    echo "Mail non envoyer. Erreur:{$mail->ErrorInfo}";
}
header('Location:index.php');






















// $to = "ikramdjellouli@ghotmail.fr";
// $subject = $_POST['name'].$_POST['lastname'];
// $message = wordwrap($_POST['message'],70,"\r\n");
// $header = [
//     "From" => $_POST['name'].$_POST['lastname'],
//     "Reply_To"=> $_POST['email']
// ];


// mail("ikramdjellouli@hotmail.fr","message","message");

?>