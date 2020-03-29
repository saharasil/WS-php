<!-- règle de base , ne jamais faire confiance aux données envoyées par l'utilisateur !!
Il fait vérifier le type de dossier envoyé, exemple pour une photo on attend de l'utilisation des formats de type (png, jpg, gif, jpeg)
- il faut vérifier la taille du fichier envoyé. Dans le principe PHP n'accépte pas les fichiers  supérieur à 8mo.
-Important de renomer les photos  une fois uploader et ce pour éviter l'écrasement de photo -->

<?php
require_once 'connect.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire</title>
</head>
<body>
    <h1>Formulaire</h1>
    <?php
        echo '<form class="col-md-4" action="" method="post" enctype="multipart/form-data">
        <label for="image" >Photo</label> <br>
        <input type="file" name="image" id="image">
        <button type="submit">Envoyer</button>
        </form>';
        if(isset($_FILES['image']) && ($_FILES['image']['error']) == 0){
            if($_FILES['photo']['size']<= 3000000){
                $infoImg = pathinfo($_FILES['image']['name']);// ça va envoyer sous forme de tableau toutes les informations de l'image notament l'extantion dont on va avoir besoin. On va pouvoir ensuite comparer l'extention de l'image reçu avec celles autorisées.
                debug($infoImg);
                $extensionArray = array('png', 'gif','jpg'); // on crée un tableau avec les extensions qu'on autorise
                if(in_array($extensionImg, $extensionArray)){

                   
    		    move_uploaded_file($_FILES['image']['tmp_name'], 'assets/img/'.time().rand().'.'.$extensionImg); //Cette fonction prend 2 paramètres le tmp_name récupère l'image temporaire et le 2ème paramètre c'est la destination qu'on va concaténer avec la fonction time(), rand()
    		    echo 'envoie réussi !';
                }

            }
        }
    ?>
</body>
</html>