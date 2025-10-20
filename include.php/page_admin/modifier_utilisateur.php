<?php
require_once '../data_base.php';

$sql = "SELECT ID_role, Nom_role FROM roles";
$result = $conn->query($sql);

// Génération des options pour le formulaire
$role_options = "";
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $role_options .= '<option value="' . $row["ID_role"] . '">' . $row["Nom_role"] . '</option>';
    }
} else {
    $role_options = '<option value="" disabled selected hidden>Aucun rôle disponible</option>';
}
?>
<?php
require_once '../data_base.php';

if(isset($_GET['id']) && $_SERVER["REQUEST_METHOD"] == "GET") {
    // Vérification si l'ID de l'utilisateur à modifier est présent dans l'URL
    $id_utilisateur = $_GET['id'];

    // Récupération des informations de l'utilisateur depuis la base de données
    $sql = "SELECT * FROM `utilisateurs` WHERE `ID_utilisateur` = $id_utilisateur";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Affichage du formulaire de modification avec les données de l'utilisateur
?>

<!DOCTYPE html>
 <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Modifier un Utilisateur</title>

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
    </style>
        </head>

        <body>
        <section id="modify_user">
        <h2>Modifier un utilisateur</h2>

        <form action="" method="post" enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type="hidden" name="id" value="<?php echo $id_utilisateur; ?>"> <!-- Champ caché pour transmettre l'ID de l'utilisateur -->

            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" value="<?php echo $row['Nom']; ?>" required>

            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenom" value="<?php echo $row['Prenom']; ?>" required>

            <label for="email">Email :</label>
            <input type="email" id="email" name="email" value="<?php echo $row['Email']; ?>" required>

            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" value="<?php echo $row['Mot_de_passe']; ?>" required>

            <label for="role">Rôle :</label>
    
        <select id="role" name="role">
            <option value="" disabled selected hidden>Sélectionner un rôle</option>
            <?php echo $role_options; ?>
        </select>
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
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $role = $_POST['role'];

        // Mise à jour des données de l'utilisateur dans la base de données
        $sql = "UPDATE `utilisateurs` SET `Nom`='$nom',`Prenom`='$prenom',`Email`='$email',`Mot_de_passe`='$password',`ID_role`='$role' 
               WHERE `ID_utilisateur`='$id'";
        if (mysqli_query($conn, $sql)) {
            echo "<script> alert('Utilisateur modifié avec succès.')</script>";

            echo "<script> setTimeout(function(){ window.location.href = 'affutilisateur.php'; }, 10);</script>";
        } else {
            echo "<script> alert('Erreur lors de la modification de l\'utilisateur! Veuillez réessayer.')</script>";
            echo "Erreur lors de la modification de l'utilisateur : " . mysqli_error($conn);
        }
    } 
else {
    echo "<script> alert('ID d\'utilisateur non valide.')</script>";
}

?>
