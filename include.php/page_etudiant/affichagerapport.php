<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultation des Rapports de Stage</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #cc9a7c;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container, form {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(233, 106, 21, 0.1);
            width: 800px;
            padding: 40px;
        }

        .container h2 {
            margin-bottom: 50px;
            text-align: center;
            color: #d85e0d;
        }

        .search-bar {
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .search-bar input[type="text"] {
            width: calc(25% - 10px);
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .search-bar select {
            width: calc(25% - 10px);
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .search-bar button {
            padding: 10px 20px;
            background-color: #d85e0d;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .search-bar button:hover {
            background-color: #c7ca21;
        }

        .results {
            margin-top: 20px;
        }

        .results p {
            margin-bottom: 10px;
        }

        .results a {
            color: #d85e0d;
            text-decoration: none;
            margin-left: 10px;
        }

        .results a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
<?php
// Include the database connection file
require_once '../data_base.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['recherche'])) {
    // Initialize variables
    $mot_cle = "%" . $_POST['mot_cle'] . "%";
    $filiere = $_POST['filiere'];
    $niveau = $_POST['niveau'];

    // Prepare and execute SQL statement
    $sql = "SELECT rs.Titre_rapport, rs.Description_rapport, rs.Chemin_fichier
    FROM rapports_stage rs
    INNER JOIN rapports_etudiants re ON rs.ID_rapport = re.ID_rapport
    -- INNER JOIN niveaux n ON re.ID_niveau = n.ID_niveau
    WHERE (rs.Titre_rapport LIKE ? OR rs.Description_rapport LIKE ?)";
    

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $mot_cle, $mot_cle);

    $stmt->execute();
    $result = $stmt->get_result();
}
?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="container">
    <h2>Consultation des Rapports de Stage</h2>
    <div class="search-bar">
        <input type="text" placeholder="Mot-clé" name="mot_cle">
        <select name="filiere">
            <option value="">Sélectionner une filière</option>
            <option value="1">BTP</option>
            <option value="2">FID</option>
            <option value="3">INFO</option>
            <option value="4">INDUS</option>
            <option value="5">ELECTRIC</option>
            <option value="6">MECA</option>
            <option value="7">GEE</option>
        </select>
        <select name="niveau">
            <option value="">Sélectionner un niveau</option>
            <option value="1">1ann</option>
            <option value="2">2ann</option>
            <option value="3">3ann</option>
        </select>
        <button type="submit" name="recherche">Rechercher</button>
    </div>
    <div class="results">
        <?php
        if (isset($result)) {
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<p>Titre : " . $row["Titre_rapport"] . "</p>";
                    echo "<p>Description : " . $row["Description_rapport"] . "</p>";
                    $file_path = htmlspecialchars($row['Chemin_fichier']);
                    echo '<a href="../dowloand.php?chemin_fichier=' . urlencode($file_path) . '">Télécharger</a>';
                    echo "<hr>";
                }
            } else {
                echo "Aucun rapport trouvé.";
            }
        }
        ?>
    </div>
</form>
</body>
</html>
