<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'C:\xampp\htdocs\Ridek-Main\Ridek-Main\Ridek Main Files\html\PHPMailer\src\PHPMailer.php';
require 'C:\xampp\htdocs\Ridek-Main\Ridek-Main\Ridek Main Files\html\PHPMailer\src\SMTP.php';
require 'C:\xampp\htdocs\Ridek-Main\Ridek-Main\Ridek Main Files\html\PHPMailer\src\PHPMailerAutoload.php';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "userdata";
$mysqli = new mysqli($servername, $username, $password,$dbname);
extract($_POST);



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form fields and remove whitespace.
    $fullname = strip_tags(trim($_POST["name-pass"]));
    $PassengerEmail = filter_var(trim($_POST["pass-email"]), FILTER_SANITIZE_EMAIL);
    $Departure_airport = trim($_POST["D-airport"]);
    $flight_no = trim($_POST["flight-no"]);
    $ArrivalAirport = trim($_POST["arrival-airport"]);
    $PassengerPhone = trim($_POST["pass-phone"]);
    $PassengerAddress = trim($_POST["pass-address"]);
    
    $MM = trim($_POST["MI"]);
    $HH = trim($_POST["HH"]);
    $AM = trim($_POST["AM"]);

    $ArrivalTime = $HH . ":" . $MM . ' ' . $AM;
    $sql = "INSERT INTO airport_transpor (`Passenger_Name`,`Passenger_Email`,`Passenger_Phone`,`Departure_Airport`,`Arrival_Airport`,`Arrival_Time`,`Passenger_Address`) VALUES ('".$fullname."','".$PassengerEmail."','".$PassengerPhone."','".$Departure_airport."','".$ArrivalAirport."','".$ArrivalTime."','".$PassengerAddress."')";
    $result = $mysqli->query($sql);
    if(!$result){
        die("Couldn't enter data: ".$mysqli->error);
    }else{
        $mail = new PHPMailer(true); 
          $mail->SMTPDebug = false; 
          $mail->isSMTP(); 
          $mail->Host = 'smtp.gmail.com';
          $mail->SMTPAuth = true;
          $mail->Username = 'feeling2point0@gmail.com';
          $mail->Password = 'meophnykfcdodjgt'; 
          $mail->SMTPSecure = 'tls';
          $mail->Port = 587;
          $mail->setFrom('feeling2point0@gmail.comm', $fullname);
          $mail->addAddress('parthasarker442@gmail.com', 'partha'); 
          $mail->isHTML(true);
          $mail->Subject = 'Customer details';
          $mail->Body = '<!DOCTYPE html>
          <html>
          <head>
          <style>
          table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
          }
          
          td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
          }
          
          tr:nth-child(even) {
            background-color: #dddddd;
          }
          </style>
          </head>
          <body>
          
          <h2 style="text-align: center;font-family: Arial, Helvetica, sans-serif;color: rgb(35, 142, 177);">Airport Transpor Customer details</h2>
          
          <table>
            <tr>
              <td>Name</td>
              <td>'.$fullname.'</td>
            </tr>
            <tr>
              <td>Passenger Email</td>
              <td>'.$PassengerEmail.'</td>
            </tr>
            <tr>
              <td>Departure Airport</td>
              <td>'.$Departure_airport.'</td>
            </tr>
            <tr>
              <td>Flight No.</td>
              <td>'.$flight_no.'</td>
            </tr>
            <tr>
              <td>Arrival Airport</td>
              <td>'.$ArrivalAirport.'</td> 
            </tr>
            <tr>
                <td>Arrival Time</td>
                <td>'.$ArrivalTime.'</td> 
              </tr>
            <tr>
              <td>Passenger Phone</td>
              <td>'.$PassengerPhone.'</td>
            </tr>
            <tr>
              <td>Passenger Address</td>
              <td>'.$PassengerAddress.'</td>
            </tr>
          </table>
          
          </body>
          </html>';
          if(!$mail->Send()) {
                echo "Your booking is Unsuccessful! Please try again.";
             } else {
               echo "Congratulations! Your booking successfully done. We'll get in touch shortly. Thank you.";
             }

 }
      $mysqli->close();
    }
?>