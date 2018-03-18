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

$id1=0;
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['del']))
{
  $id1 = (int)test_input($_POST["id"]);
  echo $id1;
  $sql  = "DELETE FROM Customers WHERE id=$id1";
  if ($conn->query($sql) === TRUE) 
  {
    echo '<br/><br/><p style="font-size:1.75em; margin-left:15%; margin-top: 1%;">Deleted Succesfully</p><br/><br/>
    <form style="margin-left: 15%;"action=view.php>
   <button type = "submit" class="button button1">
   View Transactions Table after Deleting Record</button>
   </form>';
  } 
  else 
  {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "GET")
{
  $sql = "SELECT * FROM Customers";
  $result = $conn->query($sql);

  if ($result->num_rows > 0){
    echo '<p id="head">Select <b><u>ONE</u></b> Transaction</p>
    <table>
  <tr>
  <th>ID</th>
  <th>Name</th>
  <th>Date of Trans.</th>
  <th>No. of Shares</th>
  <th>Price per share</th>
  <th>Company</th>
  <th>Comment</th>
  <th>Transaction Type</th>
  </tr>
  <form method="post" action="'.$_SERVER["PHP_SELF"].'">';
  while($row = $result->fetch_assoc()) 
  {
    echo '
    <tr>
   	<td>
   		<div>
   			<label>
   			<input type="radio" name="id" value="'.$row["id"].'">'.$row["id"].'</label>
   		</div>
   	</td>
    <td>' . $row["Name"]. '</td>
    <td>' . $row["Dat"].'</td>
    <td>' . $row["Numb"]. '</td>
    <td>' . $row["Price"]. '</td>
    <td>' . $row["Company"]. '</td>
    <td>' . $row["Comments"]. '</td>
    <td>'. $row["Transactions"].'</td>
    </tr>';
  }
  echo '<tr><td><button class="button button2" type="submit" name="del" value="Delete"/>Delete</td></tr>
  </form></table>';
} 
else {
echo "0 results";}
}
    $conn->close();
    ?>
    <footer id="foot1">
   <p>
     <img src="images/facebooklogo2.png" alt="Facebook" height=20 width=20/>
     <img src="images/twitterlogo2.png" alt="Share this on Twitter" height=20 width=20/><pre/></p>
</footer>

</body>
</html>