<?php
// Exercice 1 ------------- KHAN Akbar ---------------




// initialisation d'une variable pour afficher les contenus en html
$contenu = '';



$presentation = array(
    'prenom' => 'akbar',
    'nom' => 'khan',
    'adresse' => '10 rue Martin Luther King',
    'code_postal' => '93140',
    'ville' => 'Bondy',
    'email' => 'akbar.khan@lepoles.com',
    'telephone' => '0753175848',
    'date_naissance' => '1996/06/30'
);


foreach($presentation as $indice => $valeur) {

    if ($indice == 'date_naissance') {
        $objetDate = new DateTime($valeur);

        $valeur = $objetDate->format('d/m/Y');

        $contenu .= '<ul>';
            $contenu .= '<li>';
            $contenu .= "$indice : $valeur";
            $contenu .= '</li>';
        $contenu .= '</ul>';
    }else {
    $contenu .= '<ul>';
        $contenu .= '<li>';
        $contenu .= "$indice : $valeur";
        $contenu .= '</li>';
    $contenu .= '</ul>';
    }


    
}





?>
 <!-- ******** Affichage ******** -->

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Exercice 1 akbar</title>
</head>
<body>

<?php echo $contenu; ?>
    
</body>
</html>