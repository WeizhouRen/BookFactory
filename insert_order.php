<?php

$cluster = Cassandra::cluster()
    ->withContactPoints('172.23.99.176','172.23.99.218','172.23.99.123') //cassandra address
    ->withPort(9042)
    ->build();

$keyspace = 'book'; //keyspace
$session = $cluster->connect($keyspace);

$idNoprocess = $_SERVER["QUERY_STRING"]."<br>";
$item = explode('=', $idNoprocess);
$bookid = (int)$item[1];
session_start();
$userid=$_COOKIE['userid'];
if (empty($_COOKIE['userid'])) {
    echo "<script>alert('Please login.')</script>";
    echo "<script>location='index.php'</script>";     
}
$date=date('Y-m-d');
$rating=rand(0,5);
$orderid=rand(1029,5009);


$statement = new Cassandra\SimpleStatement (
    "INSERT into orders(orderid,userid,bookid,orderdate,rating) values ($orderid, $userid, $bookid, '".$date."', $rating)"
);
    $future = $session->executeAsync($statement);
    $result = $future->get();
    echo "<script>alert('Add to order success.')</script>";
    echo "<script>location='index.php'</script>";
?>
