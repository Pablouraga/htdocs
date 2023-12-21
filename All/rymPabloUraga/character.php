<?php
require_once(__DIR__ . '/include/header.inc.php');
$endpoint = 'https://rickandmortyapi.com/api/character/' . $_GET['id'];

$characters = json_decode(file_get_contents($endpoint), true);

echo '<img src="' . $characters['image'] . '">';
echo '<p>Name: <a href="'.$characters['url'].'">' . $characters['name'] . '</a></p>';
echo '<p>Status: ' . $characters['status'] . '</p>';
echo '<p>Species: ' . $characters['species'] . '</p>';
if ($characters['type'] != '') {
    echo '<p>Type: ' . $characters['type'] . '</p>';
}
echo '<p>Gender: ' . $characters['gender'] . '</p>';
echo '<p>Origin: <a href="' . $characters['origin']['url'] . '">' . $characters['origin']['name'] . '</a></p>';
echo '<p>Location: <a href="' . $characters['location']['url'] . '">' . $characters['location']['name'] . '</a></p>';
foreach ($characters['episode'] as $key => $value) {
    echo '<a href="' . $value . '">' . $key + 1 . '</a>&nbsp;';
}
echo '<p>Created: ' . date("Y-m-d H:i:s", strtotime($characters['created'])) . '</p>';