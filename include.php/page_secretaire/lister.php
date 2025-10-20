<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des rapports de stage</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        a {
            text-decoration: none;
            color: blue;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <table>
        <tr>
            <th>Titre du rapport</th>
            <th>Description</th>
            <th>Date de dépôt</th>
            <th>Chemin fichier</th>
        </tr>
        <?php
            
        require_once '../data_base.php';
        
        // Récupérer la filière sélectionnée, par défaut 1 si aucune filière n'est sélectionnée
        $filiere_id = isset($_GET['filieres']) ? $_GET['filieres'] : 3;
        
        // Récupérer les rapports de stage correspondant à la filière sélectionnée
        $query = "SELECT rs.Titre_rapport, rs.Description_rapport, rs.Date_depot, rs.Chemin_fichier 
                  FROM rapports_Stage rs
                  INNER JOIN rapports_etudiants re ON rs.ID_rapport = re.ID_rapport
                  INNER JOIN etudiants e ON re.ID_etudiant = e.ID_etudiant
                  WHERE e.ID_filière = $filiere_id";
        
        $result = mysqli_query($conn, $query);
        
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['Titre_rapport'] . "</td>";
                echo "<td>" . $row['Description_rapport'] . "</td>";
                echo "<td>" . $row['Date_depot'] . "</td>";
                echo "<td><a href='" . $row['Chemin_fichier'] . "'>Télécharger</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>Aucun rapport trouvé.</td></tr>";
        }
        
        mysqli_close($conn);
        ?>
    </table>
</body>
</html>
