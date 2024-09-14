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
            background-color: rgba(0, 0, 0, 0.7); /* Adjust the header background color as needed */
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Home</title>
</head>
<body>
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
                        <table class="table" style="color:#000;">
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
                                    echo '<tr class="row" onclick="window.location=\'admin-delete.php?memid=' . $resultroom['id'] . '\'">';
                                    echo '<td>' . $resultroom['fname'] . ' ' . $resultroom['lname'] . '</td>';
                                    echo '<td>' . $resultroom['status'] . '</td>';
                                    echo '<td>' . $resultroom['dept'] . '</td>';
                                    echo '<td>' . $resultroom['year'] . ' ' . $resultroom['section'] . '</td>';
                                    echo '</tr>';
                                }
                                $clk_id = "";
                                $clk_fname = "";
                                $clk_lname = "";
                                $clk_status = "";
                                $clk_usertype = "";
                                $clk_dept = "";
                                $clk_year = "";
                                $clk_section = "";
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
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="container" style="background: linear-gradient(to left, rgb(247, 150, 150), #cebef8);width:1000px;">
                        <table class="table" style="color:#000;">
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
                                    echo '<tr class="row" onclick="window.location=\'admin-delete.php?eveid=' . $resultroom['id'] . '\'">';
                                    echo '<td>' . $resultroom['ename'] . '</td>';
                                    echo '<td>' . $resultroom['edesc'] . '</td>';
                                    echo '<td>' . $resultroom['edate'] . '</td>';
                                    echo '<td>' . $resultroom['etime'] .'</td>';
                                    echo '<td>' . $resultroom['elocation'] .'</td>';
                                    echo '<td>' . $resultroom['eorg'] .'</td>';
                                    echo '</tr>';
                                }
                                $clk_id = "";
                                $clk_edesc = "";
                                $clk_ename = "";
                                $clk_edate = "";
                                $clk_etime = "";
                                $clk_elocation = "";
                                $clk_eorg = "";
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
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="hero min-h-screen" style="background-image: url(artrads.jpg);">
<div class="hero-overlay bg-opacity-60 "></div>  
  <div class="hero-content flex-col lg:flex-row-reverse">
<div class="content">
    <div class="container" style="background: linear-gradient(to left, rgb(247, 150, 150), #cebef8);margin-bottom: 400px;margin-left: 50px;">
        <div class="container" style="justify-content:center;background: linear-gradient(to left, rgb(247, 150, 150), #cebef8);max-width:auto;padding:20px;">
        <form action="admin-delete.php?eveid=<?php echo $eveid; ?>" method="post">
            <label style="display: flex;justify-content: center;align-items: center;color:#000;margin-top:10px;">Event Title</label>
           <input style="display: flex;justify-content: center;align-items: center;margin:auto;width:150px;text-align:center;color:#000" type="text" name="ename" value="<?php echo $clk_ename; ?>">
           <label style="display: flex;justify-content: center;align-items: center;color:#000">Event Description</label>
           <input style="display: flex;justify-content: center;align-items: center;margin:auto;width:150px;text-align:center;color:#000" type="text" name="edesc" value="<?php echo $clk_edesc; ?>">
           <label style="display: flex;justify-content: center;align-items: center;color:#000">Event Date</label>
           <input style="display: flex;justify-content: center;align-items: center;margin:auto;width:150px;text-align:center;color:#000" type="date" name="edate" value="<?php echo $clk_edate; ?>">
           <label style="display: flex;justify-content: center;align-items: center;color:#000">Event Time</label>
           <input style="display: flex;justify-content: center;align-items: center;margin:auto;width:150px;text-align:center;color:#000" type="time" name="etime" value="<?php echo $clk_etime; ?>">
           <label style="display: flex;justify-content: center;align-items: center;color:#000">Event Location</label>
           <input style="display: flex;justify-content: center;align-items: center;margin:auto;width:150px;text-align:center;color:#000" type="text" name="elocation" value="<?php echo $clk_elocation; ?>">
           <label style="display: flex;justify-content: center;align-items: center;color:#000">Event Organization</label>
           <input style="display: flex;justify-content: center;align-items: center;margin:auto;width:150px;text-align:center;color:#000" type="text" name="eorg" value="<?php echo $clk_eorg; ?>">
           <button style="display: flex;justify-content: center;align-items: center;margin:auto;border-radius:5px;background: linear-gradient(to left, rgb(247, 150, 150), #cebef8);color:#fff;margin-top:10px;padding:10px;" type="submit" name="delete-event">Delete Event</button>
        </div>
    </form>
    <?php
    if (isset($_POST['delete-event'])){
        $_SESSION['confirm_delete_event'] = true; // Set session variable to confirm deletion
        $_SESSION['uid_to_delete'] = $eveid; // Store the room ID to be deleted
        echo '<script>';
        echo 'if(confirm("Are you sure you want to delete event ' . $clk_id . '?")) {';
        echo 'window.location.href = "delete-event.php";'; // Redirect to the PHP script for deletion
        echo '} else {';
        echo 'alert("Canceled!");';
        echo '}';
        echo '</script>';
    }
    ?>
    </div>
</div>
<div class="hero-overlay bg-opacity-60 "></div>  
  <div class="hero-content flex-col lg:flex-row-reverse" >
<div class="content" >
    <div class="container" style="background: linear-gradient(to left, rgb(247, 150, 150), #cebef8);margin-bottom: 400px;margin-left: 50px;">
        <div class="container" style="background: linear-gradient(to left, rgb(247, 150, 150), #cebef8);justify-content:center;max-width:auto;padding:20px;">
    <form action="admin-delete.php?memid=<?php echo $memid; ?>" method="post">
            <label style="display: flex;justify-content: center;align-items: center;color:#000;margin-top:10px;">First Name</label>
           <input style="display: flex;justify-content: center;align-items: center;margin:auto;width:150px;text-align:center;color:#000" type="text" name="fname" value="<?php echo $clk_fname; ?>">
           <label style="display: flex;justify-content: center;align-items: center;color:#000">Last Name</label>
           <input style="display: flex;justify-content: center;align-items: center;margin:auto;width:150px;text-align:center;color:#000" type="text" name="lname" value="<?php echo $clk_lname; ?>">
           <label style="display: flex;justify-content: center;align-items: center;color:#000">Status</label>
           <input style="display: flex;justify-content: center;align-items: center;margin:auto;width:150px;text-align:center;color:#000" type="text" name="status" value="<?php echo $clk_status; ?>">
           <label style="display: flex;justify-content: center;align-items: center;color:#000">User Type</label>
           <input style="display: flex;justify-content: center;align-items: center;margin:auto;width:150px;text-align:center;color:#000" type="text" name="usertype" value="<?php echo $clk_usertype; ?>" >
           <label style="display: flex;justify-content: center;align-items: center;color:#000">Department</label>
           <input style="display: flex;justify-content: center;align-items: center;margin:auto;width:150px;text-align:center;color:#000" type="text" name="dept" value="<?php echo $clk_dept; ?>">
           <label style="display: flex;justify-content: center;align-items: center;color:#000">Year</label>
           <input style="display: flex;justify-content: center;align-items: center;margin:auto;width:150px;text-align:center;color:#000" type="text" name="year" value="<?php echo $clk_year; ?>">
           <label style="display: flex;justify-content: center;align-items: center;color:#000">Section</label>
           <input style="display: flex;justify-content: center;align-items: center;margin:auto;width:150px;text-align:center;color:#000" type="text" name="section" value="<?php echo $clk_section; ?>">
           <button style="display: flex;justify-content: center;align-items: center;margin:auto;border-radius:5px;background: linear-gradient(to left, rgb(247, 150, 150), #cebef8);color:#fff;margin-top:10px;padding:10px;" type="submit" name="delete-user">Delete User</button>
        </div>
    </form>
        <?php
        if (isset($_POST['delete-user'])){
            $_SESSION['confirm_delete_user'] = true; // Set session variable to confirm deletion
            $_SESSION['uid_to_delete'] = $memid; // Store the room ID to be deleted
            echo '<script>';
            echo 'if(confirm("Are you sure you want to delete user ' . $clk_id . '?")) {';
            echo 'window.location.href = "delete-user.php";'; // Redirect to the PHP script for deletion
            echo '} else {';
            echo 'alert("Canceled!");';
            echo '}';
            echo '</script>';
        }
        ?>
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