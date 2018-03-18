<!DOCTYPE html>
<html>
<head lang="en">
   <meta charset="utf-8">
   <title>Ivesmart</title>
   <link rel="stylesheet" href="project.css" />
</head>

</head>
<body>
<header>
   <h1>Invesmart</h1>
   <h3>The Wolf of G Street</h3>
</header>

   <ul class="topul">
  <li><a href=view.php>Transaction Table</a></li>
  <li><a href=form.php>Add Transaction</a></li>
  <li><a href=delete.php>Delete Transaction</a></li>
  <li><a href=modify.php>Modify Transaction</a></li>
</ul>
<div id="main">
  <div style="float:left;float: left;margin-right: -15px;">
  <ul class="sideul" >
      <li style="margin-top: 182px;"><a href=home.php>Home</a></li>
    <li><a href=#>Contact</a></li>
  <li><a href=#>About</a></li>
  <li><a href=#>News</a></li>
</ul>
</div>
</div>
<?php
$server = "localhost";
  $username = "root";
  $password = "lTjXgTQNXd5U";
  $dbname = "Project";
$conn = new mysqli($server, $username, $password,$dbname);
if ($conn->connect_error) 
  {die("Connection failed: " . $conn->connect_error); }
//echo "Connected successfully";

$sql = "CREATE TABLE IF NOT EXISTS Customers (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
Name VARCHAR(50) NOT NULL, 
Dat VARCHAR(10) NOT NULL,
Numb INT(7) NOT NULL,
Price INT(7) NOT NULL,
Company VARCHAR(100) NOT NULL,
Comments VARCHAR(160), 
Transactions VARCHAR(10) NOT NULL
)";
$conn->query($sql);
$sql = "SELECT * FROM Customers";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    echo '<p id="head">Transactions</p>
    <table><th>ID</th><th>Name</th><th>Date of Trans.</th><th>No. of Shares</th><th>Price per share</th><th>Company</th><th>Comments</th><th>Transaction Type</th></tr>';
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["id"]. "</td><td>" . $row["Name"]. "</td><td>" . $row["Dat"]."</td><td>" . $row["Numb"]. "</td><td>" . $row["Price"]. "</td><td>" . $row["Company"]. "</td><td>" . $row["Comments"]. "</td><td>" . $row["Transactions"]."</td></tr>";
      }
      echo '</table>';
    } 
    else {
    echo "0 results";}
    $conn->close();
  ?>
<footer id="foot1">
   <p>
     <img src="images/facebooklogo2.png" alt="Facebook" height=20 width=20/>
     <img src="images/twitterlogo2.png" alt="Share this on Twitter" height=20 width=20/><pre/></p>
</footer>

</body>
</html>