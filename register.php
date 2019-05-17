<?php
    //enable php debug
    error_reporting(-1);
    ini_set('display_errors','On');
?>

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
        <a href="index.php"><img id="logo" src="img/logo.png" alt="The logo of Book Factory"></a>
            <div>
                <a class="nav-component" href="index.php">Homepage</a >
                <a class="nav-component" href="booklist.php">Books</a >
            </div>
        </div>

        <div class="login-button">
            <a><button onclick="document.getElementById('login_panel').style.display='block'">Login</button></a>
            
        </div>
    </div>
    <!-- *** LOGIN ***
_________________________________________________________ -->

    <!-- The Modal -->
    <div id="login_panel" class="modal">
        <span onclick="document.getElementById('login_panel').style.display='none'" 
        class="close" title="Close Modal">&times;</span>

    <!-- Modal Content -->
        <form class="login-content animate">

            <div class="login-container">
                <label for="uname"><b>Username</b></label>
                <input type="name" placeholder="Enter Username" name="uname" required>

                <label for="psw"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="psw" required>

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
             <li id="home"><a href="index.php">Home</a ></li>
                <li id="booklist"><a href="booklist.php"> Book List</a ></li>
         </ul>
        </nav>
        
        <div id="register-panel">
            <h1>New Account</h1>
            <h2>Join us now by filling the form below!</h2>
            <p>If you have any questions, please free to call us any time.</p >
            <hr>
            <form id="register-form" method="post" action="insert_user.php">
                <div class="form-group">
                    <label>Username</label><br>
                    <input type="" class="box" id="Username" name="username">
                </div>
                <div class="form-group">
                    <label>Age</label><br>
                    <input type="" class="box" id="Age" name="age">
                </div>
                <div class="form-group">
                    <label>First Name</label><br>
                    <input type="" class="box" id="Firstname" name="firstname">
                </div>
                <div class="form-group">
                    <label>Last Name</label><br>
                    <input type="" class="box" id="Lastname" name="lastname">
                </div>
                <div class="form-group">
                    <label>Gender</label>
                    <div>
                        <input type="radio" id="genderf" value="F" name="gender"> F 
                        <input type="radio" id="genderm" value="M" name="gender"> M <br>
                    </div>
                    
                </div>
                <div class="form-group">
                    <label>Occupation</label><br>
                    <input type="" class="box" id="Occupation" name="occupation">
                </div>
                <div class="form-group">
                    <label>Password</label><br>
                    <input type="" class="box" id="Password" name="password">
                </div>
                <div class="form-group">
                    <label>Post Code</label><br>
                    <input type="" class="box" id="Postcode" name="postcode">
                </div>
                <div id="register-confirm">
                    <button id="register-button">Register</button>
                </div>
            </form>
        </div>
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