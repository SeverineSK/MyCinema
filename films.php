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
            <input id="films" type="text" name="recherche" placeholder="Trouvez votre film" class="main_search">
            <select id="filtre" name="filtre">
                <option value=""></option>
                <option value="action">Action</option>
                <option value="animation">Animation</option>
                <option value="adventure">Adventure</option>
                <option value="drama">Drama</option>
                <option value="comedy">Comedy</option>
                <option value="mystery">Mystery</option>
                <option value="biography">Biography</option>
                <option value="crime">Crime</option>
                <option value="fantasy">Fantasy</option>
                <option value="horror">Horror</option>
                <option value="sci-fi">Sci-Fi</option>
                <option value="romance">Romance</option>
                <option value="family">Family</option>
                <option value="triller">Triller</option>
            </select>
            <input id="prod" type="text" name="production" placeholder="Producteur" class="main_search">
            <button type="submit" name="valider" value="Rechercher">Rechercher</button>
        </form>
    </div>
</main>

<?php
require_once("PDO.php");

// Variables de recherche
$films = isset($_GET['recherche']) ? $_GET['recherche'] : '';
$genre = isset($_GET['filtre']) ? $_GET['filtre'] : '';
$production = isset($_GET['production']) ? $_GET['production'] : '';

// Requête principale
$requete = "SELECT movie.title AS 'Films', genre.name AS 'Genre', distributor.name AS 'Production'
            FROM movie
            LEFT JOIN movie_genre ON movie.id = movie_genre.id_movie
            LEFT JOIN genre ON genre.id = movie_genre.id_genre
            LEFT JOIN distributor ON movie.id_distributor = distributor.id
            WHERE 1=1";

// Ajout des conditions pour les critères de recherche
if (!empty($films) && !empty($genre) && !empty($production)) {
    $requete .= " AND movie.title LIKE '$films%' AND genre.name = '$genre' AND distributor.name LIKE '%$production%'";
} elseif (!empty($films) && !empty($genre)) {
    $requete .= " AND movie.title LIKE '$films%' AND genre.name = '$genre'";
} elseif (!empty($films) && !empty($production)) {
    $requete .= " AND movie.title LIKE '$films%' AND distributor.name LIKE '%$production%'";
} elseif (!empty($genre) && !empty($production)) {
    $requete .= " AND genre.name = '$genre' AND distributor.name LIKE '%$production%'";
} elseif (!empty($films)) {
    $requete .= " AND movie.title LIKE '$films%'";
} elseif (!empty($genre)) {
    $requete .= " AND genre.name = '$genre'";
} elseif (!empty($production)) {
    $requete .= " AND distributor.name LIKE '%$production%'";
}

// Exécution de la requête
$resultat = $pdo->prepare($requete);
$resultat->execute();
$rows = $resultat->fetchAll();
?>

<table>
    <tr>
        <td class="column">Films</td>
        <td class="column">Genre</td>
        <td class="column">Production</td>
    </tr>
    <?php
    foreach ($rows as $row) {
        echo '<div class ="search_container"';
        echo '<tr>';
        echo '<td>' . $row['Films'] . '</td>';
        echo '<td>' . $row['Genre'] . '</td>';
        echo '<td>' . $row['Production'] . '</td>';
        echo '<tr>';
        echo '</div>';
    }
    ?>
</table>


</body>

</html>