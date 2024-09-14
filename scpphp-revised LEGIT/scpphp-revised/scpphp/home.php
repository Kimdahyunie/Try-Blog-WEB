<?php
session_start();
ob_start();


    include("server.php");

    if(!isset($_SESSION['email'])){
        header("Location: LOGREG.php");
    }
    $id = $_SESSION['id'];
    $query = mysqli_query($conn, "SELECT * FROM scp_tbl WHERE id = '$id'");
    if(mysqli_num_rows($query) == 0) {
      echo "No User is logged in";
    } else {
    while($result = mysqli_fetch_assoc($query)){
      $res_id = $result['id'];
      $res_fname = $result['fname'];
      $res_lname = $result['lname'];
      $res_email = $result['email'];
      $res_password = $result['password'];
      $res_type = $result['user_type'];
      }

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
      <?php include("style2.css"); ?>
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Home</title>
</head>
<body>
<form action="home.php" method="post">
<div class="navbar bg-base-100">
  <div class="flex-1">
    <a class="btn btn-ghost text-xl">Artrads Web!</a>
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
      <a href="logout.php"><i class="fa-solid fa-right-from-bracket" style="margin-right: 10px;"></i> Logout</a>
      </ul>
    </div>
  </div>
</div>

<div class="hero min-h-screen" style="background-image: url(artrads.jpg);">
<div class="hero-overlay bg-opacity-60"></div>  
  <div class="hero-content flex-col lg:flex-row-reverse">
    <div class="about">
      <h1 class="text-5xl font-bold">About Artrads</h1>
      <p class="py-6">
        Artrads stands as a vibrant beacon within CVSU CCAT, a dance organization pulsating with talent and camaraderie. 
        It serves as a haven for students endowed with a passion for dance, actively scouting for individuals brimming with 
        potential in the art form. Beyond honing skills, Artrads fosters a spirit of joy and friendship, infusing its activities 
        with fun and excitement. From rehearsals buzzing with creativity to electrifying performances gracing various campus events, 
        Artrads not only nurtures talent but also enriches the campus community with its dynamic presence.
      </p>
     
      <a href="members.php" class="btn btn-outline btn-secondary">See Members</a>
      
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
</form>
<script>
  <?php include("toggleprof.js"); ?>
</script>
</body>
</html>