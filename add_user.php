
<?php
    include('./db.php');
    if(isset($_GET['phone'])){
        $phone = $_GET['phone'];
    }
    else{
        header("location: index.php");
    }

    if(isset($_POST['add_user'])){
        $name = $_POST['name'];
        $phone = $_POST['phone'];

        $query = "insert into points (name,phone) values('$name','$phone')";
        $res = mysqli_query($con,$query);
        if($res){
            header("location: profile.php?phone=$phone&status=success");
        }
        else{
            echo "something went wrong";
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
        <div class="title"><span>Add New User</span></div>
        <form method="post">
          <div class="row">
            <i class="fas fa-phone"></i>
            <input type="text" placeholder="Enter The Phone Number" name="phone" value="<?php echo $phone; ?>" required>
          </div>
          <div class="row">
            <i class="fas fa-user"></i>
            <input type="text" placeholder="Enter The Full Name" name="name" required>
          </div>
          <div class="row button">
            <input type="submit" name="add_user" value="Add User">
          </div>
        </form>
      </div>
    </div>

  </body>
</html>
