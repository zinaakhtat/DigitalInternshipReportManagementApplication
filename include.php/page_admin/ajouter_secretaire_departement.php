<?php
require_once '../data_base.php';

$sql = "SELECT ID_filiere, Nom_filiere FROM filieres";
$result = $conn->query($sql);

// Génération des options pour le formulaire
$filiere_options = "";
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $filiere_options .= '<option value="' . $row["ID_filiere"] . '">' . $row["Nom_filiere"] . '</option>';
    }
} else {
    $filiere_options = '<option value="" disabled selected hidden>Aucune filière disponible</option>';
}
?>


<?php
$ID_utilisateur = $_GET['ID_utilisateur'] ?? null;

if (isset($_POST['ajouter_secretaire'])) {
    // Vérification si le formulaire a été soumis
    if (!empty($_POST['filiere'])) {
        $ID_filiere = $_POST['filiere'];

        // Insertion des données dans la table des étudiants
        $sql = "INSERT INTO secretaires_departement (ID_utilisateur, ID_filière) VALUES ('$ID_utilisateur', '$ID_filiere')";
        if (mysqli_query($conn, $sql)) {
            echo "<script> alert('Étudiant ajouté avec succès.')</script>";
            header("Location:affSecretaires_Departement.php");
        } else {
            echo "<script> alert('Erreur lors de l\'ajout de l\'étudiant! Essayer une autre fois.')</script>";
            echo "Erreur lors de l'ajout de l'étudiant : " . mysqli_error($conn);
        }
    } else {
        echo "<script> alert('Veuillez remplir tous les champs.')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Étudiant</title>
    <link href="ajouter_etudiant.css" rel="stylesheet">
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

        h2 {
            margin-bottom: 20px;
            text-align: center;
        }
        .add-user-link:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h2>Veillez choisir la filiere </h2>

    <form id="etudiant_form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <input type="hidden" name="ID_utilisateur" value="<?php echo $ID_utilisateur; ?>">
        
        <label for="filiere">Filière :</label>
        <select id="filiere" name="filiere">
            <option value="" disabled selected hidden>Sélectionner une filiere</option>
            <?php echo $filiere_options; ?>
        </select>
        <input type="submit" value="Ajouter secretaire" name="ajouter_secretaire">
    </form>
    <a href="pageprincipale.php" class="add-user-link">Retour</a>

</body>
</html>
