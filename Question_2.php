<?php
function foo(array $arrays)
{
    // Initialisation du tableau finale qui comprendra les sous-tableaux fusionnés
    $result = [];

    // Boucle qui parcourt les sous-tableaux donnés en entrée
    foreach ($arrays as $subArray) {
        // Variable qui définit si le sous-tableau en question doit être fusionné avec un groupe existant ou être ajouté au tableau finale comme un nouveau groupe
        $merged = false;

        // Parcours du tableau finale pour vérifier si le sous-tableau en question doit être fusionné avec un groupe existant
        foreach ($result as &$group) {
            // Vérification de chevauchement avec les éléments existants à savoir si le subArray donc le tableau qui se fait analysé chevauche le groupe donc le tableau qui est déjà dans le tableau final
            if ($subArray[0] <= $group[1] && $subArray[1] >= $group[0]) {
                // Fusion des suites en mettant à jour les bornes
                $group[0] = min($group[0], $subArray[0]); // On prend le minimum des deux bornes
                $group[1] = max($group[1], $subArray[1]); // On prend le maximum des deux bornes
                $merged = true; // On met la variable merged à true pour dire que le sous-tableau a été fusionné
                break;
            }
        }

        // Si aucune fusion n'a eu lieu, ajouter le sous-tableau comme un nouveau groupe distinct
        if (!$merged) {
            $result[] = $subArray;
        }
    }

    // Formatage et affichage du résultat avec map et implode pour avoir le rendu souhaité : [[valeur, valeur], [valeur, valeur]]
    $formattedResult = array_map(function ($group) {
        return '[' . implode(', ', $group) . ']';
    }, $result);

    echo '[' . implode(', ', $formattedResult) . ']';
    echo "<br>"; // Pas demandé mais c'est mieux pour la lisibilité
}


// Exemple d'utilisation avec les données de l'énoncé
foo([[0, 3], [6, 10]]);
foo([[0, 5], [3, 10]]);
foo([[0, 5], [2, 4]]);
foo([[7, 8], [3, 6], [2, 4]]);
foo([[3, 6], [3, 4], [15, 20], [16, 17], [1, 4], [6, 10], [3, 6]]);

// Exemple d'utilisation avec des données supplémentaires
foo([[0, 3], [6, 10], [11, 15]]);
foo([[0, 5], [3, 10], [11, 15]]);
foo([[0, 5], [2, 4], [6, 10]]);
foo([[7, 8], [3, 6], [2, 4], [9, 12]]);
foo([[3, 6], [3, 4], [15, 20], [16, 17], [1, 4], [6, 10], [3, 6], [21, 25]]);
