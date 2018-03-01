<?php
    if(empty($_POST['avatarurl']))
    {
        header('Location:MyAccount2.php#settings');
        exit();
    }

    $servername = "us-cdbr-azure-central-a.cloudapp.net";
    $username = 'bdb22a73230b85';
    $password = '864466e8';
    $dbname = 'agiledb';

    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }
    try
    {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "UPDATE members
                SET Member_Image_Pathway=:NewURL
                WHERE email=:UserEmail";
        $stmt = $conn->prepare($sql);
        $sql->bindValue(':NewUrl',$_post['txtavatarurl']);
        $sql->bindValue(':UserEmail',$_SESSION['email_of_user']);
        $stmt->execute();

        // echo a message to say the UPDATE succeeded
        echo $stmt->rowCount() . " records UPDATED successfully";
    }
    catch(PDOException $e)
    {
        echo $sql . "<br>" . $e->getMessage();
    }

    $conn = null;
?>