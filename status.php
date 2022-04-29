<?php 
session_start();
$con=pg_connect("host = localhost port=5432 dbname=project user=postgres password=123") or die("connection Failed");
 $sno = (isset($_POST['SNo']) ? $_POST['SNo'] : 'error');
//$name=$_SESSION['name'];
if(isset($_POST['accept']))
{
       $query="UPDATE events SET Status =true WHERE SNo='$SNo'";
       pg_query($con,$query);
       echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/hotel/admin.php#event">';
   }
   else if(isset($_POST['pay']))
   {
       $query="UPDATE events SET Status ='paid' WHERE SNo='$SNo'";
       pg_query($con,$query);
        echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/hotel/appointment.php#event">';
   }

else if(isset($_POST['reject']))
   {
       $query="UPDATE events SET Status =false WHERE SNo='$SNo'";
       pg_query($con,$query);
        echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/hotel/admin.php#event">';
   }
else if(isset($_POST['delete']))
   {
      
     $query="DELETE FROM events WHERE 'SNo' ='$SNo'";
       pg_query($con,$query);
        echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/hotel/admin.php#E-expired">';
   }
else {
    
    $query="UPDATE events SET Status ='cancel' WHERE SNo='$SNo'";
    pg_query($con,$query);
     echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/hotel/appointment.php#event">';
}


?>
