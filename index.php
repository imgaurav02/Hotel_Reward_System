<?php
    include('./db.php');

    if(isset($_POST['view'])){
        $phone = $_POST['phone'];
        $query = "select * from points where phone = '$phone'";
        $res = mysqli_query($con,$query);
        if(mysqli_num_rows($res) > 0){
            header("location: profile.php?phone=$phone");
        }   
        else{
            header("location: add_user.php?phone=$phone");
        }
    }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
  </head>
  <body>
    <div class="container">
      <div class="wrapper">
        <div class="title"><span>Taste Of Teenagers</span></div>
        <form method="post">
          <div class="row">
            <i class="fas fa-phone"></i>
            <input type="text" placeholder="Enter The Phone Number" name="phone" required>
          </div>
          <div class="row button">
            <input type="submit" name="view" value="View">
          </div>
        </form>
      </div>
    </div>

  </body>
</html>
