<?php
$bdd = new PDO('mysql:host=localhost;dbname=id5293685_espace_membre', 'id5293685_root', '123456789');

if (isset($_POST['formregister']))
{
     if(!empty($_POST['pseudo']) AND !empty($_POST['email']) AND !empty($_POST['password']) AND !empty($_POST['password2']))
     {
      $pseudo = htmlspecialchars($_POST['pseudo']);
      $email = htmlspecialchars($_POST['email']);
      $password = sha1($_POST['password']);
      $password2 = sha1($_POST['password2']);

     $reqpseudo = $bdd->prepare("SELECT * FROM membres WHERE pseudo = ?");
     $reqpseudo->execute(array($pseudo));
     $pseudoexist = $reqpseudo->rowCount();
     if ($pseudoexist == 0) {

     if ($password == $password2) {
           $insertmbr = $bdd->prepare("INSERT INTO membres(pseudo, email, password, id_role) VALUES (?, ?, ?, 2)");
           $insertmbr->execute(array($pseudo, $email, $password));
           $erreur = "<p style='color:red; font-weight:bold;'>Inscription reussie, veuillez vous connecter !</p>";
           header( "refresh:3;url=connexion.php" );
     }
     else {
       $erreur = "<p style='color:red; font-style:italic;'>Vos mots de passe ne correspondent pas !</p>";
     }
     }
     else {
       $erreur = "<p style='color:red; font-style:italic;'>Ce pseudo est déjà utilisé !</p>";
     }
     }
     else
      {
      $erreur = "<p style='color:red; font-style:italic;'>Tous les champs doivent étre complétés !</p>";
      }

}
 ?>
  <!DOCTYPE html>
  <html lang="fr">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dans ma ville</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Fredoka+One" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/style-tablette.css">
    <link rel="stylesheet" href="../css/style-tablette-xs.css">
    <link rel="stylesheet" href="../css/style-phone.css">
    <script type="text/javascript" src="../js/app.js"></script>
  </head>

  <body>
    <header>
      <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="../../index.html"><img class="img-fluid" src="../img/logo.png"></a>
        <h2>Dans Ma Ville</h2>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item active">
              <a class="nav-link" href="../../index.html">Accueil</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="description.html">Description</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="contact.html">Contact</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="connexion.php">Connexion</a>
            </li>
          </ul>
        </div>
      </nav>
      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </header>
    <section id="page-register">
      <h2>S'inscrire</h2>

      <form method="post" action="register.php">
        <?php
if (isset($erreur))
{
    echo $erreur;
}

 ?>
        <label for="pseudo">Pseudo</label>
        <input  class="inputput" type="text" name="pseudo" placeholder="Votre pseudo" />

        <label for="email">Email</label>
        <input  class="inputput" type="email" name="email" placeholder="Votre Email" />

        <label for="password">Mot de Passe</label>
        <input  class="inputput" type="password" name="password" placeholder="Votre Mot de passe">

        <label for="password2">Confirmation</label>
        <input  class="inputput" type="password" name="password2" placeholder="Confirmer votre Mdp">

        <div id="btn2">
          <input type="submit" name="formregister" value="S'inscrire" />
          <div>
            <a class="emptyInput">Annuler</a>
          </div>
        </div>

        <div id="register">
          <p>Déjà inscrit(e) ?</p>
          <a href="connexion.php">S’identifier</a>
        </div>

      </form>
      </section>
  </body>

  </html>
