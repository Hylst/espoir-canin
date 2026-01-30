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

// Headers pour éviter certaines erreurs CORS/403 (au cas où)
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
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
    $errorLog = "";

    // --- TENTATIVE 1 : SMTP LWS (Compte 'contact') ---
    try {
        $mail->isSMTP();
        $mail->Host       = 'mail.espoir-canin.fr'; 
        $mail->SMTPAuth   = true;
        
        // CONFIGURATION LWS
        // Assurez-vous que ce compte est "ACTIF" dans votre panel LWS (pas "Désactivé" ou "Restreint")
        $mail->Username   = 'contact@espoir-canin.fr'; 
        $mail->Password   = 'REDACTED_LWS_SMTP'; 
        
        // Port 465 avec SSL est souvent plus fiable chez LWS
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; 
        $mail->Port       = 465;
        
        $mail->CharSet    = 'UTF-8';
        $mail->Timeout    = 10;

        $mail->setFrom('contact@espoir-canin.fr', 'Site Espoir Canin');
        $mail->addAddress('espoir.canin@outlook.fr');
        $mail->addReplyTo($email, $name);

        $mail->isHTML(true);
        $mail->Subject = "🐶 Nouveau contact de $name";
        $mail->Body    = "<h2>Message de $name</h2><p><strong>Email :</strong> $email</p><p><strong>Tél :</strong> $phone</p><hr><p>".nl2br(htmlspecialchars($message))."</p>";
        $mail->AltBody = "Nom: $name\nEmail: $email\nMessage: $message";

        $mail->send();
        $sent = true;
    } catch (Exception $e) {
        $errorLog .= "LWS Error: " . $mail->ErrorInfo . "; ";
        $sent = false;
    }

    // --- TENTATIVE 2 : SMTP GMAIL (Fallback) ---
    // Les identifiants Google sont ICI ↓
    if (!$sent) {
        try {
            $mail->clearAddresses();
            $mail->clearReplyTos();
            
            $mail->Host       = 'smtp.gmail.com';
            $mail->Username   = 'espoir.canin.67@gmail.com'; // Votre adresse Gmail
            $mail->Password   = 'REDACTED_GMAIL_PASS';       // Mot de passe d'application Google (Clé App)
            
            $mail->setFrom('espoir.canin.67@gmail.com', 'Site Espoir Canin (Backup)');
            $mail->addAddress('espoir.canin@outlook.fr');
            $mail->addReplyTo($email, $name);
            
            $mail->Subject = "🐶 (Gmail Backup) Nouveau message de $name";
            $mail->Body    = "<h2>Message de $name</h2><p><strong>Email :</strong> $email</p><p><strong>Tél :</strong> $phone</p><hr><p>".nl2br(htmlspecialchars($message))."</p>";
            
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;
            
            $mail->send();
            $sent = true;
        } catch (Exception $e) {
            $errorLog .= "Gmail Error: " . $mail->ErrorInfo;
            http_response_code(500);
            echo json_encode(["errors" => [["message" => "Échec envoi ($errorLog)"]]]);
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
