<?php 

$hn = "localhost";
$un = "root";
$db = "student_info";
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['password'])) {
    $id = $_SESSION['id'];
    $pass = $_SESSION['password'];
}
if (isset($_POST['id']) && isset($_POST['password'])) {
    $id = addslashes($_POST['id']);
    $p = $_POST['password'];
    $pass =$_POST['password'];
}
$sid = "NULL";
$spass = "NULL";
$conn = new mysqli($hn,$un,"",$db);

if ($conn->connect_error) die($conn->connect_error);
$query = "select * from users where id='$id' and password='$pass' ";
$result = $conn->query($query);
if (!$result) die($conn->error);
$rows = $result->num_rows;
for ($j = 0; $j < $rows; $j++) {
    $result->data_seek($j);
    $row = $result->fetch_array(MYSQLI_ASSOC);
    $sid = $row['id'];
    $spass = $row['password'];
}

if (($id == $sid) && ($pass == $spass)) {
    $_SESSION['id'] = $sid;
    $_SESSION['password'] = $spass;
    //echo "Welcome $name ! ";
    //echo <<<_end
    if($id=="2017kucp1034")
    {
        echo "<script>window.open('naresh.html','_self')</script>";
    }
    else if($id=='2017kucp1060') {
        echo "<script>window.open('harriom.html','_self')</script>";
        echo "<meta http-equiv='refresh' content=0 URL='harriom.html'/>";
        echo "<a href='harriom.html'>Click here to continue.</a>";
    }
      
} 
        else if(($id!=$sid) || ($pass!=$spass))
        {

          echo<<<_end
          Invalid UserName or Password.
	        <a href="student.php">Back to login page.</a>
_end;
        }
    
$conn->close();
$result->close();
?>