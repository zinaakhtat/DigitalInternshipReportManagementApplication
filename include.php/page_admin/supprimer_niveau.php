<?php

require_once '../data_base.php';

if(isset($_GET['id']) && $_SERVER["REQUEST_METHOD"] == "GET") {
    // Vérification si l'ID de l'utilisateur à supprimer est présent dans l'URL
    $id_niveau = $_GET['id'];

    // Suppression de l'utilisateur de la base de données
    $sql = "DELETE FROM `niveaux` WHERE `ID_niveau` = $id_niveau";

    if (mysqli_query($conn, $sql)) {
        echo "<script> alert('Niveau supprimé avec succès.')</script>";
        // Redirection vers la page des niveau après 2 secondes
        echo "<script> setTimeout(function(){ window.location.href = 'affniveau.php'; }, 10);</script>";
    } else {
        echo "<script> alert('Erreur lors de la suppression du niveau! Veuillez réessayer.')</script>";
        echo "Erreur lors de la suppression du niveau : " . mysqli_error($conn);
    }
} else {
    echo "<script> alert('ID du niveau non valide.')</script>";
}

?>
