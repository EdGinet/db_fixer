<?php

$jsonData = file_get_contents('cities.json');

$data = json_decode($jsonData, true);

if (isset($data['cities'])) {

    foreach ($data['cities'] as &$item) {
        
        $item = array_filter($item, function($key) {
            return $key !== 'insee_code' && $key !== 'city_code';
        }, ARRAY_FILTER_USE_KEY);

    }
}

$jsonDataModified = json_encode($data);

file_put_contents('cities_modified.json', $jsonDataModified);

echo "Script terminé.";
?>