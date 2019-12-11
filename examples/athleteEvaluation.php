<?php include "functions.php"; ?>
<!DOCTYPE html>
<html lang="en">

<?php include 'header.php'; ?>
<?php viewAthlete($name, $lastName, $phone, $email, $club, $age, $level, $category) ?>

<?php editAthleteScore($Score, $H, $D, $T, $P) ?>
<div class="content">
  <div class="row">

    <div class="col-md-6">
      <div class="card card-user">
        <div class="card-header">
          <h5 class="card-title">Athlete Evaluation</h5>
          <br />
          <h6 class="card-title"><?php echo $name, $lastName; ?></h6>
          <h6 class="card-title"><?php echo "Category : ", $category; ?></h6>
          <h6 class="card-title"><?php echo "Level : ", $level; ?></h6>

        </div>
        <div class="card-body">
          <form method="POST">
            <div class="row">
              <div class="col-md-4 pr-1">
                <div class="form-group">
                  <label>Score</label>
                  <input type="text" class="form-control" required name="puntos" value="<?php echo $Score; ?>">
                </div>
              </div>
              <div class="col-md-4 pr-1">
                <div class="form-group">
                  <label>D.Horizontal</label>
                  <input type="text" class="form-control" name="H" required value="<?php echo $H; ?>">
                </div>
              </div>
              <div class="col-md-4 pr-1">
                <div class="form-group">
                  <label>Difficulty</label>
                  <input type="text" class="form-control" name="dificultad" required value="<?php echo $D; ?>">
                </div>
              </div>
              <div class="col-md-4 pr-1">
                <div class="form-group">
                  <label>Time</label>
                  <input type="time" class="form-control" name="T" required value="<?php echo $T; ?>">
                </div>
              </div>
              <div class="col-md-4 pr-1">
                <div class="form-group">
                  <label>Penalty</label>
                  <input type="text" class="form-control" name="penalidad" value="<?php echo $P; ?>">
                </div>
              </div>


            </div>
            <div class="row">
              <div class="update ml-auto mr-auto">
                <?php
                if (isset($_GET['Juez'])) {
                  echo "<button type='submit' name='edit' class='btn btn-primary btn-round'>Update</button>";
                } else {
                  echo "<button type='submit' name='Add' class='btn btn-primary btn-round'>Submit</button>";
                }

                ?>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>


<?php
if (isset($_POST['Add']) || isset($_POST['edit'])) {
  EvaluarAtleta_Juez();
}
?>


<?php include 'footer.php'; ?>
</div>
</div>

</body>

</html>