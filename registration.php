<?php
session_start();

$con=pg_connect("host=localhost port=5432 dbname=project user=postgres password=123") or die("connection Failed");
$username=$_POST['username'];
$password=$_POST['password'];
$email=$_POST['email'];
$phoneno=$_POST['number'];



$s="select * from signup where username='$username';";

$result=pg_query($con,$s)or die("can't fetch");
$num=pg_num_rows($result);
if ($num>0)
{
    echo("<script>alert('Already Exiting User-Name,Try Again!');
          window.location.href = 'sign-up.html';</script>");

}
else{

    $insert="insert into signup (username,password,email,phoneno) values('$username','$password','$email',$phoneno);" ;
    pg_query($con,$insert) or die('can not');
    echo("<script>alert('Registered Successfully!');
          window.location.href = 'login.html';</script>");
  
}