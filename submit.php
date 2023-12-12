<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sigma";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$firstName = filter_var($_POST["firstName"], FILTER_SANITIZE_STRING);
$lastName = filter_var($_POST["lastName"], FILTER_SANITIZE_STRING);
$dob = $_POST["dob"]; 
$email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
$phone = filter_var($_POST["phone"], FILTER_SANITIZE_STRING);
$province = filter_var($_POST["province"], FILTER_SANITIZE_STRING);
$gender = filter_var($_POST["gender"], FILTER_SANITIZE_STRING);
$newsletter = isset($_POST["newsletter"]) ? 1 : 0;


$stmt = $conn->prepare("INSERT INTO dane (imie, nazwisko, data_urodzenia, email, telefon, wojewodztwo, plec, zgoda_newsletter) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");


$stmt->bind_param("sssssssi", $firstName, $lastName, $dob, $email, $phone, $province, $gender, $newsletter);


if ($stmt->execute()) {
    echo "Dane zostały zapisane.";
} else {
    echo "Error: " . $stmt->error;
}


$stmt->close();

$conn->close();
?>