<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Secretaire</title>
    <link rel="stylesheet" href="../css/connection_secrétaire.css">

</head>
<body>
    <div class="background"></div> <!-- L'arrière-plan flou -->
    <div class="container"> <!-- Le formulaire -->
    <?php
    require_once "data_base.php";
    
    if(mysqli_connect_errno()){
        die("Failed to connect to MySQL: " . mysqli_connect_error());
    }
    
    if(isset($_POST['connexion'])){
        $Email = $_POST['email'];
        $mdp = $_POST['passeword'];

        if(!empty($Email) && !empty($mdp)){
            $sqlState = mysqli_prepare($conn, 'SELECT * FROM utilisateurs WHERE `Email` =? ANd `Mot_de_Passe`=?');
            mysqli_stmt_bind_param($sqlState, 'ss', $Email, $mdp);
            mysqli_stmt_execute($sqlState);
            $result = mysqli_stmt_get_result($sqlState);

            if(mysqli_num_rows($result) >= 1){
                session_start();
                $utilisateurs = mysqli_fetch_assoc($result);
                $_SESSION['utilisateurs'] = $utilisateurs;

                $role = $utilisateurs['ID_role'];
                switch ($role){
                    case 3 : 
                        
                        header('Location: ../include.php/page_secretaire/pageprincipale.php');
                        exit(); // Assurez-vous de quitter le script après une redirection
                        break;
                    default : 
                        header('Location: ../main_page.php');
                        exit(); // Assurez-vous de quitter le script après une redirection
                        break;
                }
                
            }
            else{
                ?>
                <div class="alert alert-danger" role="alert">
                    Email ou mot de passe est incorrect!
                </div>
                <?php
            }
        }
        else { 
            ?>
            <div class="alert alert-danger" role="alert">
                Email , mot de passe sont obligatoires!
            </div>
            <?php
        }
    }

    ?>
        <h2>Connexion secrétaire</h2>
        <form method="POST">
            <div class="form-group">
                <label for="email">Adresse e-mail:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe:</label>
                <input type="password" id="password" name="passeword" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Connexion" name="connexion">
            </div>
        </form>
    </div>
    <a href="../main_page.php">Reuteur</a>
</body>
</html>
