<?php
/* ===========================================
   ESPOIR CANIN - Script d'envoi d'email (Backup)
   ===========================================
   
   ATTENTION : Ce fichier est une solution de secours (backup).
   Le site utilise principalement le service externe "Formspree"
   directement dans contact.html pour gérer les formulaires.
   
   Si vous devez utiliser ce script PHP, assurez-vous que :
   1. Le serveur supporte PHP et les connexions SMTP sortantes
   2. Les bibliothèques PHPMailer sont bien présentes dans assets/php/
   3. Le mot de passe d'application Gmail est valide
   
   Dernière mise à jour : Janvier 2025
=========================================== */

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// Chargement des classes PHPMailer manuelles
// (Assurez-vous que les fichiers existent à ces emplacements)
require 'assets/php/PHPMailer/Exception.php';
require 'assets/php/PHPMailer/PHPMailer.php';
require 'assets/php/PHPMailer/SMTP.php';

// On ne traite que les requêtes POST (soumission de formulaire)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // ---------------------------------------
    // 1. Nettoyage et validation des données
    // ---------------------------------------
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $phone = strip_tags(trim($_POST["phone"]));
    $message = trim($_POST["message"]);

    if (empty($name) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400); // Bad Request
        echo json_encode(["errors" => [["message" => "Merci de remplir tous les champs correctement."]]]);
        exit;
    }

    // ---------------------------------------
    // 2. Configuration de l'envoi SMTP
    // ---------------------------------------
    $mail = new PHPMailer(true);

    try {
        // Paramètres du serveur SMTP (Gmail)
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        
        // Identifiants du compte d'envoi (le "facteur")
        $mail->Username   = 'espoir.canin.67@gmail.com';
        // NOTE : Ceci est un mot de passe d'application, pas le mot de passe du compte Google.
        // Si l'envoi échoue, générez-en un nouveau dans les paramètres de sécurité Google.
        $mail->Password   = 'Ytpy segm mxsz cddk'; 
        
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;
        $mail->CharSet    = 'UTF-8';

        // ---------------------------------------
        // 3. Destinataires et Contenu
        // ---------------------------------------
        
        // De qui vient l'email ? (Doit être l'adresse Gmail authentifiée)
        $mail->setFrom('espoir.canin.67@gmail.com', 'Site Espoir Canin');
        
        // Où envoyer le message ? (Le propriétaire du site)
        $mail->addAddress('espoir.canin@outlook.fr');
        
        // Si on clique sur "Répondre", ça ira vers le client
        $mail->addReplyTo($email, $name);

        // Contenu de l'email
        $mail->isHTML(true);
        $mail->Subject = "🐶 Nouveau contact de $name - Espoir Canin";
        
        // Corps du message en HTML (joli)
        $mail->Body    = "
            <div style='font-family: sans-serif; padding: 20px; border: 1px solid #ddd; border-radius: 10px;'>
                <h2 style='color: #59d600;'>Nouveau message depuis le site web</h2>
                <p><strong>Nom :</strong> $name</p>
                <p><strong>Email :</strong> <a href='mailto:$email'>$email</a></p>
                <p><strong>Téléphone :</strong> $phone</p>
                <hr>
                <p><strong>Message :</strong></p>
                <p style='background: #f9f9f9; padding: 15px; border-left: 4px solid #59d600;'>" . nl2br(htmlspecialchars($message)) . "</p>
            </div>
        ";
        
        // Corps du message en texte brut (pour les vieux clients mail)
        $mail->AltBody = "Nom: $name\nEmail: $email\nTéléphone: $phone\n\nMessage:\n$message";

        // Envoi !
        $mail->send();
        
        http_response_code(200); // OK
        echo json_encode(["success" => true, "message" => "Merci ! Votre message a bien été envoyé."]);
        
    } catch (Exception $e) {
        // En cas d'erreur technique
        http_response_code(500); // Internal Server Error
        echo json_encode(["errors" => [["message" => "Oups ! Une erreur s'est produite lors de l'envoi. Erreur Mailer: {$mail->ErrorInfo}"]]]);
    }
} else {
    // Si quelqu'un essaie d'accéder au fichier directement sans POST
    http_response_code(403); // Forbidden
    echo json_encode(["errors" => [["message" => "Il y a eu un problème avec votre soumission, veuillez réessayer."]]]);
}
?>
