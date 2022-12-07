<?php

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

class Email {

  function EnviarCorreo($ASUNTO,$CUERPO,$PARA,$CC,$BCC,$ARR_FILES){
    $mail = new PHPMailer\PHPMailer\PHPMailer();
    try{

      $mail->SMTPDebug = 1;                                       // Enable verbose debug output
      $mail->isSMTP();                                            // Set mailer to use SMTP
      $mail->Host       = 'smtp-mail.outlook.com';  // Specify main and backup SMTP servers
      $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
      $mail->Username   = 'multiserviciossa123@hotmail.com';                     // SMTP username
      $mail->Password   = 'P@zzw0rd1';                               // SMTP password
      $mail->SMTPSecure = 'TLS';                                  // Enable TLS encryption, `ssl` also accepted
      $mail->Port       = 587;                                   // TCP port to connect to

          //Recipients
          $mail->setFrom('multiserviciossa123@hotmail.com', 'Multiservicios SA');

          if($PARA != ''){
            $PARA = str_replace(" ", "", $PARA);
            $A_PARA = explode(",", $PARA);


             if(count($A_PARA) >= 1){
               for ($i=0; $i < count($A_PARA); $i++) {
                 if($A_PARA[$i] != ''){
                 $mail->addAddress($A_PARA[$i],$A_PARA[$i]);
                }
               }
             }
          }

          if($CC != ''){
            $CC = str_replace(" ", "", $CC);
            $A_CC = explode(",", $CC);


             if(count($A_CC) >= 1){
               for ($i=0; $i < count($A_CC); $i++) {
                 if($A_CC[$i] != ''){
                 $mail->addCC($A_CC[$i]);
               }
               }
             }
          }

          if($BCC != ''){
            $BCC = str_replace(" ", "", $BCC);
            $A_BCC = explode(",", $BCC);

             if(count($A_BCC) >= 1){
               for ($i=0; $i < count($A_BCC); $i++) {
                 if($A_BCC[$i] != ''){
                 $mail->addBCC($A_BCC[$i]);
               }
               }
             }
          }

  if(count($ARR_FILES) > 0){
    for ($i=0; $i < count($ARR_FILES); $i++) {
      $mail->addAttachment($ARR_FILES[$i]);
    }
  }
  
          $mail->isHTML(true);

          $mail->Subject = utf8_decode($ASUNTO);
          $mail->Body   = utf8_decode($CUERPO);

    $SEND[0] = false;
    $SEND[1] = "";
          if($mail->Send()) {
            $SEND[0] = true;
            $SEND[1] = "Correo enviado correctamente";
                $f = fopen('LOGCORREOS/SendMailLogs.txt', 'a');
                if($f){
                  fwrite($f, date("d m Y H:i:s")." = "."/ $PARA / $CC / $BCC"."\n");
                  fclose($f);
                }

             }else{
               $SEND[1] = $mail->ErrorInfo;
               $log =  "El Correo no se pudo enviar error: {$mail->ErrorInfo}";
               $f = fopen('LOGCORREOS/ErrorMailLogs.txt', 'a');
               if($f){
                 fwrite($f, date("d m Y H:i:s")." = $log"."\n");
                 fclose($f);
               }

             }

           } catch (Exception $e) {
               $SEND[1] = $mail->ErrorInfo;
               $log =  "El Correo no se pudo enviar error: {$mail->ErrorInfo}";
               $f = fopen('LOGCORREOS/ErrorMailLogs.txt', 'a');
               if($f){
                 fwrite($f, date("d m Y H:i:s")." = $log"."\n");
                 fclose($f);
               }

           }

    return $SEND;
  }

}

 ?>
