<?php
    //enable php debug
    error_reporting(-1);
    ini_set('display_errors','On');
session_start();

if (!empty($_COOKIE['userid'])) {
     $userid = $_COOKIE['userid'];
}
?>
<html lang="en">

<head>

    <meta charset="utf-8">

    <title>
        Book Factory
    </title>

    <!-- style -->
	<link href="style.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Rajdhani" rel="stylesheet">

</head>

<body>

    

    <!-- *** NAVBAR ***-->
 	<div class="bar">
		 <h4>Student Discount! 25% OFF! Click here for more info  >></h4>
		 <button>Get CODE</button>
	</div>
    <div class="navigation">
        <div class="bar_components">
        <a href="index.php"><img id="logo" src="img/logo.png" alt="The logo of Book Factory"></a >
            <div>
                <a class="nav-component" href="index.php">Homepage</a >
                <a class="nav-component" href="booklist.php">Books</a >
            </div>
        </div>

    </div>

    <section id="all">
        <nav id="sub-nav">
	        <ul class="breadcrumb">
                <li id="home"><a href="index.php">Home</a></li>
                <li id="booklist"><a href="booklist.php"> Book List</a></li>
                <li id="booklist" id="check-out-bread"><a href="#"> Check Out</a></li>
	        </ul>
        </nav>
        
        <section id="content">
        <?php
            $cluster = Cassandra::cluster()
                ->withContactPoints('172.23.99.176','172.23.99.218','172.23.99.123') //cassandra address
                ->withPort(9042)
                ->build();

            $keyspace = 'book'; //keyspace
            $session = $cluster->connect($keyspace);

            $idNoprocess = $_SERVER["QUERY_STRING"]."<br>";
            $item = explode('=', $idNoprocess);
            $id = (int)$item[1];
            $statement = new Cassandra\SimpleStatement (
                "SELECT * FROM product WHERE bookid=".$id
            );
            $future = $session->executeAsync($statement);
            $result = $future->get();
            foreach ($result as $row){
                echo '<article id="order-review">';
                echo "<h1>Order Review</h1>";

                echo '<table id="order-review-info" >';
                    echo '<tr>';
                        echo '<th>Book</th>';
                        echo '<th>Name</th>'; 
                        echo '<th>Discount</th>';
                        echo '<th>Total</th>';
                    echo '</tr>';
                    echo '<tr>';
                        echo '<td>';
                            echo '<img class="check-img" src="'.$row['imageurl'].'" >';
                        echo '</td>';
                        echo '<td><p>'.$row['bookname'].'</p></td>';
                        echo '<td><p>$0.00</p></td>';
                        echo '<td><p>$'.$row['price'].'</p></td>';
                    echo '</tr>';
                echo '</table>';

                echo '<div id="review-buttons">';
                    echo '<button id="back-button">BACK TO BOOK LIST</button>';
                    echo '<a href="insert_order.php?id='.$row['bookid'].'">';
                        echo '<button id="confirm-button">Confirm Order</button>';
                    echo '</a>';
                echo '</div>';
            echo '</article>';

            echo '<article id="order-summary">';
                echo '<div id="order-summary-title">';
                    echo '<h1>Order Summary</h1>';
                echo '</div>';
                echo '<div id="order-summary-info">';
                    echo '<p>Costs are calculated based on the books you have entered.</p>';
                    echo '<hr>';
                    echo '<div class="summary-info">';
                        echo '<p id="summary-info-total">Order Total: </p>';
                        echo '<p class="summary-data">$'.$row['price'].'</p>';
                    echo '</div>';
                    
                    echo '<hr>';
                    echo '<div class="summary-info">';
                        echo '<p id="summary-info-ship">Shipping Fee: </p>';
                        echo '<p class="summary-data">$10</p>';
                    echo '</div>';
                    
                    echo '<hr>';
                    echo '<div class="summary-info">';
                        echo '<p id="summary-info-GST">GST 10%:</p>';
                        $price = $row['price']*0.1;
                        echo '<p class="summary-data">$'.$price.'</p>';
                    echo '</div>';
                    
                    echo '<hr>';
                    echo '<div class="summary-info">';
                        echo '<p id="summary-TOTAL">TOTAL</p>';
                        $total = $row['price']+$price + 10;
                        echo '<p id="total-price" class="summary-data">$'.$total.'</p>';
                    echo '</div>';
                    
                echo '</div>';
                
            echo '</article>';
            echo '</section>';
            echo '</section>';
            }
        ?>    
    

	<!-- *** FOOTER ***-->
	<footer id="footer">
        <div class="footer-container">
            <div class="columns">
                <div class="footer-info">
                    <h4>Information</h4>
                    <ul>
                        <li>
                            <a>About us</a>
                        </li>
                        <li>
                            <a>Terms and conditions</a>
                        </li>
                        <li>
                            <a>FAQ</a>
                        </li>
                        <li>
                            <a>Contact us</a>
                        </li>
                    </ul>
                    <hr>
                    <h4>User section</h4>
                    <ul>
                        <li>
                            <a>Login</a>
                        </li>
                        <li>
                            <a>Regiter</a>
                        </li>
                    </ul>
    
                    <hr>
    
                </div>
    
                <div class="footer-info">
    
                    <h4>Top categories</h4>
    
                    <h5>Genre</h5>
    
                    <ul>
                        <li>
                            <a>Horror</a>
                        </li>
                        <li>
                            <a>Romance</a>
                        </li>
                        <li>
                            <a>Science-Fiction</a>
                        </li>
                        <li>
                            <a>Fantasy</a>
                        </li>
                    </ul>
    
                    <h5>Author</h5>
                    <ul>
                        <li>
                            <a>J.K Rowling</a>
                        </li>
                        <li>
                            <a>Suzzane Collins</a>
                        </li>
                        <li>
                            <a>Stephen King</a>
                        </li>
                        <li>
                            <a>J. R. R. Tolkien</a>
                        </li>
                    </ul>
    
                    <hr>
    
                </div>
    
                <div class="footer-info">
    
                    <h4>Where to find us</h4>
                    <ul>
                        <li>
                            <p><strong>INFS3208 Group16.</strong>
                        </li>
                        <li>
                            <p>St.Lucia</p>
                        </li>
                        <li>
                            <p>Brisbane</p>
                        </li>
                        <li>
                            <p>Queensland 4066</p>
                        </li>
                        <li>
                            <p>Australia</p>
                        </li>
                    </ul>
                    <hr>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer end -->

	<!-- *** COPYRIGHT ***-->
 	<div id="copyright">
		<div class="copy-right-container">
			<div>
				<p>© 2018 INFS3208 Group 16.</p>
			</div>
		</div>
	</div>
	<!-- *** COPYRIGHT END *** -->

	<!-- *** SCRIPTS TO INCLUDE ***-->
	
	<script src="js/jquery-1.11.0.min.js"></script>
	<script src="js/javascript.js"></script>
 
</body>

</html>