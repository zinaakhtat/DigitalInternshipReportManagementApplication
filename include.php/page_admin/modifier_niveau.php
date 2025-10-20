<?php
require_once '../data_base.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Vérification si l'ID du niveau à modifier est présent dans l'URL
    if(isset($_GET['id'])) {
        $id_niveau = $_GET['id'];

        // Récupération des informations du niveau depuis la base de données
        $sql = "SELECT * FROM `niveaux` WHERE `ID_niveau` = $id_niveau";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            // Affichage du formulaire de modification avec les données du niveau
            ?>

            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Modifier un Niveau</title>
            </head>
            <body>
            <section id="modify_niveau">
            <h2>Modifier un niveau</h2>

            <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $id_niveau; ?>"> <!-- Champ caché pour transmettre l'ID du niveau -->

                <label for="nom_niveau">Nom du niveau :</label>
                <input type="text" id="nom_niveau" name="nom_niveau" value="<?php echo $row['Nom_niveau']; ?>" required>

                <input type="submit" value="Modifier" name="modifier_niveau">
            </form>
            </section>
            </body>
            </html>

            <?php
        } else {
            echo "<script> alert('ID de niveau non valide.')</script>";
        }
    } else {
        echo "<script> alert('ID de niveau non spécifié.')</script>";
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['modifier_niveau'])) {
    // Vérification si le formulaire de modification a été soumis
    // Récupération des données du formulaire
    if(!empty($_POST['id']) && !empty($_POST['nom_niveau'])) {
        $id_niveau = $_POST['id'];
        $nom_niveau = $_POST['nom_niveau'];

        // Mise à jour du nom du niveau dans la base de données
        $sql = "UPDATE `niveaux` SET `Nom_niveau`='$nom_niveau' WHERE `ID_niveau`='$id_niveau'";
        if (mysqli_query($conn, $sql)) {
            echo "<script> alert('Niveau modifié avec succès.')</script>";
            // Redirection vers la page des niveaux après 2 secondes
            echo "<script> setTimeout(function(){ window.location.href = 'affniveau.php'; }, 10);</script>";
        } else {
            echo "<script> alert('Erreur lors de la modification du niveau! Veuillez réessayer.')</script>";
            echo "Erreur lors de la modification du niveau : " . mysqli_error($conn);
        }
    } else {
        echo "<script> alert('Tous les champs sont obligatoires');</script>";
    }
} else {
    echo "<script> alert('Méthode de requête non valide.')</script>";
}
?>
