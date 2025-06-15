<?php
include 'connect.php';


$query = "SELECT COUNT(*) AS total_users FROM users";
$result = mysqli_query($conn, $query)  or die("Query Failed: " . mysqli_error($conn));
$row = mysqli_fetch_assoc($result);
$totalUsers = $row['total_users'];


$internship_query = "SELECT COUNT(*) AS total_internship FROM internships";
$internship_result = mysqli_query($conn, $internship_query);
$internship_row = mysqli_fetch_assoc($internship_result);
$totalInternship = $internship_row['total_internship'];


$submit_query = "SELECT COUNT(*) AS total_submit FROM resubmit";
$submit_result = mysqli_query($conn, $submit_query);
$submit_row = mysqli_fetch_assoc($submit_result);
$totalresubmit = $submit_row['total_submit'];


$contact_query = "SELECT * FROM contact ORDER BY submitted_at DESC";
$contact_result = mysqli_query($conn, $contact_query);

$sql = "SELECT fullname, email, company, internship, file FROM resubmit"; // Change to your table name
$form_result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Internship</title>
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap');

    body {
        font-family: 'Arial', sans-serif;
        background: linear-gradient(to right, #b0b8d9, #6A759F);
        height: 100vh;
        margin: 0;
        padding: 0;
        display: flex;
        overflow: hidden;
    }

    /* left container ----------------------------------------*/
    .left-container {
        width: 280px;
        background-color: #333;
        color: white;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding-top: 40px;
        position: fixed;
        height: 100vh;
        padding-right: 30px;
        overflow: hidden;
    }

    .left-container .admin {
        font-size: 24px;
        color: #f18930;
        margin-bottom: 80px;
        font-size: 33px;
    }

    .left-container ul {
        list-style-type: none;
        padding: 0;
        width: 100%;
    }

    .left-container ul li {
        padding: 15px;
        margin-bottom: 30px;
        width: fit-content;
        text-align: left;
        cursor: pointer;
        transition: color 0.3s ease, border-bottom 0.3s ease;
        font-size: 21px;
        font-weight: bold;
        letter-spacing: 0.07rem;
        position: relative;
    }

    .left-container ul li a {
        text-decoration: none;
        color: white;

    }

    .left-container .logout {
        color: white;
        text-decoration: none;
    }

    
    .left-container ul li a::after {
        content: "";
        position: absolute;
        left: 0;
        bottom: 5px;
        width: 0;
        height: 3px;
        background-color: #f18930;
        transition: width 0.3s ease;
    }

    .left-container ul li a:hover {
        color: #f18930;
    }

    .left-container ul li a:hover::after {
        width: 100%;
    }

    /* dashboard---------------------------------------------- */
    .dashboard-container {
        display: flex;
        gap: 20px;
        margin-top: 30px;
        flex-wrap: wrap;
        margin-left: 20%;
        margin-bottom: 18%;
        max-width: 100%;
        overflow-x: hidden;
        overflow-y: hidden;
    }

    
    .dashboard-title {
        display: flex;
        flex-direction: row;
        justify-content: center;
        margin-right: 800px;
        margin-bottom: 50px;
        margin-left: 50px;
        letter-spacing: 0.1rem;
        font-size: 18px;
        color: rgb(27, 7, 107);
    }

   
    .user-count {
        text-align: center;
        background: linear-gradient(135deg, #ffffff, #f8f9fa);
        color: white;
        padding: 20px;
        margin: 30px;
        max-width: 70%;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        display: flex;
        overflow: hidden;
        margin-left: 80px;
        height: 90px;
    }

    .user-count:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.2);
    }

    .user-count h2 {
        font-size: 57px;
        margin: 0;
        font-weight: bold;
        padding-bottom: 1px;
        color: rgb(27, 7, 107);
        padding: 0% 12%;
    }

    .user-count p {
        font-size: 25px;
        font-weight: 600;
        margin-top: 22px;
        padding-left: 5%;
        color: rgb(27, 7, 107);
        ;
    }

    .user-count::before {
        content: "";
        position: absolute;
        top: -50px;
        right: -50px;
        width: 100px;
        height: 100px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        transform: rotate(30deg);
    }

    
    .user-count .icon {
        font-size: 50px;
        margin: 0px 50px;
        margin-bottom: 10px;

    }

    .content-container {
        width: 100%;
    }

    /* internship container---------------------.................................... */
    .internship-container {
        padding-top: 3%;
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
        width: 100%;
        max-width: 100%;
        overflow-x: hidden;

    }

    .internship-title {
        color: rgb(27, 7, 107);
        font-size: 37px;
        letter-spacing: 0.1rem;
        margin: 0;
        font-weight: bold;
        align-self: flex-start;
        text-align: left;
        width: 100%;
        padding-bottom: 10px;
        margin-left: 30%;
    }

    .input-internship {
        background: #fff;
        padding: 40px 20%;
        padding-top: 20px;
        padding-right: 10%;
        max-width: 450px;
        margin: 20px auto;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-left: 400px;
        z-index: 1000;
        overflow: auto;
        max-height: 470px;
    }

    .input-group label {
        font-weight: bold;
        display: block;
        margin-top: 10px;
        margin: 20px 10px;
        color: rgb(27, 7, 107);
        margin-left: -270px;
        margin-right: 50px;
        width: 150px;
        font-size: 20px;
        line-height: 1.7rem;
        font-family: "Playfair Display", serif;
        font-optical-sizing: auto;
        font-weight: 600;
        font-style: normal;

    }

    .input-group input,
    .input-group textarea {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border: none;
        border-bottom: 2px solid rgb(27, 7, 107);
        box-sizing: border-box;
        flex: 1;
        background-color: transparent;
        color: black;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
        transition: border-bottom-color 0.3s ease;
        font-size: 19px;
        font-weight: medium;
        margin-bottom: 12px;
        width: 500px;
        font-family: "Playfair Display", serif;
        font-optical-sizing: auto;
        font-weight: 600;
        font-style: normal;
    }


    .input-group input:focus,
    .input-group textarea:focus {
        outline: none;
        border-bottom-color: blue;
        box-shadow: 0 2px 5px rgba(0, 0, 255, 0.2);
    }

    .input-group input:hover,
    .input-group textarea:hover {
        border-bottom-color: gray;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.5);
    }

    textarea {
        resize: none;
    }

    .popup h3,
    .popup h4 {
        color: #444;
        margin-bottom: 10px;
    }

    #add {
        background-color: #28a745;
        color: white;
        border: none;
        padding: 12px;
        width: 100%;
        margin-top: 15px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 19px;
        font-weight: bold;
        transition: 0.3s;
    }

    #add:hover {
        background-color: #218838;
    }

    
    .input-group {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    /*....................contact.........*/

    .message-title {
        text-align: center;
        margin-top: 3%;
        color: rgb(27, 7, 107);
        font-size: 33px;
        letter-spacing: 0.1rem;
        margin-left: -300px;
        margin-bottom: 3%;
    }

    table {
        width: 65%;
        border-collapse: collapse;
        background: white;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        word-break: break-word;
        margin-left: 26%;
        border: 1px solid #333;
    }

    th,
    td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ddd;
        border: 1px solid #333;
    }

    th {
        background-color: #28a745;
        color: white;
        text-align: center;
        padding: 15px 0px;
        font-size: 18px;
        letter-spacing: 0.04rem;
    }

    tr:hover {
        background-color: #f1f1f1;
    }


    .content-container>div {
        display: none;
    }

    #dashboard {
        display: block;
    }

    .logout {
        padding: 10px 25px;
        border-radius: 20px;
        font-size: 22px;
        font-weight: bold;
        letter-spacing: 0.07rem;
        background-color: rgb(241, 109, 48);
        color: white;
        cursor: pointer;
        transition: all 0.3s ease-in-out;
    }

    .logout:hover {
        background-color: rgb(246, 83, 7);
        box-shadow: 0 4px 10px rgba(246, 83, 7, 0.5);
        transform: scale(1.05);
    }

    
</style>
</style>

<body>
    <div class="left-container">
        <h2 class="admin"> Admin </h2>
        <ul>
            <li><a href="#dashboard"> Dashboard </a></li>
            <li><a href="#add-internship"> Add Internship</a> </li>
            <li><a href="#messages"> Messages/Queries </a></li>
            <li><a href="#student-resume"> Student Applications </a></li>
        </ul>
        <a href="adminlogin.php" class="logout"> Logout </a>
    </div>

    <div class="content-container">
        <div class="dashboard-container" id="dashboard">
            <div class="dashboard-title">
                <h1> Dashboard </h1>
            </div>
            <div class="user-count">
                <div class="icon">👨‍🎓</div>
                <h2>
                    <?php echo $totalUsers; ?>
                </h2>
                <p>Students Registered</p>
            </div>
            <div class="user-count">
                <div class="icon">💼</div>
                <h2>
                    <?php echo $totalInternship; ?>
                </h2>
                <p>Internships Available</p>
            </div>
            <div class="user-count">
                <div class="icon">📩</div>
                <h2>
                    <?php echo $totalresubmit; ?>
                </h2>
                <p>Applications Submitted</p>
            </div>
        </div>


        <div class="internship-container" id="add-internship">
            <h2 class="internship-title">Add Internship</h2>
            <div class="input-internship">
                <div class="input-group"> <label> Internship Name: </label><input type="text" id="internship"></div>
                <div class="input-group"> <label>Company Name:</label> <input type="text" id="company"></div>
                <div class="input-group"> <label>Location:</label> <input type="text" id="location"></div>
                <div class="input-group"> <label>Duration: </label><input type="text" id="duration"></div>

                <div class="popup">
                    <div class="input-group"> <label>Internship Description:</label>
                        <textarea name="internshipDescription" rows="4"></textarea>
                    </div>

                    <div class="input-group"> <label>Stipend:</label>
                        <input type="text" name="stipend">
                    </div>

                    <div class="input-group"> <label>Apply By:</label>
                        <input type="date" name="applyBy">
                    </div>

                    <div class="input-group"> <label>Skills Required</label>
                        <input type="text" name="skills" placeholder="Enter skills (comma separated)">
                    </div>

                    <div class="input-group"> <label>Perks</label>
                        <input type="text" name="perks" placeholder="Enter perks (comma separated)">
                    </div>

                    <div class="input-group"><label>Internship Duration:</label>
                        <input type="text" name="internshipduration">
                    </div>

                    <div class="input-group"><label>Company Name:</label>
                        <input type="text" name="companyName">
                    </div>

                    <div class="input-group"><label>Company Description:</label>
                        <textarea name="companyDescription" rows="4"></textarea>
                    </div>

                    <button id="add">Add Internship</button>
                </div>
            </div>
        </div>

        <div class="message-container" id="messages">
            <h2 class="message-title">Messages/Queries</h2>
            <table>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Submitted At</th>
                </tr>

                <?php
        if(mysqli_num_rows($contact_result) > 0) {
            while($row = mysqli_fetch_assoc($contact_result)) {
                echo "<tr>
                        <td>{$row['name']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['message']}</td>
                        <td>{$row['submitted_at']}</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='5' style='text-align:center;'>No messages found</td></tr>";
        }
        ?>
            </table>
        </div>

        <div class="resume" id="student-resume">
            <h2 class="message-title"> Applications </h2>
            <table>
                <tr>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Company</th>
                    <th>Internship</th>
                    <th>Download</th>
                </tr>
                <?php
        if ($form_result->num_rows > 0) {
            while($row = $form_result->fetch_assoc()) {
                $fileName = $row["file"]; 
                $filePath = "uploads/" . $fileName; 

                echo "<tr>
                        <td>".$row["fullname"]."</td>
                        <td>".$row["email"]."</td>
                        <td>".$row["company"]."</td>
                        <td>".$row["internship"]."</td>
                        <td><a href='download.php?file=".$fileName."'>Download</a></td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No resumes found</td></tr>";
        }
        $conn->close();
        ?>
            </table>
        </div>
    </div>

    <script>

        document.querySelector('.logout').addEventListener('click', function () {
            window.location.href = "adminlogin.php";
        });


        document.addEventListener("DOMContentLoaded", function () {
           
            const navLinks = document.querySelectorAll(".left-container a");

           
            const sections = document.querySelectorAll(".content-container > div");

           
            function showSection(sectionId) {
                sections.forEach(section => {
                    if (section.id === sectionId) {
                        section.style.display = "block";
                    } else {
                        section.style.display = "none";
                    }
                });
            }

            
            navLinks.forEach(link => {
                link.addEventListener("click", function (event) {
                    event.preventDefault();
                    const sectionId = this.getAttribute("href").substring(1); 
                    showSection(sectionId);
                });
            });

            
            showSection("dashboard");
        });


        document.addEventListener("DOMContentLoaded", function () {
            document.getElementById("add").addEventListener("click", async function () {
                let internshipData = {
                    name: document.getElementById("internship").value.trim(),
                    company: document.getElementById("company").value.trim(),
                    location: document.getElementById("location").value.trim(),
                    duration: document.getElementById("duration").value.trim(),
                    internshipDescription: document.querySelector("[name='internshipDescription']").value.trim(),
                    stipend: document.querySelector("[name='stipend']").value.trim(),
                    applyBy: document.querySelector("[name='applyBy']").value.trim(),
                    skills: document.querySelector("[name='skills']").value.trim(),
                    perks: document.querySelector("[name='perks']").value.trim(),
                    internshipduration: document.querySelector("[name='internshipduration']").value.trim(),
                    companyName: document.querySelector("[name='companyName']").value.trim(),
                    companyDescription: document.querySelector("[name='companyDescription']").value.trim(),
                };

                
                if (Object.values(internshipData).some(value => value === "")) {
                    alert("Please fill in all fields.");
                    return;
                }

                try {
                    let response = await fetch("backend.php", {
                        method: "POST",
                        headers: { "Content-Type": "application/json" },
                        body: JSON.stringify(internshipData),
                    });

                    let textResponse = await response.text(); 
                    try {
                        let result = JSON.parse(textResponse); 
                        if (result.success) {
                            alert("Internship added successfully!");

                            
                            document.getElementById("internship").value = "";
                            document.getElementById("company").value = "";
                            document.getElementById("location").value = "";
                            document.getElementById("duration").value = "";
                            document.querySelector("[name='internshipDescription']").value = "";
                            document.querySelector("[name='stipend']").value = "";
                            document.querySelector("[name='applyBy']").value = "";
                            document.querySelector("[name='skills']").value = "";
                            document.querySelector("[name='perks']").value = "";
                            document.querySelector("[name='internshipduration']").value = "";
                            document.querySelector("[name='companyName']").value = "";
                            document.querySelector("[name='companyDescription']").value = "";

                        } else {
                            alert("Failed to add internship: " + result.message);
                        }
                    } catch (jsonError) {
                        console.error("Invalid JSON response:", textResponse);
                        alert("Unexpected server response. Check console for details.");
                    }
                } catch (error) {
                    console.error("Error:", error);
                }
            });
        });

    </script>
</body>
</html>