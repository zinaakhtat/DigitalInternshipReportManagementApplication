<?php

require_once '../data_base.php';

if(isset($_GET['id']) && $_SERVER["REQUEST_METHOD"] == "GET") {
    // Vérification si l'ID de l'utilisateur à supprimer est présent dans l'URL
    $id_filiere = $_GET['id'];

    // Suppression de l'utilisateur de la base de données
    $sql = "DELETE FROM `filieres` WHERE `ID_filiere` = $id_filiere";

    if (mysqli_query($conn, $sql)) {
        echo "<script> alert('filiere supprimé avec succès.')</script>";
        // Redirection vers la page des filieres après 2 secondes
        echo "<script> setTimeout(function(){ window.location.href = 'afffilére.php'; }, 10);</script>";
    } else {
        echo "<script> alert('Erreur lors de la suppression du filiere! Veuillez réessayer.')</script>";
        echo "Erreur lors de la suppression du filiere : " . mysqli_error($conn);
    }
} else {
    echo "<script> alert('ID du filiere non valide.')</script>";
}

?>
