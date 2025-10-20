<?php

require_once '../data_base.php';

if(isset($_GET['id']) && $_SERVER["REQUEST_METHOD"] == "GET") {
    // Vérification si l'ID de l'etudiant à supprimer est présent dans l'URL
    $id_etudiant = $_GET['id'];

    // Suppression de l'utilisateur de la base de données
    $sql = "DELETE FROM `etudiants` WHERE `ID_etudiant` = $id_etudiant";

    if (mysqli_query($conn, $sql)) {
        echo "<script> alert('etudiant supprimé avec succès.')</script>";
        // Redirection vers la page des etudiants après 2 secondes
        echo "<script> setTimeout(function(){ window.location.href = 'affetudiant.php'; }, 10);</script>";
    } else {
        echo "<script> alert('Erreur lors de la suppression de l\'etudiant! Veuillez réessayer.')</script>";
        echo "Erreur lors de la suppression de l'etudiant : " . mysqli_error($conn);
    }
} else {
    echo "<script> alert('ID d\'etudiant non valide.')</script>";
}

?>
