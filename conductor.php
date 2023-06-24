<html lang="en">
<head>
  <title>Conductor_update</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body> 
<link rel="stylesheet" href="mystyle.css">
<?php
    $db_hostname = "127.0.0.1";
    $db_username = "root";
    $db_password = "";
    $db_name = "kyb";
    
    $conn = mysqli_connect($db_hostname, $db_username, $db_password, $db_name);
    
    if (!$conn) 
    {
        echo "Connection failed: " . mysqli_connect_error();
        exit;
    }
    
    $bus_no=$_POST['bus_no'];
    $starting_point=$_POST['starting_point'];
    $destination=$_POST['destination'];
    $delay=$_POST['delay'];
    $sql="update bus_schedule set delay='$delay' where bus_no='$bus_no' ";
    $result = mysqli_query($conn, $sql);
    
    if (!$result) 
    {
        ?>
        <div class="alert alert-danger">
            <strong>Failed to update</strong>
        </div>
    <?php } 
    elseif($result) 
    { ?>
        <div class="container">
            <div class="alert alert-success">
                <strong>Updated Successfully!</strong>
            </div>
        </div>
    <?php } ?>
</body>
</html>
