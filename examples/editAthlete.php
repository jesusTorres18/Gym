<?php include "functions.php";

if ($_SESSION['Role'] == "Empty") {
  echo "<script>location.href='login.php';</script>";
}
if ($_SESSION['Role'] == "Juez") {
  echo "<script>location.href='login.php';</script>";
}

?>
<!DOCTYPE html>
<html lang="en">

<?php include 'header.php'; ?>
<?php viewAthlete($name, $lastName, $phone, $email, $club, $age, $level, $category) ?>

<div class="content">
  <div class="row">

    <div class="col-md-8">
      <div class="card card-user">
        <div class="card-header">
          <h5 class="card-title">Edit Athlete</h5>
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
              <div class="col-md-2 pr-1">
                <div class="form-group">
                  <label for="exampleInputEmail1">Gender</label>
                  <select name="Genero" required class="form-control">
                    <option value="Hombre">Hombre</option>
                    <option value="Mujer">Mujer</option>
                  </select>
                </div>
              </div>
              <div class="col-md-3.1 pl-3">
                <div class="form-group">
                  <label>Age</label>
                  <input type="date" value="<?php echo $age; ?>" name="Edad" required class="form-control" placeholder="Edad">
                </div>
              </div>
              <div class="col-md-4 pr-1">
                <div class="form-group">
                  <label>Phone</label>
                  <input type="tel" value="<?php echo $phone; ?>" maxlength="10" name="Telefono" required pattern="[0-9]{3}[0-9]{3}[0-9]{4}" class="form-control" placeholder="123-456-7890">
                </div>
              </div>
              <div class="col-md-3 pr-1">
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
              <div class="col-md-4 pr-1">
                <div class="form-group">
                  <label>Coach</label>
                  <select class="form-control" name="Entrenador">
                    <?php verEntrenadores(); ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3 pr-1">
                <div class="form-group">
                  <label>Category</label>
                  <select name="Categoria" required class="form-control">
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="13">13</option>
                  </select>
                </div>
              </div>
              <div class="col-md-3 pr-1">
                <div class="form-group">
                  <label>Level</label>
                  <select name="Nivel" required class="form-control">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                  </select>
                </div>
              </div>
              <div class="col-md-3 pr-1">
                <div class="form-group">

                  <input type="checkbox" class="form-group" name="Trampoline" value="Trampoline"> Trampoline<br>
                  <input type="checkbox" class="form-group" name="Tumbling" value="Tumbling"> Tumbling<br>

                </div>
              </div>
            </div>
            <div class="row">
              <div class="update ml-auto mr-auto">
                <button type="submit" name="crear_atleta" class="btn btn-primary btn-round">Update Profile</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>


<?php
if (isset($_POST['crear_atleta'])) {
  updateAthlete();
}
?>


<?php include 'footer.php'; ?>
</div>
</div>

</body>

</html>