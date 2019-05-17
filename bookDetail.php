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

    <div id="login_panel" class="modal">
    <span onclick="document.getElementById('login_panel').style.display='none'" 
        class="close" title="Close Modal">&times;</span>

    <!-- Modal Content -->
        <form class="login-content animate" action="login.php" method="post">

            <div class="container">
                <label for="uname"><b>Username</b></label>
                <input type="name" placeholder="Enter Username" name="un" required>

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

    <section id="all">
        <nav id="sub-nav">
            <ul class="breadcrumb">
                <li id="home"><a href="index.php">Home</a></li>
                <li id="booklist"><a href="booklist.php"> Book List</a></li>
                <li id="bookname-nav">Book Name</li>
            </ul>
        </nav>

        <section id="content">
            <nav id="filter">
                <!-- *** Genre ***-->
                <section class="filter-menu">
                    <article class="panel-heading">
                        <h3 class="panel-title">Genre</h3>
                    </article>
                    <article class="body">
                        <ul class="category"> 
                            <li class="active">

                                <div class="menu-all">
                                    <a>All</a>
                                </div>
                                
                                <ul>
                                    <li>
                                        <a>Science Fiction</a>
                                    </li>
                                    <li>
                                        <a>Horror</a>
                                    </li>
                                    <li>
                                        <a>Fantasy</a>
                                    </li>
                                    <li>
                                        <a>Romance</a>
                                    </li>
                                    <li>
                                        <a>Narrative</a>
                                    </li>
                                    <li>
                                        <a>Adventure</a>
                                    </li>
                                    <li>
                                        <a>Action</a>
                                    </li>

                                </ul>
                            </li>
                        </ul>
                    </article>
                </section>

             <section class="filter-menu">
                 <article class="panel-heading">
                     <h3 class="panel-title">Author</h3>
                 </article>
                 <article class="body">
                     <ul class="category"> 
                        <li class="active">
                        <div class="menu-all">
                            <a>All</a >
                        </div>
                             <ul>
                                 <li>
                                  <a>Suzzane Collins</a >
                                 </li>
                                 <li>
                                  <a>J. K. Rowling</a >
                                 </li>
                                 <li>
                                  <a>Stephen King</a >
                                 </li>
                                 <li>
                                  <a>J. R. R. Tolkien</a >
                                 </li>

                             </ul>
                         </li>
                     </ul>
                 </article>
             </section>
            </nav>



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
                    echo '<section class="product_page">';
                        echo '<div class="img-and-price">';                       
                                echo '<img src="'.$row['imageurl'].'">';
                                echo '<div class="product_information">';
                                    echo '<h1 class="book-name-detail">'.$row['bookname'].'</h1>';
                                    echo '<h4 class="author-detail" >'.$row['author'].'</h4>';
                                    echo '<h3 class="price-detail">$'.$row['price'].'</h3>';
                                    echo '<a href="cart.php?id='.$row['bookid'].'">';
                                        echo '<button>Add to bag</button>';
                                    echo '</a>';
                                echo '</div>';
                        echo '</div>';
                        echo '<section class="product_detail">';
                          echo  '<div class="detail">';
                                echo '<h3>Book detail</h3>';
                                echo '<p class="synopsis-info">'.$row['synopsis'].'</p>';            
                           echo '</div>';
                            echo '<div class="other_info">';
                                echo '<div id="publish-date-info">';
                                    echo '<p>Publication date: </p>';
                                    echo '<p class="publish-date">'.$row['publishdate'].'</p>';
                                echo '</div>';
                                echo '<div id="genre-info">';
                                    echo '<p>Genre:</p>';
                                    echo '<p class="genre">'.$row['genre'].'</p>';
                                echo '</div>';
                                echo '<div id="ISBN-info">';
                                    echo '<p>ISBN: </p>';
                                    echo '<p class="ISBN">'.$row['bookid'].'</p>';
                                echo '</div>';
                            echo '</div>';
                        echo '</section>';
                    echo '</section>';
                    }
                ?>
        </section>   
        <!-- content ended -->
    </section>
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
    
    
    <div id="copyright">
        <div class="copy-right-container">
            <div>
                <p>© 2018 INFS3208 Group 16.</p>
            </div>
        </div>
    </div>
    <!--  COPYRIGHT END  -->

    <!-- *** SCRIPTS TO INCLUDE ***-->
	<script src="js/jquery-1.11.0.min.js"></script>
	<script src="js/javascript.js"></script>
</body>
</html>