<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
    <?php
    session_start();
    require_once('includes/header.inc.php');
    require_once('includes/dbconnection.inc.php');

    if ($_SESSION['rol'] != 'admin') {
        header('Location: /');
        exit;
    }

    $connection = getDBConnection();

    $getUsers = $connection->query('SELECT user, email, rol FROM users');
    $users = $getUsers->fetchAll(PDO::FETCH_ASSOC);

    echo '<br><br><table>';
    echo '<tr><th>'.$message['backendUsername'].'</th><th>'.$message['backendEmail'].'</th><th>'.$message['backendRole'].'</th></tr>';
    foreach ($users as $user) {
        if ($user['user'] != $_SESSION['username']) {
            echo '<tr>';
            echo '<td>' . $user['user'] . '</td>';
            echo '<td>' . $user['email'] . '</td>';
            echo '<td>' . $user['rol'] . '</td>';
            echo '</tr>';
        }
    }
    echo '</table>';
    ?>
</body>

</html>