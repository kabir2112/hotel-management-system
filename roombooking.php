    <?php
    
    session_start();
    $con=pg_connect("host = localhost port=5432 dbname=project user=postgres password=123") or die("connection Failed");

    $id = $_SESSION['ID'];
    $name=$_POST['Name'];
    $_SESSION['name']=$_POST['Name'];
    $uname=$_SESSION['username'];
    $city=$_POST['City'];
    $checkin=$_POST['Checkin'];
    $checkout=$_POST['Checkout'];
    $type=$_POST['Type'];
    $total=$_POST['Total'];
    $guest=$_POST['NoGuest'];
    $phoneno=$_POST['Phoneno'];
    


       


    $sel="select * from $type ";
   
     $num =pg_query($con,$sel);
if(pg_num_rows($num)>0)
{  
  while($row=pg_fetch_assoc($num))
{
     $flag = false;
      $sno=$row ['sno'];
      if ($row['availability']==1)
      { 
            $flag =true;
           $reg="insert into room (ID,NoGuest,Checkin,Checkout,Type,Total,Name,username,PhoneNo,City,Status) values(4,'$guest','$checkin','$checkout','$type','$total','$name','$uname','$phoneno','$city', 'Pending');";
          pg_query($con,$reg);
          break ; 
      }
     
      
      
  }
    if ($flag==false)
    {
        echo "<script>alert('No Rooms are available in this type ,plz select another type of room'); 
        window.location.href='room.php';
        </script>";
        
    }
      else {
//           header('location:appointment.php');
          echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/hotel/appointment.php#room">';
}
     
}
else {
    
    echo "Empty";
}

   



