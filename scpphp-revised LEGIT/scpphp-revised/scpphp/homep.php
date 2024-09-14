<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="@import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap');">
    <title>Welcome to Artrads</title>

<style>

    body {
        font-family: 'Montserrat', sans-serif;
        background: linear-gradient(to right, #e2e2e2, #c9d);
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
     }
     .container {
         margin-top: 0px;
         display: flex;
         flex-direction: column;
     }
     .btn {
         display: flex;
         flex-direction: column;
         padding: 10px 45px;
         margin: 20px;
         background-color: #c9d;
         color: white;
         text-decoration: none;
         border: none;
         border-radius: 8px;
         cursor: pointer;
         text-transform: uppercase;
         font-size: 15px;
         font-weight: 600;
         letter-spacing: 0.5px;
         align-items: center;
     }
     .btn:hover {
         background-color: #c9d;
         filter: brightness(85%);
     }

</style>    
</head>
<body>
    <div class="container">
        <h1>Welcome to Artrads!</h1>
        <div>
            <a href="LOGREG.PHP" class="btn">Login</a>
            <a href="LOGREG.PHP" class="btn">Register</a>
        </div>
    </div>
</body>
</html>