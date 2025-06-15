<?php

include 'connect.php';

session_start();
if (!isset($_SESSION['email'])) {
    die("User not logged in. Please <a href='login.php'>login</a>.");
}

$user_email = $_SESSION['email'];  


$query = "SELECT * FROM profile WHERE email = '$user_email'";
$result = mysqli_query($conn, $query);
$user_data = mysqli_fetch_assoc($result);

if(isset($_POST['Save'])){
    $fullname = mysqli_real_escape_string($conn,$_POST['fullname']);
    $contact = mysqli_real_escape_string($conn,$_POST['contact']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $linkedIn = mysqli_real_escape_string($conn,$_POST['linkedIn']);
    $objective = mysqli_real_escape_string($conn,$_POST['objective']);
    $tskills = mysqli_real_escape_string($conn,$_POST['tskills']);
    $sskills = mysqli_real_escape_string($conn,$_POST['sskills']);
    $experience = mysqli_real_escape_string($conn,$_POST['experience']);
    $education = mysqli_real_escape_string($conn,$_POST['education']);
    $projects = mysqli_real_escape_string($conn,$_POST['projects']);
    $certificate = mysqli_real_escape_string($conn,$_POST['certificate']);
    $languages = mysqli_real_escape_string($conn,$_POST['languages']);
    $hobbies= mysqli_real_escape_string($conn,$_POST['hobbies']);


    if ($user_data) {
       
        $update = "UPDATE profile SET fullname='$fullname', contact='$contact', linkedIn='$linkedIn', objective='$objective',
                    tskills='$tskills', sskills='$sskills', experience='$experience', education='$education', 
                    projects='$projects', certificate='$certificate', languages='$languages', hobbies='$hobbies' 
                    WHERE email='$user_email'";
        $q = mysqli_query($conn, $update);
        if ($q) {
            $success = "Profile updated successfully";
        }
    } else {
        
        $insert = "INSERT INTO profile (fullname, contact, email, linkedIn, objective, tskills, sskills, experience, education, 
                    projects, certificate, languages, hobbies) VALUES ('$fullname', '$contact', '$user_email', '$linkedIn', 
                    '$objective', '$tskills', '$sskills', '$experience', '$education', '$projects', '$certificate', 
                    '$languages', '$hobbies')";
        $q = mysqli_query($conn, $insert);
        if ($q) {
            $success = "Profile saved successfully";
        }
    }
    $result = mysqli_query($conn, $query);
    $user_data = mysqli_fetch_assoc($result);


if (!isset($_SESSION['email'])) {
    die("User not logged in. Please <a href='login.php'>login</a>.");
}

$user_email = $_SESSION['email'];


$query = "SELECT image FROM profile WHERE email='$user_email'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $_SESSION['profileImage'] = $row['image']; 
}

if (isset($_POST['upload']) && isset($_FILES['profilePicture'])) {
    $email = $_SESSION['email']; 
    $file = $_FILES['profilePicture'];

    
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];
    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    
    $allowed = ['jpg', 'jpeg', 'png'];

    if (in_array($fileExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 5000000) { 
                $newFileName = uniqid('', true) . "." . $fileExt;
                $fileDestination = "uploads/" . $newFileName;

                
                move_uploaded_file($fileTmpName, $fileDestination);

                
                $checkImage = "SELECT image FROM profile WHERE email='$email'";
                $result = $conn->query($checkImage);

                if ($result->num_rows > 0) {
                    
                    $updateImage = "UPDATE profile SET image='$fileDestination' WHERE email='$email'";
                    $conn->query($updateImage);
                } else {
                    
                    $insertImage = "INSERT INTO profile (email, image) VALUES ('$email', '$fileDestination')";
                    $conn->query($insertImage);
                }

                $_SESSION['profileImage'] = $fileDestination; 
                header("Location: creatingPROFILE.php");
                exit();
            } else {
                echo "File size is too large!";
            }
        } else {
            echo "Error uploading the file!";
        }
    } else {
        echo "Invalid file type!";
    }
}
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['upload']) && isset($_FILES['profilePicture'])) {
        
        $file = $_FILES['profilePicture'];

        
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

       
        $allowed = ['jpg', 'jpeg', 'png'];

        if (in_array($fileExt, $allowed)) {
            if ($fileError === 0) {
                if ($fileSize < 5000000) { 
                    $newFileName = uniqid('', true) . "." . $fileExt;
                    $fileDestination = "uploads/" . $newFileName;

                    
                    move_uploaded_file($fileTmpName, $fileDestination);

                    
                    $checkImage = "SELECT image FROM profile WHERE email='$email'";
                    $result = $conn->query($checkImage);

                    if ($result->num_rows > 0) {
                        
                        $updateImage = "UPDATE profile SET image='$fileDestination' WHERE email='$email'";
                        $conn->query($updateImage);
                    } else {
                       
                        $insertImage = "INSERT INTO profile (email, image) VALUES ('$email', '$fileDestination')";
                        $conn->query($insertImage);
                    }

                    $_SESSION['profileImage'] = $fileDestination; 
                } else {
                    echo "File size is too large!";
                }
            } else {
                echo "Error uploading the file!";
            }
        } else {
            echo "Invalid file type!";
        }
    } elseif (isset($_POST['remove'])) {
        
        $removeImageQuery = "UPDATE profile SET image=NULL WHERE email='$email'";
        if ($conn->query($removeImageQuery) === TRUE) {
            unset($_SESSION['profileImage']); 
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>creating PROFILE</title>
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
        
        
        .menu-toggle {
            display: none; 
            font-size: 30px;
            cursor: pointer;
            color: #6A759F;
        }
        .form-container {
            margin-right: 5%;
			width: 58%;
            background: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
			max-height: 80vh; 
            overflow-y: auto; 
            padding-right: 10px; 
            box-shadow:0 20px 35px rgba(0,0,1,0.9);
        }
        
        .form-container input, .form-container textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: none; 
            border-bottom: 1px solid black; 
            font-size: 16px; 
            background-color: transparent; 
            color: black;
	        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2); 
            transition: border-bottom-color 0.3s ease; 
	        font-size: 18px;
	        font-weight: medium;
	        margin-bottom:12px;
        }
        .form-container input:focus, .form-container textarea:focus {
            outline: none; 
            border-bottom-color: blue; 
            box-shadow: 0 2px 5px rgba(0, 0, 255, 0.2);  
        }
        .form-container input:hover, .form-container textarea:hover {
            border-bottom-color: gray; 
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.5); 
        }
        section{
            color: rgb(89, 101, 145); 
            border-bottom: 3px solid rgb(89, 101, 145);
            padding-bottom: 5px;
            width: 270px;
            border-radius: 2px;
        }
        .form-container label {
            padding-bottom: 1px;
            margin-top: 4px;
	        margin-bottom: 2px;
            display: inline-block; 
	        letter-spacing: 0.05em;
	        font-size: 18px;
	        font-weight: bold;
	        line-height: 1.5em;
            color: rgb(79, 92, 142);;
        }

        button {
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
			padding-top: 13px;	
        }

        input[type="submit"].btn {
	        background-color: rgb(89, 101, 145);
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
			min-width: 100px;
			max-width: 4px;
			margin-right: 15px;	
        }
        input[type="submit"].btn:hover{
	        background-color:rgb(68, 39, 117);
        }


		#resume {
            margin-top: 50px;
            padding: 20px;
            border: 2px solid #007bff;
            border-radius: 5px;
            background-color: #f9f9f9;
	        margin-left: 20%;
	        margin-right: 20%;
	        box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.2);
	        width: 60%;
	        display: none;
        }
	
	    #resume h2 {
            text-align: center; 
            color: #007bff; 
        }

        #resume p {
            margin: 10px 0; 
            line-height: 2.0; 
            color: #333; 
	        padding-left: 40px;
	        padding-right: 40px;
        }
        #resume strong{
	        font-size: 18px;
        }
	    #resume span{
		    font-size: 17px;
		    padding-left: 10px;
	    }
	
        .download-btn {
            text-align: center;
            margin-top: 20px; 
        }
        .download-btn button {
            background-color: rgb(89, 101, 145);
            color: white; 
            padding: 10px 20px; 
            border: none; 
            border-radius: 5px;
            cursor: pointer; 
            transition: background-color 0.3s; 
            font-size:17px;
        }
        .download-btn button:hover{
            background-color:rgb(68, 39, 117);
        }

		/*----main container-------------------------*/
		.main-container{
			display: flex;
			justify-content: space-between;
			margin-top: 120px;
			
			 }
		/*-------------  left container----------- */
		.left-container {
            width: 30%;
            margin-left: 5%;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
			max-height: 80vh; 
            overflow-y: auto; 
            padding-right: 10px; 
        }
		
		/* Custom scrollbar styles */
        .left-container::-webkit-scrollbar,
        .form-container::-webkit-scrollbar  {
            width: 8px; 
            height: 8px; 
        }

        .left-container::-webkit-scrollbar-thumb, 
        .form-container::-webkit-scrollbar-thumb {
            background-color: #d3d3d3; 
            border-radius: 5px; 
        }

        .left-container::-webkit-scrollbar-thumb:hover,
        .form-container::-webkit-scrollbar-thumb:hover  {
            background-color: #bbb; 
        }

        .left-container::-webkit-scrollbar-track,
        .form-container::-webkit-scrollbar-track {
            background-color: #f5f5f5; 
            border-radius: 5px;
        }
		
        .lbutton{
            display: block;
            width: fit-content;
            margin: 1px auto;
            text-decoration: none;
            color:rgb(32, 42, 79);
            padding: 5px 20px;
            text-align: center;
            transition: all 0.3s ease-in-out; 
            border-bottom: 2px solid transparent;
            font-family: "Playfair Display", serif;
            font-optical-sizing: auto;
            font-weight: 600;
            font-style: normal;
            font-size:19px;
        }
        .lbutton:hover{
            border: none;
            color: rgb(89, 58, 166);
            font-weight: bold;
            cursor: pointer;
            border-radius: 12px;
            border-bottom: 2px solid black;
        }

        .form {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;   
        }

        .form img {
            width: 150px; 
            height: 150px;
            border-radius: 50%;  
            object-fit: cover;  
            border: 3px solid #e0e0e0; 
            max-width: 100%;
            max-height: 100%;
            background-color: #E0E0E0; 
            transition: background-color 0.3s ease, border-color 0.3s ease;
            color: #333; 

        }

        .form input {
            margin-top: 10px;
        }
        .form img:before {
        content: attr(alt); 
        color: white;
        font-size: 14px;
        font-weight: bold;
        text-align: center;
        position: absolute;
        width: 100%;
        padding: 10px;
        background-color: rgba(0, 0, 0, 0.7);
        border-radius: 10px;
        display: none;
    }
    #profilePicture{       
        margin: 8px;
        padding: 10px; 
        padding: 10px 50px;
        font-size: 15px;
        border: 2px dashed #ccc; 
        border-radius: 10px; 
        background-color: #f9f9f9; 
        color: #333; 
        text-align: center; 
        cursor: pointer; 
        transition: background-color 0.3s ease, border-color 0.3s ease; 
    }
      
    #profilePicture:hover {
        background-color: #e6f7ff; 
        border-color: #007bff; 
    }

    .button-container {
        display: flex;
        gap: 10px;
        margin-top: 10px;
    }

    .button-container button {
        padding: 10px 10px;
        border: none;
        color: black;
        font-weight: bold;
        cursor: pointer;
        border-radius: 10px;
        font-size: 15px;
        border-bottom: 2px solid black;
    }

    .button-container button:hover {
        background-color:rgb(79, 92, 142);
        box-shadow: 3px 3px 5px rgba(0, 0, 0, 0.3), 
        -3px 0px 5px rgba(0, 0, 0, 0.2);
        color:white;
    }

    html {
        scroll-behavior: smooth;
    }
    html {
        scroll-padding-top: 390px; 
    }

    </style>
</head>
<body>
    
<nav class="nav">
    <div class="container">
        <h1 class="logo"> <img src="https://th.bing.com/th/id/OIP.j8p1rUWK9cS_n34LM4czIAAAAA?rs=1&pid=ImgDetMain"> </h1>
        <span class="menu-toggle" onclick="toggleMenu()">&#9776;</span>
        <ul id="nav-menu">
            <li> <a href="LHome.php">Home</a></li>
            <li> <a href="internshiplogin.php">Internship</a></li>
            <li> <a href="mocktest/Lmocktest.html">Test</a></li>
            <li> <a href="Lcontact.php">Contact</a></li>
            <li> <a href="#" class="current"> Profile </a></li>
            <li> <a href="logout.php"> Logout </a></li>
        </ul>
    </div>
</nav>

	
	<div class="main-container">
	<!-- input left container -->
	<div class="left-container">
		 <!-- Profile Picture -->
        <div class="image-container">
        <form action="" method="post" enctype="multipart/form-data" class="form">
        <img id="imagePreview" 
             src="<?php echo isset($_SESSION['profileImage']) ? $_SESSION['profileImage'] : 'https://via.placeholder.com/150?text=Person'; ?>" 
             >   
        <input type="file" name="profilePicture" id="profilePicture" accept="image/*" onchange="previewImage()">
	    
        <div class="button-container"> 
            <button type="submit" name="upload">Upload Image</button>
            <button type="submit" name="remove">Remove Image</button>
            <div class="gb"> <button id="generate" class="gbutton" type="button">Generate Resume</button>  </div>
        </div>
       
        </form>
			<br>
			<a href="#Pd" class="lbutton"> <h2> Personal Details </h2></a>
			<a href="#Summary" class="lbutton"> <h2> Summary </h2></a>
			<a href="#Skills" class="lbutton"> <h2> Skills </h2></a>
			<a href="#Work" class="lbutton"> <h2> Work Experience </h2></a>
			<a href="#Education" class="lbutton"> <h2> Education </h2></a>
			<a href="#Projects" class="lbutton"> <h2> Projects </h2></a>
			<a href="#Certificate" class="lbutton"> <h2> Certificates </h2></a>
			<a href="#Hobbies" class="lbutton"> <h2> Hobbies and Interests </h2></a>
			<a href="#Language" class="lbutton"> <h2> Languages </h2></a>
		</div>
	</div>

    <!-- Input Form -->
	
    <div class="form-container">
      <form method="post" action=" ">
		<section id="Pd"> <h2> Personal Details </h2> </section> <br> 
			<label>Full Name:</label>
			<input type="text" id="name" placeholder="Enter your full name" name="fullname" value="<?= $user_data['fullname'] ?? '' ?>">  

			<label>Contact Number:</label>
			<input type="text" id="contact" placeholder="Enter your contact information" name="contact" value="<?= $user_data['contact'] ?? '' ?> ">

			
			<label>Email Address:</label>
			<input type="email" id="email" placeholder="Enter your email address" name="email" value="<?= $user_data['email'] ?? '' ?>">

			
			<label>LinkedIn Profile:</label>
			<input type="text" id="LinkedIn" placeholder="Enter your contact information" name="linkedIn" value="<?= $user_data['linkedIn'] ?? '' ?>">

		<br> <br>  
		<section id="Summary"> <h2> Career Objective </h2> </section> <br> <br>
			<label> Brief overview of skills, achivements, goals, strengths, experiences </label>
			<textarea id="summary" rows="3" placeholder="write summary.. " name="objective" ><?= $user_data['objective'] ?? '' ?> </textarea>

		<br>  <br>
		<section id="Skills"> <h2> Skills </h2> </section> <br> <br>
			<label>Technical Skills:</label>
			<textarea id="Tskills" rows="2" placeholder="Enter your Technical skills" name="tskills"><?= $user_data['tskills'] ?? '' ?></textarea>
			
			<label>Soft Skills:</label>
			<textarea id="Sskills" rows="2" placeholder="Enter your Soft skills" name="sskills" ><?= $user_data['sskills'] ?? '' ?></textarea>

		<br> <br> 
		<section id="Work"> <h2> Work Experience </h2> </section>  <br> <br>
			 <label> Enter job/Internship name, company name, duration, responsibilities.</label>
			<textarea id="experience" rows="3" placeholder="enter here.." name="experience" ><?= $user_data['experience'] ?? '' ?></textarea>

		<br>  <br>
		<section id="Education"> <h2> Education </h2> </section><br> <br>
			<label> Institute name, Degree name, graduation year, percentage </label>
			<textarea id="education" rows="3" placeholder="Enter here.." name="education"><?= $user_data['education'] ?? '' ?></textarea>
		
		<br>  <br>
		<section id="Projects"> <h2> Projects </h2> </section><br> <br>
			<label>Enter Project name, role in project, tools/technologies used, Brief Description and achivements</label>
			<textarea id="projects" rows="3" placeholder="Enter here.." name="projects"><?= $user_data['projects'] ?? '' ?></textarea>

       <br>  <br>
	   <section id="Certificate"><h2> Certification Details </h2></section> <br> <br> 
			<label>Certification name, Issuing organization, Date of completion </label>
			<textarea id="Certificates" rows="3" placeholder="Enter here.." name="certificate" ><?= $user_data['certificate'] ?? '' ?></textarea>

		<br>  <br>
		<section id="Hobbies"> <h2>  Hobbies and Interests </h2> </section><br> <br>
			<label> Relevant hobbies showcasing your personalities  </label>
			<textarea id="hobbies" rows="3" placeholder="Enter here.." name="hobbies" ><?= $user_data['hobbies'] ?? '' ?></textarea>

		<br>   <br>
		<section id="Language"><h2> Languages </h2> </section><br> <br>
			 <label> Languages spoken/Written</label>
			<textarea id="language" rows="3" placeholder="Enter here.." name="languages"><?= $user_data['languages'] ?? '' ?></textarea>

        <div class="sb"> <input type="submit" class="btn" value="Save" name="Save"/> </div>

	</form>
    </div>
</div>
	
    <div id="resume" >
			<h2> Resume </h2>
            <p><strong>Name:</strong> <span id="rName"></span></p>
            <p><strong>Contact:</strong> <span id="rContact"></span></p>
            <p><strong>Email:</strong> <span id="rEmail"></span></p>
             <p><strong>LinkedIn:</strong> <span id="rLinkedIn"></span></p>
            <p><strong>Summary:</strong> <span id="rSummary"></span></p>
		<p> <strong> Skills: </strong></p>
            <p><strong>Technical Skills:</strong> <span id="rTskills"></span></p>
            <p><strong>Soft Skills:</strong> <span id="rSskills"></span></p>
            <p><strong>Experience:</strong> <span id="rExperience"></span></p>
            <p><strong>Education:</strong> <span id="rEducation"></span></p>
            <p><strong>Projects:</strong> <span id="rProjects"></span></p>
            <p><strong>Certificates:</strong> <span id="rCertificates"></span></p>
            <p><strong>Hobbies:</strong> <span id="rHobbies"></span></p>
            <p><strong>Languages:</strong> <span id="rLanguages"></span></p>
        
            <!-- Download Button -->
            <div class="download-btn">
				<button id="download">Download Resume</button>
        </div>
    </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

<script>
    function previewImage() {
        var file = document.getElementById("profilePicture").files[0];
        var reader = new FileReader();
    
        reader.onload = function(event) {
            document.getElementById("imagePreview").src = event.target.result;
        };
    
        if (file) {
            reader.readAsDataURL(file);
        }
    } 
    
    const { jsPDF } = window.jspdf;
		
	  
    document.getElementById("generate").addEventListener("click", function() {
		console.log("Checking name field: ", document.getElementById("name"));
	    const fullName = document.getElementById("name")?.value || "No Name Entered";
        console.log("Entered Name: ", fullName);
	    const contact = document.getElementById("contact").value;
        const email = document.getElementById("email").value;
	    const LinkedIn = document.getElementById("LinkedIn").value;
	    const summary = document.getElementById("summary").value;
	    const Tskills = document.getElementById("Tskills").value;
	    const Sskills = document.getElementById("Sskills").value;
	    const experience = document.getElementById("experience").value;
	    const education = document.getElementById("education").value;
	    const projects = document.getElementById("projects").value;
        const Certificates = document.getElementById("Certificates").value;
        const languages = document.getElementById("language").value;
	    const hobbies = document.getElementById("hobbies").value;

      // Display values in the resume preview
      document.getElementById("rName").innerText = fullName;
	  document.getElementById("rContact").innerText = contact;
      document.getElementById("rEmail").innerText = email;
      document.getElementById("rLinkedIn").innerText = LinkedIn;
      document.getElementById("rSummary").innerText = summary;
      document.getElementById("rTskills").innerText = Tskills;
	  document.getElementById("rSskills").innerText = Sskills;
	  document.getElementById("rExperience").innerText = experience;
	  document.getElementById("rEducation").innerText = education;
	  document.getElementById("rProjects").innerText = projects;
	  document.getElementById("rCertificates").innerText = Certificates;
	  document.getElementById("rLanguages").innerText = languages;
	  document.getElementById("rHobbies").innerText = hobbies;

      // Show the resume preview
      document.getElementById("resume").style.display = "block";
    });
	
    document.getElementById("download").addEventListener("click", function() {
      const doc = new jsPDF();
      doc.setFontSize(12);  
	  
	const fullname = document.getElementById("rName").innerText;
	const contact = document.getElementById("rContact").innerText;
    const email = document.getElementById("rEmail").innerText;
    const linkedIn = document.getElementById("rLinkedIn").innerText;
    const summary = document.getElementById("rSummary").innerText;
    const tskills = document.getElementById("rTskills").innerText;
	const sskills = document.getElementById("rSskills").innerText;
	const experience = document.getElementById("rExperience").innerText;
	const education = document.getElementById("rEducation").innerText;
	const projects = document.getElementById("rProjects").innerText;
	const certificates = document.getElementById("rCertificates").innerText;
	const languages = document.getElementById("rLanguages").innerText;
	const hobbies = document.getElementById("rHobbies").innerText;
		

doc.setFont("helvetica", "bold");
doc.setFontSize(18);
 doc.setTextColor(0, 0, 255);
doc.text("Resume", 105, 12, null, null, "center");
 

doc.setLineWidth(0.5);
doc.line(10, 20, 200, 20);


doc.setFont("times", "normal");
doc.setFontSize(16);


function addSection(title, content, yPos) {
    doc.setFont("times", "bold");
    doc.setTextColor(0, 0, 255); 
    doc.text(title, 10, yPos);
    
	doc.setFont("times", "normal");
    doc.setTextColor(0, 0, 0); 
    
	const textWidth = 130;
	const wrappedContent = doc.splitTextToSize(content, textWidth);
	
	doc.text(wrappedContent, 50, yPos);
    	
    return yPos + wrappedContent.length * 6 + 4; 
}


let yPos = 30;
const sectionSpacing = 10; 


yPos = addSection("Name:", fullname, yPos);
yPos = addSection("Contact:", contact, yPos);
yPos = addSection("Email:", email, yPos);
yPos = addSection("LinkedIn:", linkedIn, yPos);
yPos += sectionSpacing;


yPos = addSection("Summary:", summary, yPos);
yPos += sectionSpacing;

doc.setFont("times","bold");
doc.setTextColor(0, 0, 255);
doc.text("skills:", 10, yPos);
yPos += sectionSpacing;

yPos = addSection("Technical:", tskills, yPos);

yPos = addSection("Soft:", sskills, yPos);
yPos += sectionSpacing;

yPos = addSection("Experience:", experience, yPos);
yPos += sectionSpacing;

yPos = addSection("Education:", education, yPos);
yPos += sectionSpacing;

yPos = addSection("Projects:", projects, yPos);
yPos += sectionSpacing;

yPos = addSection("Certificates:", certificates, yPos);
yPos += sectionSpacing;

yPos = addSection("Languages:", languages, yPos);
yPos += sectionSpacing;

yPos = addSection("Hobbies:", hobbies, yPos);
	  

doc.save("resume.pdf");
    });
	

    document.querySelectorAll('.lbutton').forEach(button => {
         button.addEventListener('click', function(event) {
                event.preventDefault(); 
                const targetId = this.getAttribute('href').substring(1); 
                const targetElement = document.getElementById(targetId);
        if (targetElement) {
            targetElement.scrollIntoView({ behavior: "smooth", block: "start" });
        }
    });
});


<?php if (isset($_SESSION['email'])) { ?>
        localStorage.setItem("userEmail", "<?php echo $_SESSION['email']; ?>");
    <?php } ?>

    </script>
</body>
</html>
