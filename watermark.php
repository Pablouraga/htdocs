<?php

/**
 * @author Pablo Uraga
 * @version 1.0.0
 */

//Se envia por get (un array de nombres de archivos y directorios)

//file_get_contents devuelve url

$image = imagecreatefromstring(file_get_contents($_GET['img']));

// $fontColor = imagecolorallocate($image, 0, 0, 0);
$fontColor = imagecolorallocatealpha($image, 0, 0, 0, 63);

//imagen, tamaño texto, angulo, coordendas x, coordendas y, color letra, tipo letra, texto
imagettftext($image, 60, 45, 370, 580, $fontColor, __DIR__ . '/fonts/Sandler Trial.otf', 'Pablo Uraga');

header('Content-Type: image/png');
imagepng($image);

imagedestroy($image);
