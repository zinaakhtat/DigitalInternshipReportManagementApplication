<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultation des rapports de stage</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        .actions-cell {
            text-align: center;
        }

        .action-link {
            margin-right: 5px;
            color: #007bff;
            text-decoration: none;
        }

        .action-link:hover {
            color: #0056b3;
        }

        .add-user-link {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            margin-bottom: 20px;
            margin-top: 50px;
        }

        .add-user-link:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<?php
require_once '../data_base.php';

$sql = "SELECT * FROM rapports_Stage";

$result = mysqli_query($conn, $sql);

echo "<table>";
echo "<tr>
        <th>Titre</th>
        <th>Description</th>
        <th>Date de dépôt</th>
        <th>Chemin du fichier</th>
       
        
      </tr>";
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['Titre_rapport'] . "</td>";
        echo "<td>" . $row['Description_rapport'] . "</td>";
        echo "<td>" . $row['Date_depot'] . "</td>";
        echo "<td><a href='" . $row['Chemin_fichier'] . "' target='_blank'>Voir le fichier</a></td>";
      
       
        echo "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='7'>Aucun rapport trouvé.</td></tr>";
}
echo "</table>";
?>
<a href="pageprincipale.php" class="add-user-link">Retour</a>

</body>
</html>
