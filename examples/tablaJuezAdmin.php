<?php include "functions.php"; ?>
<!DOCTYPE html>
<html lang="en">

  <?php include "header.php"; ?>

      <div class="content">
        <div class="row">
          <div class="col-md-15">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title"> Judges</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <th>
                        Name
                      </th>
                      <th>
                        Lastname
                      </th>
                      <th>
                        Phone
                      </th>
                      <th>
                        Email
                      </th>


                    </thead>
                    <tbody>

                      <?php
                        VerJuecesTabla();
                        if(isset($_GET['ID'])){
                          Enable_Disable_Juez();
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
