<?php
// Lire le contenu du fichier JSON
$jsonData = file_get_contents('cities.json');

// Convertir le contenu JSON en un tableau associatif
$data = json_decode($jsonData, true);

// Assurez-vous que la clé "cities" existe
if (isset($data['cities'])) {
    // Parcourir chaque entrée dans le tableau "cities"
    foreach ($data['cities'] as &$item) {
        // Supprimer les clés "insee_code" et "city_code" si elles existent
        $item = array_filter($item, function($key) {
            return $key !== 'insee_code' && $key !== 'city_code';
        }, ARRAY_FILTER_USE_KEY);
    }
}

// Reconvertir le tableau modifié en une chaîne JSON
$jsonDataModified = json_encode($data);

// Enregistrer les données modifiées dans un nouveau fichier JSON
file_put_contents('cities_modified.json', $jsonDataModified);

echo "Script terminé.";
?>