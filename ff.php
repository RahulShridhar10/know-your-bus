<script src="https://cdn.tailwindcss.com"></script>
<div class="flex justify-evenly mt-8">
            <img src="Images/tnstc_header01.jpg">
            <h1 class="flex justify-center text-6xl mt-5"><b>KNOW YOUR BUS</b></h1>
            <img src="Images/tnstc_header03.jpg">
        </div>
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
    $start=$_POST['start'];
    $destination=$_POST['destination'];
    $boarding_at=$_POST['boarding_at'];
    $boarding_time = date('H:i:s', strtotime($_POST['boarding_time']));
    //echo $start.$destination.$boarding_at.$boarding_time;
    //*******getting route_id*********
    $sql="select route_id from route_detail where start='$start' and destination='$destination'";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        echo "Error: " . mysqli_error($conn);
        exit;
    }
    //echo "Routes <br> ";
    while ($route= mysqli_fetch_assoc($result)) {

        //echo $route['route_id']."<br>" ;
        $route_detail=$route['route_id'];
    }
    //echo "Route: ".$route_detail."<br>";

    //*********getting time**********
    $sql="select time from stop_detail where route_id='$route_detail' and stop_name='$boarding_at'";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        echo "Error: " . mysqli_error($conn);
        exit;
    }
                $row = mysqli_fetch_assoc($result);
                if ($row) {
                    $time_detail=$row['time'];
                    //echo "Time :" . $row['time'] . "<br/>";
                } else {
                    //echo "Login Failed<br/>";
                }
                //echo $time_detail. "<br/>";
    //************Getting bus Starting time and delay if any ******************
                $sql = "SELECT bus_no,st_time , delay from bus_schedule WHERE '$boarding_time'<=dest_time and route_id='$route_detail' ";

                $result = mysqli_query($conn, $sql);
                if (!$result) {
                    echo "Error: " . mysqli_error($conn);
                    exit;
                }?>
                <table border="1" cellspacing="0" cellpadding="14" class=" flex justify-center mt-48 ml-8 ">
                <tr class="border-4 border-black">
                        
                        <th class="border-4 border-black">BUS NUMBER</th>
                        <th class="border-4 border-black">ETA</th>
                        <th class="border-4 border-black">DELAY</th>
                </tr>
                <?php while ($row = mysqli_fetch_assoc($result)) 
                {
                    ?>
                
                <?php

                    
                    $time_detail="00:00:00";
                    $time = strtotime($row['st_time'])+strtotime($time_detail) - strtotime('00:00:00');
                    $time = date('H:i:s', $time);
                    //echo "Total Time  :".$time;
                    if($time>$boarding_time)
                    {
                    ?>
                          <tr class="border-2 border-black">
                        <td class="border-2 border-black"><?php echo $row['bus_no'];?> </td>
                        <td class="border-2 border-black"><?php echo $time; ?> </td>
                    <?php
                    }
                        if($time>$boarding_time & $row['delay']=='00:00:00')
                        {
                    ?>
                            <td><?php echo"No delay"; ?> </td>
                            </tr>
                        <?php
                        }
                        elseif($time>$boarding_time & $row['delay']!='00:00:00')
                        {
                         ?>   
                         <td><?php echo $row['delay']; ?> </td>
                         </tr>
                        <?php } 
                    }
                  
                ?>
                </table>

                    
                    

                

                

