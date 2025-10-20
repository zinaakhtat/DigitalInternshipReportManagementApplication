<?php

require_once '../data_base.php';

if(isset($_GET['id']) && $_SERVER["REQUEST_METHOD"] == "GET") {
    // Vérification si l'ID de l'utilisateur à supprimer est présent dans l'URL
    $id_utilisateur = $_GET['id'];

    // Suppression de l'utilisateur de la base de données
    $sql = "DELETE FROM `utilisateurs` WHERE `ID_utilisateur` = $id_utilisateur";

    if (mysqli_query($conn, $sql)) {
        echo "<script> alert('Utilisateur supprimé avec succès.')</script>";
        // Redirection vers la page des utilisateurs après 2 secondes
        echo "<script> setTimeout(function(){ window.location.href = 'affutilisateur.php'; }, 10);</script>";
    } else {
        echo "<script> alert('Erreur lors de la suppression de l\'utilisateur! Veuillez réessayer.')</script>";
        echo "Erreur lors de la suppression de l'utilisateur : " . mysqli_error($conn);
    }
} else {
    echo "<script> alert('ID d\'utilisateur non valide.')</script>";
}

?>
