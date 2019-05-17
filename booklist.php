<?php
    //enable php debug
    error_reporting(-1);
    ini_set('display_errors','On');
session_start();

if (!empty($_COOKIE['userid'])) {
     $userid = $_COOKIE['userid'];
}
?>
<html lang='en'>

<head>
  	<title>Book Factory - Book List</title>
	<meta charset="utf-8">
	<link href="style.css" rel="stylesheet">
</head>

<body>
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
	
<!-- 	<div class="navigation">
		<a href="index.php"><img id="logo" src="img/logo.png" alt="The logo of Book Factory"></a>
		<div class="bar_components">
		<a href="index.php">Homepage</a>
		<a href="booklist.php">Books</a>
		</div>
	</div> -->
    <!-- The Modal -->
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
	                            	<?php
	                            	
		                                echo '<li>';
		                                	echo '<a>Science Fiction</a>';
		                                echo '</li>';
		                                echo '<li>';
		                                	echo '<a>Horror</a>';
		                                echo '</li>';
		                                echo '<li>';
		                                	echo '<a>Fantasy</a>';
		                                echo '</li>';
		                                echo '<li>';
		                                	echo '<a>Romance</a>';
		                                echo '</li>';
		                                echo '<li>';
		                                	echo '<a>Narrative</a>';
		                                echo '</li>';
		                                echo '<li>';
		                                	echo '<a href="bookgenrelist.php?genre=adventure">Adventure</a>';
		                                echo '</li>';
		                                echo '<li>';
		                                	echo '<a>Action</a>';
		                                echo '</li>';
	                                ?>

	                            </ul>
	                        </li>
	                    </ul>
	                </article>
	            </section>
<!-- *** Author ***-->
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

	            <!-- *** Author ***-->
<!-- 	            <div class="filter-menu">

	                <div class="panel-heading">
	                    <h3 class="panel-title">Author</h3>
	                </div>

	                <div class="panel-body">
	                    <form>
	                        <div class="form-group">
	                            <div class="checkbox" >
	                                <label>
	                                    <input type="checkbox" name="test" value="Suzzane Collins">Suzzane Collins
	                                </label>
	                            </div>
	                            <div class="checkbox" >
	                                <label>
	                                    <input type="checkbox" name="test" value="J. K. Rowling">J. K. Rowling
	                                </label>
	                            </div>
	                            <div class="checkbox" >
	                                <label>
	                                    <input type="checkbox" name="test" value="Stephen King">Stephen King
	                                </label>
	                            </div>
	                            <div class="checkbox" >
	                                <label>
	                                    <input type="checkbox" name="test" value="J. R. R. Tolkien">J. R. R. Tolkien
	                                </label>
	                            </div>
	                        </div>

							<button id="apply" class="btn btn-default btn-sm btn-primary" onclick="producttype = showproduct(x, producttype, 1) ;" ><i class="fa fa-pencil" ></i> Apply</button>

	                    </form>

	                </div>
	            </div> -->

	        </nav>
			<!-- filter ended -->


			<div class="list-page">
			<?php
				$cluster = Cassandra::cluster()
					->withContactPoints('172.23.99.176','172.23.99.218','172.23.99.123') //cassandra address
					->withPort(9042)
					->build();

				$keyspace = 'book'; //keyspace
				$session = $cluster->connect($keyspace);
				$statement = new Cassandra\SimpleStatement (
					"SELECT * FROM product"
				);
				$future = $session->executeAsync($statement);
                $result = $future->get();
	
		
				echo '<section class="list-table" id="page-1">';
				echo '<section class="row">';
				
				$index=1;
				foreach ($result as $row){
					if ($index>=1 && $index<=3) {
						echo '<div class="book">';
						echo '<img class="book-cover-img" src="'.$row['imageurl'].'" alt="This is a book cover" width="240px" height="370px">';
						echo '<article class="book-info">';
							echo '<a class="book-name" href="bookDetail.php?id='.$row['bookid'].'">'.$row['bookname'].'</a>';
							echo '<p class="book-price">$'.$row['price'].'</p>';
						echo '</article>';
						echo '</div>';
						
					}
					$index++;
				}
				echo '</section>';
				echo '<section class="row">';
				$index=1;
				foreach  ($result as $row){
					if ($index>=4 && $index<=6) {
						echo '<div class="book">';
						echo '<img class="book-cover-img" src="'.$row['imageurl'].'" alt="This is a book cover" width="240px" height="370px">';
						echo '<article class="book-info">';
							echo '<a class="book-name" href="bookDetail.php?id='.$row['bookid'].'">'.$row['bookname'].'</a>';
							echo '<p class="book-price">$'.$row['price'].'</p>';
						echo '</article>';
						echo '</div>';
						
					}
					$index++;
				}
				echo '</section>';
				echo '</section>';
				// ------------------------page 2----------------------------
				echo '<section class="list-table" id="page-2">';
				echo '<section class="row">';
				$index=1;
				foreach ($result as $row){
					if ($index>=7 && $index<=9) {
						echo '<div class="book">';
						echo '<img class="book-cover-img" src="'.$row['imageurl'].'" alt="This is a book cover" width="240px" height="370px">';
						echo '<article class="book-info">';
							echo '<a class="book-name" href="bookDetail.php?id='.$row['bookid'].'">'.$row['bookname'].'</a>';
							echo '<p class="book-price">$'.$row['price'].'</p>';
						echo '</article>';
						echo '</div>';
					}
					$index++;
				}
				echo '</section>';
				echo '<section class="row">';
				$index=1;
				foreach  ($result as $row){
					if ($index>=10 && $index<=12) {
						echo '<div class="book">';
						echo '<img class="book-cover-img" src="'.$row['imageurl'].'" alt="This is a book cover" width="240px" height="370px">';
						echo '<article class="book-info">';
							echo '<a class="book-name" href="bookDetail.php?id='.$row['bookid'].'">'.$row['bookname'].'</a>';
							echo '<p class="book-price">$'.$row['price'].'</p>';
						echo '</article>';
						echo '</div>';
					}
					$index++;
				}
				echo '</section>';
				echo '</section>';

				// ------------------------page 3----------------------------
				echo '<section class="list-table" id="page-3">';
				echo '<section class="row">';
				$index=1;
				foreach ($result as $row){
					if ($index>=13 && $index<=15) {
						echo '<div class="book">';
						echo '<img class="book-cover-img" src="'.$row['imageurl'].'" alt="This is a book cover" width="240px" height="370px">';
						echo '<article class="book-info">';
							echo '<a class="book-name" href="bookDetail.php?id='.$row['bookid'].'">'.$row['bookname'].'</a>';
							echo '<p class="book-price">$'.$row['price'].'</p>';
						echo '</article>';
						echo '</div>';
					}
					$index++;
				}
				echo '</section>';
				echo '<section class="row">';
				$index=1;
				foreach  ($result as $row){
					if ($index>=16 && $index<=18) {
						echo '<div class="book">';
						echo '<img class="book-cover-img" src="'.$row['imageurl'].'" alt="This is a book cover" width="240px" height="370px">';
						echo '<article class="book-info">';
							echo '<a class="book-name" href="bookDetail.php?id='.$row['bookid'].'">'.$row['bookname'].'</a>';
							echo '<p class="book-price">$'.$row['price'].'</p>';
						echo '</article>';
						echo '</div>';
					}
					$index++;
				}
				echo '</section>';
				echo '</section>';
		
				// ------------------------page 4----------------------------
				echo '<section class="list-table" id="page-4">';
				echo '<section class="row">';
				$index=1;
				foreach ($result as $row){
					if ($index>=19 && $index<=21) {
						echo '<div class="book">';
						echo '<img class="book-cover-img" src="'.$row['imageurl'].'" alt="This is a book cover" width="240px" height="370px">';
						echo '<article class="book-info">';
							echo '<a class="book-name" href="bookDetail.php?id='.$row['bookid'].'">'.$row['bookname'].'</a>';
							echo '<p class="book-price">$'.$row['price'].'</p>';
						echo '</article>';
						echo '</div>';
					}
					$index++;
				}
				echo '</section>';
				echo '<section class="row">';
				$index=1;
				foreach  ($result as $row){
					if ($index>=22 && $index<=24) {
						echo '<div class="book">';
						echo '<img class="book-cover-img" src="'.$row['imageurl'].'" alt="This is a book cover" width="240px" height="370px">';
						echo '<article class="book-info">';
							echo '<a class="book-name" href="bookDetail.php?id='.$row['bookid'].'">'.$row['bookname'].'</a>';
							echo '<p class="book-price">$'.$row['price'].'</p>';
						echo '</article>';
						echo '</div>';
					}
					$index++;
				}
				echo '</section>';
				echo '</section>';

				// ------------------------page 5----------------------------
				echo '<section class="list-table" id="page-5">';
				echo '<section class="row">';
				$index=1;
				foreach ($result as $row){
					if ($index>=25 && $index<=27) {
						echo '<div class="book">';
						echo '<img class="book-cover-img" src="'.$row['imageurl'].'" alt="This is a book cover" width="240px" height="370px">';
						echo '<article class="book-info">';
							echo '<a class="book-name" href="bookDetail.php?id='.$row['bookid'].'">'.$row['bookname'].'</a>';
							echo '<p class="book-price">$'.$row['price'].'</p>';
						echo '</article>';
						echo '</div>';
					}
					$index++;
				}
				echo '</section>';
				echo '<section class="row">';
				$index=1;
				foreach  ($result as $row){
					if ($index>=28 && $index<=30) {
						echo '<div class="book">';
						echo '<img class="book-cover-img" src="'.$row['imageurl'].'" alt="This is a book cover" width="240px" height="370px">';
						echo '<article class="book-info">';
							echo '<a class="book-name" href="bookDetail.php?id='.$row['bookid'].'">'.$row['bookname'].'</a>';
							echo '<p class="book-price">$'.$row['price'].'</p>';
						echo '</article>';
						echo '</div>';
						
					}
					$index++;
				}
				echo '</section>';
				echo '</section>';
				
			?>
				<!-- <section class="list-table" id="page-1">

					<section class="row">
						<div class="book">
							<img class="book-cover-img" src="img/Horror/1.jpg" alt="This is a book cover" width="240px" height="370px">
							<article class="book-info">
								<p class="book-name">Book Name</p>
								<p class="book-price">Price</p>
							</article>
						</div>
						<div class="book">
							<img class="book-cover-img" src="img/Horror/2.jpg" alt="This is a book cover" width="240px" height="370px">
							<article class="book-info">
								<p class="book-name">Book Name</p>
								<p class="book-price">Price</p>
							</article>
						</div>
						<div class="book">
							<img class="book-cover-img" src="img/Horror/3.jpg" alt="This is a book cover" width="240px" height="370px">
							<article class="book-info">
								<p class="book-name">Book Name</p>
								<p class="book-price">Price</p>
							</article>
						</div>
					</section>


					<section class="row">
						<div class="book">
							<img class="book-cover-img" src="img/Horror/4.jpg" alt="This is a book cover" width="240px" height="370px">
							<article class="book-info">
								<p class="book-name">Book Name</p>
								<p class="book-price">Price</p>
							</article>
						</div>
						<div class="book">
							<img class="book-cover-img" src="img/Horror/5.jpg" alt="This is a book cover" width="240px" height="370px">
							<article class="book-info">
								<p class="book-name">Book Name</p>
								<p class="book-price">Price</p>
							</article>
						</div>
						<div class="book">
							<img class="book-cover-img" src="img/Adventure/5.jpg" alt="This is a book cover" width="240px" height="370px">
							<article class="book-info">
								<p class="book-name">Book Name</p>
								<p class="book-price">Price</p>
							</article>
						</div>
					</section>
				</section>


				<section class="list-table" id="page-2">

					<section class="row">
						<div class="book">
							<img class="book-cover-img" src="img/Romance/1.jpg" alt="This is a book cover" width="240px" height="370px">
							<article class="book-info">
								<p class="book-name">Book Name</p>
								<p class="book-price">Price</p>
							</article>
						</div>
						<div class="book">
							<img class="book-cover-img" src="img/Romance/1.jpg" alt="This is a book cover" width="240px" height="370px">
							<article class="book-info">
								<p class="book-name">Book Name</p>
								<p class="book-price">Price</p>
							</article>
						</div>
						<div class="book">
							<img class="book-cover-img" src="img/Romance/1.jpg" alt="This is a book cover" width="240px" height="370px">
							<article class="book-info">
								<p class="book-name">Book Name</p>
								<p class="book-price">Price</p>
							</article>
						</div>
					</section>


					<section class="row">
						<div class="book">
							<img class="book-cover-img" src="img/Romance/1.jpg" alt="This is a book cover" width="240px" height="370px">
							<article class="book-info">
								<p class="book-name">Book Name</p>
								<p class="book-price">Price</p>
							</article>
						</div>
						<div class="book">
							<img class="book-cover-img" src="img/Romance/1.jpg" alt="This is a book cover" width="240px" height="370px">
							<article class="book-info">
								<p class="book-name">Book Name</p>
								<p class="book-price">Price</p>
							</article>
						</div>
						<div class="book">
							<img class="book-cover-img" src="img/Romance/1.jpg" alt="This is a book cover" width="240px" height="370px">
							<article class="book-info">
								<p class="book-name">Book Name</p>
								<p class="book-price">Price</p>
							</article>
						</div>
					</section>
				</section>

				<section class="list-table" id="page-3">

					<section class="row">
						<div class="book">
							<img class="book-cover-img" src="img/Romance/1.jpg" alt="This is a book cover" width="240px" height="370px">
							<article class="book-info">
								<p class="book-name">Book Name</p>
								<p class="book-price">Price</p>
							</article>
						</div>
						<div class="book">
							<img class="book-cover-img" src="img/Romance/1.jpg" alt="This is a book cover" width="240px" height="370px">
							<article class="book-info">
								<p class="book-name">Book Name</p>
								<p class="book-price">Price</p>
							</article>
						</div>
						<div class="book">
							<img class="book-cover-img" src="img/Romance/1.jpg" alt="This is a book cover" width="240px" height="370px">
							<article class="book-info">
								<p class="book-name">Book Name</p>
								<p class="book-price">Price</p>
							</article>
						</div>
					</section>


					<section class="row">
						<div class="book">
							<img class="book-cover-img" src="img/Romance/1.jpg" alt="This is a book cover" width="240px" height="370px">
							<article class="book-info">
								<p class="book-name">Book Name</p>
								<p class="book-price">Price</p>
							</article>
						</div>
						<div class="book">
							<img class="book-cover-img" src="img/Romance/1.jpg" alt="This is a book cover" width="240px" height="370px">
							<article class="book-info">
								<p class="book-name">Book Name</p>
								<p class="book-price">Price</p>
							</article>
						</div>
						<div class="book">
							<img class="book-cover-img" src="img/Romance/1.jpg" alt="This is a book cover" width="240px" height="370px">
							<article class="book-info">
								<p class="book-name">Book Name</p>
								<p class="book-price">Price</p>
							</article>
						</div>
					</section>
				</section>

				<section class="list-table" id="page-4">

					<section class="row">
						<div class="book">
							<img class="book-cover-img" src="img/Romance/1.jpg" alt="This is a book cover" width="240px" height="370px">
							<article class="book-info">
								<p class="book-name">Book Name</p>
								<p class="book-price">Price</p>
							</article>
						</div>
						<div class="book">
							<img class="book-cover-img" src="img/Romance/1.jpg" alt="This is a book cover" width="240px" height="370px">
							<article class="book-info">
								<p class="book-name">Book Name</p>
								<p class="book-price">Price</p>
							</article>
						</div>
						<div class="book">
							<img class="book-cover-img" src="img/Romance/1.jpg" alt="This is a book cover" width="240px" height="370px">
							<article class="book-info">
								<p class="book-name">Book Name</p>
								<p class="book-price">Price</p>
							</article>
						</div>
					</section>


					<section class="row">
						<div class="book">
							<img class="book-cover-img" src="img/Romance/1.jpg" alt="This is a book cover" width="240px" height="370px">
							<article class="book-info">
								<p class="book-name">Book Name</p>
								<p class="book-price">Price</p>
							</article>
						</div>
						<div class="book">
							<img class="book-cover-img" src="img/Romance/1.jpg" alt="This is a book cover" width="240px" height="370px">
							<article class="book-info">
								<p class="book-name">Book Name</p>
								<p class="book-price">Price</p>
							</article>
						</div>
						<div class="book">
							<img class="book-cover-img" src="img/Romance/1.jpg" alt="This is a book cover" width="240px" height="370px">
							<article class="book-info">
								<p class="book-name">Book Name</p>
								<p class="book-price">Price</p>
							</article>
						</div>
					</section>
				</section>

				<section class="list-table" id="page-5">

					<section class="row">
						<div class="book">
							<img class="book-cover-img" src="img/Romance/1.jpg" alt="This is a book cover" width="240px" height="370px">
							<article class="book-info">
								<p class="book-name">Book Name</p>
								<p class="book-price">Price</p>
							</article>
						</div>
						<div class="book">
							<img class="book-cover-img" src="img/Romance/1.jpg" alt="This is a book cover" width="240px" height="370px">
							<article class="book-info">
								<p class="book-name">Book Name</p>
								<p class="book-price">Price</p>
							</article>
						</div>
						<div class="book">
							<img class="book-cover-img" src="img/Romance/1.jpg" alt="This is a book cover" width="240px" height="370px">
							<article class="book-info">
								<p class="book-name">Book Name</p>
								<p class="book-price">Price</p>
							</article>
						</div>
					</section>


					<section class="row">
						<div class="book">
							<img class="book-cover-img" src="img/Romance/3.png" alt="This is a book cover" width="240px" height="370px">
							<article class="book-info">
								<p class="book-name">Book Name</p>
								<p class="book-price">Price</p>
							</article>
						</div>
						<div class="book">
							<img class="book-cover-img" src="img/Romance/4.jpg" alt="This is a book cover" width="240px" height="370px">
							<article class="book-info">
								<p class="book-name">Book Name</p>
								<p class="book-price">Price</p>
							</article>
						</div>
						<div class="book">
							<img class="book-cover-img" src="img/Romance/5.jpg" alt="This is a book cover" width="240px" height="370px">
							<article class="book-info">
								<p class="book-name">Book Name</p>
								<p class="book-price">Price</p>
							</article>
						</div>
					</section>
				</section>
				page 5 ended -->

				<div id="pages">
					<ul>
						<li class="page-no"><p>1</p></li>
						<li class="page-no"><p>2</p></li>
						<li class="page-no"><p>3</p></li>
						<li class="page-no"><p>4</p></li>
						<li class="page-no"><p>5</p></li>
					</ul>
				</div>
			</div>
			<!-- book list ended -->
		</section>
		<!-- all content ended -->
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