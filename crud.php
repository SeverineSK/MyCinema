
<?php
require_once("PDO.php");
// require_once("Membres.php"); 

    if (isset($_GET['abonnement'])) {
        $abo = $_GET['abo'];
        $requet_abo = "SELECT id_user AS 'ID', user.firstname, user.lastname, subscription.name AS abonnement FROM user LEFT JOIN membership ON user.id = membership.id_user LEFT JOIN subscription ON subscription.id = membership.id_subscription WHERE firstname LIKE '%$abo%' OR lastname LIKE '%$abo'";
        $result_abo = $pdo->prepare($requet_abo);
        $result_abo->execute();
        $row_abo = $result_abo->fetchAll();
    }
    
    if (isset($_GET['add'])) {
        if (isset($_POST['abo'])) { 
            $abo = $_POST['abo'];
            $subscription = $_POST['subscription'];
        
            // Vérifier si l'utilisateur existe
            $sql = "SELECT * FROM user WHERE firstname LIKE '%$abo%' OR lastname LIKE '%$abo%'";
            $result = $pdo->prepare($sql);
            $result->execute();
            $user = $result->fetch();
        
            if ($user) {
                // Récupérer l'ID de l'utilisateur
                $userId = $user['id'];
        
                // Insérer le nouvel abonnement dans la table membership
                $insertSql = "INSERT INTO membership (id_user, id_subscription) VALUES (:userId, :subscriptionId)";
                $insertResult = $pdo->prepare($insertSql);
                $insertResult->bindParam(':userId', $userId);
                $insertResult->bindParam(':subscriptionId', $subscription);
                $insertResult->execute();
        
                // Rediriger vers la page de succès ou afficher un message de succès
                header("Location: membres.php?success=1");
                exit();
            } else {
                // L'utilisateur n'a pas été trouvé
                echo "Utilisateur non trouvé.";
            }
        }
        
    }
    
    if (isset($_GET['update'])) {
        $abo = $_GET["abo"];
        $id = $_GET['update'];
        $subscription = $_GET['subscription'];
    
        // Vérifier si l'utilisateur existe
        $sql = "SELECT * FROM user WHERE firstname LIKE '%$abo%' OR lastname LIKE '%$abo%'";
        $result = $pdo->prepare($sql);
        $result->execute();
        $user = $result->fetch();
    
    
            // Mettre à jour l'abonnement dans la table membership
            $updateSql = "UPDATE membership SET id_subscription = :subscriptionId WHERE id_user = :userId";
            $updateResult = $pdo->prepare($updateSql);
            $updateResult->bindParam(':subscriptionId', $subscription);
            $updateResult->bindParam(':userId', $id);
            $updateResult->execute();
    
            // Rediriger vers la page de succès ou afficher un message de succès
        //     header("Location: membres.php?success=1");
        //     exit();
        // } else {
        //     // L'utilisateur n'a pas été trouvé
        //     echo "Utilisateur non trouvé.";
    
    }
    

    // if (isset($_GET['delete'])) {
    //     $membershipId = $_GET['delete'];
    
    //     // Supprimer l'abonnement de la table membership
    //     $deleteSql = "DELETE FROM membership WHERE id = :membershipId";
    //     $deleteResult = $pdo->prepare($deleteSql);
    //     $deleteResult->bindParam(':membershipId', $membershipId);
    //     $deleteResult->execute();
    
    //     // Rediriger vers la page de succès ou afficher un message de succès
    //     header("Location: membres.php?success=1");
    //     exit();
    // }
    ?>

