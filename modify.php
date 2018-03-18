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
  $i=0;
$nameErr = $typeErr = $dateErr = $numErr= $priceErr= $compErr="";

global $id1;
global $id2;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit']))
{
$nameErr = $typeErr = $dateErr = $numErr= $priceErr= $compErr="";
$name = $type = $date = $comment = $comp="";
$m=$d=$yr=$num=$price=0;
  if (empty($_POST["name"])) 
  {
    $nameErr = "Name is required";
    $i=1;
  } 
  else 
  {
    $name = test_input($_POST["name"]);
    if(!preg_match("/^[a-zA-Z ]*$/",$name)) 
    {
      $nameErr = "Only letters and white space allowed"; 
      $i=1;
    } 
  }

  if (empty($_POST["date"])) 
  {
    $dateErr = "Date is required";
    $i=1;
  }
  else 
  {
    $date = test_input($_POST["date"]);
    if(strlen($date)>10||strlen($date)<8)
    {
      $dateErr = "Inavlid Input!";
      $i=1;
    }
    $y=0;
    
    $mon=$day=$year="";
    for($x=0 ; $x<strlen($date) ; $x++)
    {
      //echo ord($date[$x]).'<br/>';
      if(ord($date[$x])<48 || ord($date[$x])>57)
      {
        $dateErr = "Inavlid Input!";
        $i=1;
        break;
      }
      if($y==0)
      {
        for($z=$x;$z<=2;$z++)
        {
          if($date[$z]=='/')
          {
            $mon= substr($date, $x, $z);
            $x=$z;
            $y++;
            //echo 'Mon = '.$mon.'<br/>';
            $m=(int)$mon;
            break;
          }
        }
        if($y==0)
        {
          $dateErr = "Inavlid Input!";
          $i=1;
          break;
        }
        if($m<1 || $m>12)
        {
          $dateErr = "Inavlid Month!";
          $i=1;
          break;
        }
        continue;
      }
      $c=0;
      if($y==1)
      { 
        for($z=$x;$z<=5;$z++)
        {
          if($date[$z]=='/')
          {
            $day= substr($date, $x, $c);
            $x=$z;
            $y++;
            //echo 'Day = '.$day.'<br/>';
            $d=(int)$day;
            break;
          }
          else
            {$c++;}
        }
        if($y==1)
        {
          $dateErr = "Inavlid Input!";
          $i=1;
          break;
        }
        if($d==0 || $d>31)
        {
          $dateErr = "Inavlid Date!";
          $i=1;
          break;
        }
        if($d==31)
        {
          if($m==4||$m==6||$m==9||$m==11)
          {
            $dateErr = "Inavlid Date!";
            $i=1;
          }
        }
        continue;
      }
    else
    {
        $year=substr($date, $x, strlen($date)-1);
        $yr=(int)$year;
        if(strlen($year)!=4 || $yr<1900)
        {
          $dateErr = "Inavlid Year! Transactions accepted only after 01/01/1900.";
          $i=1;
          break;
        }
        
        break;
      }

    }
    if($m==2)
  {
    if($yr%4==0 && $d==29)
    { 
      //echo '1';
      if($yr%100==0 && $yr%400==0)
      {
        //echo '2';
        break;
      }
      else if($yr%100==0)
      {
        //echo '3';
        $dateErr = "Inavlid Date!";
        $i=1;
      }   
    }
    else if ($d>28)
    {
      //echo '5';
      $dateErr = "Inavlid Date!";
      $i=1;
    }
  }

  }
  $present=getdate(date("U"));
  
  //echo $present['mon'].'/'.$present['mday'].'/'.$present['year'].'<br/>';
  if($yr>$present['year'])
  {
    $dateErr = "Date cannot be in future!";
    $i=1;
  }
  else if($yr==$present['year'] && $m>$present['mon'])
  {
    $dateErr = "Date cannot be in future!";
    $i=1;
  }
  else if($yr==$present['year'] && $m==$present['mon']&& $d>$present['mday'])
  {
    $dateErr = "Date cannot be in future!";
    $i=1;
  }

  $no="";
  if (empty($_POST["num"])) 
  {
      if(test_input($_POST["num"])=='0')
      {
        $numErr = "Invalid Entry! Cannot be 0.";
        $i=1;
      }
      else
      {
        $numErr = "No. of shares is required.";
        $i=1;
      }
      
    } 
    else 
    {
      $no=test_input($_POST["num"]);
      for($x=0;$x<strlen($no);$x++)
      {
        if(ord($no[$x])<47 || ord($no[$x])>57)
        {
          $numErr = "Invalid Entry!";
          $i=1;
          $x=100;
          echo 'aa';
          break;
        }
      }
      if($x!=100)
      {
  
        $num = (int)test_input($_POST["num"]);
        if($num>100000 || $num<1)
        {
          $numErr = "Invalid Entry! Has to be between 1 and 100000.";
          $i=1;
        }
      }

  }
  if (empty($_POST["price"])) 
  {
      if(test_input($_POST["price"])=='0')
      {
        $priceErr = "Invalid Entry! Cannot be 0.";
        $i=1;
      }
      else
      {
        $priceErr = "Price is required.";
        $i=1;
      
    } 
}
    else 
    {
      $no=test_input($_POST["price"]);
      for($x=0;$x<strlen($no);$x++)
      {
        if(ord($no[$x])<47 || ord($no[$x])>57)
        {
          $priceErr = "Invalid Entry!";
          $i=1;
          $x=100;
          break;
        }
      }
      if($x!=100)
      {
  
        $price = (int)test_input($_POST["price"]);
        if($price>1000 || $price<1)
        {
          $priceErr = "Invalid Entry! Has to be between 1 and 1000.";
          $i=1;
        }
      }

  }

  if (empty($_POST["company"])) 
    {
      $compErr = "Company Name is required.";
      $i=1;
    } 
    else 
    {
      $comp = test_input($_POST["company"]);
    }
  
  if (empty($_POST["comment"])) 
  {
    $comment = "";
  } 
  else 
  {
    $comment = test_input($_POST["comment"]);
  }

  if (empty($_POST["type"])) {
    $typeErr = "Type is required";
    $i=1;
  } else {
    $type = test_input($_POST["type"]);
  }
  $id2=(int)test_input($_POST["ineedyou"]);
  //echo $id2.'<br/>';
  if($i==0){
  $sql  = "UPDATE Customers 
  SET Name = '$name', 
  Dat = '$date', 
  Numb = '$num',
  Price = '$price',
  Company = '$comp', 
  Comments = '$comment', 
  Transactions = '$type'
  WHERE id=$id2";

  if ($conn->query($sql) === TRUE) {
    echo '<br/><br/><p style="font-size:1.75em; margin-left:15%; margin-top: 1%;">Updated Succesfully</p><br/><br/>
    <form style="margin-left: 15%;"action=view.php>
   <button type = "submit" class="button button1">
   View Transactions Table after Updating Record</button>
   </form>
    ';} 
  else {
    echo "Error: " . $sql . "<br>" . $conn->error;}
  }

}

if($_SERVER["REQUEST_METHOD"] == "POST" &&isset($_POST['submit'])&&$i==1)
{
  //echo $id2.'<br/>';
  $id2=(int)test_input($_POST["ineedyou"]);
  $sql  = "SELECT * FROM Customers WHERE id=$id2";
  $result = $conn->query($sql);
  
  if ($result->num_rows > 0){
  while($row = $result->fetch_assoc()) {
  echo '<form id="form10" method="post" action="'.$_SERVER["PHP_SELF"].'"><div style="margin-left: 20%; margin-top: 3%;" ><h8>Form</h8>
<p><span class="error">* - required field.</span></p>
  <input type="hidden" name="ineedyou" Value="'.$id1.'"/>
    Name: <input type="text" name="name" Value="'.$row["Name"].'">
  <span class="error">*'.$nameErr.'</span>
  <br><br>
  Date of Transaction:<input type="date" name="date" Value="'.$row["Dat"].'"/> (MM/DD/YY)
  <span class="error">*'.$dateErr.'</span>
  <br><br>
  No. of shares: <input type="text" name="num" Value="'.$row["Numb"].'"/>
  <span class="error">*'.$numErr.'</span>
  <br><br>
  Price per share: <input type="text" name="price" Value="'.$row["Price"].'"/>$ 
  <span class="error">*'.$priceErr.'</span>
  <br><br>
  Company: <input type="text" name="company" Value="'.$row["Company"].'"/>
  <span class="error">*'.$compErr.'</span>
  <br><br>
  Comment: <textarea name="comment" rows="5" cols="40">'.$row["Comments"].'</textarea>
  <br><br>
  Transacton Type:';

  if($row["Transactions"]=='Purchased')
  {
    echo'
  <input type="radio" name="type" value="Purchased" checked>Purchased
  <input type="radio" name="type" value="Sold">Sold
   <span class="error">*'.$typeErr.'</span>
  <br><br>';
  }
  else if($row["Transactions"]=='Sold')
  {
    echo'
  <input type="radio" name="type" value="Purchased">Purchased
  <input type="radio" name="type" value="Sold" checked>Sold
   <span class="error">*'.$typeErr.'</span>
  <br><br>';
  }

  echo'<button class="button button1" type="submit" name="submit"/>Modify<br/>
  <button class="button button1" type="reset" value="Reset"/>Reset<br/>
  </div></form>';
}
}
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['modify']))
{
  global $id1;
  $id1= (int)test_input($_POST["id"]);
  $sql  = "SELECT * FROM Customers WHERE id=$id1";
  $result = $conn->query($sql);
  

if ($result->num_rows > 0){
  while($row = $result->fetch_assoc()) {
  echo '<form id="form10" method="post" action="'.$_SERVER["PHP_SELF"].'"><div style="margin-left: 20%; margin-top: 3%;" ><h8>Form</h8>
<p><span class="error">* - required field.</span></p>
  <input type="hidden" name="ineedyou" Value="'.$id1.'"/>
    Name: <input type="text" name="name" Value="'.$row["Name"].'">
  <span class="error">*'.$nameErr.'</span>
  <br><br>
  Date of Transaction:<input type="date" name="date" Value="'.$row["Dat"].'"/> (MM/DD/YY)
  <span class="error">*'.$dateErr.'</span>
  <br><br>
  No. of shares: <input type="text" name="num" Value="'.$row["Numb"].'"/>
  <span class="error">*'.$numErr.'</span>
  <br><br>
  Price per share: <input type="text" name="price" Value="'.$row["Price"].'"/>$ 
  <span class="error">*'.$priceErr.'</span>
  <br><br>
  Company: <input type="text" name="company" Value="'.$row["Company"].'"/>
  <span class="error">*'.$compErr.'</span>
  <br><br>
  Comment: <textarea name="comment" rows="5" cols="40">'.$row["Comments"].'</textarea>
  <br><br>
  Transacton Type:';

  if($row["Transactions"]=='Purchased')
  {
    echo'
  <input type="radio" name="type" value="Purchased" checked>Purchased
  <input type="radio" name="type" value="Sold">Sold
   <span class="error">*'.$typeErr.'</span>
  <br><br>';
  }
  else if($row["Transactions"]=='Sold')
  {
    echo'
  <input type="radio" name="type" value="Purchased">Purchased
  <input type="radio" name="type" value="Sold" checked>Sold 
   <span class="error">*'.$typeErr.'</span>
  <br><br>';
  }

  echo'<button class="button button1" type="submit" name="submit"/>Modify<br/>
  <button class="button button1" type="reset" value="Reset"/>Reset<br/>
  </div></form>';
}

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
    echo '<p id="head">Select <b><u>ONE</u></b> Transaction</p><table>
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
  echo '<tr><td><button class="button button2" type="submit" name="modify" value="Modify"/>Modify</td></tr>
  </form></table>';
} 
else {
echo "0 results";}
}$conn->close();
    ?>
    <footer id="foot1">
   <p>
     <img src="images/facebooklogo2.png" alt="Facebook" height=20 width=20/>
     <img src="images/twitterlogo2.png" alt="Share this on Twitter" height=20 width=20/><pre/></p>
</footer>

</body>
</html>