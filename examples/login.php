<?php include "functions.php"; 
if(!isset($_SESSION['Role'])){
  $_SESSION['Role'] = "Empty";
}

?>
<!DOCTYPE html>
<html lang="en">

  <?php include 'header.php';?>
    
      <div class="content">
        <div class="row">
    
          <div class="col-md-5">
            <div class="card card-user">
              <div class="card-header">
                <h5 class="card-title">Login</h5>
              </div>
              <div class="card-body">
                <form method="POST">
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" name="Username" placeholder="Username" >
                      </div>
                    </div>
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="Password" placeholder="Password" >
                      </div>
                      
                    </div>
                    
                    <div class="update ml-auto mr-auto">
                      <button type="submit" name="login" class="btn btn-primary btn-round">Login</button>
                    </div>
                   
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>


      <?php 
        if(isset($_POST['login'])){
          Login();
        }
      ?>

        </div>
      <?php include 'footer.php';?>
    </div>
  </div>
 
</body>

</html>
