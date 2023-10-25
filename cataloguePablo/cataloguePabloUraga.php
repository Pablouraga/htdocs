<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UD3 - Actividad 4 – Catálogo on-line</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>UD3 - Actividad 4 – Catálogo on-line</h1>

    <?php
    /**
     * @author Pablo Uraga
     * @version 1.0.0
     */
    $imageDir = __DIR__.'/img/';

    if (is_dir($imageDir)) {

        //glob > scandir > opendir
        //glob devuelve un array con los ficheros que coinciden con el patron
        //scandir devuelve un array de nombres de archivos y directorios
        //opendir requiere readdir para obtener los ficheros del directorio
        
        //GLOB_BRACE para buscar varias extensiones
        $images = glob($imageDir . '*.{jpg,jpeg,png}', GLOB_BRACE);

        foreach ($images as $image) {
            echo '<div style="display:inline-block; padding: 0px;">';
            
            // echo("<script>console.log('img url: " . $image . "');</script>");
            
            //Imagen sin espacios (' ' == '%2')
            echo '<img src="watermark.php?img=' . urlencode($image) . '" alt="Imagen con marca de agua">';
            echo '</div>';
        }
    }
    ?>

</body>
</html>
