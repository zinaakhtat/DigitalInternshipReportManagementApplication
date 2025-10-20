<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dépôt de rapport de stage</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #c792cc;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            width: 400px;
            padding: 40px;
        }

        .container h2 {
            margin-bottom: 20px;
            text-align: center;
            color: #e332e9;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input[type="text"],
        .form-group input[type="date"],
        .form-group input[type="file"],
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .form-group input[type="submit"] {
            background-color: #e332e9;
            color: white;
            cursor: pointer;
        }

        .form-group input[type="submit"]:hover {
            background-color: #5a205c;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Dépôt de rapport de stage</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="titre">Titre du rapport :</label>
            <input type="text" id="titre" name="titre" required>
        </div>
        <div class="form-group">
            <label for="description">Description :</label>
            <textarea id="description" name="description" rows="4" required></textarea>
        </div>
        <div class="form-group">
            <label for="date">Date de dépôt :</label>
            <input type="date" id="date" name="date" required>
        </div>
        <div class="form-group">
            <label for="fichier">Chemin du fichier :</label>
            <input type="file" id="fichier" placeholder="pas obligatoire" name="fichier" accept=".pdf,.doc,.docx" >
        </div>
        <div class="form-group">
            <label for="etudiants">Étudiants concernés :</label>
            <input type="text" id="etudiants" name="etudiants" placeholder="Entrez les ID des étudiants concernés " required>
        </div>
        <div class="form-group">
            <input type="submit" value="Soumettre" name="Soumettre">
        </div>
        <div class="depose">
        <?php
require_once '../data_base.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["Soumettre"])) {
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $etudiants = $_POST['etudiants'];
    $upload_dir = 'C:/wamp64/www/Projet_web/files';

    // Vérifier si un fichier a été téléchargé
    if(isset($_FILES["fichier"]) && $_FILES["fichier"]["error"] == UPLOAD_ERR_OK) {
        $file_name = $_FILES["fichier"]["name"];
        $file_tmp = $_FILES["fichier"]["tmp_name"];
        $file_destination = 'C:/wamp64/www/projet final/Projet_web/files/' . $file_name;


        // Déplacer le fichier téléchargé
        if (move_uploaded_file($file_tmp, $file_destination)) {
            $file_destination =  'C:/wamp64/www/projet final/Projet_web/files'. DIRECTORY_SEPARATOR . $file_name;
        } else {
            echo 'Une erreur s\'est produite lors de l\'upload du fichier.';
            // Arrêter l'exécution si le téléchargement du fichier a échoué
            exit;
        }
    } else {
        // Aucun fichier n'a été téléchargé, donc $file_destination est vide
        $file_destination = '';
    }

    // Insertion des données dans la table "rapport_stage"
    $sql_rapport_stage = "INSERT INTO `rapports_stage`(`Titre_rapport`, `Description_rapport`, `Date_depot`, `Chemin_fichier`)
                VALUES (?, ?, ?, ?)";
    $stmt_rapport_stage = mysqli_prepare($conn, $sql_rapport_stage);
    mysqli_stmt_bind_param($stmt_rapport_stage, "ssss", $titre, $description, $date, $file_destination);
    $success_rapport_stage = mysqli_stmt_execute($stmt_rapport_stage);

    if ($success_rapport_stage) {
        $id_rapport = mysqli_insert_id($conn);
        $etudiants_array = explode(',', $etudiants);

        // Insertion des données dans la table "rapports_etudiants"
        foreach ($etudiants_array as $id_etudiant) {
            $sql_rapport_etudiant = "INSERT INTO `rapports_etudiants`(`ID_rapport`, `ID_etudiant`)
                                    VALUES (?, ?)";
            $stmt_rapport_etudiant = mysqli_prepare($conn, $sql_rapport_etudiant);
            mysqli_stmt_bind_param($stmt_rapport_etudiant, "ii", $id_rapport, $id_etudiant);
            $success_rapport_etudiant = mysqli_stmt_execute($stmt_rapport_etudiant);

            if (!$success_rapport_etudiant) {
                echo 'Une erreur s\'est produite lors de l\'insertion des données dans la table Rapports_Etudiants.';
                break; // Sortir de la boucle en cas d'échec
            }
        }

        if ($success_rapport_etudiant) {
            echo 'Le rapport a été soumis avec succès.';
        }
    } else {
        echo 'Une erreur s\'est produite lors de la soumission du rapport.';
    }
}
?>

        </div>
    </form>
</div>
</body>
</html>
