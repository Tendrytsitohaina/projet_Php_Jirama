<?php
    require 'PHPMailer/phpmailer/src/PHPMailer.php';
    require 'PHPMailer/phpmailer/src/Exception.php';
    require 'PHPMailer/phpmailer/src/SMTP.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    foreach($item as $item){
        $item['mail'] = $item['mail'];
        $item['nom'] = $item['nom'];
        $item['prenom'] = $item['prenom'];
    }
  
    require 'vendor/vendor/autoload.php';

    $mail = new PHPMailer(true);

    try{
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'tendryrandriatsitohaina@gmail.com';
        $mail->Password = 'oxdu znlz bjbo jjat';
        $mail->SMTPSecure = 'TLS';
        $mail->Port = 587;

        
        $mail->setFrom('tendryrandriatsitohaina@gmail.com', 'Service Facturation');
        $mail->addAddress($item['mail'], $item['nom']);

        $mail->isHTML(true);

        $mail->Subject = "Rappel de paiement - Facture en attente";
        $mail->Body = "Bonjour " .$item['nom']. " " .$item['prenom']. ",<br><br>
                        Votre facture arrive à échéance. Merci de procéder au paiement.<br><br>
                        Cordialement.<br>Service facturation";

        $mail->send();
        $mail->SMTPDebug = 2;
        $mail->Debugoutput = 'html'; 


        echo "Notif envoyée à ".$item['nom']. " " .$item['prenom'];
        require 'views/mail/mailSuccess.php';
    }catch (Exception $e){
        // echo $mail->SMTPDebug = 2;
        echo "Erreur lors de l'envoie à ".$item['nom']. " " .$item['prenom'] .":".$mail->ErrorInfo ;
    }

    // $mailBody = "Bonjour " .$item['nom']. " " .$item['prenom']. ",\r\n
    // Votre facture arrive à échéance. Merci de procéder au paiement.\r\n
    // Cordialement.\nService facturation";

    // $mailTo = $item['mail'];
    // $header = "From: Services Facturation <tendryrandriatsitohaina@gmail.com>\r\nReply-To: tendryrandriatsitohaina@gmail.com";
    // mail($mailTo, "Un message pour votre Facture de Jirama", $mailBody, $header);

   

?>