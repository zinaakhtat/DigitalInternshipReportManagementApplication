<?php
require_once 'data_base.php';
if (!empty($_GET['chemin_fichier'])) {
    // Construit le chemin absolu du fichier sur le serveur
    $filePath = "C:/wamp64/www/Projet_web/files/" . basename($_GET['chemin_fichier']);

    // Vérifie si le fichier existe
    if (file_exists($filePath)) {
        // Définit les en-têtes pour forcer le téléchargement du fichier
        header("Content-Type: application/octet-stream");
        header("Content-Disposition: attachment; filename=" . basename($filePath));
        header("Content-Length: " . filesize($filePath));

        // Lit et affiche le contenu du fichier
        readfile($filePath);
        exit;
    } else {
        // Affiche un message si le fichier n'existe pas
        echo "Le fichier n'existe pas.";
    }
} else {
    // Affiche un message si le paramètre chemin_fichier n'est pas présent dans l'URL
    echo "Paramètre manquant : chemin_fichier.";
}
?>
