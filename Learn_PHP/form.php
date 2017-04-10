
<!---created by: Alger Makiputin -->
<?php 
	include('DBConnect.php');
	$eid = 0;
?>


<!DOCTYPE HTML>
<html>
    <head>
        <title>PHP FORM</title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.css">
        <script src="jquery.js"></script>
        <link rel="stylesheet" href="style.css">
        <style>
			.jumbotron {
				background: white;
			}

			.row {
				padding: 10px;
				border: solid 1px #04DD16;
			}
		</style>
    </head>
    <body>
        <div class="jumbotron">
            <div class="container">
                <div class="row">
                   <?php 
						if(isset($_GET['edit'])) { 
							$select_sql = "SELECT * FROM infos WHERE id=$_GET[edit]";
							$select = mysqli_query($conn, $select_sql);
							while($row = mysqli_fetch_assoc($select)) {
							 	$fname = $row['fname'];
								$lname = $row['lname'];
								$age = $row['age'];
								$gender = $row['gender'];
								$email= $row['email'];
								$contact_number = $row['contact_number'];
								$eid = $row['id'];
							}
							
							echo "
								<form class='col-md-3' method='GET'>
								<h3>Edit Data</h3>
								<div class='form-group'>
									<label>First Name</label>
									<input class='form-control' type='text' name='fname' value =$fname>
								</div>
								<div class='form-group'>
									<label>Last Name</label>
									<input class='form-control' type='text' name='lname' value =$lname>
								</div>
								<div class='form-group'>
									<label>Age</label>
									<input class='form-control' type='text' name='age' value=$age>
								</div>";
								?>
								<label class='control-label'>Gender</label>
								<div class='radio'>
									<label class='radio'><input type='radio' name='gender' value='male' <?php echo ($gender == "male" ? 'checked="checked"': '')?> >Male</label>
								</div>	
								<div class='radio'>
									<label class='radio'><input type='radio' name='gender' value='female' <?php echo ($gender == "female" ? 'checked="checked"': '')?>>Female</label>
								</div>
								<?php
									echo "
										<div class='form-group'>
										<label>Email</label>
										<input class='form-control' type='email' name='email' value=$email>
									</div>
									<div class='form-group'>
										<label>Contact Number</label>
										<input class='form-control' type='text' name='contact_number' value=$contact_number>
									</div>
									<div class=form-group>
										<input type ='hidden' name='updateid' value ='$eid'>
										<input class='btn btn-primary' type ='submit' value='Update' name = 'update' >
										<a href='form.php'><button class='btn btn-primary'>Cancel</button></a>
									</div>
								</form>
									
									";
								
								?>					
							
							<?php
						}else{ ?>
							<form class="col-md-3" method="POST">
								<h3>Information Form</h3>
								<div class="form-group">
									<label>First Name</label>
									<input class="form-control" type="text" name="fname">
								</div>
								<div class="form-group">
									<label>Last Name</label>
									<input class="form-control" type="text" name="lname">
								</div>
								<div class="form-group">
									<label>Age</label>
									<input class="form-control" type="text" name="age">
								</div>
								<label class="control-label">Gender</label>
								<div class="radio">
									<label class="radio"><input type="radio" name="gender" value="male">Male</label>
								</div>
								<div class="radio">
									<label class="radio"><input type="radio" name="gender" value="female">Female</label>
								</div>
								<div class="form-group">
									<label>Email</label>
									<input class="form-control" type="email" name="email">
								</div>
								<div class="form-group">
									<label>Contact Number</label>
									<input class="form-control" type="text" name="contact_number">
								</div>
								<div class="form-group">
									<input class=" btn btn-primary " type="submit" name="submit" value="Register">
								</div>
							</form>
							<?php
						}
					?>
                    <div class="col-md-9" id="left">
                        <h3 >Information Table</h3>
                        <table class="table table-responsive table-condensed">
                            <thead>
                                <tr>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Age</th>
                                    <th>Gender</th>
                                    <th>Email</th>
                                    <th>Contact Number</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                            	<?php 
									$sql = "SELECT * FROM infos";
									$result = mysqli_query($conn, $sql);
									while($row = mysqli_fetch_assoc($result)){
										echo "
											<tr>
												<td>$row[fname]</td>
												<td>$row[lname]</td>
												<td>$row[age]</td>
												<td>$row[gender]</td>
												<td>$row[email]</td>
												<td>$row[contact_number]</td>
												<td><a href='form.php?edit=$row[id]'><button class='btn btn-primary'>Edit</button></a></td>
												<td><a href='form.php?id=$row[id]'><button class='btn btn-danger'>Delete</button></a></td>
											</tr>
										";
									}
								?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

<?php 
	if(isset($_POST['submit'])){
		$fname = mysqli_real_escape_string($conn,$_POST['fname']);
		$lname = mysqli_real_escape_string($conn,$_POST['lname']);
		$age = mysqli_real_escape_string($conn,$_POST['age']);
		$gender = mysqli_real_escape_string($conn,$_POST['gender']);
		$email = mysqli_real_escape_string($conn,$_POST['email']);
		$contact_number = mysqli_real_escape_string($conn,$_POST['contact_number']);
		
		$insert_query = "INSERT INTO infos (fname,lname,age,gender,email,contact_number) VALUES ('$fname', '$lname', '$age', '$gender', '$email', '$contact_number')";
		
		if(mysqli_query($conn, $insert_query)) { ?>
			<script>window.location = 'form.php'</script>
			
			<?php	
		}	
	}
    $insert_sql = "INSERT INTO infos (fname,lname,age,gender,email,contact_number) VALUES()";

	if( isset($_GET['id'])) {
		$del_sql = "DELETE FROM infos WHERE id = $_GET[id]";
		if(mysqli_query($conn, $del_sql)){ ?>
			<script>window.location='form.php'</script>
			
			<?php
		}
	}

	if( isset($_GET['updateid'])) {
		$fname = mysqli_real_escape_string($conn,$_GET['fname']);
		$lname = mysqli_real_escape_string($conn,$_GET['lname']);
		$age = mysqli_real_escape_string($conn,$_GET['age']);
		$gender = mysqli_real_escape_string($conn,$_GET['gender']);
		$email = mysqli_real_escape_string($conn,$_GET['email']);
		$contact_number = mysqli_real_escape_string($conn,$_GET['contact_number']);
		
		$update_sql = "UPDATE infos SET fname ='$fname', lname='$lname', age='$age', gender='$gender', email='$email', contact_number ='$contact_number' WHERE id='$_GET[updateid]'";
		if(mysqli_query($conn,$update_sql)) { ?>
				<script> window.location = 'form.php' </script>
			<?php
		}
		
	}
?>