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
	 <a href='Profile1.php?hello=true'><span class="glyphicon glyphicon-bell"></span></a></span>
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
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
//$sql="UPDATE notification SET read1=1 WHERE user2='".$_SESSION['name']."'";
//$sql = "delete from notification where user2='".$_SESSION['name']."'";
//$result = $conn->query($sql);


//$conn->close();
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

	<form action="Profile1.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>
<?php
$target_dir = "profile/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        //echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
		echo '<p><center><img align="middle" src="'.$target_file.'" alt="Smiley face" height="300" width="300" /></center></p><br><br>';
		
      
// Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
		//$conn2 = new mysqli($servername, $username, $password, $dbname);
// Check connection
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }
		$sql=null;
		$sql = "delete from profile where name='".$_SESSION['name']."'";
		 $result = $conn->query($sql);
         $sql = "INSERT INTO profile (id,file,name,time) VALUES (".$_SESSION['id'].",'".$target_file."',NOW(),'".$_SESSION['name']."')";
         $result = $conn->query($sql);
           $i=0;
         if ($result === TRUE) {
        echo "your file uploded successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}	
          $sql = "SELECT name FROM users where name!= '".$_SESSION['name']."'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		$sql="INSERT INTO notification(user1,user2,type,time,read1) VALUES ('".$_SESSION['name']."','".$row['name']."','profile',NOW(),0)";
		$stmt=$conn->prepare($sql);
		$stmt->execute();
    }
} else {
    echo "0 results";
}
 $conn->close();   
}
}
// Check if file already exists

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>
</body>
</html>
