<?php
session_start();
ob_start();


    include("server.php");

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
        .table-container {
            display: flex;
            gap: 20px; /* Adjust the gap between the tables as needed */
        }
        .table-container .container {
            flex: 1;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000; /* Change to your preferred border color */
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: rgba(0, 0, 0, 0.7); 
        }
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
        <div class="form-control"></div>
        <div class="dropdown dropdown-end">
            <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar" onclick="toggleProfileMenu()">
                <div class="w-10 rounded-full">
                    <img alt="Tailwind CSS Navbar component" src="avatar.png" style="height:-10px;width:auto;" />
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
            <div class="table-container">
                <div class="container" style="background: linear-gradient(to left, rgb(247, 150, 150), #cebef8);">
                    <table class="table">
                        <thead style="color:#FFF;">
                            <tr>
                                <th>Full Name</th>
                                <th>User Type</th>
                                <th>Department</th>
                                <th>Year and Section</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sqlroom = "SELECT * FROM memberstbl";
                            $queryroom = mysqli_query($conn, $sqlroom);
                            while($resultroom = mysqli_fetch_assoc($queryroom)){
                                echo '<tr class="row" onclick="window.location=\'admin.php?memid=' . $resultroom['id'] . '\'">';
                                echo '<td>' . $resultroom['fname'] . ' ' . $resultroom['lname'] . '</td>';
                                echo '<td>' . $resultroom['status'] . '</td>';
                                echo '<td>' . $resultroom['dept'] . '</td>';
                                echo '<td>' . $resultroom['year'] . ' ' . $resultroom['section'] . '</td>';
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="container" style="background: linear-gradient(to left, rgb(247, 150, 150), #cebef8);width:2000px;">
                    <table class="table">
                        <thead style="color:#FFF;">
                            <tr>
                                <th>Event Title</th>
                                <th>Event Description</th>
                                <th>Event Date</th>
                                <th>Event Time</th>
                                <th>Event Location</th>
                                <th>Event Organization</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sqlroom = "SELECT * FROM event_tbl";
                            $queryroom = mysqli_query($conn, $sqlroom);
                            while($resultroom = mysqli_fetch_assoc($queryroom)){
                                echo '<tr class="row" onclick="window.location=\'admin.php?memid=' . $resultroom['id'] . '\'">';
                                echo '<td>' . $resultroom['ename'] . '</td>';
                                echo '<td>' . $resultroom['edesc'] . '</td>';
                                echo '<td>' . $resultroom['edate'] . '</td>';
                                echo '<td>' . $resultroom['etime'] .'</td>';
                                echo '<td>' . $resultroom['elocation'] .'</td>';
                                echo '<td>' . $resultroom['eorg'] .'</td>';
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>





<div class="bottom-navbar">  
        <a href="admin-create.php" class="footer-button"><i class="fa-solid fa-pen-to-square"></i></a>
        <a href="admin-read.php" class="footer-button"><i class="fa-solid fa-magnifying-glass"></i></a>
        <a href="admin-update.php" class="footer-button"><i class="fa-regular fa-pen-to-square"></i></a>
        <a href="admin-delete.php" class="footer-button"><i class="fa-solid fa-trash"></i></a> 
</div>
</form>
<script>
  <?php include("toggleprof.js"); ?>
</script>
</body>
</html>