<?php
require_once '../data_base.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Vérification si l'ID du role à modifier est présent dans l'URL
    if(isset($_GET['id'])) {
        $id_role = $_GET['id'];

        // Récupération des informations du role depuis la base de données
        $sql = "SELECT * FROM `roles` WHERE `ID_role` = $id_role";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            // Affichage du formulaire de modification avec les données du role
            ?>

            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Modifier un role</title>
            </head>
            <body>
            <section id="modify_role">
            <h2>Modifier un role</h2>

            <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $id_role; ?>"> <!-- Champ caché pour transmettre l'ID du role -->

                <label for="nom_role">Nom du role :</label>
                <input type="text" id="nom_role" name="nom_role" value="<?php echo $row['Nom_role']; ?>" required>

                <input type="submit" value="Modifier" name="modifier_role">
            </form>
            </section>
            </body>
            </html>

            <?php
        } else {
            echo "<script> alert('ID de role non valide.')</script>";
        }
    } else {
        echo "<script> alert('ID de role non spécifié.')</script>";
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['modifier_role'])) {
    // Vérification si le formulaire de modification a été soumis
    // Récupération des données du formulaire
    if(!empty($_POST['id']) && !empty($_POST['nom_role'])) {
        $id_role = $_POST['id'];
        $nom_role = $_POST['nom_role'];

        // Mise à jour du nom du role dans la base de données
        $sql = "UPDATE `roles` SET `Nom_role`='$nom_role' WHERE `ID_role`='$id_role'";
        if (mysqli_query($conn, $sql)) {
            echo "<script> alert('role modifié avec succès.')</script>";
            // Redirection vers la page des roles après 2 secondes
            echo "<script> setTimeout(function(){ window.location.href = 'affrole.php'; }, 10);</script>";
        } else {
            echo "<script> alert('Erreur lors de la modification du role! Veuillez réessayer.')</script>";
            echo "Erreur lors de la modification du role : " . mysqli_error($conn);
        }
    } else {
        echo "<script> alert('Tous les champs sont obligatoires');</script>";
    }
} else {
    echo "<script> alert('Méthode de requête non valide.')</script>";
}
?>
