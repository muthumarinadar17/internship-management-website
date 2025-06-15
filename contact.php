<?php

include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['access_key']) || $_POST['access_key'] !== "391d8057-3d80-41df-8eda-43dc16e7cca3") {
        die("Unauthorized request");
    }

    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $message = $conn->real_escape_string($_POST['message']);

   
    $stmt = $conn->prepare("INSERT INTO contact (name, email, message, submitted_at) VALUES (?, ?, ?, NOW())");
    $stmt->bind_param("sss", $name, $email, $message);

    if ($stmt->execute()) {
        echo "Feedback stored in the database successfully.";
    } else {
        echo "Error storing feedback: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact form</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }


        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to right, #b0b8d9, #6A759F);
            height: 100vh;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .nav {
            padding: 15px 0;
            position: fixed;
            background-color: white;
            top: 0;
            left: 0;
            right: 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        .nav .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 7px 0;
        }

        .nav .container .logo img {
            width: 100px;
        }

        .nav ul {
            display: flex;
            list-style-type: none;
        }

        .nav a {
            text-decoration: none;
            padding: 10px 18px;
            color: #6A759F;
            font-size: 21px;
            font-weight: bold;
            transition: color 0.3s;
        }

        .nav a.current,
        .nav a:hover {
            color: white;
            background-color: #8793C0;
            border-radius: 20px;
            margin: 0 5px;
        }

        
        .menu-toggle {
            display: none;
            font-size: 30px;
            cursor: pointer;
            color: #6A759F;
        }


        .contact-container {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: space-evenly;
        }

        .contact-right img {
            width: 570px;
            height: 570px;
            max-width: 100%;
            object-fit: cover;
            display: block;
            margin-top: 100px;
            margin-left: auto;
            background-color: #6A759F;
            border-radius: 50%;
            clip-path: path(M82.4 24.2C108.2 10.6 137.6 -3.6 162.7 5.5C187.9 14.6 208.8 48.1 221.3 81.6C233.7 115.1 237.7 148.6 232.4 182.1C227.1 215.6 212.5 249.1 189.6 268.9C166.7 288.7 135.6 294.9 105.8 290.4C76.1 285.8 47.7 270.5 29.1 247.4C10.6 224.3 1.8 193.5 1.6 161.8C1.3 130.1 9.5 97.6 25.3 73.4C41.2 49.2 65.6 33.3 82.4 24.2);
        }

        .contact-left {
            display: flex;
            flex-direction: column;
            align-items: start;
            gap: 20px;
            padding-top: 80px;

        }

        .contact-left-title h2 {
            font-weight: 600;
            color: #454E6B;
            font-size: 40px;
            margin-bottom: 5px;
        }

        .contact-left-title hr {
            border: none;
            width: 120px;
            height: 5px;
            background-color: #ff6b6b;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .input-box input,
        .input-box textarea {
            width: 400px;
            height: 50px;
            border: none;
            border-bottom: 3px solid #757575;
            outline: none;
            padding: 5px 10px;
            font-size: 18px;
            background-color: transparent;
            color: #454E6B !important;
            transition: 0.3s ease-in-out;
            letter-spacing: 1px;
            font-weight: bold;
            display: flex;
            margin-top: 20px;
            flex-direction: column;
        }

      
        .input-box textarea {
            margin-top: 40px;
            border: 3px solid #757575;
            height: 140px;
            resize: none;
            border-radius: 6px;
        }

        
        .input-box input:focus,
        .input-box textarea:focus {
            box-shadow: -4px 9px 8px rgba(0, 0, 50, 0.5);
            color: #454E6B !important;
        }

        
        .input-box input::placeholder,
        .input-box textarea::placeholder {
            color: #454E6B;
            font-size: 14px;
            letter-spacing: 1px;
            font-size: 19px;
        }

       
        .contact-left button {
            display: flex;
            align-items: center;
            padding: 13px 170px;
            font-size: 18px;
            color: white;
            gap: 10px;
            font-weight: bold;
            letter-spacing: 1px;
            margin-top: 30px;
            border: none;
            border-radius: 10px;
            background: #454E6B;
            cursor: pointer;

            transition: 0.3s ease-in-out;
        }

        .contact-left button:hover {
            background: #2E354A;
            box-shadow: -4px 9px 8px rgba(0, 0, 50, 0.5);
        }
        
      .dropdown {
        position: relative;
        display: inline-block;
      }

      .dropdown-content {
        display: none !important;
        position: absolute;
        background-color: #fff;
        min-width: 120px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        z-index: 1;
        list-style: none;
        padding: 0;
      }

      .dropdown-content li {
        padding: 10px;
        text-align: left;
      }

      .dropdown-content li a {
        text-decoration: none;
        color: #333;
        display: block;
        padding: 10px;
      }

      .dropdown-content li a:hover {
        color: white;
        background-color: #8793c0;
        border-radius: 20px;
        margin: 0 5px;
      }

      .dropdown:hover .dropdown-content {
        display: block !important;
      }
    </style>
</head>

<body>
    <nav class="nav">
        <div class="container">
            <h1 class="logo"> <img src="images/logo.jpg"> </h1>
            <span class="menu-toggle" onclick="toggleMenu()">&#9776;</span>
            <ul id="nav-menu">
                <li> <a href="home.html">Home</a></li>
                <li> <a href="internship.html">Internship</a></li>
                <li> <a href="mocktestsample.php">Test</a></li>
                <li> <a href="" class="current">Contact</a></li>
                <li> <a href="index.php"> SignUp </a></li>
                <li class="dropdown">
                    <a href="#" class="dropbtn">LogIn</a>
                    <ul class="dropdown-content">
                        <li><a href="login.php">Student</a></li>
                        <li><a href="adminlogin.php">Admin</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

    <div class="contact-container"> <!--web3forms website -->
        <form action="https://api.web3forms.com/submit" method="POST" class="contact-left">
            <!-- mail sent to muthumarinadar17 ACCOUNT-->
            <div class="contact-left-title">
                <h2> Get In Touch</h2>
                <hr>
            </div>
            <div class="input-box">
                <input type="hidden" name="access_key" value="391d8057-3d80-41df-8eda-43dc16e7cca3">
                <input type="text" name="name" placeholder="your name" class="contact-inputs" required>
                <input type="email" name="email" placeholder="your email" class="contact-inputs" required>
                <textarea name="message" placeholder="your message" class="contact-inputs" required></textarea>
                <button type="submit" class="form-submit"> Submit </button>
            </div>
        </form>
        <div class="contact-right">
            <img src="images/c2.png" />
        </div>
    </div>
</body>
<script>

    document.querySelector("form").addEventListener("submit", function (event) {
        event.preventDefault(); 
        let formData = new FormData(this); 

        // Send data to Web3Forms
        fetch("https://api.web3forms.com/submit", {
            method: "POST",
            body: formData
        })
            .then(response => response.json())
            .then(result => {
                console.log("Web3Forms Response:", result);

                fetch("Lcontact.php", {
                    method: "POST",
                    body: formData
                })
                    .then(response => response.text()) 
                    .then(dbResult => {
                        console.log("Database Response:", dbResult);
                        alert('Information sent successfully!!!!'); 
                        document.querySelector("form").reset(); 
                    })
                    .catch(error => console.error("Database Error:", error));
            })
            .catch(error => console.error("Web3Forms Error:", error));
    });

</script>
</html>