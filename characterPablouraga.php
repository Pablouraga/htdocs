<!DOCTYPE html>
<html lang="<?= $_SESSION['lang'] ?? 'en' ?>. ">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Character - Pablo Uraga</title>
</head>

<body>
    <?php
    session_start();
    $idiomas = array(
        'es' => 'Español',
        'en' => 'English',
        'ca' => 'Valencià'
    );

    if (isset($_POST['lang'])) {
        if ($_POST['lang'] ) {
            
        }
        $lang = $_POST['lang'];
        $_SESSION['lang'] = $lang;
    } else {
        $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
        if (isset($_SESSION['lang'])) {
            $lang = $_SESSION['lang'];
        }
    }

    switch ($lang) {
        case 'es':
            $text = '<h1>Anivia, la criofénix</h1><p>Mi campeón favorito, sin duda alguna Anivia, la criofenix.</p>
            <p>No tendrá mucho ataque, no tendrá mucha defensa... pero me encanta.</p>
            <p>Es muy difícil de controlar, sobre todo la Q, porque tienes que petarla/controlar la distancia muy bien para stunear. Y la W, porque si no en vez de ayudarte a escapar/encerrar al enemigo/ayudar a los aliados... puedes hacer lo contrario.</p>
            <p>No haré los stats que hacen Maestros Yis y de ese estilo... pero me conformo con un 6/0/20... y ser decisivo en las TF aunque yo no sea el que de last hit.</p>';
            break;

        case 'en':
            $text = '<h1>Anivia, the cryophoenix</h1><p>My favorite champion, without a doubt Anivia, the cryofenix.</p>
            <p>She won&#39;t have much attack, she won&#39;t have much defense... but I love her.</p>
            <p>It&#39;s very difficult to control, especially the Q, because you have to pet it/control the distance very well to stun. And the W, because if not instead of helping you escape/lock the enemy/help allies... you can do the opposite.</p>
            <p>I won&#39;t do the stats that Yis Masters and the like do... but I&#39;ll settle for a 6/0/20... and be decisive in the TF even if I&#39;m not the last hit.</p>';
            break;

        case 'ca':
            $text = '<h1>Anivia, la criofénix</h1><p>El meu campió favorit, sens dubte Anivia, la criofenix.</p>
            <p>No tindrà molt atac, no tindrà molta defensa... però m`encanta.</p>
            <p>És molt difícil de controlar, sobretot la Q, perquè tens que petarla/controlar la distància molt bé per a stunear. I la W, perquè si no en comptes d&#39;ajudar-te a escapar/tancar a l&#39;enemic/ajudar als aliats... pots fer el contrari.</p>
            <p>No faré els stats que fan Mestres Yis i d&#39;eixe estil... però em conforme amb un 6/0/20... i ser decisiu en les TF encara que jo no siga el que de last hit.</p>';
            break;

        default:
            break;
    }

    ?>
    <form action="#" method="post">
        <label for="Idioma">Idioma</label>
        <select name="lang">
            <?php

            foreach ($idiomas as $key => $value) {
                if ($_SESSION['lang'] == $key) {
                    $sameLang = ' selected';
                } else {
                    $sameLang = '';
                }
                echo '<option value="' . $key .'"' . $sameLang . '>' . $value . '</option>';
            }
            ?>
        </select>
        <input type="submit" value="Confirmar">
    </form>

    <?= $text ?>
</body>

</html>