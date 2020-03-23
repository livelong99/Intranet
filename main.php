<?php

include 'conn.php';

$regno = $_POST["username"];



if(!filter_var($regno,FILTER_VALIDATE_INT)) {
	header("Location: login.php"); 
  	exit;
}

$stmt = $conn->prepare("SELECT * from student where Reg_No= ?");
$stmt->bind_param("i", $regno);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {

	header("Location: login.php"); 
  	exit;
} else {
	session_start();
	$_SESSION['LAST_ACTIVITY'] = time();
	if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 600)) {
    	session_unset();     
    	session_destroy();
	}
    $_SESSION['regno'] = $regno;
    $row = $result->fetch_assoc();
}
$conn->close();

 include 'header.php';

?>



 		<a class="user" href="#"> <font><?php echo $row['Name']; ?></font><img src="Images/user.png" style="width:50px; height:50px; margin-right: 60px; margin-top: 10px; margin-left: 10px;"></a>
     </div>
     
    <div class="news"></div>
    
    <div class="dashboard">

      <h3>Dashboard</h3><br>
      <p align="left" ><b> Name :</b> <?php echo $row['Name']; ?> </p>
      <p align="left" ><b> Registration Number :</b> <?php echo $row['Reg_No']; ?> </p>
      <p align="left" ><b> Phone Number :</b> <?php echo $row['Mobile_Number']; ?> </p>
      <p align="left" ><b> Branch :</b> <?php echo $row['Stream']; ?> </p>
          
    </div>
      
      <div class="tabs">
        <h1>Recents</h1><br><br><br><br><br>
              <input id="tab-1" type="radio" name="radio-set" class="tab-selector-1" checked="checked" />
            <label for="tab-1" class="tab-label-1">Events</label>
    
              <input id="tab-2" type="radio" name="radio-set" class="tab-selector-2" />
            <label for="tab-2" class="tab-label-2">Quizes</label>
    
              <input id="tab-3" type="radio" name="radio-set" class="tab-selector-3" />
            <label for="tab-3" class="tab-label-3">Holiday</label>
            
          <div class="clear-shadow"></div>
      
            <div class="content">
              <div class="content-1">
            <h2>Events</h2>
            
            </div>
              <div class="content-2">
            <h2>Quizes</h2>
            
            </div>
              <div class="content-3">
            <h2>Holidays</h2>
            </div>
            </div>
      </div>



<?php include 'footer.php';?>