<?php

if(isset($_GET['name']) && ($_GET['genre'])){
    $films = $_GET["recherche"];
    $sql = "SELECT * FROM movie WHERE title LIKE '%$films%';";
    $result = $pdo->prepare($sql);
    $result->execute([$films]);
}
elseif(isset($_GET['name'])){
    $films = $_GET["recherche"];
    $sql = "SELECT * FROM movie WHERE title LIKE '%$films%';";
    $result = $pdo->prepare($sql);
    $result->execute([$films]);
}
elseif (isset($_GET['genre'])){
    $genre = $_GET["filtre"];
    $sql2 = "SELECT movie.title, genre.name FROM movie JOIN movie_genre ON movie.id = movie_genre.id_movie JOIN genre ON genre.id = movie_genre.id_genre;";
    $result = $pdo->prepare($sql);
    $result->execute([$genre]);
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form name="search" method="get" action="">
        <input type="text" name="recherche" placeholder="Touvez votre film">
        <input type="submit" name="valider" value="Rechercher" /><br>
    </form>
    <form name="valider" method="get" action="">
    <label for="filtre">Filtre</label>
  <select id="filtre" name="filtre">
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
  <input type="submit" name="appliquer" value="Valider" />
</form>

    <?php while($row = $result->fetch(PDO::FETCH_ASSOC)):?>

        <p><?php  echo htmlspecialchars($row['id']); ?></p>
        <p><?php  echo htmlspecialchars($row['title']); ?></p>
        <p><?php  echo htmlspecialchars($row['genre']); ?></p>

    <?php endwhile; ?>

    <?php if ($afficher == 'oui') { ?>
        <div id="resultats">
            <div id="nombres"><?= count($tab) . " " . (count($tab) > 1 ? "resultats trouvés" : "resultat trouvé") ?></div>
            <ol>
                <?php for ($i = 0; $i < count($tab); $i++) { ?>
                    <li><?php echo $tab[$i]["title"] ?></li>
                <?php } ?>
            </ol>
        </div>
    <?php } ?>
</body>



</html>

<?php

//  if (isset($_GET['add'])) {
//     $insert = $_GET['add'];
//     $insert_add = $_GET['add'];
//     $requet_insert = "INSERT INTO membership (id_subscription, id_user) VALUES (:id_subscription, :id_user)";
//     $result_insert = $pdo->prepare($requet_insert);
//     $result_insert->execute();
//     $row_insert = $result_insert->fetchAll();

//     foreach ($row_abo as $key => $value) {
//         echo $value['id_subscription'];
//     }
   
// } 



// if (isset($_GET['subscription'])) {
//     $insert = $_GET['subscription'];
//     // $insert_u = $_GET['ID'];
//     $requet_insert = "INSERT INTO membership (id_subscription, id_user) VALUES ($insert)";
//     $result_insert = $pdo->prepare($requet_insert);
//     $result_insert->execute();
//     $row_insert = $result_insert->fetchAll();

//     foreach ($row_abo as $key => $value) {
//         echo $value['id_subscription'];
//     }
// } -->





// $requet_add = "INSERT INTO membership (subscription)
// // VALUES ('ajouter')";

// "INSERT INTO users (username, email, password) VALUES (?, ?, ?)");

// <!-- <form method="get" action="">
// <input type="text" name="user" placeholder="Prénom ou Nom">
//     <form name="valider" method="get" action="">
//         <input type="submit" name="valider" value="Rechercher"/>
// </form> -->


// <?php
// require_once("PDO.php");

// if (isset($_GET['user'])) {
//     $user = $_GET['user'];
//     $sql3 = "SELECT firstname, lastname FROM user WHERE firstname LIKE '%$user%' OR lastname LIKE '%$user%'";
//     $result3 = $pdo->prepare($sql3);
//     $result3->execute();
//     $row3 = $result3->fetchAll();

//     foreach ($row3 as $key => $value) {
//         echo $value['firstname']. " " . $value['lastname'] . "<br>" ;
//     }
// }


    // if (isset($_GET['add'])) {
    //     $add_id = $_GET['abonnement'];
    //     $add_ab = $_GET['ID'];

    //     $requet_add = "INSERT INTO membership (id_subscription, id_user) VALUES (:ID, :firstname, :lastname, :abonnement)";
    //     $result_add = $pdo->prepare($requet_add);
    //     $result_add->execute();
    //     $row_add = $result_add->fetchAll();

    //     foreach ($row_add as $key => $value) {
    //         echo $value['id_subscription'];
    //     }
    // }
