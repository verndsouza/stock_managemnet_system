<!DOCTYPE html>
<html>
<head lang="en">
   <meta charset="utf-8">
   <title>Invesmart</title>
   <link rel="stylesheet" href="project.css" />
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
<?php
	$server = "localhost";
  $username = "root";
  $password = "lTjXgTQNXd5U";
  $dbname = "Project";
$conn = new mysqli($server, $username, $password,$dbname);


	if ($conn->connect_error)
	  {die("Connection failed: " . $conn->connect_error); }

?>
<div id="main">
  <div style="float:left;float: left;margin-right: -15px;">
  <ul class="sideul" >
      <li id="abc" style="margin-top: 200px;"><a href=home.php>Home</a></li>
    <li><a href=#>Contact</a></li>
  <li><a href=#>About</a></li>
  <li><a href=#>News</a></li>
</ul>
</div>
</div>
<div id="main4" style="margin-left: 15%; margin-top: 3%;" >
<h9>Features Offered:</h9><br/><br/>
   <form style="margin-left: 0%;" action=form.php>
   <button type = "submit" class="button button1">
   &nbsp&nbsp&nbsp&nbsp
   Add Transaction
   &nbsp&nbsp&nbsp&nbsp
   </button></form>
   <br/><br/><br/><br/><br/><br/><br/><br/>
   <form style="margin-left: 0%;" action=delete.php>
   <button type="submit" class="button button1">
   &nbsp&nbsp
   Delete Transaction
   &nbsp&nbsp
   </button>
   </form>
   
   <br/><br/><br/><br/><br/><br/><br/><br/>
   <form style="margin-left: 0%;" action=modify.php>
   <button type="submit" class="button button1">
   &nbsp
   Modify Transaction 
   &nbsp&nbsp
   </button>
   </form>
   <br/><br/><br/><br/><br/><br/><br/><br/>
   <form style="margin-left: 0%;" action=view.php>
   <button type="submit" class="button button1">&nbspView All Transactions&nbsp</button><br/><br/></div>
   <footer id="foot1">
   <p>
	   <img src="images/facebooklogo2.png" alt="Facebook" height=20 width=20/>
	   <img src="images/twitterlogo2.png" alt="Share this on Twitter" height=20 width=20/><pre/></p>
</footer>
</body>
</html>