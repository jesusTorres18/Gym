<?php include "functions.php"; ?>
<!DOCTYPE html>
<html lang="en">

<?php include "header.php"; ?>

<div class="content">
  <div class="row">
    <div class="col-md-15">
      <div class="card">
        <div class="card-header">
          <?php
          global $con;
          $evento = $_GET['Evento'];
          $query = "SELECT * FROM Events WHERE EventID = '$evento'";
          $run_items = mysqli_query($con, $query);
          $row_items = mysqli_fetch_array($run_items);
          $place = $row_items['Place'];
          $time = $row_items['Time'];
          $date = $row_items['Date'];
          $newDate = date("d-m-Y", strtotime($date));
          $Hora = date("g:i a", strtotime("$time UTC"));
          echo "<h6 class='card-title'>Place: $place</h4>";
          echo "<h6 class='card-title'>Date: $newDate</h4>";
          echo "<h6 class='card-title'>Hour: $Hora</h4>";

          ?>
          <?php

          global $con;
          $evento = $_GET['Evento'];
          $juez = $_GET['Juez'];
          $atleta = $_GET['Atleta'];

          $query = "SELECT * FROM User WHERE UserID='$juez' ";
          $run_items = mysqli_query($con, $query);
          $row_items = mysqli_fetch_array($run_items, MYSQLI_ASSOC);

          $name = $row_items['Name'];
          $LastName = $row_items['LastName'];

          echo "<h4 class='card-title'>Juez: $name $LastName</h4>";
          ?>
          <h4 class="card-title"> Edit Score</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table">
              <thead class=" text-primary">
                <th>Name</th>
                <th>Lastname</th>
                <th>Score</th>
                <th>H</th>
                <th>D</th>
                <th>Penalty</th>
              </thead>
              <tbody>

                <?php
                if ($_SESSION['Role'] == "Juez") {
                  ListadoAtletasParaEvaluar();
                }

                if ($_SESSION['Role'] == "Admin") {
                  EditarPuntos();
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>


    </div>
  </div>


</div>
</div>
<?php include "footer.php"; ?>

</body>

</html>