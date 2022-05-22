<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';
require_once "backend/Gites.php";



class Reservation extends Gites
{
    public function reserverGite(){
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);
        try {
            //Server settings
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Utilisation du service mail transfer protocole
            $mail->isSMTP(); //Utilisation du service mail transfer protocole
            $mail->Host = 'smtp.mailtrap.io'; //Appel du host mailtrap
            $mail->SMTPAuth = true; //Autorise et impose un user name + password
            $mail->Username = '9427859f295dcb'; //Generer lors de la création du compte mailTrap = dans l'espace mailtrap roue crantée + smtp setting -> phpmailer
            $mail->Password = 'aa1c614a61c312'; // Idem pour le mot de passe
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; //La Transport Layer Security (TLS) ou « Sécurité de la couche de transport »
            $mail->Port = 2525; //Port pour mailtrap sinon ->587 ou 465 pour `PHPMailer::ENCRYPTION_SMTPS` et gmail
            $mail->setLanguage('fr', '../vendor/phpmailer/phpmailer/language/');
            $mail->CharSet = 'UTF-8';

            //Recipients
            $mail->setFrom('from@example.com', 'Mailer');
            $mail->addAddress('joe@example.net', 'Joe User');     //Add a recipient
            $mail->addAddress('ellen@example.com');               //Name is optional
            $mail->addReplyTo('info@example.com', 'Information');
            $mail->addCC('cc@example.com');
            $mail->addBCC('bcc@example.com');

            //Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'test du sujet';

            $giteDetails = $this->getGiteById();

            $mail->Body    = '
             <!DOCTYPE html>
                    <html lang="fr">
                    <head>
                        <meta charset="UTF-8">
                        <meta http-equiv="Content-Type" content="text/html">
                        <title>Votre reservation chez locagite.com</title>
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    </head>
            <body style="color: #6cc3d5;">
            <div style="color: #8c9b03"; padding: 20px;">
            <img src="https://upload.wikimedia.org/wikipedia/fr/thumb/7/7c/G%C3%AEtes_de_France_%28logo%29.svg/1200px-G%C3%AEtes_de_France_%28logo%29.svg.png" style="display: block; border-radius: 100%" width="50px" height="50px" >  
            <p>TEST</p>
            <p>Nom du gite :<b style="color: #cc3300">'.$giteDetails['nom_gite'].'</p>
            <p>Description du gite :<b  style="color: #899703">'.$giteDetails['description_gite'].'</p>
             <p>'.$giteDetails['image_gite'].'</p>
             <p>'.$giteDetails['prix_gite'].'</p>
               <p>'.$giteDetails['nbr_chambre'].'</p>
             <p>'.$giteDetails['nbr_sdb'].'</p>
              <p>'.$giteDetails['disponible'].'</p>
              <p>'.$giteDetails['date_depart'].'</p>
              
                            
             
            </div>
            </body>
            </html>
            
            
 
            ';

            $mail->AltBody = 'Copie si ca marche pas';

            $mail->send();
            echo 'Message à bien ete envoyé (ceci s\'affiche sur la vue reservation.php)';
        } catch (Exception $e) {
            echo "Sinon on affiche une erreur : {$mail->ErrorInfo}";
        }
    }

}