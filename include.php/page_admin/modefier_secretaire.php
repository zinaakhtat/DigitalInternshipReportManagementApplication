
<?php
require_once '../data_base.php';

if(isset($_GET['id']) && $_SERVER["REQUEST_METHOD"] == "GET") {
    // Vérification si l'ID de l'utilisateur à modifier est présent dans l'URL
    $id_secretaire= $_GET['id'];

    // Récupération des informations de l'utilisateur depuis la base de données
    $sql = "SELECT * FROM `secretaires_departement` WHERE `ID_secretaire_departement` = $id_secretaire";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Affichage du formulaire de modification avec les données de l'secretaire
?>

<!DOCTYPE html>
 <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Modifier un secretaire</title>

            <style>
        /* Styles CSS */
        body {
            margin: 0;
            padding: 0;
        }

        #modify_user {
            width: 80%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            width: 70%;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="file"] {
            margin-top: 10px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            cursor: pointer;
            display: block;
            margin-top: 20px;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .error {
            color: red;
            font-size: 14px;
        }
        .add-user-link:hover {
            background-color: #0056b3;
        }
    </style>
        </head>

        <body>
        <section id="modify_user">
        <h2>Modifier un utilisateur</h2>

        <form action="" method="post" enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="hidden" name="id" value="<?php echo $id_secretaire; ?>"> <!-- Champ caché pour transmettre l'ID de l'utilisateur -->

            <label for="ID_utilisateur">ID_utilisateur</label>
            <input type="text" id="ID_utilisateur" name="ID_utilisateur" value="<?php echo $row['ID_utilisateur']; ?>" required>

            <label for="ID_filiere">ID_filiere</label>
            <input type="ID_filiere" id="ID_filiere" name="ID_filiere" value="<?php echo $row['ID_filière']; ?>" required>

            
        </select>
        <input type="submit" value="Modifier" name="modifier">
        </form>
        </section>
        <a href="pageprincipale.php" class="add-user-link">Retour</a>

        </body>
        </html>

        <?php
    } else {
        echo "<script> alert('ID d\'utilisateur non valide.')</script>";
    }
} else if(isset($_POST['modifier']) && $_SERVER["REQUEST_METHOD"] == "POST") {
 
        $id = $_POST['id'];
        $ID_utilisateur = $_POST['ID_utilisateur'];
        $ID_filiere = $_POST['ID_filiere'];


        // Mise à jour des données de l'utilisateur dans la base de données
        $sql = "UPDATE `secretaires_departement` SET `ID_utilisateur`='$ID_utilisateur',`ID_filière`='$ID_filiere'
               WHERE `ID_secretaire_departement`='$id'";
        if (mysqli_query($conn, $sql)) {
            echo "<script> alert('etudiant modifié avec succès.')</script>";

            echo "<script> setTimeout(function(){ window.location.href = 'affSecretaires_Departement.php'; }, 10);</script>";
        } else {
            echo "<script> alert('Erreur lors de la modification de l\'etudiant! Veuillez réessayer.')</script>";
            echo "Erreur lors de la modification de l'etudiant : " . mysqli_error($conn);
        }
    } 
else {
    echo "<script> alert('ID d\'utilisateur non valide.')</script>";
}

?>
