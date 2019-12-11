<?php
$con = mysqli_connect("localhost","root","password","Gym");

session_start();
if (mysqli_connect_errno())
{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
function calcularEdad($edad){
		$dateOfBirth = $edad;
		$today = date("Y-m-d");
		$diff = date_diff(date_create($dateOfBirth), date_create($today));
		// echo 'Age is '.$diff->format('%y');
		return((int)$diff->format('%y'));
}
function printPhone($from)
{

	$to = sprintf("%s-%s-%s", substr($from, 0, 3), substr($from, 3, 3), substr($from, 6, 4));
	return $to;
}

function crearAdmin(){
	global $con;
	$Nombre = $_POST['Nombre'];
	$Apellido = $_POST['Apellido'];
	$Telefono = $_POST['Telefono'];
	// $Club = $_POST['Club'];
	$Email = $_POST['Email'];
	$Password = $_POST['Password'];
	$user = strstr($Email, '@', true);

	$crear_admin = "INSERT INTO User(Name, LastName, UserName, Password, Phone, Email, Role)
						VALUES('$Nombre', '$Apellido', '$user', '$Password', '$Telefono','$Email', 'Admin')";
	$send_query = mysqli_query($con, $crear_admin);


	if (!$send_query) {
		die('Could not update data: ');
	} else {
		echo "Updated data successfully\n";
		unset($_POST);
		unset($_REQUEST);
		echo "<script>location.href='tablaAdmin.php';</script>";
	}
}

function VerAdmin(){
	global $con;

	if (isset($_POST['search'])) {
		$search = $_POST['search'];
		$query = "SELECT * FROM User WHERE UserID NOT LIKE '{$_SESSION['Admin']}' AND Name LIKE '%$search%' OR LastName LIKE '%$search%' ";
	} else {
		$query = "SELECT * FROM User WHERE Role = 'Admin' AND UserID NOT LIKE '{$_SESSION['Admin']}'";
	}

	$run_items = mysqli_query($con, $query);

	while ($row_items = mysqli_fetch_array($run_items)) {
		$ID = $row_items['UserID'];
		$Nombre = $row_items['Name'];
		$Apellido = $row_items['LastName'];
		$Telefono = $row_items['Phone'];
		$email = $row_items['Email'];
		$Status = $row_items['Status'];
		if ($Status == 'Enable') {
			echo "<tr>
						<td>$Nombre</td>
						<td>$Apellido</td>
						<td>"; echo printPhone($Telefono); echo "  </td>
						<td>$email</td>
						<td>   <a href='tablaAdmin.php?ID=$ID&Status=$Status'  class='btn btn-primary btn-round' >Desactivate</a>   </td>
					</tr>";
		}
		if ($Status == 'Disable') {
			echo "<tr>
						<td>$Nombre</td>
						<td>$Apellido</td>
						<td>"; echo printPhone($Telefono); echo "  </td>
						<td>$email</td>
						<td>   <a href='tablaAdmin.php?ID=$ID&Status=$Status'  class='btn btn-primary btn-round' >Activate</a>   </td>
					</tr>";
		}
	}
}

function Enable_Disable_Admin(){
	global $con;

	$id = $_GET['ID'];

	$Status = $_GET['Status'];

	if ($Status == 'Enable') {
		$query2 = "UPDATE User SET Status = 'Disable' WHERE UserID = '$id'AND Role = 'Admin'";
		$send_query2 = mysqli_query($con, $query2);
	}
	if ($Status == 'Disable') {
		$query2 = "UPDATE User SET Status = 'Enable' WHERE UserID = '$id'AND Role = 'Admin'";
		$send_query2 = mysqli_query($con, $query2);
	}

	echo "<script>location.href='tablaAdmin.php';</script>";
	
}

function crearAtleta(){
	global $con;
	$Nombre = $_POST['Nombre'];
	$Apellido = $_POST['Apellido'];
	$Genero = $_POST['Genero'];
	$Edad = $_POST['Edad'];//calcularEdad($_POST['Edad']);
	$Telefono = $_POST['Telefono'];
	// $Club = $_POST['Club'];
	$Entrenador = $_SESSION['NombreCompleto'];
	$Categoria = $_POST['Categoria'];
	$Nivel = $_POST['Nivel'];
	$Street1 = $_POST['street1'];
	$Street2 = $_POST['street2'];
	$State = $_POST['state'];
	$City = $_POST['city'];
	$Postal = $_POST['postal'];
	$CoachID = $_SESSION['CoachID'];
	$crear_atleta = "INSERT INTO Athletes (
		NameAthletes,
		LastNameAthletes,
		Age,
		Gender,
		Category,
		Levels,
		TypeGimnastic,
		Street1,
		Street2,
		State,
		City,
		PostalCode,
		PhoneAthletes,
		UserID )
	VALUES('$Nombre ', '$Apellido', '$Edad','$Genero', '$Categoria', '$Nivel',
		'Acro', '$Street1', '$Street2','$State','$City', '$Postal', '$Telefono','$CoachID')";

	echo $crear_atleta;
	$send_query = mysqli_query($con, $crear_atleta);

	// if(isset($_POST['Tumbling']) ){
	// 		$Tumbling = $_POST['Tumbling'];
	// 		$tmb = "INSERT INTO Diciplinas (AtletaID,Diciplina) VALUES(LAST_INSERT_ID(),'$Tumbling')";
	// 		$query = mysqli_query($con, $tmb);
	// }
	// if(isset($_POST['Trampoline']) ){
	// 		$tramp = $_POST['Trampoline'];
	// 		$trampoline = "INSERT INTO Diciplinas (AtletaID,Diciplina) VALUES(LAST_INSERT_ID(),'$tramp')";
	// 		$query = mysqli_query($con, $trampoline);
	// }

	if(!$send_query){
			die('Could not update data: ');
	}
	else{
			echo "Updated data successfully\n";
			unset($_POST);
			unset($_REQUEST);
			echo "<script>location.href='tablaAtletas.php';</script>";
	}

}

function crearAtletaAdmin(){
	global $con;
	$Nombre = $_POST['Nombre'];
	$Apellido = $_POST['Apellido'];
	$Genero = $_POST['Genero'];
	$Edad = $_POST['Edad'];//calcularEdad($_POST['Edad']);
	$Telefono = $_POST['Telefono'];
	// $Club = $_POST['Club'];
	$Entrenador = $_SESSION['NombreCompleto'];
	$Categoria = $_POST['Categoria'];
	$Nivel = $_POST['Nivel'];
	$Street1 = $_POST['street1'];
	$Street2 = $_POST['street2'];
	$State = $_POST['state'];
	$City = $_POST['city'];
	$Postal = $_POST['postal'];
	$CoachID = $_POST['Entrenador'];

	$crear_atleta = "INSERT INTO Athletes (
	NameAthletes,
	LastNameAthletes,
	Age,
	Gender,
	Category,
	Levels,
	TypeGimnastic,
	Street1,
	Street2,
	State,
	City,
	PostalCode,
	PhoneAthletes,
	UserID )
	VALUES('$Nombre ', '$Apellido', '$Edad','$Genero', '$Categoria', '$Nivel',
		'Acro', '$Street1', '$Street2','$State','$City', '$Postal', '$Telefono','$CoachID')";

	echo $crear_atleta;
	$send_query = mysqli_query($con, $crear_atleta);

		if(isset($_POST['Tumbling']) ){
				$Tumbling = $_POST['Tumbling'];
				$tmb = "INSERT INTO Diciplinas (AtletaID,Diciplina) VALUES(LAST_INSERT_ID(),'$Tumbling')";
				$query = mysqli_query($con, $tmb);
		}
		if(isset($_POST['Trampoline']) ){
				$tramp = $_POST['Trampoline'];
				$trampoline = "INSERT INTO Diciplinas (AtletaID,Diciplina) VALUES(LAST_INSERT_ID(),'$tramp')";
				$query = mysqli_query($con, $trampoline);
		}

		if(!$send_query){
				die('Could not update data: ');
		}
		else{
				echo "Updated data successfully\n";
				unset($_POST);
				unset($_REQUEST);
				echo "<script>location.href='tablaAtletasAdmin.php';</script>";
		}

}

function verAtletasEnTabla(){
	global $con;
	$CoachID = $_SESSION['CoachID'];
	if (isset($_POST['search'])) {
		$search = $_POST['search'];
		$query = "SELECT * FROM Athletes NATURAL JOIN User WHERE UserID = '$CoachID' AND
		NameAthletes LIKE '%$search%' OR LastNameAthletes LIKE '%$search%' OR 
		Name LIKE '%$search%'";
	} else {
		$query = "SELECT * FROM Athletes WHERE UserID = '$CoachID'  ";
	}

	

	$run_items = mysqli_query($con, $query);

	while($row_items=mysqli_fetch_array($run_items)){
		// $ID = $row_items['AthleteID'];
		$Nombre = $row_items['NameAthletes'];
		$Apellido = $row_items['LastNameAthletes'];
		$Genero = $row_items['Gender'];
		$Edad = $row_items['Age'];
		$Telefono = $row_items['PhoneAthletes'];
		// $Club = $row_items['Club'];
		// $Entrenador = $row_items['Entrenador'];
		$Categoria = $row_items['Category'];
		$Nivel = $row_items['Levels'];


		echo "
		<tr>
				<td>    $Nombre  </td>
				<td>    $Apellido   </td>
				<td>    $Genero  </td>
				<td>"; echo calcularEdad($Edad); echo "     </td>
				<td>"; echo printPhone($Telefono); echo "  </td>
				<td>    $Categoria  </td>
				<td>    $Nivel  </td>



		</tr>";

	}
}
function verAtletasEnTablaAdmin(){
	global $con;
	// $CoachID = $_SESSION['CoachID'];
	if(isset($_POST['search'])){
		$search = $_POST['search'];
		$query = "SELECT * FROM Athletes NATURAL JOIN User WHERE 
		NameAthletes LIKE '%$search%' OR LastNameAthletes LIKE '%$search%' OR 
		Name LIKE '%$search%'";
	}
	else{
		$query = "SELECT * FROM Athletes NATURAL JOIN User";
	}

	$run_items = mysqli_query($con, $query);

	while($row_items=mysqli_fetch_array($run_items)){
		$Name = $row_items['Name'];
		$LastName = $row_items['LastName'];
		$Nombre = $row_items['NameAthletes'];
		$Apellido = $row_items['LastNameAthletes'];
		$Genero = $row_items['Gender'];
		$Edad = $row_items['Age'];
		$Telefono = $row_items['PhoneAthletes'];
		// $Club = $row_items['Club'];
		// $Entrenador = $row_items['Entrenador'];
		$Categoria = $row_items['Category'];
		$Nivel = $row_items['Levels'];
		$ID = $row_items['AthletesID'];
		
		echo "
		<tr>
				<td>    $Nombre  </td>
				<td>    $Apellido   </td>
				<td>    $Genero  </td>
				<td>"; echo calcularEdad($Edad); echo"     </td>
				<td>"; echo printPhone($Telefono); echo"  </td>
				<td>    $Categoria  </td>
				<td>    $Nivel  </td>
				<td>    $Name $LastName  </td>
				
				<td>   <a href='editAthlete.php?ID=$ID'  class='btn btn-primary btn-round' >Edit</a>   </td>
				



		</tr>";

	}
}

function updateAthlete(){
	global $con;

	$id = $_GET['ID'];
	$Nombre = $_POST['Nombre'];
	$Apellido = $_POST['Apellido'];
	$Telefono = $_POST['Telefono'];
	$age = $_POST['Edad'];
	// $Club = $_POST['Club'];



	$update_Athlete = "UPDATE Athletes SET  NameAthletes = '$Nombre', LastNameAthletes = '$Apellido', Age = '$age' ,PhoneAthletes = '$Telefono' WHERE AthletesID = '$id' ";
	$send_query = mysqli_query($con, $update_Athlete);

	if(!$send_query){
			die('Could not update data: ');
	}
	else{
			echo "Updated data successfully\n";
			unset($_POST);
			unset($_REQUEST);
			//echo "<script>location.href='editAthlete.php?ID=$id';</script>";

	}

}

function viewAthlete(&$name,&$lastName,&$phone,&$email,&$club,&$age,&$level,&$category){

	global $con;

	$id = $_GET['ID'];
	$query = "SELECT * FROM Athletes NATURAL JOIN Coachs WHERE AthletesID = $id ";
	$run_items = mysqli_query($con, $query);
	$row =  mysqli_fetch_assoc($run_items);

	$name = $row['NameAthletes'];
	$lastName = $row['LastNameAthletes'];
	$phone = $row['PhoneAthletes'];
	$club = $row['Asociacion'];
	$age = $row['Age'];
	$level = $row['Levels'];
	$category = $row['Category'];
}

function editAthleteScore(&$Score, &$H, &$D, &$T , &$P)
{

	global $con;

	$id = $_GET['ID'];
	$juez = $_GET['Juez'];
	$evento = $_GET['Evento'];
	$query = "SELECT * FROM Points WHERE AthletesID = $id AND EventId = '$evento' AND UserID = '$juez'";
	$run_items = mysqli_query($con, $query);
	$row =  mysqli_fetch_assoc($run_items);

	$Score = $row['Score'];
	$H = $row['H'];
	$D = $row['D'];
	$T = $row['T'];
	$P = $row['Penalty'];
	
}

function EliminarAtleta(){
	global $con;

	$id = $_GET['ID'];
	$query = "DELETE  FROM Atletas WHERE AtletaID = '$id'";
	$send_query = mysqli_query($con, $query);

	$query2 = "DELETE  FROM Diciplinas WHERE AtletaID = '$id'";
	$send_query2 = mysqli_query($con, $query2);

	echo "<script>location.href='tablaAtletasAdmin.php';</script>";

}

//Final de las funciones del Atleta------------------------------------------------------------------

function crearEntrenador(){
		global $con;
		$Nombre = $_POST['Nombre'];
		$Apellido = $_POST['Apellido'];
		$Telefono = $_POST['Telefono'];
		$Club = $_POST['Club'];
		$Email = $_POST['Email'];
		$Password = $_POST['Password'];
		$user = strstr($Email, '@', true);

		$crear_entrenador = "INSERT INTO User(Name, LastName, UserName, Password, Phone, Email, Role)
							VALUES('$Nombre', '$Apellido', '$user', '$Password', '$Telefono','$Email', 'Entrenador')";
		$send_query = mysqli_query($con, $crear_entrenador);

		$login = "INSERT INTO Coachs(UserID, Role, Asociacion)
					VALUES( LAST_INSERT_ID(),'Entrenador','$Club')";
		$send_query2 = mysqli_query($con, $login);

		if(!$send_query or !$send_query2){
				die('Could not update data: ');
		}
		else{
				echo "Updated data successfully\n";
				unset($_POST);
				unset($_REQUEST);
				echo "<script>location.href='tablaEntrenadoresAdmin.php';</script>";
		}
}

function updateCoach(){
	global $con;

	$id = $_GET['ID'];
	$Nombre = $_POST['Nombre'];
	$Apellido = $_POST['Apellido'];
	$Telefono = $_POST['Telefono'];
	// $Club = $_POST['Club'];
	$Email = $_POST['Email'];
	$Password = $_POST['Password'];
	$user = strstr($Email, '@', true);


	$update_Coach = "UPDATE User SET  Name = '$Nombre', LastName = '$Apellido', Phone = '$Telefono', Email = '$Email', Password = '$Password' WHERE UserID = '$id' ";
	$send_query = mysqli_query($con, $update_Coach);

	if(!$send_query){
			die('Could not update data: ');
	}
	else{
			echo "Updated data successfully\n";
			unset($_POST);
			unset($_REQUEST);
			echo "<script>location.href='editCoach.php?ID=$id';</script>";

	}

}
function viewCoach(&$name,&$lastName,&$userName,&$password,&$phone,&$email,&$status,&$club){

	global $con;

	$id = $_GET['ID'];
	$query = "SELECT * FROM User NATURAL JOIN Coachs WHERE UserId = $id ";
	$run_items = mysqli_query($con, $query);
	$row =  mysqli_fetch_assoc($run_items);

	$name = $row['Name'];
	$lastName = $row['LastName'];
	$userName = $row['UserName'];
	$password = $row['Password'];
	$phone = $row['Phone'];
	$status = $row['Status'];
	$club = $row['Asociacion'];
	$email = $row['Email'];






}


function verEntrenadores(){
	global $con;

		$query = "SELECT DISTINCT * FROM User WHERE Role = 'Entrenador'";
		$run_items = mysqli_query($con, $query);

		while($row_items=mysqli_fetch_array($run_items)){
			$userID = $row_items['UserID'];
			$Name = $row_items['Name'];
			$LastName = $row_items['LastName'];
			echo"<option value = '$userID'>$Name $LastName</option>";

		}
}

function verEntrenadoresAdminTable(){
	global $con;

	if (isset($_POST['search'])) {
		$search = $_POST['search'];
		$query = "SELECT DISTINCT * FROM User WHERE Role = 'Entrenador' AND Name LIKE '%$search%' OR LastName LIKE '%$search%' ";
	} else {
		$query = "SELECT DISTINCT * FROM User WHERE Role = 'Entrenador'";
	}

	$run_items = mysqli_query($con, $query);

	while($row_items=mysqli_fetch_array($run_items)){
			$ID = $row_items['UserID'];

			$Nombre = $row_items['Name'];
			$Apellido = $row_items['LastName'];
			$Email = $row_items['Email'];
			$Telefono = $row_items['Phone'];
			$Status = $row_items['Status'];

	if ($Status == 'Enable') {
		echo "
					<tr>
							<td>    $Nombre  </td>
							<td>    $Apellido   </td>
							<td>"; echo printPhone($Telefono);echo "  </td>
							<td>    $Email  </td>
							<td>   <a href='editCoach.php?ID=$ID'  class='btn btn-primary btn-round' >Edit</a>   </td>

							<td>   <a href='tablaEntrenadoresAdmin.php?ID=$ID&Status=$Status'  class='btn btn-primary btn-round' >Desactivate</a>   </td>

					</tr>";
	}
	if ($Status == 'Disable') {
		echo "
					<tr>
							<td>    $Nombre  </td>
							<td>    $Apellido   </td>
							<td>"; echo printPhone($Telefono);echo "  </td>
							<td>    $Email  </td>
							<td>   <a href='editCoach.php?ID=$ID'  class='btn btn-primary btn-round' >Edit</a>   </td>
							
							<td>   <a href='tablaEntrenadoresAdmin.php?ID=$ID&Status=$Status'  class='btn btn-primary btn-round' >Enable</a>   </td>

					</tr>";
	}
				


	}
}


function Enable_Disable_Entrenador(){
	global $con;

	$id = $_GET['ID'];
	// $coach = $_GET['CoachID'];
	$Status = $_GET['Status'];
	if($Status == 'Enable'){
		$query = "UPDATE User SET Status = 'Disable' WHERE UserID = '$id'AND Role = 'Entrenador'";
		$send_query = mysqli_query($con, $query);
	}
	if($Status == 'Disable'){
		$query2 = "UPDATE User SET Status = 'Enable' WHERE UserID = '$id'AND Role = 'Entrenador'";
		$send_query2 = mysqli_query($con, $query2);
	}
	echo "<script>location.href='tablaEntrenadoresAdmin.php';</script>";
	
}

//Final de las funciones del Entrenador------------------------------------------------------------------


function viewJudge(&$name,&$lastName,&$userName,&$password,&$phone,&$email,&$status,&$judgeRole){
	global $con;
	$id = $_GET['ID'];
	$query = "SELECT * FROM User NATURAL JOIN Judge WHERE UserId = $id ";
	$run_items = mysqli_query($con, $query);
	$row =  mysqli_fetch_assoc($run_items);

	$name = $row['Name'];
	$lastName = $row['LastName'];
	$userName = $row['UserName'];
	$password = $row['Password'];
	$phone = $row['Phone'];
	$status = $row['Status'];
	$judgeRole = $row['JudgeRole'];
	$email = $row['Email'];



}


function updateJudge(){
		global $con;
		$id = $_GET['ID'];
		$Nombre = $_POST['Nombre'];
		$Apellido = $_POST['Apellido'];
		$Telefono = $_POST['Telefono'];
		// $Club = $_POST['Club'];
		$Email = $_POST['Email'];
		$Password = $_POST['Password'];
		$user = strstr($Email, '@', true);


		$update_Judge = "UPDATE User SET  Name = '$Nombre', LastName = '$Apellido', Phone = '$Telefono', Email = '$Email', Password = '$Password' WHERE UserID = '$id' ";
		$send_query = mysqli_query($con, $update_Judge);

		if(!$send_query){
				die('Could not update data: ');
		}
		else{
				echo "Updated data successfully\n";
				unset($_POST);
				unset($_REQUEST);
				echo "<script>location.href='editJudge.php?ID=$id';</script>";



		}
}



function crearJuez(){
		global $con;
		$Nombre = $_POST['Nombre'];
		$Apellido = $_POST['Apellido'];
		$Telefono = $_POST['Telefono'];
		// $Club = $_POST['Club'];
		$Email = $_POST['Email'];
		$Password = $_POST['Password'];
		$user = strstr($Email, '@', true);

		$crear_juez = "INSERT INTO User(Name, LastName, UserName, Password, Phone, Email, Role)
						VALUES('$Nombre', '$Apellido', '$user', '$Password', '$Telefono','$Email', 'Juez')";
		$send_query = mysqli_query($con, $crear_juez);

		$login = "INSERT INTO Judge(UserID,Role,JudgeRole) VALUES(LAST_INSERT_ID(),'Juez','Regular')";
		$send_query2 = mysqli_query($con, $login);

		if(!$send_query){
				die('Could not update data: ');
		}
		else{
				echo "Updated data successfully\n";
				unset($_POST);
				unset($_REQUEST);
				echo "<script>location.href='login.php';</script>";
		}
}

function Enable_Disable_Juez(){
	global $con;

	$id = $_GET['ID'];

	$Status = $_GET['Status'];

	if($Status == 'Enable'){
		$query2 = "UPDATE User SET Status = 'Disable' WHERE UserID = '$id'AND Role = 'Juez'";
		$send_query2 = mysqli_query($con, $query2);
	}
	if($Status == 'Disable'){
		$query2 = "UPDATE User SET Status = 'Enable' WHERE UserID = '$id'AND Role = 'Juez'";
		$send_query2 = mysqli_query($con, $query2);
	}
	
	echo "<script>location.href='tablaJuezAdmin.php';</script>";
	

}

function VerJuecesTabla() {
	global $con;

	if (isset($_POST['search'])) {
		$search = $_POST['search'];
		$query = "SELECT * FROM User WHERE Role = 'Juez' AND Name LIKE '%$search%' OR LastName LIKE '%$search%' ";
	} else {
		$query = "SELECT * FROM User WHERE Role = 'Juez'";
	}

	$run_items = mysqli_query($con, $query);

	while($row_items=mysqli_fetch_array($run_items)){
			$ID = $row_items['UserID'];
			$Nombre = $row_items['Name'];
			$Apellido = $row_items['LastName'];
			$Telefono = $row_items['Phone'];
			$Email = $row_items['Email'];
			$Status = $row_items['Status'];
		if ($Status == 'Enable') {
			echo "
				<tr>
						<td>    $Nombre  </td>
						<td>    $Apellido   </td>
						<td>"; echo printPhone($Telefono); echo "  </td>
						<td>    $Email  </td>
						<td>   <a href='editJudge.php?ID=$ID'  class='btn btn-primary btn-round' >Edit</a>   </td>

						<td>   <a href='tablaJuezAdmin.php?ID=$ID&Status=$Status'  class='btn btn-primary btn-round' >Desactivate</a>   </td>

				</tr>";
		}
		if ($Status == 'Disable') {
			echo "
				<tr>
						<td>    $Nombre  </td>
						<td>    $Apellido   </td>
						<td>"; echo printPhone($Telefono); echo "  </td>
						<td>    $Email  </td>
						<td>   <a href='editJudge.php?ID=$ID'  class='btn btn-primary btn-round' >Edit</a>   </td>
						
						<td>   <a href='tablaJuezAdmin.php?ID=$ID&Status=$Status'  class='btn btn-primary btn-round' >Activate</a>   </td>

				</tr>";
		}
				

	}
}
//Final de las funciones del Juez------------------------------------------------------------------
function Login(){
		global $con;
		$user = $_POST['Username'];
		$pass = $_POST['Password'];

		$query = "SELECT * FROM User WHERE UserName = '$user' AND Password = '$pass' AND Status = 'Enable'";

		$run_items = mysqli_query($con, $query);
		$row_items = mysqli_fetch_array($run_items, MYSQLI_ASSOC);

		$nombre = $row_items['Name'];
		$apellido = $row_items['LastName'];
		$user = $row_items['UserName'];
		$rol = $row_items['Role'];
		$count = mysqli_num_rows($run_items);

		if($count == 1)
		{
				$_SESSION['Role'] = $rol;
				$_SESSION['Username'] = $user;


				if($_SESSION['Role'] == "Entrenador"){
					$quer2 = "SELECT * FROM User WHERE UserName = '$user' AND Password = '$pass'";

					$run_items = mysqli_query($con, $quer2);
					$row_items = mysqli_fetch_array($run_items, MYSQLI_ASSOC);
					$ID = $row_items['UserID'];
					$_SESSION['CoachID'] = $ID;
					echo"<script>location.href='tablaAtletas.php?ID=$ID';</script>";
				}
				if($_SESSION['Role'] == "Admin"){
					$quer2 = "SELECT * FROM User WHERE UserName = '$user' AND Password = '$pass'";

					$run_items = mysqli_query($con, $quer2);
					$row_items = mysqli_fetch_array($run_items, MYSQLI_ASSOC);
					$ID = $row_items['UserID'];
					$_SESSION['Admin'] = $ID;
					echo"<script>location.href='tablaAtletasAdmin.php';</script>";
				}
				if($_SESSION['Role'] == "Juez"){
					$quer2 = "SELECT * FROM User WHERE UserName = '$user' AND Password = '$pass'";

					$run_items = mysqli_query($con, $quer2);
					$row_items = mysqli_fetch_array($run_items, MYSQLI_ASSOC);
					$ID = $row_items['UserID'];
					$_SESSION['JudgeID'] = $ID;
					echo"<script>location.href='Eventos.php';</script>";
				}
		}
		else {
				$error = "Your Login Name or Password is invalid";
				echo $error;
		}

}
function Sesiones(){
		switch($_SESSION['Role']){
				case 'Entrenador':
						echo"
						<li >
						<a href='./crearAtleta.php'>
							<i class='nc-icon nc-single-02'></i>
							<p>Create Athlete</p>
						</a>
						</li>
					<li >
						<a href='./tablaAtletas.php'>
							<i class='nc-icon nc-bullet-list-67'></i>
							<p>My Athletes</p>
						</a>
					</li>
					 <li>
						<a href='./Eventos.php'>
							<i class='nc-icon nc-single-copy-04'></i>
							<p>Events</p>
						</a>
					</li>
					<li>
						<a href='./logout.php'>
							<i class='nc-icon nc-simple-remove'></i>
							<p>Logout</p>
						</a>
					</li>";
				break;

				case 'Admin':
						echo "
						<li >
							<a href='./crearAdmin.php'>
								<i class='nc-icon nc-single-02'></i>
								<p>Create Administrator</p>
							</a>
						</li>
						<li >
							<a href='./crearAtletaAdmin.php'>
								<i class='nc-icon nc-single-02'></i>
								<p>Create Athelete</p>
							</a>
						</li>
						<li >
							<a href='./crearEntrenador.php'>
								<i class='nc-icon nc-single-02'></i>
								<p>Create Coach</p>
							</a>
						</li>
						<li >
							<a href='./crearJuez.php'>
								<i class='nc-icon nc-single-02'></i>
								<p>Create Judge</p>
							</a>
						</li>
						<li >
						<a href='./tablaAdmin.php'>
							<i class='nc-icon nc-bullet-list-67'></i>
							<p>Administrators</p>
						</a>
						</li>
						<li >
						<a href='./tablaAtletasAdmin.php'>
							<i class='nc-icon nc-bullet-list-67'></i>
							<p>Athletes</p>
						</a>
						</li>
						<li>
						<a href='./tablaEntrenadoresAdmin.php'>
							<i class='nc-icon nc-bullet-list-67'></i>
							<p>Coachs</p>
						</a>
						</li>
						<li >
						<a href='./tablaJuezAdmin.php'>
							<i class='nc-icon nc-bullet-list-67'></i>
							<p>Judges</p>
						</a>
				  		</li>
					 	<li>
						<a href='./Eventos.php'>
							<i class='nc-icon nc-single-copy-04'></i>
							<p>Events</p>
						</a>
						</li>
						<li>
						<a href='./logout.php'>
							<i class='nc-icon nc-simple-remove'></i>
							<p>Logout</p>
						</a>
						</li>
						";
				break;

				case 'Empty':
						echo"
						<li >
							<a href='./login.php'>
								<i class='nc-icon nc-single-02'></i>
								<p>Login</p>
							</a>
						</li>
						 ";
				break;
				case 'Juez':
						echo"
						<li>
							<a href='./Eventos.php'>
								<i class='nc-icon nc-single-copy-04'></i>
								<p>Eventos</p>
							</a>
						</li>
						<li>
							<a href='./logout.php'>
								<i class='nc-icon nc-simple-remove'></i>
								<p>Logout</p>
							</a>
						</li>
						 ";
				break;
		}
}

function Trampoline(){
	echo "<div class='col-md-4'>
	<div class='card card-user'>
		<div class='card-header'>
			<h5 class='card-title'>List of Events</h5>
		</div>
		<div class='card-body'>
			<form action='' method= 'post' >

				<div class='row-md-4'>
					";
					 getTrampolineEvents();
				if($_SESSION['Role']=='Admin'){
					echo"
					<div class='update ml-auto mr-auto'>
						<button type='submit' name='Tab' class='btn btn-primary btn-round'>+</button>

								</div>
							</div>
							</form>
						</div>
					</div>
				</div>";

				}
}

function newtabTrampoline(){
	echo "
		
		<div class='card card-user' style='position:relative; left: 15px;'>
			<div class='card-header'>
				<h5 class='card-title'>Create Event</h5>
			</div>
			<div class='card-body'>
				<form action='' method= 'post' >

					<div class='col'>
					<div class='col-md-12 pr-1'>
					<div class='form-group'>
						
						<label>Date</label>
						<input type='date' class='form-control' name = 'Date' placeholder='Date' />

						<label>Place</label>
						<input type='text' class='form-control' name = 'Place' placeholder='Place' />

						<label>Time</label>
						<input type='time' class='form-control' name = 'Time' placeholder='Hour' />

						
					</div>
						<div class='update ml-auto mr-auto'>
							<button type='submit' name='Crear' class='btn btn-primary btn-round'>Create</button>
						</div>
					</div>
				</form>
			</div>
		";
}

function addTrampolineEevent(){

		global $con;

		$Time = $_POST['Time'];
		$Date = $_POST['Date'];
		$Place = $_POST['Place'];
		$createUser = "INSERT INTO Events (Place, Date, Time) VALUES ('$Place', '$Date', '$Time')";

		$retval = mysqli_query($con,$createUser);
		if(! $retval ) {
		die('Could not update data: ');
		}

		else{

		//echo "Updated data successfully\n";
		//   Para evitar que al darle refresh se vuelva añadir un atleta por accidente
		unset($_POST);
		unset($_REQUEST);
		//echo "<script>location.href='tableEntrenadores.php';</script>";
		}
}

function getTrampolineEvents(){
	global $con;
	if($_SESSION['Role'] == 'Admin'){
		$get_items = "SELECT * from Events Order BY EventID  ";
	}
	else{
		$get_items = "SELECT * from Events WHERE Status = 'Enable' Order BY EventID  ";
	}
	$run_items = mysqli_query($con, $get_items);

		while($row_items=mysqli_fetch_array($run_items)){

			$item_ID = $row_items['EventID'];
			$time = $row_items['Time'];
			$place = $row_items['Place'];
			$date = $row_items['Date'];
			$Status = $row_items['Status'];
			//$_SESSION['Evento'] =$item_name;
			if($_SESSION['Role'] == "Entrenador"){
				echo"<a href='currentEvento.php?Evento=$item_ID' class='btn btn-primary btn-round'>$place</a>";
			}
			if($_SESSION['Role'] == "Admin"){
				echo"<a href='currentEvento.php?Evento=$item_ID&Status=$Status' class='btn btn-primary btn-round'>$place</a>";
			}
			if($_SESSION['Role'] == "Juez"){
				echo"<a href='currentEventoJuez.php?Evento=$item_ID' class='btn btn-primary btn-round'>$place</a>";
			}
		}


}

function Enable_Disable_Event(){
	global $con;

	$evento = $_GET['Evento'];

	$Status = $_GET['Status'];


	if($Status == 'Enable'){
		$query2 = "UPDATE Events SET Status = 'Disable' WHERE EventID = '$evento'";
		$send_query2 = mysqli_query($con, $query2);
	}
	if($Status == 'Disable'){
		$query2 = "UPDATE Events SET Status = 'Enable' WHERE EventID = '$evento'";
		$send_query2 = mysqli_query($con, $query2);
	}


	if(!$send_query2){
			die('Could not update data: ');
	}
	else{
		 echo "<script>location.href='Eventos.php';</script>";
	}
}

function selectAtleta(){
	global $con;
	$evento = $_GET['Evento'];
	if($_SESSION['Role'] == "Entrenador")
	{
		$CoachID = $_SESSION['CoachID'];

		$query = "SELECT * FROM Athletes  WHERE UserID = '$CoachID' AND AthletesID NOT IN(SELECT AthletesID FROM CurrentEvent WHERE EventID = '$evento') ";
		$run_items = mysqli_query($con, $query);
	}
	else if($_SESSION['Role'] == "Admin")
	{
		$query = "SELECT * FROM Athletes WHERE AthletesID NOT IN(SELECT AthletesID FROM CurrentEvent WHERE EventID = '$evento') ";
		$run_items = mysqli_query($con, $query);
	}


	while($row_items=mysqli_fetch_array($run_items)){
			$ID = $row_items['AthletesID'];
			$Nombre = $row_items['NameAthletes'];
			$Apellido = $row_items['LastNameAthletes'];
			echo "<option value='$ID'>$Nombre $Apellido</option>";

	}
}
function addAtletaToEvento(){
	global $con;
	$evento = $_GET['Evento'];
	$atleta = $_POST['Add'];
	$query = "INSERT INTO CurrentEvent(EventID, AthletesID) VALUES('$evento', '$atleta')";
	$run_items = mysqli_query($con, $query);

	echo "<script>location.href='CurrentEvento.php?Evento=$evento';</script>";
}
function verAtletasEnEvento(){
	global $con;

	$evento = $_GET['Evento'];
	if($_SESSION['Role'] == "Entrenador"){
		$CoachID = $_SESSION['CoachID'];
		$query = "SELECT * FROM CurrentEvent NATURAL JOIN Athletes
			WHERE UserID = '$CoachID' AND EventID='$evento' ";
		$run_items = mysqli_query($con, $query);
	}

	while($row_items=mysqli_fetch_array($run_items)){
			$ID = $row_items['AtletaID'];
			$Nombre = $row_items['NameAthletes'];
			$apellido = $row_items['LastNameAthletes'];
			$Total = $row_items['Total'];
			echo "<tr>
					<td>$Nombre</td>
					<td>$apellido</td>
					<td>$Total</td>
				</tr>";

	}
}

function verAtletasEnEventoAdmin(){
	global $con;

	$evento = $_GET['Evento'];
	$query = "SELECT * FROM CurrentEvent NATURAL JOIN Athletes WHERE EventID='$evento' ORDER BY Total DESC";
	$run_items = mysqli_query($con, $query);
	$ranking = 0;

	while($row_items=mysqli_fetch_array($run_items)){
			$ID = $row_items['AthletesID'];
			$Nombre = $row_items['NameAthletes'];
			$Apellido = $row_items['LastNameAthletes'];

			$Total = $row_items['Total'];
			$ranking++;
			echo "
				<tr><form method = 'POST'>
						<input type='hidden' name='Atleta' value='$ID'/>
						<td>$ranking</td>
						<td>$Nombre</td>
						<td>$Apellido</td>
						<td>"; PuntosAtletas($ID, $evento); echo" </td>
						
						<td>$Total</td>
					</form>

				</tr>";

	}
}
function PuntosAtletas($ID, $Event){
	global $con;

	$query = "SELECT * FROM Points WHERE AthletesID = '$ID' AND EventID = '$Event'";
	$run_items = mysqli_query($con, $query);
	while($row_items=mysqli_fetch_array($run_items)){
		$atleta = $row_items['AthletesID'];
		$Score = $row_items['Score'];
		$D = $row_items['D'];
		$H = $row_items['H'];
		$penal = $row_items['Penalty'];
		$sum = $Score + $D + $H - $penal;
		$juez = $row_items['UserID'];
		echo "

		<input type='hidden' name='Juez' value='$juez'/>
		<a href='EditarPuntos.php?Evento=$Event&Juez=$juez&Atleta=$atleta' class='btn btn-primary btn-round'>$sum</a>

		  ";

	}
}
function penalidadesAtletas($ID, $Event){
	global $con;

	$query = "SELECT * FROM Points WHERE AthletesID = '$ID' AND EventID = '$Event'";
	$run_items = mysqli_query($con, $query);
	while($row_items=mysqli_fetch_array($run_items)){
		$atleta = $row_items['AthletesID'];
		$penalty = $row_items['Penalty'];
		$juez = $row_items['UserID'];
		echo "

		<input type='hidden' name='Juez' value='$juez'/>
		<a href='EditarPuntos.php?Evento=$Event&Juez=$juez&Atleta=$atleta' class='btn btn-primary btn-round'> $penalty</a>

		  ";
	}
}

function EditarPuntos(){
	global $con;
	$evento = $_GET['Evento'];
	$juez = $_GET['Juez'];
	$atleta = $_GET['Atleta'];

	$query = "SELECT * FROM Athletes WHERE AthletesID='$atleta'   ";

	$run_items = mysqli_query($con, $query);
	$row_items = mysqli_fetch_array($run_items, MYSQLI_ASSOC);

	$nombre = $row_items['NameAthletes'];
	$apellido = $row_items['LastNameAthletes'];


	$query2 = "SELECT * FROM Points WHERE AthletesID='$atleta' AND UserID = '$juez' AND EventID = '$evento'  ";

	$run_items2 = mysqli_query($con, $query2);
	$row_items2 = mysqli_fetch_array($run_items2, MYSQLI_ASSOC);
	$score = $row_items2['Score'];
	$penal = $row_items2['Penalty'];
	$H = $row_items2['H'];
	$D = $row_items2['D'];
	echo "<tr><form method='POST'>
			<td>$nombre</td>
			<td>$apellido</td>
			<td><input type='text' maxlength='4' size='4' class='form-control' value='$score' name = 'puntos'/></td>
			<td><input type='text' maxlength='4' size='4' class='form-control' value='$H' name = 'H'/></td>
			<td><input type='text' maxlength='4' size='4' class='form-control' value='$D' name = 'D'/></td>
			<td><input type='text' maxlength='4' size='4' class='form-control' value='$penal' name = 'penal'/></td>
			<td><button type='submit' class='btn btn-primary btn-round' name='update' >Update</button></td>
			</tr></form>";

	if(isset($_POST['update'])){
		$score = $_POST['puntos'];
		$Status = $_GET['Status'];
		$H = $_POST['H'];
		$D = $_POST['D'];
		$penal = $_POST['penal'];

		$score = formula_puntos($score, 'Score');
		$H_f = formula_puntos($H, 'H');
		$p_f = formula_puntos($penal, 'Penal');

		$query2 = "UPDATE Points SET Score = $score, H = $H_f, D = $D, Penalty = $p_f WHERE AthletesID = '$atleta' AND UserID='$juez' AND EventID='$evento'";
		$run_items = mysqli_query($con, $query2);

		$query2 = "UPDATE CurrentEvent SET Total = (SELECT SUM(Score + H + D - Penalty) FROM Points WHERE EventID = '$evento' AND AthletesID = '$atleta') WHERE EventID = '$evento' AND AthletesID = '$atleta'";
		$run_items = mysqli_query($con, $query2);
		if(!$query2){
			die('Could not update data: ');
		}
		else{
			echo "Updated data successfully\n";
			unset($_POST);
			unset($_REQUEST);
			echo "<script>location.href='currentEvento.php?Evento=$evento';</script>";
		}
	}

}

function ListadoAtletasParaEvaluar(){
	global $con;
	$evento = $_GET['Evento'];
	$JudgeID = $_SESSION['JudgeID'];
	$query = "SELECT * FROM CurrentEvent Natural JOIN Athletes WHERE EventID = '$evento;'
	AND AthletesID NOT IN(SELECT AthletesID FROM Points WHERE UserID = '$JudgeID' AND EventID='$evento') ";

	$run_items = mysqli_query($con, $query);
	while($row_items=mysqli_fetch_array($run_items)){
		$ID = $row_items['AthletesID'];
		$Nombre = $row_items['NameAthletes'];
		$apellido = $row_items['LastNameAthletes'];
		$category = $row_items['Category'];
		$level = $row_items['Levels'];

		echo"
			<form method='POST'>
				<tr>
					<input type='hidden' name='Athlete' value='$ID'/>
					<td>$Nombre </td>
					<td>$apellido </td>
					<td>$category</td>
					<td>$level</td>
					<td>   <a href='athleteEvaluation.php?ID=$ID&Evento=$evento'  class='btn btn-primary btn-round' >Evaluate</a>   </td>
				</tr>
			</form>
			";

	}
}
function verPuntuaciones($AthletesID, $p){
	global $con;
	$evento = $_GET['Evento'];
	$JudgeID = $_SESSION['JudgeID'];	
	$query2 = "SELECT * FROM Points WHERE UserID='$JudgeID' AND EventID = '$evento' AND AthletesID = '$AthletesID'";
	$run_items2 = mysqli_query($con, $query2);
	$row_items2 = mysqli_fetch_array($run_items2);
	$score = $row_items2['Score'];
	$penalty = $row_items2['Penalty'];
	$H = $row_items2['H'];
	$D = $row_items2['D'];
	if($p == 'score'){
		echo "$score";
	}
	if($p == 'penal')
	{
		echo "$penalty";
	}
	if ($p == 'H') {
		echo "$H";
	}
	if ($p == 'D') {
		echo "$D";
	}
	
}
function ListadoAtletasEvaluados(){
	global $con;
	$evento = $_GET['Evento'];
	$JudgeID = $_SESSION['JudgeID'];
	$query = "SELECT * FROM CurrentEvent Natural JOIN Athletes WHERE EventID = '$evento;'
	AND AthletesID IN(SELECT AthletesID FROM Points WHERE UserID = '$JudgeID' AND EventID='$evento') ";
	
	$run_items = mysqli_query($con, $query);
	while($row_items=mysqli_fetch_array($run_items)){
		

		$ID = $row_items['AthletesID'];
		$Nombre = $row_items['NameAthletes'];
		$apellido = $row_items['LastNameAthletes'];
		$category = $row_items['Category'];
		$level = $row_items['Levels'];
		// $puntuacion = $row_items2['Score'];
		// $penalidad = $row_items2['Penalty'];

		echo"
			<form method='POST'>
				<tr>
					<input type='hidden' name='Athlete' value='$ID'/>
					<td>$Nombre </td>
					<td>$apellido </td>
					<td>$category</td>
					<td>$level</td>
					<td>";verPuntuaciones($ID,'score'); echo "</td>
					
					<td>";verPuntuaciones($ID, 'H');echo "</td>
					<td>";verPuntuaciones($ID, 'D'); echo "</td>
					<td>";verPuntuaciones($ID, 'penal');echo "</td>
					<td>   <a href='athleteEvaluation.php?ID=$ID&Evento=$evento&Juez=$JudgeID' name='edit'  class='btn btn-primary btn-round' >Edit</a>   </td>
				</tr>
			</form>
			";

	}
}


function EvaluarAtleta_Juez(){
	if(isset($_POST['Add'])){
		global $con;
		$evento = $_GET['Evento'];
		$puntos = $_POST['puntos'];
		$penal = $_POST['penalidad'];
		$atleta = $_GET['ID'];
		$Judge = $_SESSION['JudgeID'];
		$H = $_POST['H'];
		$dificultad = $_POST['dificultad'];
		$T = $_POST['T'];
		
		$score = formula_puntos($puntos, 'Score');
		$H_f = formula_puntos($H, 'H');
		$p_f = formula_puntos($penal, 'Penal');

		$query = "INSERT INTO Points (EventID, AthletesID, UserID, Score, H, D, T, Penalty)
				VALUES('$evento', '$atleta', '$Judge', '$score', '$H_f', '$dificultad', '$T', '$p_f')";
		
		$run_items = mysqli_query($con, $query);
		echo $query;

		$query2 = "UPDATE CurrentEvent SET Total = (SELECT SUM(Score + H + D - Penalty) FROM Points WHERE EventID = '$evento' AND AthletesID = '$atleta') WHERE EventID = '$evento' AND AthletesID = '$atleta'";
		$run_items = mysqli_query($con, $query2);

		
		echo "<script>location.href='currentEventoJuez.php?Evento=$evento';</script>";
	}
	if (isset($_POST['edit'])) {
		global $con;
		$evento = $_GET['Evento'];
		$puntos = $_POST['puntos'];
		$penal = $_POST['penalidad'];
		$atleta = $_GET['ID'];
		$Judge = $_SESSION['JudgeID'];
		$H = $_POST['H'];
		$dificultad = $_POST['dificultad'];
		$T = $_POST['T'];

		$score = formula_puntos($puntos, 'Score');
		$H_f = formula_puntos($H, 'H');
		$p_f = formula_puntos($penal, 'Penal');

		$query = "UPDATE Points SET Score = '$score', H = '$H_f', 
				D = '$dificultad', T = '$T', Penalty = '$p_f'
				WHERE AthletesID = '$atleta' AND UserID='$Judge' AND EventID = '$evento'";

		$run_items = mysqli_query($con, $query);
		echo $query;

		$query2 = "UPDATE CurrentEvent SET Total = (SELECT SUM(Score + H + D - Penalty) FROM Points WHERE EventID = '$evento' AND AthletesID = '$atleta') WHERE EventID = '$evento' AND AthletesID = '$atleta'";
		$run_items = mysqli_query($con, $query2);

		// $query3 = "UPDATE CurrentEvent SET Total = (SELECT (Total - Penalty) FROM Points NATURAL JOIN CurrentEvent WHERE EventID = '$evento' AND AthletesID = '$atleta') ";
		// $run_items = mysqli_query($con, $query3);
		echo "<script>location.href='currentEventoJuez.php?Evento=$evento';</script>";
	}
}

function formula_puntos($var, $option){
	switch($option){
		case 'Score':
			if($var > 20 ){
				return 20;
			}
			else if($var < 0){
				return 0;
			}
			else{
				return $var;
			}
		break;
		case 'H':
			if ($var > 10) {
				return 10;
			} 
			else if ($var < 0) {
				return 0;
			} 
			else {
				return $var;
			}
		break;
		case 'Penal':
			if ($var > 0.5) {
				return 0.5;
			} else if ($var < 0) {
				return 0;
			} else {
				return $var;
			}
			break;
	}
}

?>
