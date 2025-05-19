<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mock Test</title>
    <link rel="stylesheet" href="test.css">
    <!-- <script src="https://kit.fontawesome.com/a076d05399.js"></script> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
   
<style>
    
.firstsection,
.secondsection,
.thirdsection,
.fourthsection,
.fifthsection,
.sixthsection,
.seventhsection,
.eightsection,
.ninesection,
.tensection,
.elevensection,
.twelvesection,
.thirteensection{
    display: inline-block;
    background: white;
    border-color: 2px solid rgb(246, 215, 215);
    margin-top: 10px;
    /*  to reduce the space between the div tag */
    height: 120px;
    width: 1200px;
    margin-left: 0px;
    border-radius: 8px;
    position: relative;
    /* so that button appears in the next div also*/
}

.secondsection,
.thirdsection,
.fourthsection,
.fifthsection,
.sixthsection,
.seventhsection,
.eightsection,
.ninesection,
.tensection,
.elevensection,
.twelvesection,
.thirteensection {
    margin-top: 50px;
}

    </style>
</head>
<body>


<!-- nav bar -->
<nav class="nav">
    <div class="container">
        <h1 class="logo"> <img src="images/logo.jpg"> </h1>
        <span class="menu-toggle" onclick="toggleMenu()">&#9776;</span>
        <ul id="nav-menu">
            <li> <a href="home.html" class="home.html">Home</a></li>
            <li> <a href="internship.html">Internship</a></li>
            <li> <a href="" class="current">Test</a></li>
            <li> <a href="contact.php">Contact</a></li>
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
            <option value=""> Select Test </option>
            <option value="Aptitude"> Aptitude </option>
            <option value="Verbal"> Verbal </option>
            <option value="Verbal Reasoning">verbal Reasoning</option>
            <option value="General Knowledge"> General Knowledge </option>
        </select>
        
        <select id="filter-type">
            <option value=""> test type </option>
            <option value="Logical Reasoning"> Logical Reasoning</option>
            <option value="Data Structure">Data Structure</option>
            <option value="Synonyms">Synonyms</option>
            <option value="Antonyms">Antonyms</option>
            <option value="Selecting Words">Selecting Words</option>
            <option value="Basic GK">Basic GK</option>
            <option value="Simple Interest">Simple Interest</option>
        </select>
        
        <button onclick="applyFilters()"> Apply Filter </button>
        <div id="no-results" style="display:none;">No Test found.</div>
    
    </div>
    

    <!-- <div class="cr" id="mainbox"> -->
        <div class="nbar">
    <div class="firstsection" data-name="Aptitude" data-type="Logical Reasoning">
        <table>
            <tr>
                <th> Aptitude test </th>
                <th class="type">Type: Logical reasoning </th>
            </tr>
            <tr>
                <td> total 5 Ques</td>
                <td> Duration: 5min </td>
            </tr>
        </table>
    <!-- start quiz button  -->
     <!-- <a href="http://www.example.com" target="_blank"> -->
    <div class="start_btn"> <button onclick="window.location.href='login.php';"> Start Test</button></div>

</div>  <!-- div 1st class close -->
</div>

 <!-- <div class="cr" id="mainbox"> -->
    <div class="nbar">
    <div class="secondsection" data-name="Aptitude" data-type="Data structure">
        <table>
            <tr>
                <th data-name="Aptitude"> Apptitude test </th>
                <th class="type" data-type="Data Structure"> Type: Data Structure </th>
            </tr>
            <tr>
                <td> total 5 Ques</td>
                <td> Duration: 5min </td>
            </tr>
        </table>
    <!-- start quiz button  -->
     <!-- <a href="http://www.example.com" target="_blank"> -->
    <div class="start_btn"> <button onclick="window.location.href='login.php';"> Start Test</button></div>
	</div>  <!-- div 1st class close -->
</div>

<!-- section 5-->
<div class="nbar">
    <div class="fifthsection" data-name="Verbal" data-type="Synonyms">
        <table>
            <tr>
                <th> Verbal Test </th>
                <th class="type"> Type: Synonyms </th>
            </tr>
            <tr>
                <td> total 5 Ques</td>
                <td> Duration: 5min </td>
            </tr>
        </table>
    <!-- start quiz button  -->
     <!-- <a href="http://www.example.com" target="_blank"> -->
    <div class="start_btn"> <button onclick="window.location.href='login.php';"> Start Test</button></div>
	</div>  <!-- div 1st class close -->
</div>
<!-- -->

<!-- section 4-->
<div class="nbar">
    <div class="sixthsection" data-name="Verbal" data-type="Antonyms">
        <table>
            <tr>
                <th> Verbal Test</th>
                <th class="type"> Type: Antonyms </th>
            </tr>
            <tr>
                <td> total 5 Ques</td>
                <td> Duration: 5min </td>
            </tr>
        </table>
    <!-- start quiz button  -->
     <!-- <a href="http://www.example.com" target="_blank"> -->
    <div class="start_btn"> <button onclick="window.location.href='login.php';"> Start Test</button></div>
	</div>  <!-- div 1st class close -->
</div>
<!-- -->

<!-- section 4-->
<div class="nbar">
    <div class="seventhsection" data-name="Verbal" data-type="Selecting Words">
        <table>
            <tr>
                <th> Verbal Test</th>
                <th class="type"> Type: Selecting Words </th>
            </tr>
            <tr>
                <td> total 5 Ques</td>
                <td> Duration: 5min </td>
            </tr>
        </table>
    <!-- start quiz button  -->
     <!-- <a href="http://www.example.com" target="_blank"> -->
    <div class="start_btn"> <button onclick="window.location.href='login.php';"> Start Test</button></div>
	</div>  <!-- div 1st class close -->
</div>
<!-- -->

<!-- section 4-->
<div class="nbar">
    <div class="eightsection" data-name="Verbal Reasoning" data-type="Series Completion">
        <table>
            <tr>
                <th> Verbal Reasoning </th>
                <th class="type"> Type: Series Completion </th>
            </tr>
            <tr>
                <td> total 5 Ques</td>
                <td> Duration: 5min </td>
            </tr>
        </table>
    <!-- start quiz button  -->
     <!-- <a href="http://www.example.com" target="_blank"> -->
    <div class="start_btn"> <button onclick="window.location.href='login.php';"> Start Test</button></div>
	</div>  <!-- div 1st class close -->
</div>
<!-- -->

<!-- section 4-->
<div class="nbar">
    <div class="ninesection" data-name="Verbal Reasoning" data-type="Analogy">
        <table>
            <tr>
                <th> Verbal Reasoning </th>
                <th class="type"> Type: Analogy </th>
            </tr>
            <tr>
                <td> total 5 Ques</td>
                <td> Duration: 5min </td>
            </tr>
        </table>
    <!-- start quiz button  -->
     <!-- <a href="http://www.example.com" target="_blank"> -->
    <div class="start_btn"> <button onclick="window.location.href='login.php';"> Start Test</button></div>
	</div>  <!-- div 1st class close -->
</div>
<!-- -->

<!-- section 4-->
<div class="nbar">
    <div class="tensection" data-name="Verbal Reasoning" data-type="Verification of Truth">
        <table>
            <tr>
                <th> Verbal Reasoning </th>
                <th class="type"> Type: Verification of Truth </th>
            </tr>
            <tr>
                <td> total 5 Ques</td>
                <td> Duration: 5min </td>
            </tr>
        </table>
    <!-- start quiz button  -->
     <!-- <a href="http://www.example.com" target="_blank"> -->
    <div class="start_btn"> <button onclick="window.location.href='login.php';"> Start Test</button></div>
	</div>  <!-- div 1st class close -->
</div>
<!-- -->


<!-- section 4-->
<div class="nbar">
    <div class="elevensection" data-name="General Knowledge" data-type="Basic GK">
        <table>
            <tr>
                <th> General Knowledge </th>
                <th class="type"> Type: Basic GK section 1</th>
            </tr>
            <tr>
                <td> total 5 Ques</td>
                <td> Duration: 5min </td>
            </tr>
        </table>
    <!-- start quiz button  -->
     <!-- <a href="http://www.example.com" target="_blank"> -->
    <div class="start_btn"> <button onclick="window.location.href='login.php';"> Start Test</button></div>
    <div id="score_display_11" class="dbtn"></div> 
	</div>  <!-- div 1st class close -->
</div>
<!-- -->



<!-- section 4-->
<div class="nbar">
    <div class="thirteensection" data-name="Aptitude" data-type="Simple Interest">
        <table>
            <tr>
                <th> Aptitude </th>
                <th class="type"> Type: Simple Interest </th>
            </tr>
            <tr>
                <td> total 5 Ques</td>
                <td> Duration: 5min </td>
            </tr>
        </table>
    <!-- start quiz button  -->
     <!-- <a href="http://www.example.com" target="_blank"> -->
    <div class="start_btn"> <button onclick="window.location.href='login.php';"> Start Test</button></div>
    <div id="score_display_11" class="dbtn"></div> 
	</div>  <!-- div 1st class close -->
</div>
<!-- -->



</div>
</div>

<script type="text/javascript">
    function toggleMenu() {
            var menu = document.getElementById("nav-menu");
            menu.classList.toggle("active");
        }
    function search() {
        let filter = document.getElementById('find').value.toUpperCase();
        let items = document.querySelectorAll('.nbar'); // Get all sections
        let types = document.querySelectorAll('.type'); // Get type fields
    
        for (let i = 0; i < types.length; i++) {
            let value = types[i].innerText || types[i].textContent;
            
            if (value.toUpperCase().indexOf(filter) > -1) {
                items[i].style.display = ""; // Show the matching item
            } else {
                items[i].style.display = "none"; // Hide non-matching items
            }
        }
    }

    //filter bar

    function applyFilters() {
        let selectedName = document.getElementById("filter-name").value.toLowerCase();
        let selectedType = document.getElementById("filter-type").value.toLowerCase();
        
        let tests = document.querySelectorAll(".nbar > div"); // Selects all test sections
        
        let matchFound = false;
    
        tests.forEach(test => {
            let name = test.getAttribute("data-name").toLowerCase();
            let type = test.getAttribute("data-type").toLowerCase();
    
            let nameMatch = selectedName === "" || name.includes(selectedName);
            let typeMatch = selectedType === "" || type.includes(selectedType);
    
            if (nameMatch && typeMatch) {
                test.style.display = "block"; // Show matching test
                matchFound = true;
            } else {
                test.style.display = "none"; // Hide non-matching test
            }
        });
    
        document.getElementById("no-results").style.display = matchFound ? "none" : "block";
    }
    


</script>

      <script src="mocktestjs/mocktest.js"></script>
      <script src="mocktestjs/question.js"></script>
</body>
</html>