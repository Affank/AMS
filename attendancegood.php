
<?php
include('header.php');
//Declaring Globals
$date = date('Y-m-d');
//Initializing session 
$c=0;
session_start();

    if(isset($_POST['present']))
	{
        $_SESSION['i'] = isset($_SESSION['i']) ? ++$_SESSION['i'] : 0;
        $c=$_SESSION['i'];
		
		}
		 if(isset($_POST['absent']))
	{
        $_SESSION['i'] = isset($_SESSION['i']) ? ++$_SESSION['i'] : 0;
        $c=$_SESSION['i'];
		
		}
		/* if(isset($_POST['submit1']))
	{
        $_SESSION['i'] = isset($_SESSION['i']) ? ++$_SESSION['i'] : 0;
        $c=$_SESSION['i'];
		echo $c;
		}*/
		if(isset($_POST['des']))
		{
			$_SESSION["i"]=0;
		}
		
 //Connecting to Database
$servername = "localhost";
$username = "root";
$password = "";
$dbname= "attendance";
// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//fetching roll numbers
$sql = "SELECT roll_no from student";
$res=$conn->query($sql);
	$array=array();
while($a=$res->fetch_row())
{
	$array[]=$a[0];
}
if(isset($_POST['n1']))
$roll=$_POST['n1'];

//if present
if(isset($_POST['present']))
$conn->query("INSERT into stat values($roll,NOW(),'p')");

//if absent
if(isset($_POST['absent']))
$conn->query("INSERT into stat values($roll,NOW(),'a')");

?>




<html>
<html lang="en">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/custom.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
  </head>
  <body>
  
 
<div class="container-fluid text-center"> <h3>Today's Date is <?php echo $date?><br><br></h3>
<form action="" method="POST">
<p><strong><?php  try{
	if($c>=count($array))
		throw new Exception("List completed");
		else
			echo $array[$c];
	} 
catch(Exception $e){
echo $e->getMessage();
} ?></strong></p>
<input type="hidden" name="n1" value="<?php echo $array[$c];?>">
<div class="btn-group">
<div class="btn-group">
<input type="submit" class="btn btn-success btn-lg" name="present" value="present">
</div>
<div class="btn-group">
<input type="submit" class="btn btn-danger btn-lg"name="absent" value="absent">
</div>
<div class="btn-group">
<input type="submit" name="des" class="btn btn-warning btn-lg" value="Reset">
</div>
</div>
</div>
</form>




<!--<div class="container-fluid bg-1 text-center">
  <h3>Who Am I?</h3>
  <img src="bird.jpg" class="img-circle" alt="Bird">
  <h3>I'm an adventurer</h3>
</div>

<div class="container-fluid bg-2 text-center">
  <h3>What Am I?</h3>
  <p>Lorem ipsum..</p>
</div>

<div class="container-fluid bg-3 text-center">
  <h3>Where To Find Me?</h3>
  <p>Lorem ipsum..</p>
</div> -->
</body>







