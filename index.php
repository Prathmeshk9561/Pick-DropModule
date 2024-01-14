<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="./css/style.css" />
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <title>SewaCity</title>
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
  <div class="container1">
    <style>
      .required_field{
        color: red;
      }
    </style>
    <form action="config.php" class="form" method="post">
      <div class="label">
        <h4>Choose Service</h4>
      </div>
      <div class="container">
        <div class="grid-wrapper grid-col-auto">
          <label for="radio-card-1" class="radio-card">
            <input type="radio" name="radio-card" id="radio-card-1" value="1" onclick="showprice(1)" />
            <div class="card-content-wrapper">
              <span class="check-icon"></span>
              <div class="card-content">
                <img src="https://cdn3d.iconscout.com/3d/premium/thumb/package-delivery-tracking-5045287-4204239.png"
                  alt="IMG1" />
                <h4>Food | Clothes | Books | Documents</h4>
                <h4>Within 2 KM</h4>
                <h4>30.00 INR</h4>
              </div>
            </div>
          </label>
          <label for="radio-card-2" class="radio-card">
            <input type="radio" name="radio-card" id="radio-card-2" value="2" onclick="showprice(2)" />
            <div class="card-content-wrapper">
              <span class="check-icon"></span>
              <div class="card-content">
                <img
                  src="https://cdn3d.iconscout.com/3d/premium/thumb/package-delivery-success-5045288-4204240.png?f=webp"
                  alt="IMG2" />
                <h4>Food | Clothes | Books | Documents</h4>
                <h4>Within 4 KM</h4>
                <h4>40.00 INR</h4>
              </div>
            </div>
          </label>
          <input type="hidden" name="hidden-service-option" id="hidden-service-option" value="Within 2 KM" />
        </div>
      </div>

      <div id="inr1">
        <div class="label">
          <h4 class="service">Total : 00.00 INR</h4>
        </div>
      </div>

      <div class="input-box">
        <label>Full Name <span class="required_field">*</span></label>
        <input type="text" placeholder="Enter full name" name="name" required />
        <!-- <i class='bx bx-user' ></i> -->
      </div>
      <div class="input-box">
        <label>E-Mail ID</label>
        <input type="text" placeholder="Enter your email id" name="email"/>
      </div>

      <div class="label">
        <h4>Pickup Location</h4>
      </div>

      <div class="input-box">
        <label>Street Address <span class="required_field">*</span></label>
        <input type="text" placeholder="Enter Street/Area Name" name="pick_add_line1" required />
      </div>
      <div class="input-box">
        <label>Street Address Line 2 <span class="required_field">*</span></label>
        <input type="text" placeholder="Enter Near Landmark" name="pick_add_line2" required />
      </div>
      <div class="input-box">
        <label>City <span class="required_field">*</span></label>
        <input type="text" placeholder="Enter City Name" name="pick_city" required />
      </div>
      <div class="input-box">
        <label>Mobile Number <span class="required_field">*</span></label>
        <input type="number" placeholder="Enter Mobile number" name="pick_mob_no" required />
      </div>
      <div class="input-box">
        <label>Pickup Time <span class="required_field">*</span></label>
        <input type="time" placeholder="Enter Pickup Time" name="pick_time" required />
      </div>
      <div class="input-box">
        <label>Any Note</label>
        <input type="text" placeholder="Notes (Optional)" name="pick_note" />
      </div>
      <div class="label">
        <h4>Drop Location</h4>
      </div>
      <div class="input-box">
        <label>Street Address <span class="required_field">*</span></label>
        <input type="text" placeholder="Enter Street/Area Name" name="drop_add_line1" required />
      </div>
      <div class="input-box">
        <label>Street Address Line 2 <span class="required_field">*</span></label>
        <input type="text" placeholder="Enter Near Landmark" name="drop_add_line2" required/>
      </div>
      <div class="input-box">
        <label>City <span class="required_field">*</span></label>
        <input type="text" placeholder="Enter City Name" name="drop_city" required/>
      </div>
      <div class="input-box">
        <label>Mobile Number <span class="required_field">*</span></label>
        <input type="number" placeholder="Enter Mobile number" name="drop_mob_no" required/>
      </div>
      <div class="input-box">
        <label>Any Note</label>
        <input type="text" placeholder="Notes (Optional)" name="drop_note" />
      </div>

      <button onclick="start_spinner()" name="send_mail"><b>SUBMIT</b></button>
    </form>
  </div>
  <div class="spinner_div">
  
  <style>
        body {
        margin: 0;
        font-family: Arial, sans-serif;
      }
      .loading-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(245, 245, 245, 0.418);
        justify-content: center;
        align-items: center;
        z-index: 9999;
      }
      
      .spinner {
        border: 4px solid #1A2238;
        border-top: 4px solid #fff;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        animation: spin 1s linear infinite;
      }
      
      @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
      }  
      </style>

      <!-- Loading Spinner -->
      <div id="loading-spinner" class="loading-overlay">
        <div class="spinner"></div>
      </div>
    
      <script>
        function start_spinner(){
          // Hide the loading spinner and show the page content
          document.getElementsByClassName("loading-overlay")[0].style.display = "flex";
          setTimeout(function () {
            document.getElementsByClassName("loading-overlay")[0].style.display = "none";
          }, 16000);
        }
      </script>

  </div>
  <div class="boxes">
    <div class="box">
      <img src="https://cdn3d.iconscout.com/3d/premium/thumb/shopping-store-4809880-3997871.png" alt="" />
      <h4>CONVINIENT</h4>
      <h5>We PICK and DROP packages from your door step.</h5>
    </div>
    <div class="box">
      <img src="https://cdn3d.iconscout.com/3d/premium/thumb/delivery-time-3856397-3212585.png" alt="" />
      <h4>FAST</h4>
      <h5>We deliver the packages within few minutes of pickup.</h5>
    </div>
    <div class="box">
      <img
        src="https://static.vecteezy.com/system/resources/thumbnails/012/808/496/small/safe-delivery-icon-packing-box-with-shield-symbol-goods-delivery-guarantee-3d-render-png.png"
        alt="" />
      <h4>SECURE</h4>
      <h5>
        Every package is important and we transfer it safe and securely.
      </h5>
    </div>
  </div>
  <script>
    function showprice(val) {
      if (val == 1) {
        document.getElementsByClassName("service")[0].innerHTML =
          "Total : 30.00 INR";
        document.getElementById("hidden-service-option").value =
          "Within 2 KM";
      }
      if (val == 2) {
        document.getElementsByClassName("service")[0].innerHTML =
          "Total : 40.00 INR";
        document.getElementById("hidden-service-option").value =
          "Within 4 KM";
      }
    }
  </script>
</body>

</html>