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
        <input type="text" name="abo" placeholder="Membres" class="main_search">
        <form name="valider" method="get" action="">
            <button type="submit" name="valider" value="Rechercher">Valider</button>
        </form>
</div>
</main>

</body>

</html>


<?php
require_once("PDO.php");
require("./crud.php");

if (isset($_GET['abo'])) {
    $abo = $_GET['abo'];
    $requet_abo = "SELECT id_user AS 'ID', user.firstname, user.lastname, subscription.name, subscription.id 
    AS abonnement FROM user 
    LEFT JOIN membership ON user.id = membership.id_user 
    LEFT JOIN subscription ON subscription.id = membership.id_subscription 
    WHERE firstname LIKE '%$abo%' OR lastname LIKE '%$abo'";
    $result_abo = $pdo->prepare($requet_abo);
    $result_abo->execute();
    $row_abo = $result_abo->fetchAll();

    $membership = $pdo->prepare("select subscription.id, subscription.name from subscription");
    $membership->execute(); 
    $membershipList = $membership->fetchAll();
}
?>
 <table>
    <tr>
        <td class="column">ID</td>
        <td class="column">Prénom</td>
        <td class="column">Nom</td>
        <td class="column">Selection</td>
        <td class="column">Ajouter</td>
        <td class="column">Modifier</td>
        <td class="column">Supprimer</td>
    </tr>
    <?php
    foreach ($row_abo as $key => $value) {
    ?>
        <tr>
            <td><?= $value['ID'] ?></td>
            <td><?= $value['firstname'] ?></td>
            <td><?= $value['lastname'] ?></td>
            <form method="GET" action="crud.php">
                <td>
                    <select id="filtre" name="subscription">
                        <option>Modifier</option>    
                        <?php foreach($membershipList as $list):?> 
                        <option value="<?php $list["id"];?>"><?php echo $list["name"];?></option>
                        <?php endforeach ?>
                    </select>
                </td>
                
                <td><button type="submit" value = "<?$value['id_user'] ?>" name="add"> <img class="btn" width='30' height='30' src="./image/ajouter.png" alt=""></a></td>
                <td><button type="submit" value = "<?$value['id_user'] ?>" name="update"> <img class="btn" width='30' height='30' src="./image/modifier.png" alt=""></a></td>
                <td><button type="submit" value = "<?$value['id_user'] ?>" name="delete"> <img class="btn" width='30' height='30' src="./image/supprimer.png" alt=""></a></td>
            </form>
        </tr>
<?php
    }
?>
 </table>

