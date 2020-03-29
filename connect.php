<?php
$pdo = new PDO('mysql:host=localhost;dbname=candidat',
'root', // pseudo
'', 
array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
));

//autre façon pour ce connecter à la BDD
// try{
//     $bdd = new PDO('mysql:host=localhost;dbname=candidat;charset=utf8','root','');
// }
// catch(Exception $e){  // exception va attraper l'erreur qui se serait produit dans le try et la mettre dans la variable $e
//     die('erreur:' .$e->getMessage()); // die permet d'afficher
// }

function debug ($var){
    echo '<pre>';
    print_r($var);
    echo '</pre>';
}