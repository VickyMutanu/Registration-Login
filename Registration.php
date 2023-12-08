<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THE BUDGET GROCER</title>
    <link rel="stylesheet" type="text/css" href="style.css">
   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
  <section class="container forms">
  <div class="nav">
      <ul>
      <li><a href="">Home</a></li>
      <li><a href="">About</a></li>
      <li><a href="">Contact</a></li>
      <li><a href="">Services</a></li>
      <li><button class="show-popup">SIGN UP</button></li>
    </ul>
    <span class="overlay"></span>
  </div>

  
  <div class="Login">
      <h1>THE BUDGET </br> <span> GROCERY </span> </br> STORE</h1>
      <p class="par">Experience the best of a healthy life with the least from your pocket.<br> From the best variety and combination you can get in town. <br>Choose from a variety of packages with fresh groceries for a healthy life, <BR> including vegetables and fruits.
      </p>
        <button class="btn"><a href="" >ORDER NOW</a></button>
    </div>


    <div class="registration">
      <div class="form login">
        <h2>Login Here</h2>

        <?php
        if (isset($_POST["login"])) {
           $email = $_POST["email"];
           $password = $_POST["password"];
            require_once "database.php";
            $sql = "SELECT * FROM registration WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
            if ($user) {
                if (password_verify($password, $user["password"])) {
                    session_start();
                    $_SESSION["user"] = "yes";
                    header("Location: index.php");
                    die();
                }else{
                    echo "<div class='alert alert-danger'>Password does not match</div>";
                }
            }else{
                echo "<div class='alert alert-danger'>Email does not match</div>";
            }
        }
        ?>

        <form action="Registration.php" method="post">
                <div class="form-field">
                    <input type="email" class="input-field" name="email" placeholder="Email:">
                </div>
                <div class="form-field">
                    <input type="password" class="input-field" name="password" placeholder="Password:">
                </div>
                <div class="form-btn">
                    <input type="submit" class="btton" Value="Login" name="submit">
                </div>
          </form>
      </div>


      <div class="formsignup">
        <h2>Sign Up Here</h2>
        <?php
        if(isset($_POST["submit"])){
          $fullName =$_POST["fullname"];
          $email = $_POST["email"];
          $password = $_POST["password"];
          $confirmpassword = $_POST["password"];

          $errors = array();

          if (empty($email) OR empty($password) OR empty($confirmpassword) OR empty($fullname)) {
            array_push($errors,"All fields are required");
          }
          if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($errors,"Email is not valid"); 
          }
          if(strlen($password)<8){
            array_push($errors,"Password must be 8 characters long."); 
          }
          if($password!==$confirmpassword) {
            array_push($errors,"Password does not match.");
          }
          require_once "database.php";
           $sql = "SELECT * FROM registration WHERE email = '$email'";
           $result = mysqli_query($conn, $sql);
           $rowCount = mysqli_num_rows($result);
           if ($rowCount>0) {
            array_push($errors,"Email already exists!");
           }
          if (count($errors)>0) {
            foreach ($errors as $error) {
              echo"<div class='alert alert-danger'>$error</div>";
            }
          }
          else{
            
            $sql = "INSERT INTO users (full_name, email, password) VALUES ( ?, ?, ? )";
            $stmt = mysqli_stmt_init($conn);
            $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
            if ($prepareStmt) {
                mysqli_stmt_bind_param($stmt,"sss",$fullName, $email, $passwordHash);
                mysqli_stmt_execute($stmt);
                echo "<div class='alert alert-success'>You are registered successfully.</div>";
            }else{
                die("Something went wrong");
            }
           }

        }
        ?>

          <form action="registration.php" method="post">
          <div class="form-field">
                    <input type="text" class="input-field" name="fullname" placeholder="Full Name:">
                </div>
                <div class="form-field">
                    <input type="email" class="input-field" name="email" placeholder="Email:">
                </div>
                <div class="form-field">
                    <input type="password" class="input-field" name="password" placeholder="Password:">
                </div>
                <div class="form-field">
                    <input type="password" class="input-field" name="confirmpassword" placeholder="Confirm Password:">
                </div>
                <div class="form-btn">
                    <input type="submit" class="bttn" Value="Register" name="submit">
                </div>
          </form>
      </div>
    </div>
  </section>


  <section class="home">
    <div class="article">
      <h1>GROCMART</h1>
      <h2>The budget grocery store</h2>
      <p>Experience the best of a healthy life with the least from your pocket.<br> From the best variety and combination you can get in town. Choose from a variety of packages with fresh groceries for a healthy life, including vegetables and fruits.
      </p>
        <a href="" class="btn">ORDER NOW</a>
    </div>
  </section>


  <section class="prices">
    <div class="quantity">
      <h1>LOW PRICES, HUGE QUANTITY</h1>
      <h2>Pocket friendly services</h2> 
      <p>No need to spend much while you can get a huge quantity with us.<br> We offer a budget friendly package to our customer.<br> We care for your pocket</p>
      <a href=""class="btn">VIEW PACKAGES</a>
    </div>
  </section>


  <section class="services">
    <div class="time">
      <h1> SAVE TIME, ORDER ONLINE</h1>
      <p>Tired of long queues? Or better said, tired of leaving your house?<br> You can order the groceries with us online<br> The hustle is now over</p>
    </div>
    <div class="inshop">
      <h1> OR VISIT OUR STORE</h1>
      <p>Physical shopping can also be an option for you.<br> Visit us in our store for the best Groceries package.</p>
      <a href="" class="btn">ORDER NOW</a>
    </div>
  </section>


  <section class="try">
    <div class="rectangle"></div>
    <div class="offers">
      <h1>ENJOY OUR COMMUNITY OFFERS</h1>
      <h2>Enjoy our offers </h2> 
      <p>Start ordering with us<br> from as low as 1.5 $ per grocery basket.<br> Enjoy the offer while it lasts.</p>
      <a href=""class="btn">VIEW OFFERS</a>
    </div>
  </section>


  <footer>
    <p> &copy; 2023 THE GROCMART. All rights reserved.</p>
  </footer>


  <script>
    const section = document.querySelector("section"),
      overlay = document.querySelector(".overlay"),
      showBtn = document.querySelector(".show-popup");

    showBtn.addEventListener("click", () => section.classList.add("active"));

    overlay.addEventListener("click", () =>
      section.classList.remove("active")
    );
  </script>
    
</body>
</html>
