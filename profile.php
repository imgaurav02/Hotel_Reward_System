
<?php
    include("./db.php");

    if(isset($_GET['phone'])){
        $phone = $_GET['phone'];
        $query = "select * from points where phone = '$phone'";
        $res = mysqli_query($con,$query);
        if(mysqli_num_rows($res) > 0){
            $arr = mysqli_fetch_array($res);
        }
        else{
            header("location: index.php");    
        }
    }
    else{
        header("location: index.php");
    }

    if(isset($_POST['earn'])){
        $point = $_POST['points'];
        $new_points = (int)$point + (int)$arr['reward'];
        $phone = $arr['phone'];
        $query = "update points set reward = $new_points where phone = '$phone'";
        $res = mysqli_query($con,$query);
        if($res){
            $query = "insert into history(phone,transectionType,latestPoints,transectionPoint) values('$phone',1,$new_points,$point)";
            mysqli_query($con,$query);
            echo '<div class="alert alert-success" role="alert">
            Reward Updated SuccessFully!!!!
          </div>';
            $url1=$_SERVER['REQUEST_URI'];
            header("Refresh: 5; URL=$url1");
        }
        else{
            echo '<div class="alert alert-danger" role="alert">
            Something Went Wrong    
          </div>';
        }
    }
    if(isset($_POST['redeem'])){
        $point = $_POST['points'];
        if((int)$point <= (int)$arr['reward']  )
        {
            $new_points = (int)$arr['reward'] - (int)$point;
            $phone = $arr['phone'];
            $query = "update points set reward = $new_points where phone = '$phone'";
            $res = mysqli_query($con,$query);
            if($res){
                $query = "insert into history(phone,transectionType,latestPoints,transectionPoint) values('$phone',0,$new_points,$point)";
                mysqli_query($con,$query);
                echo '<div class="alert alert-success" role="alert">
                Reward Redeemed SuccessFully!!!!
            </div>';
                $url1=$_SERVER['REQUEST_URI'];
                header("Refresh: 5; URL=$url1");
            }
            else{
                echo '<div class="alert alert-danger" role="alert">
                Something Went Wrong    
            </div>';
            }
        }   
        else{
            echo '<div class="alert alert-danger" role="alert">
                Not Enough Coins    
            </div>';
        }
    }
?>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href = "https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css"> </link>
    <link rel="stylesheet" href = "https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"> </link>
    <link rel="stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> </link>
    
    <link rel="stylesheet" href = "./profile_style.css"> </link>
    
    

</head>

<div class="container mt-5">
    <div class="row d-flex justify-content-center">
        <div class="col-md-7">
            <div class="card p-3 py-4">
                <div class="text-center"> <img src="https://i.imgur.com/bDLhJiP.jpg" width="100" class="rounded-circle"> </div>
                <div class="text-center mt-3"> <span class="bg-secondary p-1 px-4 rounded text-white">Points : <?php echo $arr['reward'] ?></span>
                    <h5 class="mt-2 mb-0"><?php echo $arr['name'] ?></h5> <span><?php echo $arr['phone'] ?></span>
                    
                    <ul class="social-list">
                        <li><i class="fa fa-facebook"></i></li>
                        <li><i class="fa fa-dribbble"></i></li>
                        <li><i class="fa fa-instagram"></i></li>
                        <li><i class="fa fa-linkedin"></i></li>
                        <li><i class="fa fa-google"></i></li>
                    </ul>
                    <div class="buttons">
                         <button type="button" class="btn btn-outline-primary px-4" data-toggle="modal" data-target="#earnpoint">Earn Points</button>
                    
                    <button class="btn btn-primary px-4 ms-3" data-toggle="modal" data-target="#redeempoint">Reedeem Points</button> 
                    <a href="./history.php?phone=<?php echo $arr['phone']?>" class="btn btn btn-outline-primary px-4 ms-3">History</a>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="buttons">
    <a href="./index.php" class="btn btn-primary px-4 ms-3">Go Back</a>
</div>

<!-- earnpoint Modal -->
<div class="modal fade" id="earnpoint" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Earn Points</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="post" >
        <div class="form-group">
            <input type="number" name="points" placeholder="Enter the amount that person has spends" class="form-control" required>
        </div>
        <button type="submit" name="earn" class="btn btn-primary">Submit</button>
    </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Redeem point Modal -->
<div class="modal fade" id="redeempoint" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Redeem Points</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="post" >
        <div class="form-group">
            <input type="number" name="points" placeholder="Enter the amount that person has spends" class="form-control" required>
        </div>
        <button type="submit" name="redeem" class="btn btn-primary">Submit</button>
    </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>