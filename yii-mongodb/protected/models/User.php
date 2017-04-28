<?php

class User extends EMongoDocument
    {
      public $username;
      public $email;
      public $password;
      //public $userDocument;
 
      // This has to be defined in every model, this is same as with standard Yii ActiveRecord
      public static function model($className=__CLASS__)
      {
        return parent::model($className);
      }
 
      // This method is required!
      public function getCollectionName()
      {
        return 'users';
      }
 
      public function rules()
      {
        return array(
          array('username, password', 'required'),
          array('username, password', 'length', 'max' => 20),
          array('email', 'length', 'max' => 255),
          array('username,password,email', 'safe')
        );
      }
 
      public function attributeLabels()
      {
        return array(
          'username'  => 'User Login',
          'email'   => 'Email',
          'password'   => 'Password',
        );
      }
    }