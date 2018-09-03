<style>
.red {
    color : red;
}
</style>

<?php
// Exercice 3 ------------- KHAN Akbar ---------------


// connexion à la BDD
$pdo = new PDO('mysql:host=localhost;dbname=exercice_3','root',
                '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8') 
            );




echo '<pre>';
print_r($_POST);
echo '</pre>';
            



// initialisation d'une variable pour afficher les contenus en html
$contenu = '';

// ---------- Traitement du Formulaire -----------
if (!empty($_POST)) {
    // Titre
    if (!isset($_POST['titre']) || strlen($_POST['titre']) < 5) $contenu .= '<div class="red">Le titre doit contenir au minimum 5 caractères.</div>';
    
    // Acteurs
    if (!isset($_POST['acteurs']) || strlen($_POST['acteurs']) < 5) $contenu .= '<div class="red">Le champ Acteurs doit contenir au minimum 5 caractères.</div>';

    // Directeur
    if (!isset($_POST['directeur']) || strlen($_POST['directeur']) < 5) $contenu .= '<div class="red">Le champ Directeur doit contenir au minimum 5 caractères.</div>';

    // Producteur
    if (!isset($_POST['producteur']) || strlen($_POST['producteur']) < 5) $contenu .= '<div class="red">Le champ Producteur doit contenir au minimum 5 caractères.</div>';

    // Annee de réalisation
    if (!isset($_POST['annee_de_realisation']) || !ctype_digit($_POST['annee_de_realisation']) || $_POST['annee_de_realisation'] > 2018 || $_POST['annee_de_realisation'] < 1900) $contenu .= '<div>L\'année de réalisation n\'est pas valide !</div>';

    // Catégorie
    if (!isset($_POST['categorie']) || ($_POST['categorie'] != 'sciencefiction' && $_POST['categorie'] != 'comédie' && $_POST['categorie'] != 'action')) $contenu .= '<div>Le categorie de votre contact est incorrect !</div>';
    
   // Synopsis
   if (!isset($_POST['synopsis']) || strlen($_POST['synopsis']) < 5) $contenu .= '<div class="red">Le champ Synopsis doit contenir au minimum 5 caractères.</div>';

   // Vidéo
   if (!isset($_POST['video']) || !filter_var($_POST['video'], FILTER_VALIDATE_URL)) $contenu .= '<div>Le lien est invalide</div>';
  


    // -----------------------------


    if (empty($contenu)) {  // si $contenu est vide c'est qu'il n'y a pas d'erreur

        // On échappe toutes les valeurs de $_POST :
        foreach($_POST as $indice => $valeur) {
            $_POST[$indice] = htmlspecialchars($valeur, ENT_QUOTES);
        }
    
        // On fait une requête préparée :
        $result = $pdo->prepare("INSERT INTO movies(titre, acteurs, directeur, producteur, annee_de_realisation, langue, categorie, synopsis, video) VALUES (:titre, :acteurs, :directeur, :producteur, :annee_de_realisation, :langue, :categorie, :synopsis, :video)");
    
        $result->bindParam(':titre', $_POST['titre']);
        $result->bindParam(':acteurs', $_POST['acteurs']);
        $result->bindParam(':directeur', $_POST['directeur']);
        $result->bindParam(':producteur', $_POST['producteur']);
        $result->bindParam(':annee_de_realisation', $_POST['annee_de_realisation']);
        $result->bindParam(':langue', $_POST['langue']);
        $result->bindParam(':categorie', $_POST['categorie']);
        $result->bindParam(':synopsis', $_POST['synopsis']);
        $result->bindParam(':video', $_POST['video']);
    
    
    
        $req = $result->execute();  // la méthode execute() renvoie un boolean selon que la requête à marchée (true) ou pas (false)
    
        // Afficher un message de réussite ou d'échec :
        if ($req) {
            $contenu .= '<div>Le film à bien été ajouté</div>';
        } else {
            $contenu .= '<div>Une erreur est survenue lors de l\'eregistrement de votre film.</div>';
        }
    
    } // fin empty $contenu

} // fin !empty $_POST ------ traitement formulaire



?>



 <!-- ******** Affichage ******** -->

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Exercice 3 akbar</title>
</head>
<body>

<h1>Ajouter un film :</h1>

<?php echo $contenu; ?>

<form action="" method"post">

    <div>
        <label for="titre">Titre :</label><br>
        <input type="text" name="titre" id="titre" value="">
    </div>
    <div>
        <label for="acteurs">Acteurs :</label><br>
        <input type="text" name="acteurs" id="acteurs" value="">
    </div>
    <div>
        <label for="directeur">Directeur :</label><br>
        <input type="text" name="directeur" id="directeur" value="">
    </div>
    <div>
        <label for="producteur">Producteur :</label><br>
        <input type="text" name="producteur" id="producteur" value="">
    </div>
    <div>
        <label for="annee_de_realisation">Année de réalisation :</label><br>
        <select name="annee_de_realisation" id="annee_de_realisation">
            <?php
                for($i=1900;$i<=2018;$i++) {
                    echo "<option>$i</option>";
                }
            ?>
        </select>
    </div>

    <div>
        <label for="langue">Langue :</label><br>
        <select name="langue" id="langue">
                <option value="anglais">Anglais</option>
                <option value="français">Français</option>
                <option value="espagnol">Espagnol</option>
                <option value="allemand">Allemand</option>
        </select>
    </div>

    <div>
        <label for="categorie">Catégorie :</label><br>
        <select name="categorie" id="categorie">
                <option value="sciencefiction">Science-Fiction</option>
                <option value="comédie">Comédie</option>
                <option value="action">Action</option>
        </select>
    </div>

    <div>
        <label for="synopsis">Synopsis :</label><br>
        <textarea name="synopsis" id="synopsis"></textarea>
    </div>

    <div>
        <label for="video">Vidéo :</label><br>
        <input type="text" name="video" id="video" value="">
    </div>

    <div>
        <input type="submit" name="validation" value="Envoyer">
    </div>

</form>
    
</body>
</html>