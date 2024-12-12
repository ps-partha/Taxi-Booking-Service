
<?php
 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'C:\xampp\htdocs\Ridek-Main\Ridek-Main\Ridek Main Files\html\PHPMailer\src\Exception.php';
require 'C:\xampp\htdocs\Ridek-Main\Ridek-Main\Ridek Main Files\html\PHPMailer\src\PHPMailer.php';
require 'C:\xampp\htdocs\Ridek-Main\Ridek-Main\Ridek Main Files\html\PHPMailer\src\SMTP.php';
require 'C:\xampp\htdocs\Ridek-Main\Ridek-Main\Ridek Main Files\html\PHPMailer\src\PHPMailerAutoload.php';

$mail = new PHPMailer(true); 
 
try {
    //Server settings
    $mail->SMTPDebug = 1; // Enable verbose debug output
    $mail->isSMTP(); // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
    $mail->SMTPAuth = true; // Enable SMTP authentication
    $mail->Username = 'feeling2point0@gmail.com'; // SMTP username
    $mail->Password = 'meophnykfcdodjgt'; // SMTP password
    $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587; 
    $mail->setFrom('feeling2point0@gmail.comm', 'Mailer');
    $mail->addAddress('parthasarker442@gmail.com', 'partha'); // Add a recipient
    $mail->isHTML(true); // Set email format to HTML
    $mail->Subject = 'Customer details';
    $mail->Body    = '<!DOCTYPE html>
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
        <td><?php echo  $fullname; ?></td>
      </tr>
      <tr>
        <td>Email</td>
        <td><?php echo   $email; ?></td>
      </tr>
      <tr>
        <td>Phone</td>
        <td><?php echo  $fullname; ?></td>
      </tr>
      <tr>
        <td>Package Type</td>
        <td><?php echo  $packageType; ?></td>
      </tr>
      <tr>
        <td>Passengers</td>
        <td><?php echo  $passengers; ?></td> 
      </tr>
      <tr>
        <td>Start Destination</td>
        <td><?php echo  $startDest; ?></td>
      </tr>
      <tr>
        <td>End Destination</td>
        <td><?php echo  $endDest; ?></td>
      </tr>
      <tr>
        <td>Ride Date</td>
        <td><?php echo  $rideDate; ?></td>
      </tr>
      <tr>
        <td>Ride Time</td>
        <td><?php echo  $rideTime; ?></td>
      </tr>
      <tr>
        <td>Luggage</td>
        <td><?php echo  $luggage; ?></td>
      </tr>
    </table>
    
    </body>
    </html>';
 
    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}


