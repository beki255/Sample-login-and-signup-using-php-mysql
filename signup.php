<?php
$fname="";
$lname="";
$email="";
$sex="";
$pass1="";
$pass2="";
$err=array();
$congra="";
//database connection
$conn=mysqli_connect("localhost","root","","db");
if(isset($_POST["SIGNUP"])){
$fname=mysqli_real_escape_string($conn,$_POST["fname"]);
$lname=mysqli_real_escape_string($conn,$_POST["lname"]);
$email=mysqli_real_escape_string($conn,$_POST["email"]);
$sex=mysqli_real_escape_string($conn,$_POST["sex"]);
$pass1=mysqli_real_escape_string($conn,$_POST["pass1"]);
$pass2=mysqli_real_escape_string($conn,$_POST["pass2"]);
//validation
if($pass1!=$pass2){
    array_push($err,"the two passwords is not match!");
}
$user_check_query="select * from users where firstname='$fname' or email='$email' limit 1";
$result=mysqli_query($conn,$user_check_query);
$user=mysqli_fetch_assoc($result);

if($user['firstname']===$fname){
    array_push($err,"user name already exist");

}else if($user['email']===$email){
    array_push($err,"email is already exist");
}
//finaly register
if(count($err)===0){
    $query="insert into users (firstname,lastname,sex,email,password)values('$fname','$lname','$sex','$email','$pass1')";
    mysqli_query($conn,$query);
    $congra="you are successfully registerd! please login";
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>signup system</title>
    <link rel="stylesheet" href="css/signup_style.css">
</head>
<body>
    <div class="box2">
        <h1>signup here</h1>
        <div class="err">
            <?php include "err.php";?>
        </div>
        <?php echo $congra; ?>
        <form action="signup.php" method="post">
            <input type="text" name="fname" id="" placeholder="enter firstname" required> 
            <input type="text" name="lname" id="" placeholder="enter lastname" required> 
            <input type="email" name="email" id="" placeholder="enter email" required> 
            <label>SEX</label>
            <input type="radio" name="sex" id="" value="male" required>Male
            <input type="radio" name="sex" id="" value="female" required>Female
            <input type="password" name="pass1" id="" placeholder="enter password" required>
            <input type="password" name="pass2" id="" placeholder="confirm password" required>
            <input type="submit" value="SIGNUP" name="SIGNUP" >
            already a member? <a href="login.php" style="color:#ffc107;">LOGIN</a>
        </form>
    </div>
</body>
</html>