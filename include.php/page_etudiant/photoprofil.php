<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modify Profile Picture</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      background-color: #cc9a7c;
    }

    .container {
      max-width: 600px;
      margin: 10px auto;
      background-color: #fff;
      border-radius: 8px;
      padding: 40px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }

    h1 {
      text-align: center;
      margin-bottom: 20px;
      color: #d85e0d;
    }

    .file-input {
      position: relative;
      margin-bottom: 20px;
    }

    input[type="file"] {
      position: absolute;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      opacity: 0;
    }

    label {
      display: block;
      padding: 10px 20px;
      background-color: #7e5d48;
      color: #fff;
      border-radius: 4px;
      cursor: pointer;
      text-align: center;
    }

    label:hover {
      background-color: #968c30;
    }

    button[type="submit"] {
      display: block;
      width: 100%;
      padding: 10px;
      background-color: #f18d4a;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    button[type="submit"]:hover {
      background-color: #ac9f2c;
    }

    .preview {
      text-align: center;
    }

    .preview img {
      max-width: 200px;
      margin-top: 20px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Modify Profile Picture</h1>
    <form id="profilePictureForm" enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <div class="file-input">
        <input type="file" id="profilePictureInput" name="profilePicture" accept="image/*" onchange="previewProfilePicture(event)">
        <label for="profilePictureInput">Choose a file</label>
      </div>
      <button type="submit">Upload</button>
    </form>
    <div class="preview">
      <img id="previewProfilePicture" src="#" alt="Preview" style="display: none;">
    </div>
  </div>

  <script>
    function previewProfilePicture(event) {
      var input = event.target;
      var preview = document.getElementById('previewProfilePicture');
      var reader = new FileReader();

      reader.onload = function() {
        preview.src = reader.result;
        preview.style.display = 'block';
      };

      reader.readAsDataURL(input.files[0]);
    }
  </script>

  <?php
  session_start(); // Start the session

  // Check if the user is logged in
  if (isset($_SESSION['id_utilisateur'])) {
      // Handle file upload
      if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["profilePicture"])) {
          $userId = $_SESSION['id_utilisateur'];
          $targetDir = "uploads/"; // Specify the directory where you want to store uploaded files
          $targetFile = $targetDir . basename($_FILES["profilePicture"]["name"]);
          $uploadOk = 1;
          $imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));

          // Check if image file is a actual image or fake image
          $check = getimagesize($_FILES["profilePicture"]["tmp_name"]);
          if($check !== false) {
              $uploadOk = 1;
          } else {
              echo "File is not an image.";
              $uploadOk = 0;
          }

          // Check file size
          if ($_FILES["profilePicture"]["size"] > 500000) {
              echo "Sorry, your file is too large.";
              $uploadOk = 0;
          }

          // Allow certain file formats
          if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
          && $imageFileType != "gif" ) {
              echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
              $uploadOk = 0;
          }

          // Check if $uploadOk is set to 0 by an error
          if ($uploadOk == 0) {
              echo "Sorry, your file was not uploaded.";
          // if everything is ok, try to upload file
          } else {
              if (move_uploaded_file($_FILES["profilePicture"]["tmp_name"], $targetFile)) {
                  // File uploaded successfully, update database
                  require_once '../data_base.php'; // Include your database connection file

                  $updateQuery = "UPDATE utilisateurs SET photo = ? WHERE id_utilisateur = ?";
                  $stmt = $connection->prepare($updateQuery);
                  $stmt->bind_param("si", $targetFile, $userId);
                  $stmt->execute();
                  echo "The file ". htmlspecialchars( basename( $_FILES["profilePicture"]["name"])). " has been uploaded.";
              } else {
                  echo "Sorry, there was an error uploading your file.";
              }
          }
      }
  }
  ?>
</body>
</html>
