<?php
require_once '../data_base.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Vérification si l'ID de la filière à modifier est présent dans l'URL
    if(isset($_GET['id'])) {
        $id_filiere = $_GET['id'];

        // Récupération des informations de la filière depuis la base de données
        $sql = "SELECT * FROM `filieres` WHERE `ID_filiere` = $id_filiere";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            // Affichage du formulaire de modification avec les données de la filière
            ?>

            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Modifier une Filière</title>
            </head>
            <body>
            <section id="modify_filiere">
            <h2>Modifier une filière</h2>

            <form action="" method="post" enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <input type="hidden" name="id" value="<?php echo $id_filiere; ?>"> <!-- Champ caché pour transmettre l'ID de la filière -->

                <label for="nom_filiere">Nom de la filière :</label>
                <input type="text" id="nom_filiere" name="nom_filiere" value="<?php echo $row['Nom_filiere']; ?>" required>

                <input type="submit" value="Modifier" name="modifier_filiere">
            </form>
            </section>
            </body>
            </html>

            <?php
        } else {
            echo "<script> alert('ID de filière non valide.')</script>";
        }
    } else {
        echo "<script> alert('ID de filière non spécifié.')</script>";
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['modifier_filiere'])) {
    // Vérification si le formulaire de modification a été soumis
    // Récupération des données du formulaire
    if(!empty($_POST['id']) && !empty($_POST['nom_filiere'])) {
        $id_filiere = $_POST['id'];
        $nom_filiere = $_POST['nom_filiere'];

        // Mise à jour du nom de la filière dans la base de données
        $sql = "UPDATE `filieres` SET `nom_filiere`='$nom_filiere' WHERE `ID_filiere`='$id_filiere'";
        if (mysqli_query($conn, $sql)) {
            echo "<script> alert('Filière modifiée avec succès.')</script>";
            // Redirection vers la page des filières après 2 secondes
            echo "<script> setTimeout(function(){ window.location.href = 'afffilére.php'; }, 10);</script>";
        } else {
            echo "<script> alert('Erreur lors de la modification de la filière! Veuillez réessayer.')</script>";
            echo "Erreur lors de la modification de la filière : " . mysqli_error($conn);
        }
    } else {
        echo "<script> alert('Tous les champs sont obligatoires');</script>";
    }
} else {
    echo "<script> alert('Méthode de requête non valide.')</script>";
}
?>
