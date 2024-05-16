C'est embétant pour Echo d'avoir trouvé cette mystérieuse fonction mais de ne pas avoir retrouvé le code...
Je veux bien d'abord l'aider à la comprendre puis lui refaire le code pour son plaisir !


## Étapes de la fonction :

### Entrée
Un tableau contenant plusieurs sous-tableaux, chacun représentant une suite d'entiers par ses bornes de début et de fin.

### Suites
Pour chaque sous-tableau, la fonction génère la liste complète des entiers de la suite correspondante. Par exemple :

- `[0, 5]` devient `[0, 1, 2, 3, 4, 5]`
- `[3, 10]` devient `[3, 4, 5, 6, 7, 8, 9, 10]`

### Fusion des suites avec chevauchement
La fonction examine les suites ainsi générées et cherche celles qui ont des éléments communs. Si deux suites partagent au moins un élément, elles sont fusionnées en un seul groupe. Par exemple :

Les suites `[0, 1, 2, 3, 4, 5]` et `[3, 4, 5, 6, 7, 8, 9, 10]` partagent les éléments 3, 4 et 5. Donc, elles sont fusionnées en une seule suite allant de 0 à 10, ce qui donne le groupe `[0, 10]`.

### Résultat
La fonction retourne un tableau de sous-tableaux (groupes) fusionnés ou distincts selon la présence ou l'absence d'éléments communs. Par exemple :

- Pour les entrées `[0, 5]` et `[3, 10]`, le résultat sera `[[0, 10]]` car les deux suites se chevauchent.
- Pour les entrées `[0, 3]` et `[6, 10]`, le résultat sera `[[0, 3], [6, 10]]` car il n'y a aucun élément commun entre les deux suites.
