<?php
include 'confi.php';
session_start();
$_SESSION['id'];
$_SESSION['name'];
$_SESSION['email'];
$_SESSION['password'];
?>
<!DOCTYPE html>
<html>
<head>
 <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script   src="https://code.jquery.com/jquery-3.1.0.min.js"   integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s="   crossorigin="anonymous"></script>

<style>
ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #333;
}

li {
    float: left;
}

li a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

li a:hover:not(.active) {
    background-color: #111;
}

.active {
    background-color: #4CAF50;
}
.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    padding: 12px 16px;
    z-index: 1;
}

.dropdown:hover .dropdown-content {
    display: block;
}
</style>
</head>
<body>


 
<nav class="navbar navbar-inverse">
            <div class="container-fluid">
                
  <li><a  href="Profile.php">Profile</a></li>
  <li><a class="active" href="Home.php">Home</a></li>
  <li><a  href="ADDImage.php">Add Image</a></li>
  
  
     <div class="dropdown">
	 <a href='Home.php?hello=true'><span class="glyphicon glyphicon-bell"></span></a></span>
 <span class="badge" style="color:WHITE">
         
<div id="myDropdown" class="dropdown-content" size="3">
   
      
	 <?php


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "select user1,user2,type,time,read1  from notification where user2='".$_SESSION['name']."' order by time desc";

$result = $conn->query($sql);
$i=0;
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		$sql = "select file  from profile where name='".$row['user1']."'";
		$result1 = $conn->query($sql);
		$row1 = $result1->fetch_assoc();
		 
		if($row['read1']==0)
		{
		$i=$i+1;
		echo '<p><img align="middle" src="'.$row1["file"].'" alt="Smiley face" height="20" width="20" /></p>';
        echo "<font color='red'>".$row["user1"]." upload a ".$row["type"].",".$row["time"]."</font><br><br>";
		
		}
		else
		{
			echo '<p><img align="middle" src="'.$row1["file"].'" alt="Smiley face" height="20" width="20" /></p>';
        echo "<font color='blue'>".$row["user1"]." upload a ".$row["type"].",".$row["time"]."</font><br><br>";
		
		}
    }
} else {
    echo "0 results";
}

$conn->close();
?>
         <br><span class="badge"><?php
		 echo $i?> Notifications</span>
                    </div><span class="badge"><?php
		 echo $i?></span>
  </div>
			<li style="float:right"><a href="logout.php"><span class="	glyphicon glyphicon-off"></span></a></li>
            <li style="float:right"><?php echo "<font color='green'>".$_SESSION['name']."</font>" ?></a></li>				
</div>
        </nav>
		

<?php
   //
  function runMyFunction($servername, $username, $password, $dbname) {
	$conn = new mysqli($servername, $username, $password, $dbname);
	$sql="UPDATE notification SET read1=1 WHERE user2='".$_SESSION['name']."'";
    $result = $conn->query($sql);	
	$conn->close();
  }

  if (isset($_GET['hello'])) {
    runMyFunction($servername, $username, $password, $dbname);
  }
?>

	<?php
	     
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "select name, file, time from profile order by time desc";

$result = $conn->query($sql);
$i=0;
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		echo "<center><h2>".$row["name"]." change the profile </h2><br/>";
		echo "<p>".$row["time"]. "</p><br/></center>";
		echo '<p><center><img align="middle" src="'.$row["file"].'" alt="Smiley face" height="300" width="300" /></center></p><br><br>';
        //echo "<li>","<a href=". $row["name"].".html>".$row["name"]."<br></a></li>";
		$i=$i+1;
    }
} else {
    echo "0 results";
}

$sql = "select name, file ,time from add_img order by time desc";

$result = $conn->query($sql);
$i=0;
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
			echo "<center><h2>".$row["name"]." uploaded the image </h2><br/>";
		echo "<p>".$row["time"]. "</p><br/></center>";
		echo '<center><img align="middle" src="'.$row["file"].'" alt="Smiley face" height="300" width="300" align="middle"/></center><br /><br/>';
        //echo "<li>","<a href=". $row["name"].".html>".$row["name"]."<br></a></li>";
		$i=$i+1;
    }
} else {
    
}

$conn->close();
	?>
</body>
</html>
