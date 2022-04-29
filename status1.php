<!--status1 for room booking management-->

<?php 
session_start();
$con=pg_connect("host = localhost port=5432 dbname=project user=postgres password=123") or die("connection Failed");
 $SNo = (isset($_POST['SNo']) ? $_POST['SNo'] : 'error');
 $Type = (isset($_POST['Type']) ? $_POST['Type'] : 'error');
 $ID = (isset($_POST['ID']) ? $_POST['ID'] : 'error');
 $Name = (isset($_POST['Name']) ? $_POST['Name'] : 'error');
 $Rno = (isset($_POST['NoRoom']) ? $_POST['NoRoom'] : 'error');
//$name=$_SESSION['name'];


if(isset($_POST['accept']))
{
       $query="UPDATE room SET Status='true' WHERE SNo=$SNo";
    pg_query($con,$query);
    echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/hotel/admin.php#room">';
    
   }
 else if(isset($_POST['pay']))
   {
     
     
      $query="UPDATE room SET Status ='paid' WHERE SNo='$SNo'"; $sel="select * from $Type";
   $num =pg_query($con,$sel);
    
     while($row=pg_fetch_assoc($num))
{
     
      $SNo=$row['SNo'];
      if ($row['Availability']==1)
      {       
           $avail="UPDATE $Type SET  Availability =false,Name='$Name',ID='$ID'  WHERE SNo ='$SNo' ";
           break ; 
      }
     
  }
       pg_query($con,$avail);
       pg_query($con,$query);
        echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/hotel/appointment.php#room">';
   }


else if (isset($_POST['free'])){
     
       $query="DELETE FROM room WHERE sno ='$sno'";
      $sel="select * from $type";
      $num =pg_query($con,$sel);
    
     while($row=pg_fetch_assoc($num))
{
      $sno=$row['SNo'];
      if ($row['Availability']==0)
      {   
           $avail="UPDATE $Type SET  Availability =true,Name='',ID=''  WHERE SNo ='$SNo'AND ID='$ID' AND Name='$Name' ";
           break ; 
      }
      
  }
    pg_query($con,$avail);
    pg_query($con,$query);
    echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/hotel/admin.php#expired">';
    
}


else if (isset($_POST['Rfree'])){
     
       $query="DELETE FROM room WHERE SNo ='$SNo'";
    pg_query($con,$query);
    echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/hotel/admin.php#rejected">';
    
}

   else if(isset($_POST['reject']))
   {
       $query="UPDATE room SET Status ='false' WHERE 'SNo'='$SNo'";
       pg_query($con,$query);
        echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/hotel/admin.php#room">';
   }

else if(isset($_POST['add']))
   { $i=0;
    while($i<$Rno){
        $i++;
        $query="insert into $Type ("Availability") values('1');";
        pg_query($con,$query);
    }
     //echo "<script>alert('Room is added'); window.location.href='http://localhost/hotel/admin.php#add'; </script>";
 
   }
else if(isset($_POST['delete']))
   { $i=0;
    $sel="select * from $Type";
   $num =pg_query($con,$sel);
    while($row=pg_fetch_assoc($num))
{
      $SNo=$row['SNo'];
    }
    echo $SNo;
  
    while($i<$Rno){
        
       $query="DELETE  FROM $Type WHERE SNo='$SNo'";
       pg_query($con,$query);
        $i++;
        $SNo--;
        
    }
     echo "<script>alert('Room is deleted'); window.location.href='http://localhost/hotel/admin.php#add'; </script>";
 
   }

else {
    
    $query="UPDATE room SET Status ='cancel' WHERE SNo='$SNo'";
    pg_query($con,$query);
     echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/hotel/appointment.php#room">';
}



?>

