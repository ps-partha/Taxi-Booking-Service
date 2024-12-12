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
    $fullname = strip_tags(trim($_POST["full-name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $packageType = trim($_POST["package-type"]);
    $passengers = trim($_POST["passengers"]);
    $startDest = trim($_POST["start-dest"]);
    $endDest = trim($_POST["end-dest"]);
    $phone = trim($_POST["phone"]);
    $luggage = trim($_POST["luggage"]);
    $rideDate =  trim($_POST["ride-date"]);

    $MM = trim($_POST["MI"]);
    $HH = trim($_POST["HH"]);
    $AM = trim($_POST["AM"]);

    $rideTime = $HH . ":" . $MM . ' ' . $AM;
    $sql = "INSERT INTO customer_data (`fullname`,`email`,`phone`,`packageType`,`passengers`,`startDest`,`endDest`,`rideDate`,`rideTime`,`luggage`) VALUES ('".$fullname."','".$email."','".$phone."','".$packageType."','".$passengers."','".$startDest."','".$endDest."','".$rideDate."','".$rideTime."','".$luggage."')";
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
          $mail->Body = '
          <!DOCTYPE html>
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
              
              <h2 style="text-align: center;font-family: Arial, Helvetica, sans-serif;color: rgb(35, 142, 177);">Customer details</h2>
              
              <table>
                <tr>
                  <td>Name</td>
                  <td>'.$fullname.'</td>
                </tr>
                <tr>
                  <td>Email</td>
                  <td>'.$email.'</td>
                </tr>
                <tr>
                  <td>Phone</td>
                  <td>'.$phone.'</td>
                </tr>
                <tr>
                  <td>Package Type</td>
                  <td>'.$packageType.'</td>
                </tr>
                <tr>
                  <td>Passengers</td>
                  <td>'.$passengers.'</td> 
                </tr>
                <tr>
                  <td>Start Destination</td>
                  <td>'.$startDest.'</td>
                </tr>
                <tr>
                  <td>End Destination</td>
                  <td>'.$endDest.'</td>
                </tr>
                <tr>
                  <td>Ride Date</td>
                  <td>'.$rideDate.'</td>
                </tr>
                <tr>
                  <td>Ride Time</td>
                  <td>'.$rideTime.'</td>
                </tr>
                <tr>
                  <td>Luggage</td>
                  <td>'.$luggage.'</td>
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