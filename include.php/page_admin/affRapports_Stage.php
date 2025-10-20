<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Rapports_Stage""</title>
    <style>
       body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
}

.container {
    width: 80%;
    margin: 0 auto;
}

h2 {
    text-align: center;
    margin-top: 20px;
    color: #333;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th, td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

th {
    background-color: #f2f2f2;
}

.actions {
    margin-top: 20px;
    text-align: center;
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
    <div class="container">
        <h2>Gestion des Rapports_Stage</h2>
        <table>
            <tr>
                <th>   ID_rapport </th>
                <th>  Titre_rapport</th>
                
                <th> Description_rapport </th>
                <th> Date_depot </th>
                <th>  Chemin_fichier</th>
                
              
            </tr>
            <?php 
            
            
// Inclure le fichier de connexion à la base de données
require_once '../data_base.php';

// Récupérer tous les rapports de la base de données
$query = "SELECT * FROM  rapports_stage";
$result = mysqli_query($conn, $query);

// Vérifier s'il y a des résultats
if (mysqli_num_rows($result) > 0) {
    // Parcourir les résultats et afficher chaque rapport dans une ligne de tableau
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['ID_rapport'] . "</td>";
       
        echo "<td>" . $row['Titre_rapport'] . "</td>";
        echo "<td>" . $row['Description_rapport'] . "</td>";
        echo "<td>" . $row['Date_depot'] . "</td>";
        echo "<td>" . $row['Chemin_fichier'] . "</td>";
        
        
        
        echo "<td>
                <a href='modifier_rapport.php?id=" . $row['ID_rapport'] . "'>Modifier</a> | 
                <a href='supprimer_rapport.php?id=" . $row['ID_rapport'] . "'>Supprimer</a>
              </td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='5'>Aucun  niveau  trouvé.</td></tr>";
}

// Fermer la connexion à la base de données
mysqli_close($conn);
            ?>
        </table>
        
    </div>
</body>
</html>
