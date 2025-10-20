<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Change Password</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      background-color: #91ABF6;
      color: #704529;
    }

    .container {
      max-width: 400px;
      margin: 10px auto;
      background-color: #fff;
      border-radius: 8px;
      padding: 40px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }

    h1 {
      text-align: center;
      margin-bottom: 30px;
      color: #3C68E4;
    }

    .form-group {
      margin-bottom: 20px;
    }

    label {
      display: block;
      margin-bottom: 5px;
    }

    input[type="password"] {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    button[type="submit"] {
      display: block;
      width: 100%;
      padding: 10px;
      background-color: #3C68E4;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    button[type="submit"]:hover {
      background-color: #3C68E4;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Change Password</h1>
    <form id="changePasswordForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <div class="form-group">
        <label for="currentPassword">Current Password</label>
        <input type="password" id="currentPassword" name="currentPassword" required>
      </div>
      <div class="form-group">
        <label for="newPassword">New Password</label>
        <input type="password" id="newPassword" name="newPassword" required>
      </div>
      <div class="form-group">
        <label for="confirmNewPassword">Confirm New Password</label>
        <input type="password" id="confirmNewPassword" name="confirmNewPassword" required>
      </div>
      <button type="submit" name="submit">Change Password</button>
    </form>
    <div class="change">
    <?php
session_start(); // Démarrer la session

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Inclure le fichier de connexion à la base de données
    require_once '../data_base.php';

    // Obtenir l'ID de l'utilisateur à partir de la session
    if(isset($_SESSION['utilisateurs'])) {
        $userId = $_SESSION['utilisateurs']['ID_utilisateur'];
    } else {
        echo '<p>Utilisateur non connecté.</p>';
        exit; // Arrêter l'exécution
    }

    // Obtenir les données soumises dans le formulaire
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmNewPassword = $_POST['confirmNewPassword'];

    // Valider si le nouveau mot de passe correspond au confirm new password
    if ($newPassword !== $confirmNewPassword) {
        echo '<p>Le nouveau mot de passe et la confirmation ne correspondent pas.</p>';
    } else {
        // Obtenir le mot de passe actuel de l'utilisateur depuis la base de données
        $query = "SELECT Mot_de_passe FROM utilisateurs WHERE ID_utilisateur = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            $currentStoredPassword = $row['Mot_de_passe'];

            // Vérifier si le mot de passe actuel correspond à celui dans la base de données
            if ($currentPassword === $currentStoredPassword) {
                // Le mot de passe est correct, procéder à la modification du mot de passe

                // Mettre à jour le mot de passe dans la base de données
                $updateQuery = "UPDATE utilisateurs SET Mot_de_passe = ? WHERE ID_utilisateur = ?";
                $updateStmt = $conn->prepare($updateQuery);
                $updateStmt->bind_param("si", $newPassword, $userId);
                $updateStmt->execute();

                echo '<p>Mot de passe mis à jour avec succès.</p>';
            } else {
                echo '<p>Mot de passe actuel incorrect.</p>';
            }
        } else {
            echo '<p>Utilisateur non trouvé.</p>';
        }
    }
}
?>


    </div>
  </div>
</body>
</html>