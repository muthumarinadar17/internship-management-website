<?php
include 'connect.php';
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    header('Content-Type: application/json'); 
    $fullname = mysqli_real_escape_string($conn, $_POST['fname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $company = mysqli_real_escape_string($conn, $_POST['company']);
    $internship = mysqli_real_escape_string($conn, $_POST['internship']);

    
    if (isset($_FILES['file']) && $_FILES['file']['error'] === 0) {
        $file_name = $_FILES['file']['name']; 
        $file_tmp = $_FILES['file']['tmp_name']; 

        
        $upload_dir = "uploads/";

        
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        
        if (move_uploaded_file($file_tmp, $upload_dir . $file_name)) {
            
            $insert = "INSERT INTO resubmit (company, internship, fullname, email, file) 
                       VALUES ('$company', '$internship', '$fullname', '$email', '$file_name')";

            if (mysqli_query($conn, $insert)) {
                echo json_encode(["success" => true, "internship" => $internship]); 
                exit();
            } else {
                echo json_encode(["success" => false, "message" => "Database Error"]);
                exit();
            }
        } else {
            echo json_encode(["success" => false, "message" => "File upload failed"]);
            exit();
        }
    } else {
        echo json_encode(["success" => false, "message" => "No file uploaded"]);
        exit();
    }
      
      echo json_encode($response);
      exit;
}
?>

    

<html>
<head>
<title>After Internship</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap');
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
    
    .nav .container .logo img{
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
    
    .nav a.current, .nav a:hover {
        color: white;
        background-color: #8793C0;
        border-radius: 20px;
        margin: 0 5px;
    }
    
    /* Mobile Navigation */
    .menu-toggle {
    display: none; /* Initially hidden */
    font-size: 30px;
    cursor: pointer;
    color: #6A759F;
    }
     
    /* ------------------ search bar */
    .container-fluid
    {
    height: auto;
    padding: 0px 0px 80px 0px;
    }
    .container
    {
    height: auto;
    margin: auto;
    }
    .container .search
    {
    flex-direction: column;
    align-items: center;
    display: flex;
    padding: 150px 0px;
    padding-bottom: 50px;
    justify-content: space-between;
    }
    .container .search input
    {
    border:none;
    width: 38%;
    padding: 5px 16px;
    font-size: 20px;
    text-transform: capitalize;
    letter-spacing: 3px;
    outline: none;
    margin-left: 62%;
    padding: 12px 20px;
    font-size: 18px;
    
    outline: none;
    background-color: white;
    transition: all 0.3s ease;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2), 
                    0 6px 20px rgba(0, 0, 0, 0.19); /* Adds a subtle 3D shadow effect */
        transition: transform 0.3s ease, box-shadow 0.3s ease; /* Smooth animation */
    border: 2px solid white;
    }
    .container .search input::placeholder
    {
    color: #6A759F ;
    font-weight: bold;
    }
    
    
    .container .search input:focus{
        box-shadow: 0px 4px 8px rgba(0,123,255,0.3);
    }
    
    .search i{
    display: flex;
    position: absolute;
    left: 1300px;
    margin-top: 11px;
    font-size: 20px;
    color: #6A759F;
    }
    /* -------------------- product......................... */
    
    .container .product-list
    {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    text-align: left;
    
    }
    .container .product-list .product
    {
    background-color: white;
    margin-top: 30px;
    margin-left: 25px;
    width: 1100px;
     padding: 15px; 
        border-radius: 8px; 
        color: black;
    position: relative;	
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2), 
                    0 6px 20px rgba(0, 0, 0, 0.19);
        transition: transform 0.3s ease, box-shadow 0.3s ease; 
    }
    .product h2{
        margin: 0;
        margin-top:10px;
        margin-left: 40px; 
        color: #254E96;
    }
    
    .product h3 i {
        margin-right: 15px; 
        color: #555; 
        font-size: 18px;
    }
    
    .product h3 {
        color: gray;
        margin: 5px 0;
        display: flex;
        align-items: center;
    margin-left: 40px;	
    }
    
    .product-list .product .inner{
    
        
          padding: 10px; 
        border-radius: 8px; 
        color: black; 
        min-width: 200px; 
    position: absolute;
    top: 15px;
    left: 40%;	
    }
    
    /* ----------------- view more button - */
    .product-list .product .view-more{
        margin-left: 78%;
        display: flex;
        position: relative;
        top: -50px;
        margin-bottom: -45px;
        
    }
    .view-more .view{
        Padding: 10px 0px;
        padding-right: 20px;
        padding-left: 20px;
        font-size: 18px;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        letter-spacing: 0.1em;  
            
    }
    .view-more .view:hover{
        color: white;
        background-color: #6F7AA8;
        box-shadow: 3px 3px 5px rgba(0, 0, 0, 0.3), 
                -3px 0px 5px rgba(0, 0, 0, 0.2);
    }
    .view {
        color: white; 
        border: none;
        background-color: rgb(89, 101, 145);
        border-radius: 8px;
    }
    
    /* -------------------- view more -----------------*/
    .popup{
            display: none;
            background-color: #ffffff;
            width: 1100px;
            margin-left: 25px;
            max-height: 500px;
            padding: 30px 40px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
            position: relative;
            border-top: 2px solid gray;
        }
    
        .popup::-webkit-scrollbar {
            width: 8px;
            height: 3px;
        }
    
        .popup::-webkit-scrollbar-thumb {
            background: #c5c5c5;
            border-radius: 4px;
        }
    
        .popup button {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: transparent;
            font-size: 24px;
            color: #c5c5c5;
            border: none;
            outline: none;
            cursor: pointer;
            transition: color 0.3s;
        }
    
        .popup button:hover {
            color: #0f72e5;
        }
        .popup h4 {
            font-size: 21px;
            margin-top: 18px;
            color: #6A759F;
            font-weight: 800;
            margin-bottom: 20px;
            
        }
        .popup ul{
            margin-left: 50px;
            margin-top: 11px;
        }
        .popup ul li {
            letter-spacing: 1px;
            padding: 5px 0px;
            font-weight: bold;
            font-size: 18px;
            color: rgba(54, 50, 50, 0.847);
            padding-left: 10px;
        }
        .popup p {
        font-size: 18px;
        line-height: 1.8;
        color: rgba(54, 50, 50, 0.847);
        margin: 10px 0;
        letter-spacing: 1px; 
        font-weight: 700; 
        margin-left: 50px;
        }
    
        .popup span {
            display: inline-block;
            background-color:#d9d9d9;
            padding: 9px 12px;
            border-radius: 8px;
            font-size: 18px;
            color: rgba(54, 50, 50, 0.847);
            margin-right: 12px;
            font-weight: bold;
        }
        .skillsRequired{
            margin: 10px 0;
            margin-left:50px;
            margin-top: 24px;
            margin-bottom: 20px;
        }
    
    .popup button#apply {
        box-sizing: border-box;
        position: relative;
        margin-bottom: 20px; 
        left: 50%; 
        transform: translateX(-50%); 
        color: #fff; 
        font-size: 18px; 
        font-weight: bold; 
        border: none; 
        border-radius: 5px; 
        cursor: pointer; 
        transition: background-color 0.3s; 
        padding: 10px 15px; 
        display: inline-block;
        width: auto;
        border:none;
        background-color: #8793C0 ;
       }
    
    .popup button#apply:hover {
        border:2px solid #6A759F;
        border-radius: 5px;
        background-color: #6A759F;
        box-shadow: 3px 3px 5px rgba(0, 0, 0, 0.3), 
                -3px 0px 5px rgba(0, 0, 0, 0.2);
    }
    
    .popup button#apply a {
        color: #fff;
        text-decoration: none; 
        display: block; 
        text-align: center; 
    }
    
    /* ------------------ Filter Bar */
    .filter-bar {
        display: flex;
        
        align-items: center;
        gap: 15px;
        padding: 2px 0px;
        border-radius: 10px;
        box-shadow: none; 
        margin-bottom: 25px;
        flex-wrap: wrap; 
        background: transparent; 
        border: none;
        margin-top: -8%;
    }
    
    .filter-bar select, 
    .filter-bar button {
        padding: 12px 10px;
        border-radius: 8px;
        border: none;
        font-size: 16px;
        outline: none;
        font-weight: 500;
        transition: 0.3s ease-in-out;
        width: 150px;
    }
    
    .filter-bar select {
        background: white;
        cursor: pointer;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        color: #6A759F;
        font-weight: bold;
    }
    
    .filter-bar select:hover {
        transform: scale(1.02);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
    }
    
    .filter-bar button {
        background: #ff6b6b;
        color: white;
        cursor: pointer;
        border: none;
        font-weight: bold;
        letter-spacing: 1px;
        box-shadow: 0 4px 6px rgba(255, 107, 107, 0.4);
    }
    
    .filter-bar button:hover {
        background: #e63946;
        transform: scale(1.05);
        box-shadow: 0 6px 12px rgba(255, 107, 107, 0.6);
    }
    
    /* Make it responsive */
    @media (max-width: 768px) {
        .filter-bar {
            flex-direction: column;
            gap: 10px;
        }
    
        .filter-bar select, .filter-bar button {
            width: 100%;
        }
    }
     
     /* ----------------------- resume upload ------------------------- */
    
     .container-apply {
        margin: 20px auto;
        background-color: white;
        width: 500px;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        letter-spacing: 1px;
        text-align: center;
        font-family: Arial, sans-serif;
        display: none; 
    }
    
    .container-apply {
      
      display: none;
       position: fixed;
        top: 55%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: white;
        padding: 20px;
        box-shadow: 
        0px 0px 10px rgba(0, 0, 0, 0.6), 
        0px 0px 20px rgba(0, 0, 0, 0.4), 
        0px 0px 30px rgba(0, 0, 0, 0.3);
        border-radius: 8px;
        z-index: 1000;
    }
    .popup-active, .container-apply.active{
      display: block;
    }
    .container-apply .resume-close-btn{
            position: absolute;
            padding-left: 39%;
            background-color: transparent;
            font-size: 24px;
            color: #c5c5c5;
            border: none;
            outline: none;
            cursor: pointer;
            transition: color 0.3s;
    }
    
    .container-apply p {
        font-size: 19px;
        font-weight: bold;
        margin-bottom: 15px;
        color: #333;
    }
    
    .resume-upload {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 10px;
        background: #f4f4f4;
        border-radius: 8px;
        border: 1px dashed #8793C0;
        cursor: pointer;
        transition: 0.3s;
    }
    
    .resume-upload:hover {
        background: #e3e7f1;
    }
    
    .resume-upload input {
        font-size: 16px;
        border: none;
        outline: none;
    }
    
    .resume-name {
        margin-top: 20px;
        text-align: left;
    }
    
    .resume-name label {
        font-size: 18px;
        font-weight: 500;
        display: block;
        margin-bottom: 5px;
        color: #ff6b6b;
        font-weight: bold;
    }
    
    .resume-name input {
        width: 100%;
        padding: 8px;
        font-size: 18px;
        border: 1px solid #ccc;
        border-radius: 5px;
        outline: none;
        transition: 0.3s;
        margin-bottom: 20px;
        letter-spacing: 1px;
        font-weight: bold;
        color: rgba(54, 50, 50, 0.847);
    }
    
    .resume-name input:focus {
        border-color: #8793C0;
        box-shadow: 0 0 5px rgba(135, 147, 192, 0.5);
    }
    
    .resume-submit button{
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        padding: 10px;
        background: #ff6b6b;
        border-radius: 8px;
        border: 1px dashed #8793C0;
        cursor: pointer;
        transition: 0.3s;
        margin-top: 20px;
        font-size: 18px;
        letter-spacing: 1px;
        font-weight: 600;
        color: white;
    }
    
     .resume-submit button:hover{
         background: linear-gradient(to right, #e63946, #ff6b6b);
        transform: scale(1.05);
        box-shadow: 0 6px 12px rgba(255, 107, 107, 0.6);
     }
     
@media screen and (max-width: 1200px) {
    .container .search input {
        width: 40%;
        margin-left: 60%;
        font-size: 16px;
        padding: 10px 15px;
    }
    .filter-bar{
        display: flex;
    }
    .filter-bar select{
        width:100px;
    }
    .search i {
        left: auto;
        right: 30px;
    }

    .container .product-list .product {
        width: 90%;
        margin-left: auto;
        margin-right: auto;
    }

    .product-list .product .inner {
        left: 30%;
    }

    .view-more .view {
        margin-left: 10%;
    }

    .popup {
        width: 90%;
        margin-left: auto;
        margin-right: auto;
    }
}

@media screen and (max-width: 992px) {
    .container .search {
        padding: 100px 0px;
        padding-top: 120px;
    }

    .container .search input {
        width: 60%;
        margin-left: 20%;
        font-size: 16px;
        padding: 8px 12px;
    }

    .product-list {
        flex-direction: column;
        align-items: center;
    }

    .container .product-list .product {
        width: 95%;
    }

    .product-list .product .inner {
        left: 30%;
    }

    .view-more .view {
        margin-left: 10%;
    }

    .filter-bar {
        flex-direction: column;
        align-items: center;
        gap: 10px;
    }

    .filter-bar select, .filter-bar button {
        width: 80%;
    }

    .popup {
        max-height: 300px;
        padding: 20px;
    }

    .popup p, .popup ul li {
        font-size: 16px;
    }
}

/* Make it responsive */
@media (max-width: 768px) {
 
.nav ul {
display: none; 
flex-direction: column;
position: absolute;
top: 60px;
right: 0;
background: white;
width: 100%;
text-align: center;
box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
padding: 10px 0;
transition: all 0.3s ease-in-out;
}

.nav ul.active {
display: flex;
}

.nav ul li {
padding: 10px;
width: 100%;
}

.menu-toggle {
display: block; 
}
 /*filter bar*/
    .filter-bar {
        flex-direction: column;
        gap: 10px;
    }

    .filter-bar select, .filter-bar button {
        width: 100%;
    }
    /* search bar*/
    .container .search {
        padding: 80px 0px;
        padding-top: 120px;
    }

    .container .search input {
        width: 70%;
        margin-left: 15%;
        font-size: 14px;
    }

    .search i {
        left: auto;
        right: 10px;
        font-size: 18px;
    }

    .container .product-list .product {
        width: 100%;
        margin-left: 0;
    }

    .product-list .product .inner {
        position: relative;
        left: 0;
        text-align: center;
    }

    .view-more .view {
        margin-left: 10%;
    }

    .popup {
        width: 95%;
        max-height: 250px;
        padding: 15px;
    }

    .popup button#apply {
        font-size: 16px;
        padding: 8px 12px;
    }
}
@media screen and (max-width: 576px) {
    .container .search {
        padding: 50px 0px;
        padding-top: 120px;
    }

    .container .search input {
        width: 90%;
        margin-left: 10%;
        font-size: 12px;
        padding: 6px 10px;
        height: 30px;
    }

    .search i {
        font-size: 16px;
        margin-right: 20px;
    }

    .container .product-list .product {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        text-align: center;
        width: 100%;
        height: 250px;
    }

    .view-more .view {
        margin-left: 1%;
        padding-left: 25px;
        padding-right: 25px;
        display: block;
        display: flex;
        flex-direction: column;
        
    }

    .filter-bar select, .filter-bar button {
        width: 100%;
    }

    .popup {
        width: 100%;
        max-height: 200px;
        padding: 10px;
    }

    .popup p, .popup ul li {
        font-size: 14px;
    }

    .popup button#apply {
        font-size: 14px;
        padding: 6px 10px;
    }
}
</style>
</head>
<body>

<!-- nav bar -->
<nav class="nav">
    <div class="container">
        <h1 class="logo"> <img src="https://th.bing.com/th/id/OIP.j8p1rUWK9cS_n34LM4czIAAAAA?rs=1&pid=ImgDetMain"> </h1>
        <span class="menu-toggle" onclick="toggleMenu()">&#9776;</span>
        <ul id="nav-menu">
            <li> <a href="LHome.php">Home</a></li>
            <li> <a href="#" class="current">Internship</a></li>
            <li> <a href="mocktest/Lmocktest.html">Test</a></li>
            <li> <a href="Lcontact.php">Contact</a></li>
            <li> <a href="creatingPROFILE.php"> profile </a></li>
            <li> <a href="logout.php"> Logout </a></li>
        </ul>
    </div>
</nav>

<!-- search bar -->
<div class="container-fluid">
<div class="container">
<div class="search">
 <input type="text" name="" id="find" placeholder="search here...." onkeyup="search()">
 <i class="fas fa-search"></i> 
</div>

<!-- Filter Bar -->
<div class="filter-bar">
	<select id="filter-name">
		<option value=""> Select Internship </option>
		<option value="Web Development"> Web Development </option>
		<option value="Sales and Marketing"> Sales and marketing </option>
		<option value="Software Developer">Software Developer</option>
		<option value="Artificial Intelligence"> Artificial Intelligence </option>
        <option value="Business Development">Business Development </option>
        <option value="Digital Marketing"> Digitial Marketing </option>
        <option value="Data Entry"> Data Entry </option>
        <option value="Data Science"> Data Science </option>
	</select>
	
	<select id="filter-duration">
		<option value=""> Select Duration </option>
        <option value="2 Months">2 Months</option>
        <option value="3 Months">3 Months</option>
        <option value="6 Months">6 Months</option>
	</select>
	
	<select id="filter-skills">
		<option value="">Select Skill</option>
        <option value="Python">Python</option>
        <option value="JavaScript">JavaScript</option>
        <option value="SEO">SEO</option>
        <option value="English Proficiency"> English Proficiency</option>
        <option value="sales">Sales</option>
        <option value="node.JS"> Node.Js</option>
        <otpion value="AWS">AWS</otpion>
        <option value="data analysis"> Data Analysis</option>
        <option value="AI">AI</option>
        <option value="mongodb">mongodb</option>
        <option value="communication">communication</option>
	</select>
	
	<button onclick="applyFilters()"> Apply Filter </button>
	<div id="no-results" style="display:none;">No internships found.</div>

</div>

<div class="product-list">
<div class="product" data-name="Web Development" data-duration="3 Months" data-skill="html,css,javascript">
	<h2> Web Development </h2> <br/> 
	<h3 class="cname"><i class="far fa-building"></i> Cloud Quest </h3> <br/>
	<div class="inner">  
		<h3><i class="fas fa-house-user"></i> Work From Home </h3><br/> 
		<h3> <i class="far fa-calendar-alt"></i> 3 Months </h3> 
	</div>
 <div class="view-more">
	<button class="view" data-popup="pop1">View More </button>  
    <div class="application-status" id="status-${index}" style="color: green;"></div>
 </div>
</div>
</div>
<div class="popup" id="pop1">
        <button  class="close-btn"><i class="fa-solid fa-xmark"></i></button>
        <h4>About this internship</h4>
        <ul>
			<li> Enhance and customize the website. </li>
			<li> Add new features as per requirements </li>
			<li> Research and suggest system improvements. </li>
			<li> Work with the team to develop solution. </li>
            <li> hiring since December 2024 </li>
            <li> Start Immediately, Apply before may 26 </li>
		</ul>
        <h4>Skills Required</h4>
		<div class="skillsRequired" >
            <span>HTML and CSS</span>
            <span>JavaScript</span>
            <span>SEO</span>
        </div>
        <h4>Perks</h4>
        <ul>
			<li> Certification upon successful completion. </li>
			<li> Internship duration: <strong> 3 months </strong>.</li>
			<li> Hands-on experience in real world projects. </li>
			<li> Outstanding interns may recieve gift vouchers.</li>
		</ul>
		<h4> About Cloud Quest </h4>
		<p>
        <strong>Cloud Quest</strong> specializes in innovative cloud solutions.  
        We help businesses grow with seamless integration and advanced technologies.
    </p>
    <p>
        Our internship program offers hands-on experience in various fields.  
        We aim to foster talent and support career growth.
    </p>
        <button id="apply"> APPLY NOW  </button>
 </div>

    

    <form method="post" enctype="multipart/form-data" id="applyForm">
    <div class="container-apply">
       <button  class="resume-close-btn" type="button"><i class="fa-solid fa-xmark"></i></button>
       <p> Upload your resume </p>
       <div class="resume-upload">
           <input type="file" name="file">
       </div>
       
       <div class="resume-name">
           <label> Company: </label> <input type="varchar" name="company" id="company" readonly><br>
           <label> Internship: </label> <input type="varchar" name="internship" id="internship" readonly><br>
           <label> Fullname: </label> <input type="text" name="fname">  <br>
           <label> Email: </label> <input type="email" name="email">
       </div>
       <div class="resume-submit">
           <button type="submit" name="submit" id="submit-resume" > Submit </button>
       </div>
       </div>
   </form>

<!-- javascript -->
<script type="text/javascript">

document.addEventListener("DOMContentLoaded", function() {
    let form = document.getElementById("applyForm");

    if (form) {
        form.addEventListener("submit", function(event) {
            event.preventDefault(); 

            let formData = new FormData(this);

            fetch("", { 
                method: "POST",
                body: formData
            })
            .then(response => response.json()) 
            .then(data => {
                if (data.success) {
                   

                    
                    let internshipName = data.internship;

                    // Find the matching internship block and update status
                    let internships = document.querySelectorAll(".product");
                    internships.forEach(product => {
                        let name = product.getAttribute("data-name");
                        if (name === internshipName) {
                            let statusDiv = product.querySelector(".application-status");
                            if (statusDiv) {
                                statusDiv.textContent = "Applied ✅";
                                statusDiv.style.color = "green";
                            }
                        }
                    });
                } else {
                    alert("Error: " + data.message);
                }
            })
            .catch(error => {
                console.error("Error:", error);
                alert("An error occurred. Please try again.");
            });
        });
    } else {
        console.error("Error: Form element not found!");
    }
});

function toggleMenu() {
            var menu = document.getElementById("nav-menu");
            menu.classList.toggle("active");
        }


function search() {
let filter = document.getElementById('find').value.toUpperCase();
let item = document.querySelectorAll('.product');
let l = document.getElementsByTagName('h2');
for(var i = 0;i<=l.length;i++){
let a=item[i].getElementsByTagName('h2')[0];
let value=a.innerHTML || a.innerText || a.textContent;
if(value.toUpperCase().indexOf(filter) > -1) {
item[i].style.display="";
}
else
{
item[i].style.display="none";
}
}
}

//--------------------------- resume upload

document.addEventListener("DOMContentLoaded", function () {
    const fileInput = document.querySelector(".resume-upload input[type='file']");
    const fullNameInput = document.querySelector(".resume-name input[type='text']");
    const emailInput = document.querySelector(".resume-name input[type='email']");
    const submitButton = document.querySelector(".resume-submit button");

    fileInput.addEventListener("change", function (event) {
        const file = event.target.files[0];

        if (file) {
            if (file.type === "application/pdf") {
                extractTextFromPDF(file);
            } else if (file.name.endsWith(".docx")) {
                extractTextFromWord(file);
            } else {
                alert("Please upload a valid PDF or DOCX resume.");
            }
        }
    });

    // Function to extract text from PDF using PDF.js
    async function extractTextFromPDF(file) {
        const reader = new FileReader();
        reader.onload = async function () {
            const pdfData = new Uint8Array(this.result);
            const pdf = await pdfjsLib.getDocument({ data: pdfData }).promise;
            let text = "";

            for (let i = 1; i <= pdf.numPages; i++) {
                const page = await pdf.getPage(i);
                const content = await page.getTextContent();
                text += content.items.map(item => item.str).join(" ") + " ";
            }

            autofillDetails(text);
        };
        reader.readAsArrayBuffer(file);
    }

    
    function extractTextFromWord(file) {
        const reader = new FileReader();
        reader.onload = function (event) {
            const text = event.target.result;
            autofillDetails(text);
        };
        reader.readAsText(file);
    }

    
    function autofillDetails(text) {
    console.log("Extracted Text:", text); 

    
    const nameRegex = /Name:\s*([A-Za-z]+(?:\s[A-Za-z]+)?)/;
    const emailRegex = /Email:\s*([\w.-]+@[\w.-]+\.\w+)/;

    const foundName = text.match(nameRegex);
    const foundEmail = text.match(emailRegex);

    if (foundName) fullNameInput.value = foundName[1].trim();
    if (foundEmail) emailInput.value = foundEmail[1].trim();
}

submitButton.addEventListener("click", function () {
        alert(`Submitted! successfully`);

        



    });
});


// --------------------------------------- internship name into resume
document.addEventListener("DOMContentLoaded", function () {
    const viewButtons = document.querySelectorAll(".view");
    const InternshipInput = document.getElementById("internship");
    const companyInput = document.getElementById("company");


    viewButtons.forEach(button => {
        button.addEventListener("click", function () {
            const product = this.closest(".product"); 
            const internshipName = product.getAttribute("data-name"); 
            InternshipInput.value = internshipName; 
        
            const companyNameElement = product.querySelector(".cname"); 
            const companyName = companyNameElement ? companyNameElement.textContent.trim() : "";
            companyInput.value = companyName;
        });
    });
});
//...................................

async function fetchInternships() {
    try {
        let response = await fetch("backend.php"); 
        let internships = await response.json();
        displayInternships(internships); 
    } catch (error) {
        console.error("Error fetching internships:", error);
    }
}


function displayInternships(internships) {
    let container = document.querySelector(".product-list");
    container.innerHTML = ""; 

    if (internships.length === 0) {
        document.getElementById("no-results").style.display = "block";
        return;
    } else {
        document.getElementById("no-results").style.display = "none";
    }

    internships.forEach((internship, index) => {
        let productDiv = document.createElement("div");
        productDiv.classList.add("product");
        productDiv.setAttribute("data-name", internship.name);

        productDiv.innerHTML = `
        <h2>${internship.name}</h2><br/>
        <h3 class="cname"><i class="far fa-building"></i> ${internship.company} </h3><br/>
        <div class="inner">
            <h3><i class="fas fa-house-user"></i> ${internship.location}</h3><br/>
            <h3><i class="far fa-calendar-alt"></i> ${internship.duration}</h3><br/>
        </div>
        <div class="view-more">
            <button class="view" onclick="openPopup(${index})"> View More</button>
        </div>
        <div class="application-status" id="status-${index}" style="color: green;">Not Applied</div>
    `;

        
        let popupDiv = document.createElement("div");
        popupDiv.classList.add("popup");
        popupDiv.id = `popup-${index}`;
        popupDiv.style.display = "none"; 
       

        popupDiv.innerHTML = `
            <button class="close-btn" onclick="closePopup(${index})" type="button">
                <i class="fa-solid fa-xmark"></i>
            </button>
            <h4>About this internship</h4>
            <ul>
                <li>${internship.internshipDescription}</li>
                <li>Stipend: ${internship.stipend}</li>
                <li>Apply by ${new Date(internship.applyBy).toDateString()}</li>
            </ul>
            <h4>Skills Required</h4>
            <div class="skillsRequired">
                ${internship.skills.split(',').map(skill => `<span>${skill.trim()}</span>`).join(' ')}
            </div>
            <h4>Perks</h4>
            <ul>
                ${internship.perks.split(',').map(perk => `<li>${perk.trim()}</li>`).join('')}
                <li>Internship duration: <strong>${internship.internshipduration}</strong></li>
            </ul>
            <h4>About ${internship.companyName}</h4>
            <p>
                <strong>${internship.companyName}</strong> - ${internship.companyDescription}
            </p>
             <button id="apply" class="apply-btn" data-internship="${internship.name}" data-company="${internship.companyName}" data-index="${index}"> APPLY NOW </button>
        `;

        container.appendChild(productDiv);
        container.appendChild(popupDiv); 
    });
}


function openPopup(index) {
    document.getElementById(`popup-${index}`).style.display = "block";
}


function closePopup(index) {
    document.getElementById(`popup-${index}`).style.display = "none";
}
    


function applyFilters() {
    let selectedName = document.getElementById("filter-name").value.toLowerCase();
    let selectedDuration = document.getElementById("filter-duration").value.toLowerCase();
    let selectedSkill = document.getElementById("filter-skills").value.toLowerCase();

    fetch("backend.php")
        .then(response => response.json())
        .then(internships => {
            let filteredInternships = internships.filter(internship => {
                let nameMatch = selectedName ? internship.name.toLowerCase().includes(selectedName) : true;
                let durationMatch = selectedDuration ? internship.duration.toLowerCase().includes(selectedDuration) : true;
                let skillMatch = selectedSkill ? internship.skills.toLowerCase().includes(selectedSkill) : true;

                return nameMatch && durationMatch && skillMatch;
            });
            displayInternships(filteredInternships);     
        })
        .catch(error => console.error("Error fetching filtered internships:", error));
}

fetchInternships();
document.addEventListener("DOMContentLoaded", function () {
    fetchInternships(); 

    
    document.addEventListener("click", function (event) {
        if (event.target.classList.contains("apply-btn")) {
            let internshipName = event.target.getAttribute("data-internship");
            let companyName = event.target.getAttribute("data-company");

            document.getElementById("internship").value = internshipName;
            document.getElementById("company").value = companyName;

           

            
            document.querySelector(".container-apply").classList.add("active");
        }
    });

    
    document.querySelector(".resume-close-btn").addEventListener("click", function () {
        document.querySelector(".container-apply").classList.remove("active");
    });
});








</script>
</body>
</html>