<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
// Check if the form is submitted
if (isset($_POST['send_mail'])) {
    // Database connection parameters
    $host = 'localhost'; // Replace with your MySQL host
    $username = 'root'; // Replace with your MySQL username
    $password = ''; // Replace with your MySQL password
    $database = 'sewacity_db'; // Replace with your MySQL database name

    // Connect to the database
    $conn = new mysqli($host, $username, $password, $database);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    // Retrieve the selected radio button value
    $service_option = ($_POST['radio-card'] == 1) ? 'Within 2 KM' : 'Within 4 KM';

    // Convert the selected radio button value to the appropriate charge
    $charge = ($_POST['radio-card'] == 1) ? 30 : 40;

    // Sanitize and store form data in variables
    $order_id = rand(100001,999999);
    //$service_option = $_POST['price'] ?? 0; // Use a default value of 0 if 'price' is not set
    $full_name = $_POST['name'];
    $email = $_POST['email'] ?? N/A;
    $pick_street = $_POST['pick_add_line1'];
    $pick_landmark = $_POST['pick_add_line2'];
    $pick_city = $_POST['pick_city'];
    $pick_mobile = $_POST['pick_mob_no'];
    $pick_time = $_POST['pick_time'];
    $pick_note = $_POST['pick_note'] ?? N/A;
    $drop_street = $_POST['drop_add_line1'];
    $drop_landmark = $_POST['drop_add_line2'];
    $drop_city = $_POST['drop_city'];
    $drop_mobile = $_POST['drop_mob_no'];
    $drop_note = $_POST['drop_note'] ?? N/A;

    // Prepare and execute the SQL query to insert data into the table
    $sql = "INSERT INTO delivery_requests 
            (order_id,service_option, charge, full_name, email, pick_street, pick_landmark, pick_city, pick_mobile,pick_time, pick_note, drop_street, drop_landmark, drop_city, drop_mobile, drop_note)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        'ssisssssssssssss',
        $order_id,
        $service_option,
        $charge,
        $full_name,
        $email,
        $pick_street,
        $pick_landmark,
        $pick_city,
        $pick_mobile,
        $pick_time,
        $pick_note,
        $drop_street,
        $drop_landmark,
        $drop_city,
        $drop_mobile,
        $drop_note
    );

    // Check if the query executed successfully
    if ($stmt->execute()) {
            // Data inserted successfully
            require 'phpMailer/Exception.php';
            require 'phpMailer/PHPMailer.php';
            require 'phpMailer/SMTP.php';

            $mail = new PHPMailer(true);
            $i=1;
            while($i<4){
            try {
                        $mail->isSMTP();                                            //Send using SMTP
                        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                        $mail->Username   = 'prathmeshkumbhar84032@gmail.com';                     //SMTP username
                        $mail->Password   = 'wbcpvylylwshiuil';                                    //SMTP password
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                        $mail->Port       = 465;                                    //TCP port to connect 

                        //Recipients
                        $mail->setFrom('prathmeshkumbhar84032@gmail.com', 'Sewacity');

                        //Add a recipient
                        if($i==1){
                          $mail->addBCC($email, $full_name);
                        }
                        else if($i==2){
                          $mail->addBCC('prathmeshkumbhar84032@gmail.com', 'PrathmeshKumbhar');
                        }
                        else{
                          $mail->addBCC('choragepratik12@gmail.com', 'Pratik Chorage');
                        }
                        
                        //Content in mail
                        $mail->isHTML(true);              //Set email format to HTML
                        $mail->Subject = 'Regarding To Sewacity Pick And Drop Service';
                        $mail->Body    = "Dear Customer, <br>Name: $full_name <br>E-Mail id: $email <br>Order Id: $order_id<br><br>
                                        You Have Requested An Pick And Drop Service at time - $pick_time<br><br>
                                        Your Pickup Address is<br>
                                        $pick_street, $pick_landmark<br>
                                        From City - $pick_city<br>Phone No: $pick_mobile<br>Pickup Note: $pick_note<br><br>
                                        Your Drop Address is<br>
                                        $drop_street,  $drop_landmark<br>
                                        From City - $drop_city<br>Phone No: $drop_mobile<br>Drop Note: $drop_note<br>";
                        //mail send function
                        $mail->send();

                        
                } 
              catch (Exception $e) {
                  // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
                $i++;
            }
            } 
        
        else {
            // Error in sql query execution
            ?>
              <script>
              swal({
                title: "Error!",
                text: " Can't Connect to database",
                icon: "warning",
              });
              
              </script>
              <?php 
            echo "Error: " . $sql . "<br>" . $conn->error;
        }   

    // Close the statement and the connection
    $stmt->close();
    $conn->close();


    session_start();
        $_SESSION['order_id'] = $order_id;
        $_SESSION['service_option'] = $service_option;
        $_SESSION['charge'] = $charge;
        $_SESSION['full_name'] = $full_name;
        $_SESSION['email'] = $email;
        $_SESSION['pick_street'] = $pick_street;
        $_SESSION['pick_landmark'] = $pick_landmark;
        $_SESSION['pick_city'] = $pick_city;
        $_SESSION['pick_mobile'] = $pick_mobile;
        $_SESSION['pick_time'] = $pick_time;
        $_SESSION['pick_note'] = $pick_note;
        $_SESSION['drop_street'] = $drop_street;
        $_SESSION['drop_landmark'] = $drop_landmark;
        $_SESSION['drop_city'] = $drop_city;
        $_SESSION['drop_mobile'] = $drop_mobile;
        $_SESSION['drop_note'] = $drop_note;
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./css/config.css" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>SewaCity</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>  
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'></link> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.debug.js"></script>
  </head>
  <body>
    <div class="header">
      <div class="logo">
        <img src="./assets/logo.png" alt="" />
      </div>
      <div class="name">
        <h2>PICK & DROP</h2>
      </div>
    </div>
    <div class="boxes">
        <div class="box">
            <img
            src="https://cdn-icons-png.flaticon.com/512/9262/9262320.png"
            alt=""
            />
            <h3>SUCCESS..!</h3>
            <h5>Your Pick & Drop Request Submitted successfully.</h5>
            <h6>*Note - All Details Are Sent to your Registered Mail</h6>
        </div>
    </div>
    <!-- <div class="label">
      <h4>Your Details</h4>
    </div> -->
    <div class="container1">
      <form action="index.php" class="form" method="post">
      <div class="label">
      <h4>Your Details</h4>
    </div>
        <div class="input-box">
          <label>Pickup Id -</label> <br>
          <label class="data"><?php echo"$order_id"?></label>
        </div>

        <div class="input-box">
          <label>Full Name -</label> <br>
          <label class="data" id="fname"><?php echo"$full_name"?></label>
        </div>
        <div class="input-box">
          <label>E-Mail ID -</label> <br>
          <label class="data"><?php echo"$email"?></label>
        </div>

        <div class="input-box">
          <label>Service Type -</label> <br>
          <label class="data"><?php echo"$service_option"?></label>
        </div>

        <div class="input-box">
          <label>Total Charge -</label> <br>
          <label class="data"><?php echo"$charge"?></label>
        </div>

        <div class="label">
          <h4>Pickup Address</h4>
        </div>

        <div class="input-box">
          <label class="data"><?php echo"$pick_street , $pick_landmark , $pick_city"?></label>
        </div>
        <div class="input-box">
          <label>City -</label> <br>
          <label class="data"><?php echo"$pick_city"?></label>
        </div>
        <div class="input-box">
          <label>Mobile Number -</label> <br>
          <label class="data"><?php echo"$pick_mobile"?></label>
        </div>
        <div class="input-box">
          <label>Pickup Time -</label> <br>
          <label class="data"><?php echo"$pick_time"?></label>
        </div>
        <div class="input-box">
          <label>Pickup Note -</label> <br>
          <label class="data"><?php echo"$pick_note"?></label>
        </div>
        <div class="label">
          <h4>Drop Address</h4>
        </div>
        <div class="input-box">
          <label class="data"><?php echo"$drop_street , $drop_landmark , $drop_city"?></label>
        </div>
        <div class="input-box">
          <label>City -</label> <br>
          <label class="data"><?php echo"$drop_city"?></label>
        </div>
        <div class="input-box">
          <label>Mobile Number -</label> <br>
          <label class="data"><?php echo"$drop_mobile"?></label>
        </div>
        <div class="input-box">
          <label>Drop Note -</label> <br>
          <label class="data"><?php echo"$drop_note"?></label>
        </div>
        <hr>
        <button >Back</button>
      </form>
      <style>
            .gen_pdf button {
              height: 55px;
              width: 100%;
              color: #fff;
              font-size: 25px;
              font-weight: 400;
              margin-top: 30px;
              border: none;
              border-radius: 20px;
              cursor: pointer;
              transition: all 0.2s ease;
              background:#1A2238;
              box-shadow: 0px 8px 20px rgba(6, 14, 98, 0.503);
            }
            .gen_pdf button {
              background:  #1A2238;
            }
      </style>
      <form action="./convert_pdf.php" method="get">

        <div class="gen_pdf">
        <button name="generate_pdf" onclick="notify()" id="export_pdf">
          Download  Your  Details
        </button>
      </div>
      </form>
    </div>
    <script>
      function notify(){
          swal({
            icon: "success",  
            title: "Downloaded Successfully!",  
            text: "",    
            button: "oh yes!",  
          });  

      }
    </script>
  </body>
</html>

