<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styl.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
<?php
// Démarrer la session
session_start();

// Inclure le fichier de connexion à la base de données
require_once '../data_base.php';

// Initialiser les variables
$username = "Unknown";
$email = "user@example.com";
$photo = "user-icon.png"; // Chemin vers l'image par défaut

// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['utilisateurs'])) {
    // Obtenir les détails de l'utilisateur à partir de la session
    $utilisateur = $_SESSION['utilisateurs'];
    $username = $utilisateur['Nom'];
    $email = $utilisateur['Email'];
    // Si une photo de profil est stockée dans la base de données, mettre à jour le chemin
    if (!empty($utilisateur['photo'])) {
        $photo = $utilisateur['photo'];
    }
}
?>
<div class="sidebar">
    <h2>ENSA <span style="color: white;"> AGADIR</span></h2>
    <ul>
        <li><a href="pageprincipale.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
        <li><a href="#" onclick="loadContent('depose.php')"><i class="fas fa-search"></i> Déposer</a></li>
        <li><a href="#" onclick="toggleSettingsDropdown()"><i class="fas fa-cog"></i> Settings</a>
            <ul id="settingsDropdown" style="display: none;">
                <!-- <li><a href="#" onclick="loadContent('changphotoprofil.php')">Modifier photo profile</a></li> -->
                <li><a href="#" onclick="loadContent('chanecode.php')">Change Password</a></li>
            </ul>
        </li>
        <li><a href="#" id="sign-out-link"><i class="fas fa-sign-out-alt"></i> Sign Out</a></li>
    </ul>
</div>
<div class="content">
    <div class="topbar">
        <div class="user-info">
            <!-- Ajouter la balise img ici -->
            <!-- <img src="<?php echo $photo; ?>" alt="User Icon"> -->
            <div class="user-details">
                <p><?php echo $username; ?></p>
                <p><?php echo $email; ?></p>
            </div>
        </div>
    </div>
    <div class="main-content background" id="mainContent">
        <!-- Contenu principal de la page -->
        <div class="moving-text">
            Welcome!
        </div>
    </div>
</div>

<script>
    function loadContent(url) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("mainContent").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", url, true);
        xhttp.send();
    }

    function toggleSettingsDropdown() {
        var dropdown = document.getElementById("settingsDropdown");
        dropdown.style.display = (dropdown.style.display === "none") ? "block" : "none";
    }

    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("sign-out-link").addEventListener("click", function(event) {
            event.preventDefault(); // Empêcher le comportement par défaut du clic sur le lien
            // Rediriger vers une autre page
            window.location.href = "http://localhost/projet%20final/Projet_web/main_page.php";
        });
    });
</script>
</body>
</html>
