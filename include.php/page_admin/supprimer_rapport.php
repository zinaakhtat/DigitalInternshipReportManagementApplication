<?php

require_once '../data_base.php';

if(isset($_GET['id']) && $_SERVER["REQUEST_METHOD"] == "GET") {
    // Vérification si l'ID de l'utilisateur à supprimer est présent dans l'URL
    $id_rapport = $_GET['id'];

    // Suppression de l'utilisateur de la base de données
    $sql = "DELETE FROM `rapports_stage` WHERE `ID_rapport` = $id_rapport";

    if (mysqli_query($conn, $sql)) {
        echo "<script> alert('rapport supprimé avec succès.')</script>";
        // Redirection vers la page des rapports après 2 secondes
        echo "<script> setTimeout(function(){ window.location.href = 'affRapports_Stage.php'; }, 10);</script>";
    } else {
        echo "<script> alert('Erreur lors de la suppression du rapport! Veuillez réessayer.')</script>";
        echo "Erreur lors de la suppression du rapport : " . mysqli_error($conn);
    }
} else {
    echo "<script> alert('ID du rapport non valide.')</script>";
}

?>
