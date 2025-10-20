<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Rapports_Etudiant""</title>
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
        <h2>Gestion des Rapports_Etudiant</h2>
        <table>
            <tr>
                <th>    ID_rapport_etudiant </th>
                <th>   ID_rapport </th>
                
                <th>  ID_etudiant </th>
               
                
              
            </tr>
            <?php 
            
            
// Inclure le fichier de connexion à la base de données
require_once '../data_base.php';

// Récupérer tous les rapportEts de la base de données
$query = "SELECT * FROM  rapports_etudiants";
$result = mysqli_query($conn, $query);

// Vérifier s'il y a des résultats
if (mysqli_num_rows($result) > 0) {
    // Parcourir les résultats et afficher chaque rapportEt dans une ligne de tableau
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['ID_rapport_etudiant'] . "</td>";
       
        echo "<td>" . $row['ID_rapport'] . "</td>";
        echo "<td>" . $row['ID_etudiant'] . "</td>";
      
        
        
        
        echo "<td>
                <a href='modifier_rapportEt.php?id=" . $row['ID_rapport_etudiant'] . "'>Modifier</a> | 
                <a href='supprimer_rapportEt.php?id=" . $row['ID_rapport_etudiant'] . "'>Supprimer</a>
              </td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='5'>Aucun  rapport trouvé.</td></tr>";
}

// Fermer la connexion à la base de données
mysqli_close($conn);
            ?>
        </table>
        <div class="actions">
            <a href="ajouter_rapportEt.php">Ajouter un rapport </a>
        </div>
    </div>
</body>
</html>
