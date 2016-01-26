<?php

class AdminController extends RController
{
	public $defaultAction = 'admin';
	public $layout='//layouts/column2';
	
	private $_model;

	/**
	 * @return array action filters
	 */
	public function filters()
	{
        return array(
            'rights', // perform access control for CRUD operations
        );
	}
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','create','update','view'),
				'users'=>UserModule::getAdmins(),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
	if(isset($_GET['updatePassword'])){
		$updatePass = "<div>".TbHtml::alert(TbHtml::ALERT_COLOR_SUCCESS, 'Well Done! You Successfully update password user!')."</div>";} else $updatePass = '';
		
		$sukses = false;
		$gagal = false;
		$alreadyUser = false;
		$userExists = false;
				 
		 if(isset($_POST['User']))
		 {
			 Yii::import('ext.phpexcelreader.JPhpExcelReader');
			 $model=new User;
			 $model->attributes=$_POST['User'];
			 $fileUpload=CUploadedFile::getInstance($model,'filee');
			 $path=Yii::getPathOfAlias('webroot').'/FileExcel/'.$fileUpload;
			 if( $fileUpload == '' ) die( 'Please Insert File Excel 2003 with format template! ');
			 if( substr($path,-3,3) != 'xls' ) die( 'Please Insert File Excel 2003! ');
			 
			 $fileUpload->saveAs($path);
			 
			 if( !file_exists( $path ) ) die( 'File could not be found at: ' . $path );
				 $data=new JPhpExcelReader($path);
				 $baris = $data->rowcount($sheet_index=0);
 
				 $sukses = 0;
				 $gagal = 0;
				 $alreadyUser = 0;
 
				 for ($i=2; $i<=$baris; $i++)
					{
						for($n=1; $n<=14; $n++):
						 $rowData[$n] = str_replace(",", "", $data->val($i, $n));
						endfor;
						
					 $command = Yii::app()->db->createCommand();
					 
					 if(User::model()->findByAttributes(array('username'=>$rowData[1])) !=null){
						$alreadyUser++;
						$userExists[$rowData[1]] = $rowData[1];
					 } else {
					try {
					 $command->insert('users', array(
										'username'=>$rowData[1],
										'password'=>Yii::app()->controller->module->encrypting($rowData[14]),
										'email'=>$rowData[1].'@morena.co.id',
										'create_at'=>date('Y-m-d H:i:s'),
										'status'=>1
										));

					$idUsersCreate=User::model()->findByAttributes(array('username'=>$rowData[1]));
							
					 $command->insert('profiles', array(
										'user_id'=>$idUsersCreate->id,
										'nip'=>$rowData[1],
										'firstname'=>$rowData[2],
										'lastname'=>$rowData[3],
										'birthdate'=>$rowData[4],
										'address'=>$rowData[5],
										'location'=>$rowData[6],
										'position'=>$rowData[7],
										'departement'=>$rowData[8],
										'class'=>$rowData[9],
										'joinDate'=>$rowData[10],
										'hireDate'=>$rowData[11],
										'state'=>$rowData[12],
										'marriageStatus'=>$rowData[13]
										));


					 $command->insert('authassignment', array(
										'itemname'=>'employee',
										'userid'=>$idUsersCreate['id']
										));
										
										$sukses++;
					} 
						catch(Exception $e){
						$gagal++;
						}
					 }
						}	
     
			unlink($path);

		}		
		
		$model=new User('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['User']))
            $model->attributes=$_GET['User'];
		
        $this->render('index',array(
            'model'=>$model,
            'sukses'=>$sukses,
            'gagal'=>$gagal,
            'alreadyUser'=>$alreadyUser,
            'userExists'=>$userExists,
            'updatePass'=>$updatePass,
        ));
		
		/*$dataProvider=new CActiveDataProvider('User', array(
			'pagination'=>array(
				'pageSize'=>Yii::app()->controller->module->user_page_size,
			),
		));

		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));//*/
	}


	/**
	 * Displays a particular model.
	 */
	public function actionView()
	{
		$model = $this->loadModel();
		$this->render('view',array(
			'model'=>$model,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new User;
		$profile=new Profile;
		$this->performAjaxValidation(array($model,$profile));
		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			$model->activkey=Yii::app()->controller->module->encrypting(microtime().$model->password);
			$profile->attributes=$_POST['Profile'];
			$profile->user_id=0;
			if($model->validate()&&$profile->validate()) {
				$model->password=Yii::app()->controller->module->encrypting($model->password);
				if($model->save()) {
					$profile->user_id=$model->id;
					$profile->save();
				}
				$this->redirect(array('view','id'=>$model->id));
			} else $profile->validate();
		}

		$this->render('create',array(
			'model'=>$model,
			'profile'=>$profile,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionUpdate()
	{
		$model=$this->loadModel();
		$profile=$model->profile;
		$this->performAjaxValidation(array($model,$profile));
		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			$profile->attributes=$_POST['Profile'];
			
			if($model->validate()&&$profile->validate()) {
				$old_password = User::model()->notsafe()->findByPk($model->id);
				if ($old_password->password!=$model->password) {
					$model->password=Yii::app()->controller->module->encrypting($model->password);
					$model->activkey=Yii::app()->controller->module->encrypting(microtime().$model->password);
				}
				$model->save();
				$profile->save();
				$this->redirect(array('view','id'=>$model->id));
			} else $profile->validate();
		}

		$this->render('update',array(
			'model'=>$model,
			'profile'=>$profile,
		));
	}


	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 */
	public function actionDelete()
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$model = $this->loadModel();
			$profile = Profile::model()->findByPk($model->id);
			$profile->delete();
			$model->delete();
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_POST['ajax']))
				$this->redirect(array('/user/admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
	
	/**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($validate)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
        {
            echo CActiveForm::validate($validate);
            Yii::app()->end();
        }
    }
	
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 */
	public function loadModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['id']))
				$this->_model=User::model()->notsafe()->findbyPk($_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}
	

	public function actionDownload()
	{
		 $path = Yii::getPathOfAlias('webroot')."/template-upload-user.xls";
		 return Yii::app()->getRequest()->sendFile('template-upload-user.xls', @file_get_contents($path));
	}
		
	public function actionReset($id)
	{
	
	$newPass = Yii::app()->controller->module->encrypting('morenarent');
	User::model()->updateByPk($id, array('password'=>$newPass));
		$this->redirect(array('admin','updatePassword'=>'yes'));
		echo "you successfully update password user!";
	}
		
	
}