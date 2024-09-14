<?php
session_start();

    include("server.php");

    $id = $_SESSION['id'];
    $query = mysqli_query($conn, "SELECT * FROM scp_tbl WHERE id = '$id'");
    while($result = mysqli_fetch_assoc($query)){
      $res_id = $result['id'];
      $res_fname = $result['fname'];
      $res_lname = $result['lname'];
      $res_email = $result['email'];
      $res_password = $result['password'];
      $res_type = $result['user_type'];
      }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.10.2/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
      <?php include("style3.css"); ?>
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>User</title>
</head>
<body>
<div class="navbar bg-base-100">
  <div class="flex-1">
    <a class="btn btn-ghost text-xl" href="home.php">Artrads Web!</a>
  </div>
  <div class="flex-none gap-2">
    <div class="form-control">
    </div>
    <div class="dropdown dropdown-end">
      <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar" onclick="toggleProfileMenu()">
        <div class="w-10 rounded-full">
          <img alt="Tailwind CSS Navbar component" src="avatar.png"  style="height:-10px;width:auto;" />
        </div>
      </div>    
      <ul tabindex="0" class="type mt-3 z-[1] p-2 shadow menu menu-sm dropdown-content bg-base-100 rounded-box w-52">
      <p>Welcome <?php echo $res_fname; ?>!</p>
      <a href="logout.php"><i class="fa-solid fa-right-from-bracket" style="margin-right: 10px;"></i>  Logout</a>
      </ul>
      </div>
    </div>
  </div>
</div>

<div class="hero min-h-screen" style="background-image: url(artrads.jpg);">
<div class="hero-overlay bg-opacity-60 "></div>  
  <div class="hero-content flex-col lg:flex-row-reverse">
<div class="content">
    <div class="container" style="background: linear-gradient(to left, rgb(247, 150, 150), #cebef8);margin-bottom: 400px;margin-left: 50px;">
        <div class="container" >
            <h1 style="color: black;"><i class="fas fa-user-circle" style="font-size: 70px;margin-right: 10px;"></i>ID: <?php echo $res_id;?></h1>
            <p style="color: black;margin-left:50px;">User: <?php echo $res_fname . ' ' . $res_lname; ?><br>
              User Type: <?php echo $res_type ?><br>
                Email: <?php echo $res_email; ?><br>
                <p style="margin-top:-2px;margin-bottom:-2px;color:#000;float:right;" id="pass">
                    Password: 
                <span class="password-container">
                    <input style="background-color:transparent;border:none;cursor:default;outline:none;display:inline-block;white-space:nowrap;width:90px;color:#000;" type="password" value="<?php echo $res_password; ?>" id="password-field" readonly>
                    <button style="background-color:transparent;border:none;color:#000;" onclick="togglePassword()">
                        <i class="fa fa-eye" id="toggle-icon"></i>
                    </button>
                </span>
                <br>
            </p>
        </div>
    </div>
</div>
  </div>
</div>
</div>


<div class="bottom-navbar">  
        <a href="home.php" class="footer-button"><i class="fas fa-home"></i></a>
        <a href="eventtry.php" class="footer-button"><i class="fas fa-chart-line"></i></a>
        <a href="user.php" class="footer-button"><i class="fas fa-user"></i></a>
        <a href="members.php" class="footer-button"><i class="fas fa-users"></i></a> 
</div>
<script>

  function togglePassword() {
    var passwordField = document.getElementById('password-field');
    var toggleIcon = document.getElementById('toggle-icon');

    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        toggleIcon.className = 'fa fa-eye-slash';
    } else {
        passwordField.type = 'password';
        toggleIcon.className = 'fa fa-eye';
    }
}

</script>
</body>
</html>