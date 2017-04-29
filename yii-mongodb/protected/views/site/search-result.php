
<?php

	//var_dump($model);

	$counter = 0;

	foreach ($model as $user) {
		
		if($user != null) {
			$counter++;
?>
			<div class="row">
			<?php
				echo "Id: ".$counter."<br>";
				//echo "Test1";
				//echo "Username: ".$user['username']."<br>";
				echo "Email: ".$user."<br>";
				//echo "Password: ".$user['password']."<br>";
	?>
	<hr>
	<?php
		}//end of if
	}
	?>
	</div>
	<center>Total number of users with given email are are <?php echo $counter ?></center>

	
<!--The below code is just for reference to my initial knowledge 
<?php	
	//$results = $model->find();

	//foreach ($results as $user) {
	//	echo $user['username'].$user['email'].$user['password'];
	//}

?>
-->

