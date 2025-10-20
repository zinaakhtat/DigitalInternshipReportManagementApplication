<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Utilisateur</title>
    <style>
        .add-user-link {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff; /* Blue background color */
            color: white;
            text-decoration: none;
            border-radius: 4px;
            margin-bottom: 20px;
            margin-top: 50px;
        }
        
        .add-user-link:hover {
            background-color: #0056b3; /* Darker blue color on hover */
        }

            form {
                width: 300px;
                margin: 20px auto 0; /* Added margin-top and adjusted margin-bottom */
                padding: 20px;
                border: 1px solid #ccc;
                border-radius: 5px;
                background: linear-gradient(to bottom, #3498db 0%, #2980b9 100%); /* Gradient of blue colors */
            }
            input[type="text"], input[type="email"], input[type="password"], select {
                width: 100%;
                padding: 10px;
                margin: 5px 0;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
            }
            input[type="submit"] {
                background-color: #DADFEB;
                color: white;
                padding: 10px 20px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }
            input[type="submit"]:hover {
                background-color: #3D5390;
            }

    </style>
</head>
<body>
<section id="add_user">
<h2>Ajouter une filiere</h2>

<form action="" method="post" enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="nom">Nom :</label>

    <input type="text" id="nom" name="nom">
    <input type="submit" value="Ajouter" name="ajouter">
</form>
</section>
</body>
</html>
<?php

require_once '../data_base.php';

if(isset($_POST['ajouter']) && $_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérification si le formulaire a été soumis
    // Récupération des données du formulaire
    if(!empty($_POST['nom'])) {
        $nom = $_POST['nom'];
       

        // Insertion des données dans la base de données
        $sql = "INSERT INTO `filieres`( `Nom_filiere`) 
                VALUES ('$nom')";
        if (mysqli_query($conn, $sql)) {
            echo "<script> alert('filiere ajouté avec succès.')</script>";
            // Redirect to the main page after 2 seconds
            echo "<script> setTimeout(function(){ window.location.href = 'afffilére.php'; },10);</script>";
        } else {
            echo "<script> alert('Erreur lors de l\'ajout du filiere! Essayer une autre fois:')</script>";
            echo "Erreur lors de l'ajout du filiere: " . mysqli_error($conn);
        }
    } else {
        echo "<script> alert('Tous les champs sont obligatoires');</script>";
    }
}

?>

