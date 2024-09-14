<?php
session_start();
include("server.php");
?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Welcome!</title>
    <style>
        .go-back {
            position: absolute;
            top: 10px;
            right: 10px;
            padding: 10px 20px;
            background-color: #ff347f;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .go-back:hover {
            background-color: #c9356c;
        }
    </style>
</head>
<body>
    <a href="index.html" class="go-back">Go Back</a>
    
    <div class="container" id="container">
        <div class="form-container sign-up">
            <form action="LOGREG.php" method="post">
                <h1>Create Account</h1>
                <input type="text" placeholder="First Name" name="fname" id="fname" required>
                <input type="text" placeholder="Last Name" name="lname" id="lname" required>
                <input type="email" placeholder="Email" name="email" id="email" required>
                <input type="password" placeholder="Password" name="password" id="password" required>           
                <button type="submit" name="register">Sign Up</button>
            </form>
        </div>
        <div class="form-container sign-in">
            <form action="LOGREG.php" method="post">                
                <h1>Sign In</h1>              
                <input type="email" placeholder="Email" name="email" required>
                <input type="password" placeholder="Password" name="password" required>
                <a href="#">Forgot Your Password?</a>
                <button type="submit" name="login">Sign In</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-right">
                    <h1>Hello, Friend!</h1>
                    <p>Register with your personal details to use all of site features</p>
                    <button class="hidden" id="Login">Sign Up</button>
                </div> 
                <div class="toggle-panel toggle-login">
                    <h1>Welcome Back!</h1>
                    <p>Enter your personal details to use all of site features</p>
                    <button class="hidden" id="register">Sign In</button>
                </div>
            </div>            
        </div>    
    </div>
    
<?php
$fname = "";
$lname = "";
$email = "";
$password = "";
if (isset($_POST['register'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "INSERT INTO scp_tbl (fname, lname, email, password) VALUES ('$fname', '$lname', '$email', '$password')";
    mysqli_query($conn, $sql);
    echo '<script>alert("Registered Successfully!")</script>';
}
?>

<?php 
$row = "";
$email = "";
$password = "";

if (isset($_POST['login'])) {
    $email1 = mysqli_real_escape_string($conn, $_POST['email']);
    $password1 = mysqli_real_escape_string($conn, $_POST['password']);
    $result = mysqli_query($conn, "SELECT * FROM scp_tbl WHERE email='$email1' AND password='$password1'") or die("Select Error");
    $row = mysqli_fetch_assoc($result);

    if (is_array($row) && !empty($row)) {
        $_SESSION['id'] = $row['id'];
        $_SESSION['fname'] = $row['fname'];
        $_SESSION['lname'] = $row['lname'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['password'] = $row['password'];
        header("location: home.php");
    } else {
        echo '<script>alert("Wrong Email or Password!")</script>';
    }
}
?>
    <script src="script.js"></script>
</body>
</html>