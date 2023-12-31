<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilotos Moto GP</title>
</head>

<body>
    <?php

    require_once(__DIR__ . '/inc/utils.inc.php');
    require_once(__DIR__ . '/inc/Person.inc.php');
    require_once(__DIR__ . '/inc/Mechanic.inc.php');
    require_once(__DIR__ . '/inc/Rider.inc.php');
    require_once(__DIR__ . '/inc/GrandPrix.inc.php');

    $team1 = $teams[0];
    $rider11 = new Rider(randomName(), randomBirthday(), randomDorsal($dorsals));
    $rider21 = new Rider(randomName(), randomBirthday(), randomDorsal($dorsals));
    $mechanic11 = new Mechanic(randomName(), randomBirthday(), randomSpeciality());
    $mechanic21 = new Mechanic(randomName(), randomBirthday(), randomSpeciality());

    $team1->addRider($rider11);
    $team1->addRider($rider21);
    $team1->addMechanic($mechanic11);
    $team1->addMechanic($mechanic21);

    $team2 = $teams[1];
    $rider12 = new Rider(randomName(), randomBirthday(), randomDorsal($dorsals));
    $rider22 = new Rider(randomName(), randomBirthday(), randomDorsal($dorsals));
    $mechanic12 = new Mechanic(randomName(), randomBirthday(), randomSpeciality());
    $mechanic22 = new Mechanic(randomName(), randomBirthday(), randomSpeciality());

    $team2->addRider($rider12);
    $team2->addRider($rider22);
    $team2->addMechanic($mechanic12);
    $team2->addMechanic($mechanic22);

    $team3 = $teams[2];
    $rider13 = new Rider(randomName(), randomBirthday(), randomDorsal($dorsals));
    $rider23 = new Rider(randomName(), randomBirthday(), randomDorsal($dorsals));
    $mechanic13 = new Mechanic(randomName(), randomBirthday(), randomSpeciality());
    $mechanic23 = new Mechanic(randomName(), randomBirthday(), randomSpeciality());

    $team3->addRider($rider13);
    $team3->addRider($rider23);
    $team3->addMechanic($mechanic13);
    $team3->addMechanic($mechanic23);

    $team4 = $teams[3];
    $rider14 = new Rider(randomName(), randomBirthday(), randomDorsal($dorsals));
    $rider24 = new Rider(randomName(), randomBirthday(), randomDorsal($dorsals));
    $mechanic14 = new Mechanic(randomName(), randomBirthday(), randomSpeciality());
    $mechanic24 = new Mechanic(randomName(), randomBirthday(), randomSpeciality());

    $team4->addRider($rider14);
    $team4->addRider($rider24);
    $team4->addMechanic($mechanic14);
    $team4->addMechanic($mechanic24);

    $gp1 = new GrandPrix($circuits[0], randomBirthday());
    $gp2 = new Grandprix($circuits[1], randomBirthday());
    $gp3 = new Grandprix($circuits[2], randomBirthday());

    $gps = [$gp1, $gp2, $gp3];

    ?>

    <h1>Equipos</h1>
    <ul>
        <?php
        foreach ($teams as $team) {
            echo $team->__toString();
        }
        ?>
    </ul>

    <h1>Carreras</h1>
    <ol>
        <?php
        foreach ($gps as $grandprix) {
            echo $grandprix . '<br>';
            echo $grandprix->results();
        }

        
        ?>
    </ol>
</body>

</html>