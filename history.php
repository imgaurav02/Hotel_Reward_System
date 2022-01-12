<?php
    include("./db.php");
    if(isset($_GET['phone'])){
        $phone = $_GET['phone'];
        $query = "select * from points where phone = '$phone'";
        $res = mysqli_query($con,$query);
        if(mysqli_num_rows($res) > 0){
            $name = mysqli_fetch_array($res);
            $name = $name['name'];
            $query = "select * from history where phone = '$phone'";
            $res_history = mysqli_query($con,$query);
            if(mysqli_num_rows($res) == 0){
                echo "No Record Found";
                die();
            }
        }
        else{
            header("location: index.php");    
        }
    }
    else{
        header("location: index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <title>History</title>
</head>
<body>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Phone</th>
      <th scope="col">Transection Type</th>
      <th scope="col">Reward</th>
      <th scope="col">Closing Reward</th>
    </tr>
  </thead>
  <tbody>
      <?php
        while($arr = mysqli_fetch_assoc($res_history)){
      ?>
      <?php if($arr['transectionType'] == 0){ ?>
    <tr class="table-danger">
      <td><?php echo $name; ?></td>
      <td><?php echo $arr['phone']; ?></td>
      <td>Debit</td>
      <td><?php echo $arr['transectionPoint']; ?></td>
      <td><?php echo $arr['latestPoints']; ?></td>
    </tr>
    <?php }  else{?>
        <tr class="table-success">
            <td><?php echo $name; ?></td>
            <td><?php echo $arr['phone']; ?></td>
            <td>Credit</td>
            <td><?php echo $arr['transectionPoint']; ?></td>
            <td><?php echo $arr['latestPoints']; ?></td>
        </tr>
        
        <?php } // if else end ?> 
    <?php } //while ends ?>
  </tbody>
</table>

<div class="buttons">
    <a href="./index.php" class="btn btn-primary px-4 ms-3">Go Back</a>
</div>
</body>
</html>