<?php
session_start();
$con=pg_connect("host = localhost port=5432 dbname=project user=postgres password=123") or die("connection Failed");
$username=$_POST['username'];
$password=$_POST['password'];
//$s="select username,password from signup where username='".$_POST["$username"]."' and password='".$_POST["$password"]."';";
$s="select username, password from signup where username= '$username' and password= '$password'";
$result=pg_query($con,$s) or die ('failed to query');
$row=pg_fetch_array($result);   

if(($row['username']==$username) && ($row['password']==$password))
{
    $_SESSION['username']=$username;
    $_SESSION['password']=$password;
    $_SESSION['ID']=$row['ID'];
   
    echo("<script>alert('Login Successfully!');
          window.location.href = 'home1.php';</script>");
        
//    header('location:home1.php');
}
else{
	echo("<script>alert('Invalid Username or Password. Try Again!');
          window.location.href = 'login.html';</script>");
}
?>
