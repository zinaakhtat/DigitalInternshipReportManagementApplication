<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Secretaires_Departement"</title>
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
.add-user-link:hover {
            background-color: #0056b3;
        }



        </style>
</head>
<body>
    <div class="container">
        <h2>Gestion des Secretaires_Departement"</h2>
        <table>
            <tr>
                <th>  ID_secretaire_departement </th>
                <th> ID_utilisateur</th>
                <th> ID_filière </th>
                
              
            </tr>
            <?php 
            
            
// Inclure le fichier de connexion à la base de données
require_once '../data_base.php';

// Récupérer tous les utilisateurs de la base de données
$query = "SELECT * FROM  secretaires_departement ";
$result = mysqli_query($conn, $query);

// Vérifier s'il y a des résultats
if (mysqli_num_rows($result) > 0) {
    // Parcourir les résultats et afficher chaque utilisateur dans une ligne de tableau
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['ID_secretaire_departement'] . "</td>";
       
        echo "<td>" . $row['ID_utilisateur'] . "</td>";
        echo "<td>" . $row['ID_filière'] . "</td>";
        
        
        echo "<td>
                <a href='modefier_secretaire.php?id=" . $row['ID_secretaire_departement'] . "'>Modifier</a> | 
                <a href='supprimer_secretaire.php?id=" . $row['ID_secretaire_departement'] . "'>Supprimer</a>
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
        <div class="actions">
        </div>
    </div>
</body>
</html>
