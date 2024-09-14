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
    <title>Members</title>
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
      <a href="logout.php"><i class="fa-solid fa-right-from-bracket" style="margin-right: 10px;"></i> Logout</a>
      </ul>
    </div>
  </div>
</div>
    </div>

<div class="hero min-h-screen" style="background-image: url(artrads.jpg);">
<div class="hero-overlay bg-opacity-60 "></div>  
  <div class="hero-content flex-col lg:flex-row-reverse">
<div class="content">
    <div class="container" style="background: linear-gradient(to left, rgb(247, 150, 150), #cebef8);margin-bottom:400px;">
        <table class="table" >
  
                    <thead>
                        <tr>
                            <th>FullName</th>
                            <th>User Type</th>
                            <th>Department</th>
                            <th>Year and Section</th>
                        </tr>
                    </thead>
                    <tbody>
                <?php
                    $clk_id = "";
                    $clk_fname = "";
                    $clk_lname = "";
                    $clk_status = "";
                    $clk_dept = "";
                    $clk_year= "";
                    $clk_section = "";
                    $sqlroom = "SELECT * FROM memberstbl";
                    $queryroom = mysqli_query($conn, $sqlroom);
                    $scheduled =  mysqli_num_rows($queryroom);

                    while($resultroom = mysqli_fetch_assoc($queryroom)){
                    $tblmember_id = $resultroom['id'];
                    $fname = $resultroom['fname'];
                    $lname = $resultroom['lname'];
                    $status = $resultroom['status'];
                    $dept = $resultroom['dept'];
                    $year = $resultroom['year'];
                    $section = $resultroom['section'];
                    echo '<tr  class="row" onclick="window.location=\'members.php?memid=' . $tblmember_id . '\'">';
                    echo '<td>' . $fname . ' ' . $lname . '</td>';
                    echo '<td>' . $status . '</td>';
                    echo '<td>' . $dept . '</td>';
                    echo '<td>' . $year . ' ' . $section . '</td>';
                    echo '</tr>';
                }
                if (isset($_GET['memid'])) {
                    $memberid = $_GET['memid'];
                    $ridgetsql = "SELECT * FROM memberstbl WHERE id = '$memberid'";
                    $ridquery = mysqli_query($conn, $ridgetsql);
                    $ridrows =  mysqli_num_rows($ridquery);
                   
                    if ($ridrows > 0) {
                      $resultroom1 = mysqli_fetch_assoc($ridquery);
                      $clk_id = $resultroom1['id'];
                      $clk_fname = $resultroom1['fname'];
                      $clk_lname = $resultroom1['lname'];
                      $clk_status = $resultroom1['status'];
                      $clk_dept = $resultroom1['dept'];
                      $clk_year= $resultroom1['year'];
                      $clk_section = $resultroom1['section'];
                      }
                    }
                ?>
            </tbody>
        </table>
    </div>
    <div class="container" style="background: linear-gradient(to left, rgb(247, 150, 150), #cebef8);margin-top:20px;margin-left: 50px;">
        <div class="container" >
            <h1 style="color: black;">User: <?php echo $clk_fname . ' ' . $clk_lname; ?></h1>
            <p style="color: black;">User Type: <?php echo $clk_status; ?><br>
                Department: <?php echo $clk_dept; ?><br>
                Year and Section: <?php echo $clk_year . ' Year ' . $clk_section; ?><br>
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
  <?php include("toggleprof.js"); ?>

  

</script>
</body>
</html>