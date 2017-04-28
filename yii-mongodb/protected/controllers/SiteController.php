<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

	public function actionListUsers(){
		$users = User::model()->findAll();
		$this->render('user-list', array('model'=>$users));
	}

	public function actionCreateUser(){

		/*
		//$arr = array(
		//	"username" => "Test1",
		//	"password" => "Test1",
		//	"email" => "test1@yiimongodb.com"
		//	);



		User::model()->username = "Test1";
		User::model()->password = "Test1";
		User::model()->email = "test1@yiimongodb.com";
		User::model()->save();

		$users = User::model()->findAll();
		$this->render('user-list', array('model'=>$users));
		*/


		//$model=new ContactForm;

		$model = new User;

		if( isset( $_POST['User'] ) ) {

			$model->attributes = $_POST['User'];
			
			//$username= $_POST['User']['username'];
		
			//$email=$_POST['User']['email'];

			//$password=$_POST['User']['password'];

			/*
			$username= $model->username;
			$email = $model->email;
			$password = $model->password;
			*/
			if($model->save()){
				Yii::app()->user->setFlash('success','Created user successfully.');
			}

		}
		


		//mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
		//$this->refresh();
		//$this->refresh();
		
		/*
		$model->username = $username;
		$model->password = $password;
		$model->email = $email;
		$model->save();
		*/

		$this->render('create-user',array('model'=>$model));

	}


	public function actionSearch() {

		$model = new User;
		if(isset($_POST['User']['email'])) {

			$email = $_POST['User']['email'];

			if( $model->findAllByAttributes(array('email' => $email)) ) {
				$this->render('search-result', array('model'=> $model));
			}

		}

		$this->render('search-user', array('model' => $model));

	}
}