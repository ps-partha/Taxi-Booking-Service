<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'C:\xampp\htdocs\Ridek-Main\Ridek-Main\Ridek Main Files\html\PHPMailer\src\PHPMailer.php';
require 'C:\xampp\htdocs\Ridek-Main\Ridek-Main\Ridek Main Files\html\PHPMailer\src\SMTP.php';
require 'C:\xampp\htdocs\Ridek-Main\Ridek-Main\Ridek Main Files\html\PHPMailer\src\PHPMailerAutoload.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the form fields and remove whitespace.
        $firstname = strip_tags(trim($_POST["firstname"]));
        $lastname = strip_tags(trim($_POST["lastname"]));
		$lastname = str_replace(array("\r","\n"),array(" "," "),$lastname);
        $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
        $phone = trim($_POST["phone"]);
        $message = trim($_POST["message"]);

        // Check that data was sent to the mailer.
        if ( empty($firstname) OR empty( $phone ) OR empty($message) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            http_response_code(400);
            echo "Oops! There was a problem with your submission. Please complete the form and try again.";
            exit;
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
          $mail->setFrom('feeling2point0@gmail.comm', $firstname);
          $mail->addAddress('parthasarker442@gmail.com', 'partha'); 
          $mail->isHTML(true);
          $mail->Subject = ''.$firstname. ' ' .$lastname.' '.'Sent a new contact massage' ;
          $mail->Body = '<!DOCTYPE html>
          <html lang="en">
          <head>
              <meta charset="UTF-8">
              <meta name="viewport" content="width=device-width, initial-scale=1.0">
              <title>Document</title>
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
                    
                    <h2 style="text-align: center;font-family: Arial, Helvetica, sans-serif;color: rgb(35, 142, 177);">Contact information </h2>
                    
                    <table>
                      <tr>
                        <td>Name</td>
                        <td>'.$firstname. '' .$lastname.'</td>
                      </tr>
                      <tr>
                        <td>Email</td>
                        <td>'.$email.'</td>
                      </tr>
                      <tr>
                        <td>Phone</td>
                        <td>'.$phone.'</td>
                      </tr>
                     
                        <td>Massage</td>
                        <td>'.$message.'</td>
                      </tr>
                    </table>
          </body>
          </html>';
              if(!$mail->Send()) {
                echo "Oops! Something went wrong and we couldn't send your message.";
             } else {
               echo "Thank You! Your message has been sent.";
             }
    }
}
?>
