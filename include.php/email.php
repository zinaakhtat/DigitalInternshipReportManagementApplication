<?php
/*
if(isset($_POST['envoyer'])){

    if(!empty($_POST['name'])&&!empty($_POST['email'])&&!empty($_POST['message'])){
        $name=$_POST['name'];
        $email=$_POST['email'];
        $message=$_POST['message'];

        $to="dani@onlineittuts.com";
        $subject="Nouveau message de la part du".$name;
        $body="you have received an email from" .$message.".\n\n"." Message:" .$message;
        $headers="From".$email;
        if(mail($to, $subject, $body, $headers)) {
            echo 'Le message a été envoyé avec succès.';
        } else 
        {
            echo "message not sent";
                }
    } 
  else echo"tout les champs sont obligatoires";
}*/
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Faites quelque chose avec les données (envoi d'e-mail, enregistrement en base de données, etc.)
    // Par exemple, envoyez les données par e-mail
    $to = "maryamiguizoul@gmail.com";
    $subject = "Nouveau message de formulaire de contact";
    $txt = "Nom: " . $name . "\n" . "Email: " . $email . "\n" . "Message: " . $message;
    if(mail($to, $subject, $txt)){ echo "great";}
    else {echo "erreur";}
    // Rediriger l'utilisateur vers une page de confirmation
    //header("include.php/connection_etudiant.php");
    //exit();
}
?>
