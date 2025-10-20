<?php

require_once '../data_base.php';

if(isset($_GET['id']) && $_SERVER["REQUEST_METHOD"] == "GET") {
    // Vérification si l'ID de l'utilisateur à supprimer est présent dans l'URL
    $id_role = $_GET['id'];

    // Suppression de l'utilisateur de la base de données
    $sql = "DELETE FROM `roles` WHERE `ID_role` = $id_role";

    if (mysqli_query($conn, $sql)) {
        echo "<script> alert('role supprimé avec succès.')</script>";
        // Redirection vers la page des role après 2 secondes
        echo "<script> setTimeout(function(){ window.location.href = 'affrole.php'; }, 10);</script>";
    } else {
        echo "<script> alert('Erreur lors de la suppression du role! Veuillez réessayer.')</script>";
        echo "Erreur lors de la suppression du role : " . mysqli_error($conn);
    }
} else {
    echo "<script> alert('ID du role non valide.')</script>";
}

?>
