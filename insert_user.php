<?php

    $userid=$_POST['username'];
    $age=$_POST['age'];
    $gender=$_POST['gender'];
    $first=$_POST['firstname'];
    $last=$_POST['lastname'];
    $occupa=$_POST['occupation'];
    $pass=$_POST['password'];
    $post=(int)$_POST['postcode'];

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
    $value = 0;

    foreach ($result as $row) {
        $value = 1;
        echo "<script>alert('The username is already existing.')</script>";
        echo "<script>location='register.php'</script>";
    }
    if ($value != 1) {
            
        $statement1 = new Cassandra\SimpleStatement (
            "INSERT into user(userid, age, firstname, lastname, gender, occupation, password, zipcode) values ($userid, $age, '".$first."', '".$last."', '".$gender."', '".$occupa."', '".$pass."', $post)"
        );
        $future1 = $session->executeAsync($statement1);
        $result1 = $future1->get();
        setcookie("userid", $userid);
        echo "<script>alert('Login success.')</script>";
        echo "<script>location='index.php'</script>";        
    }   

?>