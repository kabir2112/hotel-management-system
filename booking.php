    <?php
    session_start();
    $con=pg_connect("host = localhost port=5432 dbname=project user=postgres password=123") or die("connection Failed");
    
    $id = $_SESSION['ID'];
    $name=$_POST['Name'];
    $_SESSION['name']=$_POST['Name'];
    $uname=$_SESSION['username'];
    $city=$_POST['City'];
    $checkin=$_POST['Checkin'];
    $type=$_POST['Type'];
    $guest=$_POST['NoGuest'];
    $in=$_POST['InTime'];
   
    $phoneno=$_POST['Phoneno'];
 $out=$_POST['OutTime'];
 $tot=$_POST['Total'];
    


         if (isset($_SESSION['username'])){
              $reg="insert into events (ID,Type,NoGuest,Checkin,InTime,OutTime,username,Name,Phone,City,Total,Status) values('$id','$type','$guest','$checkin','$in','$out','$uname','$name','$phoneno','$city','$tot','Pending') ";
             pg_query($con,$reg);
//             header('location:appointment.php');
              echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/hotel/appointment.php#event">';
             
         }
       
       
       else{
           $reg="insert into events (ID,Type,NoGuest,Checkin,InTime,OutTime,username,Name,Phone,City,Total,Status) values('NO ID','$type','$guest','$checkin','$in','$out','Guest','$name','$phoneno','$city','$tot','Pending') ";
             pg_query($con,$reg);
           header('location:home.html');
//           echo'HI YOUR ROOMS IS BOOKED AS A GUEST ACCOUNT ,PLEASE LOGIN TO SEE BOOKING HISTORY ';
           
        }
       
    ?>