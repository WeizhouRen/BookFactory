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

    

    <!-- *** NAVBAR ***
 _________________________________________________________ -->
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

        <div class="login-button">
            <?php
                if (empty($_COOKIE['userid'])) {
                    echo "<a>";
                    echo "<button id=’login-login-button‘ onclick=document.getElementById('login_panel').style.display='block'>Login</button>"; 
                    echo "</a>";
                }else{
                    echo "<a data-toggle='modal' >Welcome:".$userid."</a>";
                    echo "<a href='logout.php'>";
                    echo "<button>Logout</button>"; 
                    echo "</a>";
                }
            ?>               
        </div>
    </div>


    <section class="slidesContainer">
        <div class="slideShow">
            <img class="slide" src="img/homepage_display_1.JPG" >
            <img class="slide" src="img/homepage_display_2.JPG" >
            <img class="slide" src="img/homepage_display_3.JPG" >
            <img class="slide" src="img/homepage_display_4.JPG" >
            <img class="slide" src="img/homepage_display_5.JPG" >
        </div>
        
        <section id="web-info">
            <div class="info">
                <h1>The newest book</h1>
                <p>We have blablablablabla</p>
            </div>
            <div class="info">
                <h1>The newest book</h1>
                <p>We have blablablablabla</p>
            </div>
            <div class="info">
                <h1>The newest book</h1>
                <p>We have blablablablabla</p>
            </div>
        </section>        
    </section>

    <section class="homepage_bottom">
        <div id="new">
            <h2>New Release</h2>
        </div>
        <div class="new_release">

        <?php
            $cluster = Cassandra::cluster()
                ->withContactPoints('172.23.99.176') //cassandra address
                ->withPort(9042)
                ->build();

            $keyspace = 'book'; //keyspace
            $session = $cluster->connect($keyspace);
            $statement = new Cassandra\SimpleStatement (
                "select bookname, price, imageurl 
                from product "
            );
            $future = $session->executeAsync($statement);
            $result = $future->get();
            $index = 0;
            foreach ($result as $row){
                echo "<div class='book'>";
                    echo "<img src='".$row['imageurl']."' alt='This is a book cover'>";
                    echo '<article class="book-info">';
                        echo '<p class="book-name">'.$row['bookname'].'</p >';
                        echo '<p class="book-price">'.$row['price'].'</p >';
                    echo '</article>';
                echo "</div>";
                $index++;
                if ($index == 4) {
                    break;
                }
            }
        ?>
    </section>

    <!-- *** LOGIN ***
_________________________________________________________ -->

    <!-- The Modal -->
    <div id="login_panel" class="modal">
    <span onclick="document.getElementById('login_panel').style.display='none'" 
        class="close" title="Close Modal">&times;</span>

    <!-- Modal Content -->
        <form class="login-content animate" action="login.php" method="post">

            <div class="container">
                <label for="uname"><b>Username</b></label>
                <input type="naminpute" placeholder="Enter Username" name="un" required>

                <label for="psw"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="pw" required>

                <button type="submit">Login</button>

                <div class="last_container">
                <button onclick="document.getElementById('login_panel').style.display='none'" class="cancel_button">Cancel</button>
                <a href="register.php">Register</a>
                </div>
            </div>
        </form>
    </div>
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