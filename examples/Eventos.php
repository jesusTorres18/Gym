<?php include "functions.php";
if ($_SESSION['Role'] == "Empty") {
  echo "<script>location.href='login.php';</script>";
}
// if($_SESSION['Role'] == "Juez"){
//     echo"<script>location.href='login.php';</script>";
// }
?>
<!DOCTYPE html>
<html lang="en">

<?php include 'header.php'; ?>

<div class="content">
  <div class="row">

    <div class="col-md-3">
      <div class="card card-user">
        <div class="card-header">
          <h5 class="card-title">Event Types</h5>
        </div>
        <div class="card-body">
          <form action="" method="post">

            <div class="row">
              <div class="update ml-auto mr-auto">
                <button type="submit" name="Trampoline" class="btn btn-primary btn-round">Trampoline</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <?php
    if (isset($_POST['Trampoline']) || isset($_POST['Tab'])) {
      Trampoline();
      if (isset($_POST['Tab'])) {
        newtabTrampoline();
      }
    }
    if (isset($_POST['Crear'])) {
      addTrampolineEevent();
      Trampoline();
    }
    ?>
  </div>

</div>

</body>

</html>