<?php

require_once '../data_base.php';

if(isset($_GET['id']) && $_SERVER["REQUEST_METHOD"] == "GET") {
    // Vérification si l'ID de l'chef_departement à supprimer est présent dans l'URL
    $id_chef_departement = $_GET['id'];

    // Suppression de l'utilisateur de la base de données
    $sql = "DELETE FROM `chefs_departement` WHERE `ID_chef_departement` = $id_chef_departement";

    if (mysqli_query($conn, $sql)) {
        echo "<script> alert('chef_departement supprimé avec succès.')</script>";
        // Redirection vers la page des chef_departements après 2 secondes
        echo "<script> setTimeout(function(){ window.location.href = 'affchefs_Departement.php'; }, 10);</script>";
    } else {
        echo "<script> alert('Erreur lors de la suppression de l\'chef_departement! Veuillez réessayer.')</script>";
        echo "Erreur lors de la suppression de l'chef_departement : " . mysqli_error($conn);
    }
} else {
    echo "<script> alert('ID d\'chef_departement non valide.')</script>";
}

?>
