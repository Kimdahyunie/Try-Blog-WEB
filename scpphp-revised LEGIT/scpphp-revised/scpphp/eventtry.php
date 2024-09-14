<?php
session_start();
include("server.php");

$id = $_SESSION['id'];
$query = mysqli_query($conn, "SELECT * FROM scp_tbl WHERE id = '$id'");
while ($result = mysqli_fetch_assoc($query)) {
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
        
        .event-box {
            background: white;
            padding: 20px;
            margin: 10px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        .event-image {
            width: 100%;
            height: auto;
            border-radius: 10px;
        }
        
        .comment-section {
            margin:auto;
        }

        .comment-popup {
            background: white;
            padding: 20px;
            margin: 10px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .comment {
            padding: 10px;
            margin: 10px 0;
            background: #f9f9f9;
            border-radius: 5px;
        }

        .comment p {
            margin: 0;
        }

        .comment .comment-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 5px;
        }
        
        .comment-input {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Events</title>
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
        <div class="content">
            <div class="container-row" style="background: linear-gradient(to left, rgb(247, 150, 150), #cebef8); margin-top: 20px;">
                <div style="justify-content:center; display:flex; flex-direction:column; position:absolute;">
                    <br><h1 style="font-size:30px;">Upcoming Events</h1>
                </div>
                <div class="event-container" style="margin:70px;">
                    <?php
                    $sqlevent = "SELECT * FROM event_tbl";
                    $queryevent = mysqli_query($conn, $sqlevent);
                    $scheduled = mysqli_num_rows($queryevent);

                    while ($resultevent = mysqli_fetch_assoc($queryevent)) {
                        $res_eventid = $resultevent['id'];
                        $res_description = $resultevent['edesc'];
                        $res_ename = $resultevent['ename'];
                        $res_edate = $resultevent['edate'];
                        $res_etime = $resultevent['etime'];
                        $res_location = $resultevent['elocation'];
                        $res_organizer = $resultevent['eorg'];

                        echo '<div class="event-box" onclick="redirectToEvent(' . $res_eventid . ')">';
                        echo '<img src="path/to/event_image.jpg" alt="Event Image" class="event-image">';
                        echo '<h2 style="color:#000;">' . $res_ename . '</h2>';
                        echo '<p style="text-align: left; color:#000; padding-left: 15px;">Description: ' . $res_description . '<br>';
                        echo 'Date: ' . $res_edate . ' Time: ' . $res_etime . '<br>';
                        echo 'Location: ' . $res_location . '<br>';
                        echo 'Organizer: ' . $res_organizer . '<br>';
                        echo '</p>';
                        echo '</div>';
                    }
                    if (isset($_GET['eventid'])) {
                      $eventid = $_GET['eventid'];
                      $ridgetsql = "SELECT * FROM event_tbl WHERE id = '$eventid'";
                      $ridquery = mysqli_query($conn, $ridgetsql);
                      $ridrows =  mysqli_num_rows($ridquery);
                     
                      if ($ridrows > 0) {
                        $resultnotif1 = mysqli_fetch_assoc($ridquery);
                        $clk_eventid = $resultnotif1['id'];
                        $clk_description = $resultnotif1['edesc'];
                        $clk_ename = $resultnotif1['ename'];
                        $clk_edate = $resultnotif1['edate'];
                        $clk_etime = $resultnotif1['etime'];
                        $clk_location = $resultnotif1['elocation'];
                        $clk_organizer = $resultnotif1['eorg'];
                        }
                      }
                    ?>
                </div>
            </div>
            <?php
            if (($showCommentSection = isset($_GET['showCommentSection'])) && $_GET['showCommentSection'] === 'true') {
                echo '<div class="comment-section" id="comment-sec-div">';
                echo '<div class="comment-popup">';
                echo '<span class="close-btn" onclick="closeCommentSection()">X</span>';
                echo '<form action="eventtry.php?eventid=' . $eventid . '&showCommentSection=true" method="post">';
                echo '<div class="container" style="margin-top:10px;text-align: center;">';
                echo '<img src="path/to/event_image.jpg" alt="Event Image" class="event-image">';
                echo '<h2 style="color:#000;">' . $clk_ename . '</h2>';
                echo  '<p style="text-align: left;color:#000;padding-left: 15px;">Description: ' . $clk_description . '<br><br>';
                echo 'Date:' . $clk_edate . 'Time: ' . $clk_etime . '<br>';
                echo 'Location: ' . $clk_location . '<br>';
                echo 'Organizer: ' . $clk_ename . '<br>';
                echo '</p>';
                echo '</div>';
                echo '<div class="container" style="margin-top:20px;text-align: center; padding:20px;">';
                echo '<h2 style="color:#000;">Comments</h2>';

                $sqlcomment = "SELECT * FROM comments_tbl WHERE event_id = '$eventid'";
                $querycomment = mysqli_query($conn, $sqlcomment);
                $comments_num = mysqli_num_rows($querycomment);

                while ($resultcomment = mysqli_fetch_assoc($querycomment)) {
                    $comment_id = $resultcomment['id'];
                    $comment_uid = $resultcomment['user_id'];
                    $comment_fname = $resultcomment['user_fname'];
                    $comment_lname = $resultcomment['user_lname'];
                    $comment_date = $resultcomment['date'];
                    $comment_comment = $resultcomment['comment'];
                    echo '<div class="comment">';
                    echo '<div class="comment-header">';
                    echo '<h2 style="color:#000; text-align:left; margin-bottom:10px;"><i class="fas fa-user-circle" style="font-size:20px;"></i>' . $comment_fname . ' ' . $comment_lname . '</h2>';
                    echo '<p style="color:#000; font-size:12px; text-align:left; margin-top:-18px;">commented on: ' . $comment_date . '</p>';
                    echo '</div>';
                    echo '<p style="color:#000; font-size:20px; text-align:left;">' . $comment_comment . '</p>';
                    echo '</div>';
                }

                echo '<p style="color:#000; display:flex; align-items:center;"><i class="fas fa-user-circle" style="font-size:30px; margin-right: 10px;"></i>' . $res_fname . ' ' . $res_lname . '</p>';
                echo '<input class="comment-input" placeholder="Write your comment here" name="comment_text"></input>';
                echo '<button style="display:block; margin: 20px auto; padding:10px; background: linear-gradient(to left, rgb(247, 150, 150), #cebef8); border:none; cursor:pointer; border-radius:5px;" type="submit" name="comment">Post</button>';

                if (isset($_POST['comment'])) {
                    $user_id = $res_id;
                    $event_com_id = $clk_eventid;
                    $user_fname = $res_fname;
                    $user_lname = $res_lname;
                    $comment_text = $_POST['comment_text'];

                    $sql = "INSERT INTO comments_tbl (user_id, event_id, user_fname, user_lname, comment) VALUES ('$user_id', '$event_com_id', '$user_fname', '$user_lname', '$comment_text')";
                    if (mysqli_query($conn, $sql)) {
                        echo '<script>alert("Commented Successfully!")</script>';
                        echo '<script>window.location.href = "eventtry.php?eventid=' . $eventid . '&showCommentSection=true";</script>';
                    } else {
                        echo '<script>alert("Comment Failed!")</script>';
                    }
                }

                echo '</div>';
                echo '</div>';
            }
            ?>
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
    function toggleProfileMenu() {
        // Add your toggle profile menu script here if needed
    }

    function closeCommentSection() {
        document.getElementById('comment-sec-div').style.display = 'none';
    }

    function redirectToEvent(eventId) {
        window.location.href = 'eventtry.php?eventid=' + eventId + '&showCommentSection=true';
    }
</script>
</body>
</html>