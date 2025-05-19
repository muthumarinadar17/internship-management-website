<?php 

include 'connect.php';


if(isset($_POST['signUp'])){
    $firstName= mysqli_real_escape_string($conn,$_POST['fName']);
    $email=mysqli_real_escape_string($conn,$_POST['email']);
    $password=mysqli_real_escape_string($conn,$_POST['password']);
    $confirmpassword=mysqli_real_escape_string($conn,$_POST['confirmpassword']);
    // $password=md5($password);
   //  $pwd= password_hash($password,PASSWORD_DEFAULT);
    

if(empty($firstName)){
   $error="username fiield is required";
}
elseif(empty($email)){
  $error = "email field is required";
}
elseif(empty($password)){
  $error = "password field is required";
}
elseif($password != $confirmpassword){
  $error = "password does not match";
}
elseif(strlen($firstName) <3 || strlen($firstName) >30){
  $error = " username must be between 3 to 30 character";
}
elseif(strlen($password) <=7 ){
  $error = "password must be atleast 8 character";
}
else{
  $check_email="SELECT * FROM users WHERE email='$email'";
  $data=mysqli_query($conn,$check_email);
  $result = mysqli_fetch_array($data);
  if($result > 0 ){
    $error ="email already exists";
  }
  else{
    $pass=md5($password);
    $insert="INSERT INTO users(firstName,email,password) VALUES ('$firstName','$email','$password')";
    $q=mysqli_query($conn,$insert);
    if($q){
      $success = "Your account has been created successfully";
    }

  }
}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register & Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- <link rel="stylesheet" href="style.css"> -->

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "poppins", sans-serif;
        }

        body {
            background-color: #c9d6ff;
            background: linear-gradient(to right, #b0b8d9, #6A759F);
        }

        .container {
            width: 550px;
            height: 500px;
            padding: 1.5rem;
            margin: 100px auto;
            border-radius: 10px;
            box-shadow: 0 20px 35px rgba(0, 0, 1, 0.9);
            background-color: #c9d6ff;
            background: linear-gradient(to right, #e2e2e2, #c9d6ff);
        }

        form {
            margin: 0 2rem;
        }

        .form-title {
            font-size: 1.6rem;
            font-weight: bold;
            text-align: center;
            padding: 1.3rem;
            margin-bottom: 0.4rem;
            letter-spacing: 1px;
            color: #414A60;
        }

        input {
            color: inherit;
            width: 100%;
            background-color: transparent;
            border: none;
            border-bottom: 1px solid #757575;
            padding-left: 1.5rem;
            font-size: 17px;
            letter-spacing: 1px;
            margin-bottom: 20px;
        }

        .input-group {
            padding: 1% 0;
            position: relative;
            padding-bottom: 10px;
            padding-top: 10px;
        }

        .input-group i {
            font-size: 19px;
            position: absolute;
            color: #6A759F;
        }

        input:focus {
            background-color: transparent;
            outline: transparent;
            border-bottom: 2px solid hsl(327, 90%, 28%);
        }

        input::placeholder {
            color: black;
            letter-spacing: 1px;
            padding-left: 5px;
            font-size: 16px;
        }

        input:focus::placeholder {
            color: transparent;
        }

        .btn {
            font-size: 1.1rem;
            padding: 8px 0;
            border-radius: 5px;
            outline: none;
            border: none;
            width: 100%;
            background: rgb(125, 125, 235);
            color: white;
            cursor: pointer;
            transition: 0.9s;
            background-color: #6A759F;
            font-weight: bold;

        }

        .btn:hover {
            box-shadow: -4px 9px 8px rgba(0, 0, 50, 0.5);
        }

        .links {
            display: flex;
            justify-content: space-around;
            padding: 0 4rem;
            margin-top: 0.9rem;
            font-weight: bold;
            font-size: 19px;
        }

        button {
            color: rgb(125, 125, 235);
            border: none;
            background-color: transparent;
            font-size: 1rem;
            font-weight: bold;
        }

        a {
            text-decoration: none;
            font-size: 19px;
            color: #6A759F !important;
        }

        a:hover {
            text-decoration: none;
            color: white !important;
            background: #6A759F;
            border-radius: 15px;
            padding: 8px 15px;
        }

        #close {
            position: absolute;
            top: 17%;
            right: 34%;
            background-color: transparent;
            font-size: 24px;
            color: #6A759F;
            border: none;
            outline: none;
            cursor: pointer;
            transition: color 0.3s;
        }

        @media (max-width: 768px) {
            .container {
                width: 90%;
                height: auto;
                padding: 1.5rem;
                margin: 80px auto;
            }

            .form-title {
                font-size: 1.4rem;
                padding: 1rem;
            }

            input {
                font-size: 15px;
            }

            .btn {
                font-size: 1rem;
                padding: 6px 0;
            }

            #close {
                top: 13%;
                right: 10%;
                font-size: 20px;
            }
        }
    </style>
</head>

<body>
    <button id="close"><i class="fa-solid fa-xmark"></i></button>
    <div class="container" id="signup">
        <p style="color:red">
            <?php 
        if(isset($error)){ 
        echo $error;
      } 
        ?>
        </p>
        <p style="color:green">
            <?php 
        if(isset($success)){ 
        echo $success;
      } 
        ?>
        </p>
        <h1 class="form-title">SIGN UP</h1>
        <form method="post" action=" ">
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" name="fName" id="fName" placeholder="First Name">

            </div>
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" id="email" placeholder="Email">

            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" id="password" placeholder="Password">

            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="confirmpassword" id="confirmpassword" placeholder="re-enter Password">

            </div>
            <input type="submit" class="btn" value="Sign Up" name="signUp">
        </form>
        </p>
        <div class="links">
            <p>Already Have An Account ?</p>
            <button id="signInButton"><a href="login.php#anchor">Sign In</a></button>
        </div>
    </div>

    <script src="script.js"></script>
    <script>
        function toggleMenu() {
            var menu = document.getElementById("nav-menu");
            menu.classList.toggle("active");
        }

        document.getElementById("close").addEventListener("click", function () {
            window.location.href = "home.html"; // Redirects to the home page
        });
    </script>
</body>

</html>