<?php include "functions.php"; ?>
<!DOCTYPE html>
<html lang="en">

  <?php include 'header.php';?>
    
      <div class="content">
        <div class="row">
    
          <div class="col-md-8">
            <div class="card card-user">
              <div class="card-header">
                <h5 class="card-title">Crear/Editar Juez</h5>
              </div>
              <div class="card-body">
                <form method="POST">
                  <div class="row">
                    <div class="col-md-3 pr-1">
                      <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" class="form-control" name="Nombre" placeholder="Nombre" >
                      </div>
                    </div>
                    <div class="col-md-3 pr-1">
                      <div class="form-group">
                        <label>Apellido</label>
                        <input type="text" class="form-control" name="Apellido" placeholder="Apellido" >
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
                        <label>Telefono</label>
                        <input type="tel" name="Telefono" required pattern="[0-9]{3}[0-9]{3}[0-9]{4}" class="form-control" placeholder="123-456-7890">
                      </div>
                    </div>
                    <div class="col-md-2 pr-1">
                      <!-- <div class="form-group">
                        <label>Club</label>
                        <select name="Club" required class="form-control">
                          <option value="volvo">Volvo</option>
                          <option value="saab">Saab</option>
                          <option value="mercedes">Mercedes</option>
                          <option value="audi">Audi</option>
                        </select>
                      </div> -->
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
                        <input type="email" class="form-control" name="Email" placeholder="Email" >
                      </div>
                    </div>
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="Password" placeholder="Password" >
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="update ml-auto mr-auto">
                      <button type="submit" name="crear_admin" class="btn btn-primary btn-round">Update Profile</button>
                    </div>
                  </div> 
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>


      <?php 
        if(isset($_POST['crear_admin'])){
          crearAdmin();
        }
      ?>


      <?php include 'footer.php';?>
    </div>
  </div>
 
</body>

</html>
