<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $phone = strip_tags(trim($_POST["phone"]));
    $message = trim($_POST["message"]);

    if (empty($name) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "Merci de remplir tous les champs correctement.";
        exit;
    }

    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'espoir.canin.67@gmail.com';
        $mail->Password   = 'Ytpy segm mxsz cddk'; // Application Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;
        $mail->CharSet    = 'UTF-8';

        //Recipients
        $mail->setFrom('espoir.canin.67@gmail.com', 'Site Espoir Canin');
        $mail->addAddress('espoir.canin@outlook.fr');
        $mail->addReplyTo($email, $name);

        //Content
        $mail->isHTML(true);
        $mail->Subject = "Nouveau contact de $name - Espoir Canin";
        $mail->Body    = "
            <h2>Nouveau message depuis le site web</h2>
            <p><strong>Nom :</strong> $name</p>
            <p><strong>Email :</strong> $email</p>
            <p><strong>Téléphone :</strong> $phone</p>
            <p><strong>Message :</strong><br>" . nl2br(htmlspecialchars($message)) . "</p>
        ";
        $mail->AltBody = "Nom: $name\nEmail: $email\nTéléphone: $phone\nMessage:\n$message";

        $mail->send();
        http_response_code(200);
        echo "Merci ! Votre message a bien été envoyé.";
    } catch (Exception $e) {
        http_response_code(500);
        echo "Oups ! Une erreur s'est produite et votre message n'a pas pu être envoyé. Erreur Mailer: {$mail->ErrorInfo}";
    }
} else {
    http_response_code(403);
    echo "Il y a eu un problème avec votre soumission, veuillez réessayer.";
}
?>
