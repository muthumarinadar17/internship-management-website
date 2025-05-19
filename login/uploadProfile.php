<?php
session_start();
include 'connect.php';

if(isset($_POST['upload']) && isset($_FILES['profilePicture'])) {
    $email = $_SESSION['email']; // Get logged-in user email
    $file = $_FILES['profilePicture'];

    // File properties
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];
    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    // Allowed file extensions
    $allowed = ['jpg', 'jpeg', 'png'];

    if (in_array($fileExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 5000000) { // Max 5MB
                $newFileName = uniqid('', true) . "." . $fileExt;
                $fileDestination = "uploads/" . $newFileName;

                // Move file to uploads folder
                move_uploaded_file($fileTmpName, $fileDestination);

                // Save file path in database
                $sql = "INSERT INTO profile (email, image) VALUES ('$email', '$fileDestination')
                        ON DUPLICATE KEY UPDATE image='$fileDestination'";

                if ($conn->query($sql) === TRUE) {
                    $_SESSION['profileImage'] = $fileDestination; // Store in session
                    header("Location: creatingPROFILE.php");
                    exit();
                } else {
                    echo "Database error: " . $conn->error;
                }
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
?>
