<?php include "functions.php"; ?>
<!DOCTYPE html>
<html lang="en">

<?php include 'header.php'; ?>
<?php viewCoach($name, $lastName, $userName, $password, $phone, $email, $status, $club); ?>

<div class="content">
  <div class="row">

    <div class="col-md-8">
      <div class="card card-user">
        <div class="card-header">
          <h5 class="card-title">Edit Coach</h5>
        </div>

        <div class="card-body">
          <form method="POST">
            <div class="row">
              <div class="col-md-3 pr-1">
                <div class="form-group">
                  <label>Name</label>
                  <input type="text" class="form-control" value="<?php echo $name; ?>" name="Nombre" placeholder="Nombre">
                </div>
              </div>
              <div class="col-md-3 pr-1">
                <div class="form-group">
                  <label>LastName</label>
                  <input type="text" class="form-control" value="<?php echo $lastName; ?>" name="Apellido" placeholder="Apellido">
                </div>
              </div>

              <!-- <div class="col-md-3.1 pl-1">
                      <div class="form-group">
                        <label >Edad</label>
                        <input type="date" name="Edad" required class="form-control" placeholder="Edad">
                      </div>
                    </div> -->
              <div class="col-md-3 pr-1">
                <div class="form-group">
                  <label>Phone</label>
                  <input type="tel" name="Telefono" value="<?php echo $phone; ?>" maxlength="10" required pattern="[0-9]{3}[0-9]{3}[0-9]{4}" class="form-control" placeholder="123-456-7890">
                </div>
              </div>
              <div class="col-md-2 pr-1">
                <div class="form-group">
                  <label>Club</label>
                  <select name="Club" required class="form-control">
                    <option value="volvo">Volvo</option>
                    <option value="saab">Saab</option>
                    <option value="mercedes">Mercedes</option>
                    <option value="audi">Audi</option>
                  </select>
                </div>
              </div>
              <!-- <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <label>Entrenador</label>
                        <input type="text" name="Entrenador" required class="form-control" placeholder="Entrenador">
                      </div>
                    </div> -->
            </div>
            <div class="row">
              <div class="col-md-4 pr-1">
                <div class="form-group">
                  <label>Email</label>
                  <input type="email" class="form-control" value="<?php echo $email; ?>" name="Email" placeholder="Email">
                </div>
              </div>
              <div class="col-md-4 pr-1">
                <div class="form-group">
                  <label>Password</label>
                  <input type="password" class="form-control" value="<?php echo $password; ?>" name="Password" placeholder="Password">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="update ml-auto mr-auto">
                <button type="submit" name="crear_entrenador" class="btn btn-primary btn-round">Update Profile</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>


<?php
if (isset($_POST['crear_entrenador'])) {
  updateCoach();
}
?>


<?php include 'footer.php'; ?>
</div>
</div>

</body>

</html>