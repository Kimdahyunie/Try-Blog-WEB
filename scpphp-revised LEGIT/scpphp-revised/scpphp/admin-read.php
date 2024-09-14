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
        <style>
    /* Ensure tables are responsive */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px; /* Add margin between tables */
    }

    /* Adjust table headers and cells */
    th, td {
        border: 1px solid #000;
        padding: 8px;
        text-align: left;
    }

    /* Style table headers */
    th {
        background-color: rgba(0, 0, 0, 0.7);
        color: #fff;
    }

    /* Ensure containers stretch to fit their content */
    .container {
        width: 100%;
    }

    /* Ensure tables are scrollable on smaller screens */
    @media (max-width: 768px) {
        table {
            overflow-x: auto;
        }
    }


    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Home</title>
</head>
<body>
<form action="" method="post">
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
            <form action="read-admin.php" method="post">
                <!-- Search Input Group -->
                <div class="input-group mb-3">
                    <input class="form-control" name="user_search" type="text" placeholder="Search users...">
                    <button class="btn btn-primary" name="user_searchbtn" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
                <!-- Sort Input Group -->
                <div class="input-group mb-3">
                    <select class="form-control" name="user_sort">
                        <option value="ALL">ALL</option>
                        <option value="Admin">Admin</option>
                        <option value="Student">Student</option>
                    </select>
                    <button class="btn btn-primary" name="user_sortbtn" type="submit">
                        <i class="fa-solid fa-sort"></i>
                    </button>
                </div>
            </form>
                <div class="table-container">
                    <div class="container" style="background: linear-gradient(to left, rgb(247, 150, 150), #cebef8);">
                        <table class="table" style="color:#000;">
                            <thead style="color:#FFF;">
                                <tr>
                                    <th>ID</th>
                                    <th>Full Name</th>
                                    <th>Status</th>
                                    <th>User Type</th>
                                    <th>Department</th>
                                    <th>Year and Section</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($_GET['memid'])) {
                                    $memid = $_GET['memid'];
                                    $ridgetsql = "SELECT * FROM memberstbl WHERE id = '$memid'";
                                    $ridquery = mysqli_query($conn, $ridgetsql);
                                    $ridrows =  mysqli_num_rows($ridquery);
                                   
                                    if ($ridrows > 0) {
                                      $resultnotif1 = mysqli_fetch_assoc($ridquery);
                                        $clk_id = $resultnotif1['id'];
                                        $clk_fname = $resultnotif1['fname'];
                                        $clk_lname = $resultnotif1['lname'];
                                        $clk_status = $resultnotif1['status'];
                                        $clk_usertype = $resultnotif1['usertype'];
                                        $clk_dept = $resultnotif1['dept'];
                                        $clk_year = $resultnotif1['year'];
                                        $clk_section = $resultnotif1['section'];
                                      }
                                    }
                                $vis = "";
                                if(isset($_POST['user_searchbtn'])){
                                    
                                        $vis = "show";
                                        $search = mysqli_real_escape_string($conn, $_POST['user_search']);
                                        $sql = "SELECT * FROM memberstbl WHERE id LIKE '%$search%' OR fname LIKE '%$search%' OR lname LIKE '%$search%' OR status LIKE '%$search%' OR usertype LIKE '%$search%' OR dept LIKE '%$search%' OR year LIKE '%$search%' OR section LIKE '%$search%'";
                                        $result = mysqli_query($conn, $sql);
                                        $qresults = mysqli_num_rows($result);

                                        if ($qresults > 0) {
                                            while($resultUser = mysqli_fetch_assoc($result)){
                                                echo '<tr style="display:' . $vis . '" onclick="window.location=\'admin-read.php?memid=' . $resultUser['id'] . '\'">';
                                                echo '<td>' . $resultUser['id'] . '</td>';
                                                echo '<td>' . $resultUser['fname'] . ' ' . $resultUser['lname'] . '</td>';
                                                echo '<td>' . $resultUser['status'] . '</td>';
                                                echo '<td>' . $resultUser['usertype'] . '</td>';
                                                echo '<td>' . $resultUser['dept'] . '</td>';
                                                echo '<td>' . $resultUser['year'] . ' ' . $resultUser['section'] . '</td>';
                                                echo '</tr>';
                                            }
                                        } else { 
                                            echo "<script>alert('NO MEMBERS FOUND')</script>"; 
                                        }
                                    } 
                                if(isset($_POST['user_sortbtn'])){
                                    $sort = mysqli_real_escape_string($conn, $_POST['user_sort']);
                                    if ($sort == "ALL") {
                                        $vis = "show";
                                        $sql = "SELECT * FROM memberstbl";
                                        $result = mysqli_query($conn, $sql);
                                    } else {
                                        $vis = "show";
                                        $sql = "SELECT * FROM memberstbl WHERE usertype = '$sort'";
                                        $result = mysqli_query($conn, $sql);
                                    }
                                
                                    if ($result) {
                                        while($resultUser = mysqli_fetch_assoc($result)){
                                            echo '<tr style="display:' . $vis . '" onclick="window.location=\'read-admin.php?memid=' . $resultUser['id'] . '\'">';
                                            echo '<td>' . $resultUser['id'] . '</td>';
                                            echo '<td>' . $resultUser['fname'] . ' ' . $resultUser['lname'] . '</td>';
                                            echo '<td>' . $resultUser['status'] . '</td>';
                                            echo '<td>' . $resultUser['usertype'] . '</td>';
                                            echo '<td>' . $resultUser['dept'] . '</td>';
                                            echo '<td>' . $resultUser['year'] . ' ' . $resultUser['section'] . '</td>';
                                            echo '</tr>';
                                        }
                                    } else {
                                        echo "<script>alert('No users found');</script>";
                                    }
                                }
                                if (!isset($_POST['user_searchbtn']) && !isset($_POST['user_sortbtn'])){
                                    $sqlUser = "SELECT * FROM memberstbl";
                                    $queryUser = mysqli_query($conn, $sqlUser);

                                    while($resultUser = mysqli_fetch_assoc($queryUser)){
                                        echo '<tr style="display:' . $vis . '" onclick="window.location=\'read-admin.php?memid=' . $resultUser['id'] . '\'">';
                                        echo '<td>' . $resultUser['id'] . '</td>';
                                        echo '<td>' . $resultUser['fname'] . ' ' . $resultUser['lname'] . '</td>';
                                        echo '<td>' . $resultUser['status'] . '</td>';
                                        echo '<td>' . $resultUser['usertype'] . '</td>';
                                        echo '<td>' . $resultUser['dept'] . '</td>';
                                        echo '<td>' . $resultUser['year'] . ' ' . $resultUser['section'] . '</td>';
                                        echo '</tr>';
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <form action="admin-read.php" method="post">
                            <!-- Search Input Group -->
                            <div class="input-group mb-3">
                                <input class="form-control" name="event_search" type="text" placeholder="Search Events...">
                                <button class="btn btn-primary" name="event_searchbtn" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                    </form>
                    <div class="container" style="background: linear-gradient(to left, rgb(247, 150, 150), #cebef8);width:1000px;">
                        <table class="table" style="color:#000;">
                            <thead style="color:#FFF;">
                                <tr>
                                    <th>Event ID</th>
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
                                if (isset($_GET['eveid'])) {
                                    $eveid = $_GET['eveid'];
                                    $ridgetsql = "SELECT * FROM event_tbl WHERE id = '$eveid'";
                                    $ridquery = mysqli_query($conn, $ridgetsql);
                                    $ridrows =  mysqli_num_rows($ridquery);
                                   
                                    if ($ridrows > 0) {
                                      $resultnotif1 = mysqli_fetch_assoc($ridquery);
                                        $clk_id = $resultnotif1['id'];
                                        $clk_edesc = $resultnotif1['edesc'];
                                        $clk_ename = $resultnotif1['ename'];
                                        $clk_edate = $resultnotif1['edate'];
                                        $clk_etime = $resultnotif1['etime'];
                                        $clk_elocation = $resultnotif1['elocation'];
                                        $clk_eorg = $resultnotif1['eorg'];
                                      }
                                    }
                                $vis = "";
                                if(isset($_POST['event_searchbtn'])){
                                    
                                        $vis = "show";
                                        $search = mysqli_real_escape_string($conn, $_POST['event_search']);
                                        $sql = "SELECT * FROM event_tbl WHERE id LIKE '%$search%' OR edesc LIKE '%$search%' OR ename LIKE '%$search%' OR edate LIKE '%$search%' OR etime LIKE '%$search%' OR elocation LIKE '%$search%'";
                                        $result = mysqli_query($conn, $sql);
                                        $qresults = mysqli_num_rows($result);

                                        if ($qresults > 0) {
                                            while($resultUser = mysqli_fetch_assoc($result)){
                                                echo '<tr style="display:' . $vis . '" onclick="window.location=\'admin-read.php?eveid=' . $resultUser['id'] . '\'">';
                                                echo '<td>' . $resultUser['id'] . '</td>';
                                                echo '<td>' . $resultUser['edesc'] . '</td>';
                                                echo '<td>' . $resultUser['ename'] . '</td>';
                                                echo '<td>' . $resultUser['edate'] . '</td>';
                                                echo '<td>' . $resultUser['etime'] . '</td>';
                                                echo '<td>' . $resultUser['elocation'] . '</td>';
                                                echo '<td>' . $resultUser['eorg'] . '</td>';
                                                echo '</tr>';
                                            }
                                        } else { 
                                            echo "<script>alert('NO EVENT FOUND')</script>"; 
                                        }
                                    } 
                                if (!isset($_POST['event_searchbtn'])){
                                    $sqlUser = "SELECT * FROM event_tbl";
                                    $queryUser = mysqli_query($conn, $sqlUser);

                                    while($resultUser = mysqli_fetch_assoc($queryUser)){
                                        echo '<tr style="display:' . $vis . '" onclick="window.location=\'read-admin.php?eveid=' . $resultUser['id'] . '\'">';
                                        echo '<td>' . $resultUser['id'] . '</td>';
                                        echo '<td>' . $resultUser['edesc'] . '</td>';
                                        echo '<td>' . $resultUser['ename'] . '</td>';
                                        echo '<td>' . $resultUser['edate'] . '</td>';
                                        echo '<td>' . $resultUser['etime'] . '</td>';
                                        echo '<td>' . $resultUser['elocation'] . '</td>';
                                        echo '<td>' . $resultUser['eorg'] . '</td>';
                                        echo '</tr>';
                                    }
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