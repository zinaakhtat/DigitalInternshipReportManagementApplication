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
if ( isset($_POST['ajouter'])) {
    // Vérification si le formulaire a été soumis

    if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['email']) &&
        !empty($_POST['password']) && !empty($_POST['role'])) {
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $role = $_POST['role'];

        // Insertion des données dans la base de données
        $sql = "INSERT INTO `utilisateurs`( `Nom`, `Prenom`, `Email`, `Mot_de_passe`, `ID_role`)
                VALUES ('$nom', '$prenom', '$email', '$password', '$role')";
        if (mysqli_query($conn, $sql)) {
            echo "<script> alert('Utilisateur ajouté avec succès.')</script>";
            
            // Récupérer l'ID de l'utilisateur inséré
            $ID_utilisateur = mysqli_insert_id($conn);

            // Rediriger vers la page appropriée en fonction du rôle
            switch($role) {
                case 4: 
                    header("Location: ajouter_etudiant.php?ID_utilisateur=$ID_utilisateur");
                    exit();
                    break;
                case 2:
                    header("Location: ajouter_chef_departement.php?ID_utilisateur=$ID_utilisateur");
                    exit();
                    break;
                case 3:
                    header("Location: ajouter_secretaire_departement.php?ID_utilisateur=$ID_utilisateur");
                    exit();
                    break;
            }
        } else {
            echo "<script> alert('Erreur lors de l\'ajout de l\'utilisateur! Essayer une autre fois.')</script>";
            echo "Erreur lors de l'ajout de l'utilisateur : " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Utilisateur</title>
    <link href="ajout_utilisateur.css" rel="stylesheet">
<style>
            
            form {
            width: 300px;
            margin: 20px auto; 
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
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

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        #add_user {
            text-align: center; 
        }

        h2 {
            margin-bottom: 20px;
        }

        .additional-fields {
            display: none;
        }
        .add-user-link:hover {
            background-color: #0056b3;
        }

</style>
</head>
<body>
<section id="add_user">
    <h2>Ajouter un utilisateur</h2>

    <form id="user_form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required>

        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" required>

        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required>

        <label for="role">Rôle :</label>
        <select id="role" name="role">
            <option value="" disabled selected hidden>Sélectionner un rôle</option>
            <?php echo $role_options; ?>
        </select>
        <input type="submit" value="Ajouter" name="ajouter">
    </form>
    <a href="pageprincipale.php" class="add-user-link">Retour</a>
</section>
<script>
</body>

</html>
