
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/totalcs.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-0tMKRgkIptx4eC5Y0GJwGDV0kep9iS96NcGzIaI54k2HHzuYH0/wmZPjn7VW8zNY4udrh5LaLmmXuEjGRc/Jgg==" crossorigin="anonymous" />
   
</head>
<body>
    <section id="home">

        <header class="nav">
            <nav >
                <ul>
                    <li><strong>ENSA Agadir</strong></li>
                    <li><a href="#"><i class="fas fa-home"></i> Home</a></li>
                    <li><a href="#apropose"><i class="fas fa-info-circle"></i> À Propos</a></li>
                    <li><a href="#vous"><i class="fas fa-user"></i> Vous Êtes</a></li>
                    <li><a href="#contact"><i class="fas fa-envelope"></i> Contact</a></li>
                </ul>
            </nav>
             
          </header>
        
          <main>
            <div class="background">
              <div class="content">
                <h1>Welcome to Your Application</h1>
              </div>
            </div>
          </main>
    </div>
    </section>
    
    <section id="apropose">

        <div class="propose">
            <div class="propose-content">
              <h1><strong>À propos de cette application</strong></h1>
              <p>L'application de gestion de stages des élèves ingénieurs à l'ENSA Agadir a été développée pour faciliter la coordination et la gestion des stages pour les étudiants et les responsables pédagogiques.</p>
              <p>Fonctionnalités Principales :</p>
              <ul>
                <li>Aux étudiants de consulter et télécharger les rapports de stage numérisés.</li>
                <li>Aux administrateurs (enseignants, responsables pédagogiques) de déposer et gérer les rapports de stage.</li>
              </ul>
              <p>L'application a été développée par une équipe d'étudiants de l'ENSA Agadir dans le cadre d'un projet sous la supervision de <strong>OUKHOUYA</strong>.</p>
            </div>
            <div class="propose-image">
              
              <img src="css/images/single-report-without-background-green-color-illus-GuTckJ4STo68Oby8MhN-Nw-vP0WMkyBT7WZG4wbYUHjgw.jpeg" alt="Description de l'image">
        
            </div>
          </div>
                
    </section>
    
    
    <section id="vous">

        <main class="backround2">
            <div class="container">
              <a href="include.php/connection_etudiant.php" class="card student" target="_blank" >
                <h2>Étudiant</h2>
              </a>
              <a href="include.php/connection_administration.php" class="card admin" target="_blank" >
                <h2>Administration</h2>
              </a>
              <a href="include.php/connection_secrétaire.php" class="card secretary" target="_blank" >
                <h2>Secrétaire</h2>
              </a>
              <a href="include.php/connection_chefdepartment.php" class="card head" target="_blank" >
                <h2>Chef de filière</h2>
              </a>
            </div>
          </div>
    </div>
        </main>
    </section>
        
    
    <section id="contact">

        <div class="container">
            <h1>Contactez-nous</h1>
            <form action="include.php/email.php" method="POST">
              <label for="name">Nom:</label>
              <input type="text" id="name" name="name" required>
        
              <label for="email">Email:</label>
              <input type="email" id="email" name="email" required>
        
              <label for="message">Message:</label>
              <textarea id="message" name="message" required></textarea>
              <input type="submit"  id="send" name="envoyer" value="Envoyer">
            </form>
          </div>
    </div>
    </section>
    
    
</body>
</html>
