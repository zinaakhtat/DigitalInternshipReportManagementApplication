<?php
require_once '../data_base.php';

$id_rapport = isset($_GET['id']) ? $_GET['id'] : null;

if (!$id_rapport) {
    header("Location: consultation_rapports.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ID_rapport = $_POST['ID_rapport'];
    $ID_etudiant = $_POST['ID_etudiant'];
  
    $sql = "UPDATE rapports_etudiants
            SET ID_rapport = '$ID_rapport', ID_etudiant_rapport = '$ID_etudiant'
            WHERE ID_rapport_etudiant = $id_rapport";

    if (mysqli_query($conn, $sql)) {
        header("Location: affRapports_Stage.php");
        exit;
    } else {
        echo "Erreur lors de la modification du rapport: " . mysqli_error($conn);
    }
}

$sql = "SELECT * FROM rapports_etudiants WHERE ID_rapport_etudiant = $id_rapport";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
} else {
    echo "Rapport non trouvé.";
    exit;
}


mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification de rapport de stage</title>
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
    <h2>Modification de rapport de stage</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $id_rapport; ?>" method="POST">
        <div>
            <label for="ID_rapport">ID du rapport :</label>
            <input type="text" id="ID_rapport" name="ID_rapport" value="<?php echo htmlspecialchars($row['ID_rapport_rapport'] ?? ''); ?>" required>
        </div>
        <div>
            <label for="ID_etudiant">ID_etudiant :</label>
            <textarea id="ID_etudiant" name="ID_etudiant" rows="4" required><?php echo htmlspecialchars($row['ID_etudiant_rapport'] ?? ''); ?></textarea>
    </div>
        
    
        <div>
            <input type="submit" value="Enregistrer les modifications">
        </div>
    </form>
</body>
</html>
