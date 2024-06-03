<?php
function foo(array $arrays)
{
    // Initialisation du tableau final qui comprendra les sous-tableaux fusionnés
    $result = [];

    // Boucle pour créer le tableau final qui comprendra les sous-tableaux fusionnés ou non
    foreach ($arrays as $subArray) {
        $merged = false;

        // Parcours du tableau final pour vérifier si le sous-tableau en question doit être fusionné avec un groupe existant
        foreach ($result as &$group) {
            // Vérification de chevauchement avec les éléments existants à savoir si le subArray donc le tableau qui se fait analysé chevauche le groupe donc le tableau qui est déjà dans le tableau final
            if ($subArray[0] <= $group[1] && $subArray[1] >= $group[0]) {
                // Fusion des suites en mettant à jour les bornes
                $group[0] = min($group[0], $subArray[0]);
                $group[1] = max($group[1], $subArray[1]);
                $merged = true; // sous-tableau a été fusionné
                break;
            }
        }

        // Si aucune fusion n'a eu lieu, ajouter le sous-tableau comme un nouveau groupe distinct
        if (!$merged) {
            $result[] = $subArray;
        }
    }

    // Boucle supplémentaire pour fusionner les groupes avec des bornes égales
    $i = 0;
    while ($i < count($result) - 1) {
        if ($result[$i][1] == $result[$i + 1][0]) {
            // Fusionner les intervalles
            $result[$i][1] = $result[$i + 1][1];
            array_splice($result, $i + 1, 1);
        } else {
            $i++;
        }
    }

    // Trier les tableaux

    if (!function_exists('compareArrays')) {
        // Définir la fonction compareArrays
        function compareArrays($a, $b)
        {
            $sumA = array_sum($a);
            $sumB = array_sum($b);
            if ($sumA == $sumB) {
                return 0;
            }
            return ($sumA < $sumB) ? -1 : 1;
        }
    }

    // Tri du tableau $result en utilisant la fonction de comparaison personnalisée
    usort($result, 'compareArrays');

    // Formatage et affichage du résultat avec map et implode pour avoir le rendu souhaité
    $formattedResult = array_map(function ($group) {
        return '[' . implode(', ', $group) . ']';
    }, $result);

    echo '[' . implode(', ', $formattedResult) . ']';
    echo "<br>"; // Pas demandé mais c'est mieux pour la lisibilité
}

// Exemple d'utilisation avec les données de l'énoncé
foo([[0, 3], [6, 10]]); // [[0, 3], [6, 10]]
foo([[0, 5], [3, 10]]); // [[0, 10]]
foo([[0, 5], [2, 4]]); // [[0, 5]]
foo([[7, 8], [3, 6], [2, 4]]); // [[2, 6], [7, 8]]
foo([[3, 6], [3, 4], [15, 20], [16, 17], [1, 4], [6, 10], [3, 6]]); // [[1, 10], [15, 20]]

echo "<br>";
echo "<br>";

// Exemple d'utilisation avec des données supplémentaires
foo([[0, 3], [6, 10], [11, 15]]); // [[0, 3], [6, 10], [11, 15]]
foo([[7, 8], [3, 6], [2, 4], [9, 12]]); // [[2, 6], [7, 8], [9, 12]]
foo([[3, 6], [3, 4], [15, 20], [16, 17], [1, 4], [6, 10], [3, 6], [21, 25]]); // [[1, 10], [15, 20], [21, 25]]
foo([[3, 6], [3, 4], [15, 20], [16, 17], [1, 4], [6, 10], [3, 6], [21, 25], [26, 30]]); // [[1, 10], [15, 20], [21, 25], [26, 30]]
foo([[1, 8], [89, 96], [3, 6], [3, 4], [15, 20], [16, 17], [1, 4], [6, 10], [3, 6], [21, 25], [26, 30]]); // [[1, 10], [15, 20], [21, 25], [26, 30], [89, 96]]
foo([[3, 6], [3, 4], [15, 20], [16, 17], [1, 4], [6, 15], [3, 6]]); // [[1, 20]]
