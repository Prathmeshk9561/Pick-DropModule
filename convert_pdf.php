<?php
session_start();

if (isset($_GET['generate_pdf'])) {
function generate_pdf(){

    require("fpdf/fpdf.php");

    $pdf = new FPDF();
    $pdf -> AddPage();
    $pdf -> SetFont("Arial","B",12);

    $pdf -> Cell(0,10,"SEWACITY",1,1,'C',);
    // $pdf -> Cell(width,height,attribute,border,nextline,'C');
    $pdf -> Cell(0,10,"PICK AND DROP SERVICE",0,1,'C');

    $pdf -> Cell(0,10,"",0,1,'');
    $pdf -> Cell(0,10,"Your Details -",0,1,'L');

    $pdf -> Cell(30,10,"PickID",1,0,'C');
    $pdf -> Cell(60,10,"Full Name",1,0,'C');
    $pdf -> Cell(0,10,"E-Mail",1,1,'C');
    $pdf -> Cell(30,10,$_SESSION['order_id'],1,0,'C');
    $pdf -> Cell(60,10,$_SESSION['full_name'],1,0,'C');
    $pdf -> Cell(0,10,$_SESSION['email'],1,1,'C');

    $pdf -> Cell(0,10,"",0,1,'');
    $pdf -> Cell(0,10,"Service Type -",0,1,'L');

    $pdf -> Cell(60,10,"Pick Time",1,0,'C');
    $pdf -> Cell(60,10,"Service Option",1,0,'C');
    $pdf -> Cell(0,10,"Service Charge",1,1,'C');
    $pdf -> Cell(60,10,$_SESSION['pick_time'],1,0,'C');
    $pdf -> Cell(60,10,$_SESSION['service_option'],1,0,'C');
    $pdf -> Cell(0,10,$_SESSION['charge'],1,1,'C');

    $pdf -> Cell(0,10,"",0,1,'');
    $pdf -> Cell(0,10,"Pickup Details -",0,1,'L');

    $pdf -> Cell(70,10,"Pick Street",1,0,'C');
    $pdf -> Cell(80,10,"Pick Landmark",1,0,'C');
    $pdf -> Cell(0,10,"Pick City",1,1,'C');
    $pdf -> Cell(70,10,$_SESSION['pick_street'],1,0,'C');
    $pdf -> Cell(80,10,$_SESSION['pick_landmark'],1,0,'C');
    $pdf -> Cell(0,10,$_SESSION['pick_city'],1,1,'C');

    $pdf -> Cell(0,10,"",0,1,'');
    $pdf -> Cell(0,10,"Drop Details -",0,1,'L');

    $pdf -> Cell(70,10,"Drop Street",1,0,'C');
    $pdf -> Cell(80,10,"Drop Landmark",1,0,'C');
    $pdf -> Cell(0,10,"Drop City",1,1,'C');
    $pdf -> Cell(70,10,$_SESSION['drop_street'],1,0,'C');
    $pdf -> Cell(80,10,$_SESSION['drop_landmark'],1,0,'C');
    $pdf -> Cell(0,10,$_SESSION['drop_city'],1,1,'C');


    $file = time().'.pdf';
    $pdf->output($file,'D');

}
generate_pdf();
}
?>