<?php
$jsonData = file_get_contents('cities_modified.json');

$data = json_decode($jsonData, true);

$file = fopen('cities__modified_converted.sql', 'w');

if (!$file) {
    die('Impossible de créer le fichier SQL.');
}

foreach ($data['cities'] as $city) {
    $sql = "INSERT INTO villes (zip_code, label, latitude, longitude, department_name, department_number, region_name, region_geojson_name) VALUES (";

    $sql .= "\"" . $city['zip_code'] . "\", ";
    $sql .= "\"" . $city['label'] . "\", ";
    $sql .= "\"" . $city['latitude'] . "\", ";
    $sql .= "\"" . $city['longitude'] . "\", ";
    $sql .= "\"" . $city['department_name'] . "\", ";
    $sql .= "\"" . $city['department_number'] . "\", ";
    $sql .= "\"" . $city['region_name'] . "\", ";
    $sql .= "\"" . $city['region_geojson_name'] . "\"";
    $sql .= ");\n";

    fwrite($file, $sql);
}

fclose($file);

echo 'Données converties en fichier SQL.';
?>