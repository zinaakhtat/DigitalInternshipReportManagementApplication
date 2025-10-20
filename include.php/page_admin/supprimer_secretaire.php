<?php

require_once '../data_base.php';

if(isset($_GET['id']) && $_SERVER["REQUEST_METHOD"] == "GET") {
    // Vérification si l'ID de l'secretaire_departement à supprimer est présent dans l'URL
    $id_secretaire_departement = $_GET['id'];

    // Suppression de l'utilisateur de la base de données
    $sql = "DELETE FROM `secretaires_departement` WHERE `ID_secretaire_departement` = $id_secretaire_departement";

    if (mysqli_query($conn, $sql)) {
        echo "<script> alert('secretaire_departement supprimé avec succès.')</script>";
        // Redirection vers la page des secretaire_departements après 2 secondes
        echo "<script> setTimeout(function(){ window.location.href = 'affSecretaire_Departement.php'; }, 10);</script>";
    } else {
        echo "<script> alert('Erreur lors de la suppression de l\'secretaire_departement! Veuillez réessayer.')</script>";
        echo "Erreur lors de la suppression de l'secretaire_departement : " . mysqli_error($conn);
    }
} else {
    echo "<script> alert('ID d\'secretaire_departement non valide.')</script>";
}

?>
