<?php
/*
 * Script d'envoi de mail simple pour Espoir Canin
 * Compatible avec les hébergeurs classiques (LWS, OVH...) supportant la fonction mail()
 */

// Configuration
$to_email = "espoir.canin@outlook.fr"; // VOTRE ADRESSE EMAIL
$subject_prefix = "[Site Web] Nouveau message de : ";

// Vérification de la méthode
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Récupération et nettoyage des données
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $phone = strip_tags(trim($_POST["phone"]));
    $message = trim($_POST["message"]);

    // Validation basique
    if (empty($name) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Erreur
        header("Location: contact.html?status=error&msg=invalid_input");
        exit;
    }

    // Construction du mail
    $subject = $subject_prefix . $name;
    
    $email_content = "Nom: $name\n";
    $email_content .= "Email: $email\n";
    $email_content .= "Téléphone: $phone\n\n";
    $email_content .= "Message:\n$message\n";

    // Headers pour une meilleure délivrabilité (Important sur LWS/OVH)
    // "From" doit idéalement être une adresse du domaine (ex: no-reply@votre-domaine.fr)
    // Ici on met une adresse générique, mais l'idéal est de mettre "contact@espoir-canin.fr" si vous l'avez créée.
    $from_server = "no-reply@espoir-canin.fr"; // À remplacer par une vraie adresse de votre hébergement si possible
    
    $headers = "From: Espoir Canin Site <$from_server>\r\n";
    $headers .= "Reply-To: $name <$email>\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Envoi
    if (mail($to_email, $subject, $email_content, $headers)) {
        // Succès
        header("Location: contact.html?status=success");
    } else {
        // Echec serveur
        header("Location: contact.html?status=error&msg=server_error");
    }

} else {
    // Accès direct interdit
    header("Location: contact.html");
}
?>
