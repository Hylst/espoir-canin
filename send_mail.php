<?php
/* ===========================================
   ESPOIR CANIN - Script d'envoi d'email
   =========================================== */

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'assets/php/PHPMailer/Exception.php';
require 'assets/php/PHPMailer/PHPMailer.php';
require 'assets/php/PHPMailer/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Nettoyage des données
    $name = strip_tags(trim($_POST["name"] ?? ""));
    $email = filter_var(trim($_POST["email"] ?? ""), FILTER_SANITIZE_EMAIL);
    $phone = strip_tags(trim($_POST["phone"] ?? ""));
    $message = trim($_POST["message"] ?? "");

    if (empty($name) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo json_encode(["errors" => [["message" => "Merci de remplir tous les champs correctement."]]]);
        exit;
    }

    $mail = new PHPMailer(true);
    $sent = false;

    // --- TENTATIVE 1 : SMTP LWS (Prioritaire) ---
    try {
        $mail->isSMTP();
        $mail->Host       = 'mail.espoir-canin.fr';
        $mail->SMTPAuth   = true;
        // Utilisation de l'adresse mail_php de LWS (configurée pour le site)
        $mail->Username   = 'mail_php@espoir-canin.fr';
        $mail->Password   = 'votre_mot_de_passe_lws'; // À REMPLIR PAR L'UTILISATEUR
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;
        $mail->CharSet    = 'UTF-8';
        $mail->Timeout    = 10; // Timeout court pour le fallback

        $mail->setFrom('mail_php@espoir-canin.fr', 'Site Espoir Canin');
        $mail->addAddress('espoir.canin@outlook.fr');
        $mail->addReplyTo($email, $name);

        $mail->isHTML(true);
        $mail->Subject = "🐶 (LWS) Nouveau message de $name";
        $mail->Body    = "<h2>Message de $name</h2><p><strong>Email :</strong> $email</p><p><strong>Tél :</strong> $phone</p><hr><p>".nl2br(htmlspecialchars($message))."</p>";
        $mail->AltBody = "Nom: $name\nEmail: $email\nMessage: $message";

        $mail->send();
        $sent = true;
    } catch (Exception $e) {
        // Échec LWS, on tente Gmail
        $sent = false;
    }

    // --- TENTATIVE 2 : SMTP GMAIL (Fallback) ---
    if (!$sent) {
        try {
            $mail->clearAddresses();
            $mail->clearReplyTos();
            
            $mail->Host       = 'smtp.gmail.com';
            $mail->Username   = 'espoir.canin.67@gmail.com';
            $mail->Password   = 'Ytpy segm mxsz cddk'; // Mot de passe d'application Gmail
            
            $mail->setFrom('espoir.canin.67@gmail.com', 'Site Espoir Canin');
            $mail->addAddress('espoir.canin@outlook.fr');
            $mail->addReplyTo($email, $name);
            
            $mail->Subject = "🐶 (Gmail) Nouveau message de $name";
            $mail->send();
            $sent = true;
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(["errors" => [["message" => "Oups ! L'envoi a échoué. ({$mail->ErrorInfo})"]]]);
            exit;
        }
    }

    if ($sent) {
        echo json_encode(["success" => true, "message" => "Merci ! Votre message a bien été envoyé."]);
    }
} else {
    http_response_code(403);
    echo json_encode(["errors" => [["message" => "Méthode non autorisée."]]]);
}
?>
