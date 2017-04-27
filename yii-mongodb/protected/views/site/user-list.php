<?php
	//var_dump($model);
	
	foreach ($model as $user) {
		echo $user['username']. "\n" .$user['email']."\n".$user['password'];
	}
	
	
	//$results = $model->find();

	//foreach ($results as $user) {
	//	echo $user['username'].$user['email'].$user['password'];
	//}
?>