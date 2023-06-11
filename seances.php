<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.0/css/all.css">

</head>

<body>

<header>
        <nav>
            <div class="logo">
                <img src="./image/sskmovies.png" alt="Logo du site">
            </div>
            <div class="menu">
                <ul>
                    <li><a href="cinema.php">Home</a></li>
                    <li><a href="films.php">Films</a></li>
                    <li><a href="seances.php">Séances</a></li>
                </ul>
                <div class="link">
                    <a href="">
                        <i class="fa-solid fa-lock"></i>
                    </a>
                    <a class="admin" href="Membres.php">
                        <i class="fa-light fa-users"></i>
                    </a>


                </div>
            </div>
        </nav>
    </header>
    <main>
    <div class="search">
    <form method="get" action="">
        <input type="text" name="date" placeholder="Seances" class="main_search">
        <button type="submit" name="valider" value="Rechercher">Valider</button>
    </form>
    </div>
</main>



<?php
require_once("PDO.php");


if (isset($_GET['date'])) {
    $seances = $_GET['date'];
    $requet_seances = "SELECT movie.title AS 'Title', date_begin AS 'Seance' FROM movie JOIN movie_schedule ON movie.id = movie_schedule.id_movie WHERE movie_schedule.date_begin LIKE '%$seances%'";
    $result_seances = $pdo->prepare($requet_seances);
    $result_seances->execute();
    $row_seances = $result_seances->fetchAll();
}
?>
<table>
    <tr>
        <td class="column">Films</td>
        <td class="column">Séances</td>
    </tr>
    <?php
    foreach ($row_seances as $key => $value) {
        echo '<div class ="search_container"';
        echo '<tr>';
        echo '<td>' . $value['Title'];
        echo '<td>' . $value['Seance'];
        echo '<tr>';
        echo '</div>';
    }
    ?>
</table>

</body>

</html>