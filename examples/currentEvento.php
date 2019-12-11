<?php include "functions.php"; ?>
<!DOCTYPE html>
<html lang="en">

  <?php include "header.php"; ?>
  
      <div class="content">
        <div class="row">
          <div class="col-md-15" style="position:relative; left: 15px;">
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
                  echo"<h6 class='card-title'>Lugar: $place</h4>";
                  echo "<h6 class='card-title'>Fecha: $newDate</h4>";
                  echo "<h6 class='card-title'>Hora: $Hora</h4>";

                ?>
                <h4 class="card-title"> Atletas</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                    <th>
                        Ranking
                      </th>
                      <th>
                        Nombre
                      </th>
                      <th>
                        Apellido
                      </th>
                      <th>
                        Puntuaciones
                      </th>
                      
                      <th>
                        Total
                      </th>
                      
                    </thead>
                    <tbody>
                    <form method="POST">
                        <select name="Add" required class="form-control">
                            <?php selectAtleta(); ?>
                        </select>
                        <button type='submit' class='btn btn-primary btn-round'>Add</button>
                        
                        <?php 
                          if(isset($_POST['Add'])){
                            addAtletaToEvento();
                          }
                          ?>
                    </form>
                    
                      <?php 
                      
                        if($_SESSION['Role'] == "Entrenador"){
                            verAtletasEnEvento();
                        }
                        if($_SESSION['Role'] == "Admin"){
                            verAtletasEnEventoAdmin();
                            if($_GET['Status'] == 'Enable'){
                              echo"<form action='currentEvento.php?Evento={$_GET['Evento']}&Status={$_GET['Status']}' method = 'POST'><tr><td><button type='submit' name='enable' class='btn btn-primary btn-round'>Finalizar</button></td></tr> </form>";
                            }
                            if($_GET['Status'] == 'Disable'){
                              echo"<form action='currentEvento.php?Evento={$_GET['Evento']}&Status={$_GET['Status']}' method = 'POST'><tr><td><button type='submit' name='enable' class='btn btn-primary btn-round'>Activar</button></td></tr> </form>";
                            }
                            if(isset($_POST['enable'])){
                              Enable_Disable_Event();
                            }
                            
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
  <?php include "footer.php"; ?>
  
</body>

</html>
