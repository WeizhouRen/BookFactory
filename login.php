<?php

    $userid=$_POST['un'];
    $password=$_POST['pw'];
    $cluster = Cassandra::cluster()
        ->withContactPoints('172.23.99.176','172.23.99.218','172.23.99.123') //cassandra address
        ->withPort(9042)
        ->build();

    $keyspace = 'book'; //keyspace
    $session = $cluster->connect($keyspace);
    $statement = new Cassandra\SimpleStatement (
        "SELECT * FROM user WHERE userid=".$userid
    );
    $future = $session->executeAsync($statement);
    $result = $future->get();
    foreach ($result as $row){
        if ($password === $row['password']) {
            setcookie("userid",$userid);
            echo "<script>alert('Login success.')</script>";
            echo "<script>location='index.php'</script>";
        }else{
            echo "<script>alert('Invalid.')</script>";
            echo "<script>location='index.php'</script>";
        }
    }

?>