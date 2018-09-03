<?php
// Exercice 2 ------------- KHAN Akbar ---------------




// initialisation d'une variable pour afficher les contenus en html
$contenu = '';


function convert_EuroUsd($montant, $monnaie='USD') {
    

    if (is_numeric($montant)) {

        if ($monnaie == 'USD') {
            return 'Le montant en USD : ' . $montant*1.085965 . ' $';
        }elseif ($monnaie == 'EUR') {
            return 'Le montant en EUR : ' . $montant*.85965 . ' €';
        }else {
            return 'Erreur : la conversion se fait que d\'un montant en EUR vers un montant en  USD, et vice-versa.';
        }

    } else {
        return '<p>Le montant n\'est pas un nombre</p>';
    
    }  // fin condition is_numeric


    


}

$contenu .= '<strong>';

$contenu .= convert_EuroUsd('100','USD');

$contenu .= '</strong>';








?>
 <!-- ******** Affichage ******** -->

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Exercice 2 akbar</title>
</head>
<body>

<h1>On part en voyage !</h1>

<?php echo $contenu; ?>
    
</body>
</html>