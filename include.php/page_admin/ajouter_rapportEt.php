<?php
require_once '../data_base.php';


if(isset($_POST['ajouter']) && $_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérification si le formulaire a été soumis
    // Récupération des données du formulaire
    if(!empty($_POST['ID_etudiant'])) {
        $nom = $_POST['ID_rapport'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ID_rapport = $_POST['ID_rapport'];
    $ID_etudiant = $_POST['ID_etudiant'];
  
    $sql = "INSERT INTO `rapports_etudiants`(`ID_rapport`, `ID_etudiant`) 
            VALUES ID_rapport = '$ID_rapport', ID_etudiant_rapport = '$ID_etudiant'
            WHERE ID_rapport_etudiant = $id_rapport";

    if (mysqli_query($conn, $sql)) {
        header("Location: affRapports_Stage.php");
        exit;
    } else {
        echo "Erreur lors de la modification du rapport: " . mysqli_error($conn);
    }
}
}
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout de rapport de stage etudiant</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            margin-top: 50px;
        }

        form {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="date"],
        textarea,
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 50px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
            text-align: left;
        }
    </style>
</head>
<body>
    <h2>Ajout de rapport de stage etudiant</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
        <div>
            <label for="ID_rapport">ID du rapport :</label>
            <input type="text" id="ID_rapport" name="ID_rapport" required>
        </div>
        <div>
            <label for="ID_etudiant">ID_etudiant :</label>
            <textarea id="ID_etudiant" name="ID_etudiant" rows="4" required></textarea>
    </div>
        
    
        <div>
            <input type="submit" value="Ajouter" nom="ajouter">
        </div>
    </form>
</body>
</html>
