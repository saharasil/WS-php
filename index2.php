<?php
require_once 'connect.php';


$contenu ='';
debug($_POST);


if ( isset ($_POST ['name'])&&($_POST ['prenom'])&&($_POST ['age'])&&($_POST ['ville'])&&($_POST ['motivations'])&&($_FILES['photo']['name'])){

        // $nom = $_POST ['name'];
        // $prenom = $_POST ['prenom'];
        // $age = $_POST ['age'];
        // $ville = $_POST ['ville'];
        // $motivations = $_POST ['motivations'];
        $photo = 'assets/img/' .$_FILES['photo']['name']; 
        copy($_FILES['photo']['tmp_name'], $photo);
        
        // 5 types possibles 
        // $_FILES['image']['name'] Nom
        // $_FILES ['image']['type'] Type
        // $_FILES ['image']['size'] Taille
        // $_FILES ['image']['tmp_name'] Emplacement temporaire
        // $_FILES ['image']['error'] Erreur si oui/non l'image a été réceptionné

    
    $requete = $pdo->prepare("INSERT INTO profils (nom, prenom, age, ville, photo, motivation) VALUE (:nom, :prenom, :age, :ville, :photo, :motivation)")
    //permet de capturer l'erreur et de l'afficher.
        or die (print_r($pdo->errorInfo()));
    $succes = $requete -> execute(array(':prenom' => $_POST['nom'], 
                                        ':nom' => $_POST['prenom'] , 
                                        ':age' => $_POST['age'], 
                                        ':ville' => $_POST['ville'],
                                        ':photo' => $photo, 
                                        ':motivation' => $_POST['motivation']
                                    ));
        header('location:index.php');

        if($succes){
          $contenu .= '<p>le profil est bien enregistré </p>';
        }else {
            $contenu.= '<p>Erreur l\'ors de l`\'enregistrement</p>';
        }
    

}

if(isset($_GET['id_profils'])){

    $query = $pdo->prepare("SELECT * FROM profils WHERE id_profils = ? ");
    $query ->execute(array('?' => $_GET['id_profils']));

    if ($query->rowCount()=== 0){
       $contenu .= '<p>Ce profil n\'existe pas</p>';
    }else {

       while( $profil = $query->fetch(PDO::FETCH_ASSOC);){

        $contenu .= '<div class="row">';
            $contenu .= ' <div class="col-lg-12">';
                $contenu .= ' <h3>Présentation du profil</h3>';
            $contenu .= ' </div>';
                $contenu .= ' <div class="card" style="width: 18rem;">';
                    $contenu .= ' <img src="' . $_profil['photo'] . '" class="card-img-top" alt="">';
                    $contenu .= ' <div class="card-body">';
                        $contenu .= ' <h5 class="card-title">Nom et Prenom</h5>';
                        $contenu .= ' <p class="card-text">' . $profil['nom'].' ' . $profil['prenom'] .'</p>';
                    $contenu .= ' </div>';
                    $contenu .= ' <ul class="list-group list-group-flush">';
                        $contenu .= ' <li class="list-group-item">Age : ' .$profil['age'] .'</li>';
                        $contenu .= ' <li class="list-group-item">Ville : ' . $profil['ville'] . '</li>';     
                    $contenu .= ' </ul>';
                    $contenu .= ' <div class="card-body">';
                    $contenu .= '<a href="#" class="card-link">' . substr($profil['motivation']).'....</a>';
                    $contenu .= ' </div>';
                    $contenu .= ' </div> ';
        $contenu .= '</div>';
        }
      
    }


}




?>
<!doctype html>
<html lang="fr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css" >
    <title>Candidat</title>
  </head>
  <body>
    <div class="container mt-5">
        
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Formulaire</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav mr-auto">
                
                <li class="nav-item">
                    <a class="nav-link" href="#">Frofil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"></a>
                </li>
                </ul>
                <span class="navbar-text">
                    Formulaire D'inscription 
                </span>
            </div>
        </nav>
    </div> <!-- fermeture div.container  -->

        <!-- LA CARED  -->
        <div class="container">
                <div class="col-md-4">
                <?php echo $contenu; ?>
                </div> 
        </div>
    
    <div class="container">   
        <div  class="row">
        <div class="col-md-4"></div>
        <?php echo $contenu ?>
            <form class="col-md-4" action="" method="post" enctype="multipart/form-data">
                <h2 class="text-center col-md-12" id="formulaire">Formulaire d'inscription de 
                stage</h2>
                <div class="form-row ">

                    <div class="form-group col-md-12 ">
                        
                            <label for="nom">Nom</label>
                            <input type="text" name="nom" class="form-control" id="nom" value="<?php echo $_POST['nom'] ?? '' ?>">
                    </div>
                    <div class="form-group col-md-12 ">
                        
                        <label for="prenom">Prenom</label>
                        <input type="text" name="prenom" class="form-control" id="prenom" value="<?php echo $_POST['prenom'] ?? '' ?>">
                </div>
                    
                    <div class="form-group col-md-12 ">
                            <label for="age">Age</label>
                            <input type="text" name="age" class="form-control" id="age" value="<?php echo $_POST['age'] ?? '' ?>">
                    </div>
                        
                    
                    <div class="form-group col-md-12">
                        <label for="ville">Ville</label>
                        <input type="text" name="ville" class="form-control" id="ville" value="<?php echo $_POST['ville'] ?? '' ?>">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="photo">Photo</label>
                        <input type="file" name="photo" class="form-control" id="photo" value="<?php echo $_FILES['photo']['name'] ?? '' ?>">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="motivation">Motivation </label><br>
                        <textarea type="texte" name="motivation" id="motivation" value="<?php echo $_POST['motivation'] ?? '' ?>" ></textarea>
                    </div>
                </div>
                <div class="form-row ">
                    <button type="submit" class="btn btn-primary" value="S'inscrire">Inscrivez-vous</button>
                </div>
            </form>
        </div>
    </div>



   

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>