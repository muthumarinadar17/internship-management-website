<?php
session_start();
include 'connect.php'; 

if (isset($_POST['signIn'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query to check admin credentials
    $stmt = $conn->prepare("SELECT * FROM admin WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['admin'] = $email;
        header("Location: inputinternship.php"); // Redirect to admin dashboard
        exit();
    } else {
        $error = "Invalid email or password!";
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
   
     <style>
      
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:"poppins",sans-serif;
}
body{
   
	background-color: #c9d6ff;
    background: linear-gradient(to right, #b0b8d9, #6A759F);
}
.container{
    width:550px;
	height: 400px;
    padding:1.5rem;
    margin:150px auto;
    border-radius:10px;
	border-radius:10px;
    box-shadow:0 20px 35px rgba(0,0,1,0.9);
	background-color: #c9d6ff;
    background:linear-gradient(to right,#e2e2e2,#c9d6ff);
}
form{
    margin:0 2rem;
}
.form-title{
	color: #ff6b6b;
    font-size:1.6rem;
    font-weight:bold;
    text-align:center;
    padding:1.3rem;
    margin-bottom:0.4rem;
	letter-spacing: 1px;
    color: #414A60;
}
input{
    color:inherit;
    width:100%;
    background-color:transparent;
    border:none;
    border-bottom:1px solid #757575;
    padding-left:1.5rem;
    font-size:17px;
	letter-spacing: 1px;
	margin-bottom: 20px;
}
.input-group{
	
    padding:1% 0;
    position:relative;
	padding-bottom: 25px;
	padding-top: 20px;

} 
.input-group i{
    font-size: 19px;
    position:absolute;
    color: #6A759F;
	
}
input:focus{
    background-color: transparent;
    outline:transparent;
    border-bottom:2px solid hsl(327,90%,28%);
}
input::placeholder{
    color:black;
	letter-spacing: 1px;
	padding-left: 8px;
	font-size: 16px;
}
input:focus::placeholder{
	color:transparent;
}
.btn{
    font-size:1.1rem;
    padding:8px 0;
    border-radius:5px;
    outline:none;
    border:none;
    width:100%;
    color:white;
    cursor:pointer;
    transition:0.9s;
	margin-bottom: 25px;
	margin-top: 10px;
	font-weight:bold;
	background-color: #6A759F;
   
   }
.btn:hover{
    box-shadow: -4px 9px 8px rgba(0, 0, 50, 0.5);
}

.links{
    display:flex;
    justify-content:space-around;
    padding:0 4rem;
    margin-top:0.9rem;
    font-weight:bold;
	font-size: 19px;
}
button{
    color:rgb(125,125,235);
    border:none;
    background-color:transparent;
    font-size:1rem;
    font-weight:bold;
	
}
a{
	text-decoration: none;
	font-size: 19px;
	color:  #6A759F !important;
}
a:hover{
    text-decoration: none;
	color: white !important;
	background: #6A759F;
	border-radius: 15px;
	padding: 8px 15px;
	}
    #close{
        position: absolute;
        top: 24%;
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
        margin: 100px auto;
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

    .links {
        padding: 0 2rem;
        font-size: 16px;
        flex-direction: column;
        text-align: center;
    }

    button {
        font-size: 0.9rem;
    }

    #close {
        top: 10%;
        right: 10%;
        font-size: 20px;
    }
}
      </style>
</head>
<body>
    <button id="close"><i class="fa-solid fa-xmark"></i></button>
    <div class="container" id="signIn">
    <p style="color: red"> 
        <?php 
        if(isset($error)){ 
        echo $error;
      } 
        ?>
      </p>
        <h1 class="form-title">Log In</h1>
        <form method="post" action="">
          <div class="input-group">
              <i class="fas fa-envelope"></i>
              <input type="email" name="email" id="email" placeholder="Email" required>
              
          </div>
          <div class="input-group">
              <i class="fas fa-lock"></i>
              <input type="password" name="password" id="password" placeholder="Password" required>
              
          </div>
         <input type="submit" class="btn" value="Sign In" name="signIn">
        </form>
        </p>
        
      </div>
      <script src="script.js"></script>
      <script>
        document.getElementById("close").addEventListener("click" , function(){
            window.location.href = "home.html";
        });


        const urlParams = new URLSearchParams(window.location.search);
const redirectURL = urlParams.get("redirect");




      </script>
</body>
</html>