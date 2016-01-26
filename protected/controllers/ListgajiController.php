<?php

class ListgajiController extends RController
{

	public $layout='//layouts/column2';

	public function filters()
	{
        return array(
            'rights', // perform access control for CRUD operations
        );
	}

	public function actionView($id)
	{
			$roles=Rights::getAssignedRoles(Yii::app()->user->Id);			
		    foreach($roles as $role)
		    $cekrole = $role->name;	
			
				if($cekrole != 'supervisorMorena' and $cekrole != 'Admin' and $cekrole != 'adminMorena' and $nipUser['nip'] != $nip  ){
					throw new CHttpException(403,'You are not authorized to perform this action.');}
					
					
		$listgaji = $this->loadModel($id);
		$dataKaryawan = $this->loadModel2($listgaji->nip);
		
		$this->render('view',array(
			'model'=>$this->loadModel($id),
			'model2'=>$this->loadModel2($listgaji->nip),
		));
	}

	public function actionCreate()
	{
		$model=new Listgaji;

		if (isset($_POST['Listgaji'])) {
			$model->attributes=$_POST['Listgaji'];
			$model->noSlipGaji = $model->year.$model->month.$model->nip;
			$model->createdTimeStamp = date('Y-m-d H:i:s');
			$model->createdBy = Yii::app()->user->Id;
			
			if ($model->save()) {
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		if (isset($_POST['Listgaji'])) {
			$model->attributes = $_POST['Listgaji'];
			$model->updatedTimeStamp = date('Y-m-d H:i:s');
			$model->updatedBy = Yii::app()->user->Id;
			if ($model->save()) {
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	public function actionDelete($id)
	{
		if (Yii::app()->request->isPostRequest) {

			$this->loadModel($id)->delete();

			if (!isset($_GET['ajax'])) {
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
			}
		} else {
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
		}
	}


	public function actionIndex()
	{
		$this->redirect(array('admin'));
	}

	public function actionAdmin()
	{
		$sukses = false;
		$gagal = false;
		$alreadySlip = false;
		$slipExists = false;
		
		$loadModelFirstname=$this->loadModelFirstname();
		 if(isset($_POST['Listgaji']))
		 {
			 Yii::import('ext.phpexcelreader.JPhpExcelReader');
			 $model=new Listgaji;
			 $model->attributes=$_POST['Listgaji'];
			 $fileUpload=CUploadedFile::getInstance($model,'filee');
			 $path=Yii::getPathOfAlias('webroot').'/FileExcel/'.$fileUpload;
			 $fileUpload->saveAs($path);
			 
			 
			 if( !file_exists( $path ) ) die( 'File could not be found at: ' . $path );
				 $data=new JPhpExcelReader($path);
				 $baris = $data->rowcount($sheet_index=0);
 
				 $sukses = 0;
				 $gagal = 0;
				 $alreadySlip = 0;
				 
				 for ($i=2; $i<=$baris; $i++)
					{
						for($n=1; $n<=31; $n++):
						$rowData[$n] = str_replace(",", "", $data->val($i, $n));
						if($rowData[$n] == null or $rowData[$n] == ''){
							$rowData[$n] = 0; }
							
						endfor;
						
					 $command = Yii::app()->db->createCommand();
					 if(Listgaji::model()->findByAttributes(array('noSlipGaji'=>($rowData[1].$rowData[2].$rowData[3]))) !=null){
						$alreadySlip++;
						$slipExists[$rowData[1].$rowData[2].$rowData[3]] = $rowData[1].$rowData[2].$rowData[3];
					 } else {					 
					 try{
					 
					 $command->insert('listgaji', array(
										'noSlipGaji'=>($rowData[1].$rowData[2].$rowData[3]),
										'year'=>$rowData[1],
										'month'=>$rowData[2],
										'nip'=>$rowData[3],
										'workdays'=>$rowData[4],
										'grossSalary'=>$rowData[5],
										'fixAllowance'=>$rowData[6],
										'pulse'=>$rowData[7],
										'medicalAllowance'=>$rowData[8],
										'overtime'=>$rowData[9],
						 				'bonus'=>$rowData[10],
										'thr'=>$rowData[11],
										'correctionPlus'=>$rowData[12],
										'incentive'=>$rowData[13],
										'jobAllowance'=>$rowData[14],
										'marriageAllowance'=>$rowData[15],
										'houseAllowance'=>$rowData[16],
										'maternityAllowance'=>$rowData[17],
										'glassesAllowance'=>$rowData[18],
										'condolanceAllowance'=>$rowData[19],
										'separationPay'=>$rowData[20],
										'opex'=>$rowData[21],
										'coc'=>$rowData[22],
										'pph21'=>$rowData[23],
						 				'bpjs'=>$rowData[24],
						 				'jamsostek'=>$rowData[25],
										'benefitMin'=>$rowData[26],
										'copAllowanceMin'=>$rowData[27],
										'loan'=>$rowData[28],
										'meal'=>$rowData[29],
										'transport'=>$rowData[30],
										'taskForceAllowance'=>$rowData[31],
										'state'=>'Y',
										'createdTimeStamp'=>date('Y-m-d H:i:s'),
										'createdBy'=> Yii::app()->user->Id
										));
										
										$sukses++;
						}
						catch(Exception $e){
						$gagal++;
					}
					}	}
     
			unlink($path);

		}		
		$date = date('Y-m-d');
		$dateStamp = Yii::app()->db->createCommand()
			->select('count(id)')
			->from('listgaji')
			->where('substr(createdTimeStamp,1,10)=:date', array(':date'=>$date))
			->queryRow();
				
		$model=new Listgaji('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['Listgaji'])) {
			$model->attributes=$_GET['Listgaji'];
		}

		
		
		$this->render('admin',array(
			'model'=>$model,
			'loadModelFirstname'=>$loadModelFirstname,
			'sukses'=>$sukses,
			'gagal'=>$gagal,
			'alreadySlip'=>$alreadySlip,
			'slipExists'=>$slipExists,
			'dateStamp'=>$dateStamp,
		));
	}

	public function loadModel($id)
	{
		$model=Listgaji::model()->findByPk($id);
		if ($model===null) {
			throw new CHttpException(404,'The requested page does not exist.');
		}
		return $model;
	}

	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax']==='listgaji-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionPdf()
		{
			$roles=Rights::getAssignedRoles(Yii::app()->user->Id);			
		    foreach($roles as $role)
		    $cekrole = $role->name;	
			
			if($cekrole == 'employee' or isset($_GET['noSlipGaji'])):
				
			$model=$this->loadModelPdfAdmin($_GET['noSlipGaji']);
			$status=(Yii::app()->user->Id);
			//$nip = $this->loadModel2($status); /*User::model()->findByAttributes(array('id'=>$status));*/
		
		$command = Yii::app()->db->createCommand();
		$nip = $command->select('*')
			->from('profiles')
			->where('user_id=:id', array(':id'=>$status))
			->queryRow();	
			
			endif;


			
				if($cekrole != 'supervisorMorena' and $cekrole != 'Admin' and $cekrole != 'adminMorena' and $nip['nip'] != $model->nip  ){
					throw new CHttpException(403,'You are not authorized to perform this action.');}
	
	
			if(isset($_GET['noSlipGaji'])):
				$modelNoSlip = $this->loadModelPdfAdmin($_GET['noSlipGaji']);
				$id = $modelNoSlip->id;
			elseif(isset($_GET['id'])):
				$id = $_GET['id'];
			else:
				throw new CHttpException(772,'Salary Slip cannot be found in Database, please check NIP, Year, or Month in Payroll Management.');
			endif;
			
			
			
			//Instanciation of inherited class
			$pdf=new Pdf('L','mm','A4');
			$model=$this->loadModel($id);
			$model2=$this->loadModel2($model->nip);
			$pdf->AliasNbPages();
			$pdf->AddPage();
			$pdf->SetFont('Arial','',12);

			$pdf->mySurat(
			//$model->tglsurat,
			//$tgl,
			$model2['firstname'],
			$model2['lastname'],
			$model2['position'],
			$model2['departement'],
			$model2['location'],
			$model2['class'],
			$model2['marriageStatus'],
			$model->noSlipGaji,
			$model->year,
			$model->month,
			$model->nip,
			$model->workDays,
			$model->grossSalary,
			$model->fixAllowance,
			$model->pulse,
			$model->medicalAllowance,
			$model->overtime,
			$model->bonus,
			$model->thr,
			$model->correctionPlus,
			$model->incentive,
			$model->jobAllowance,
			$model->marriageAllowance,
			$model->houseAllowance,
			$model->maternityAllowance,
			$model->glassesAllowance,
			$model->condolanceAllowance,
			$model->separationPay,
			$model->opex,
			$model->coc,
			$model->pph21,
			$model->bpjs,
			$model->jamsostek,
			$model->benefitMin,
			$model->copAllowanceMin,
			$model->koperasi,
			$model->mcs,
			$model->loan,
			$model->meal,
			$model->transport,
			$model->taskForceAllowance);
			$pdf->Output();
			
			
	//	}
	//	else {

	 //				throw new CHttpException(403,'You are not authorized to perform this action.');
	//				}
}	
	public function loadModel2($nip)
	{
		$command = Yii::app()->db->createCommand();
		$dataKaryawan = $command->select('*')
			->from('profiles')
			->where('nip=:nip', array(':nip'=>$nip))
			->queryRow();		

		if($dataKaryawan==null)
			throw new CHttpException(771,'NIP cannot be found in Data Users, please check NIP "'.$nip.'" in Users Management.');
		return $dataKaryawan;
	}	
	public function loadModelFirstname()
	{
		$command = Yii::app()->db->createCommand();
		$dataKaryawan = $command->select('firstname')
			->from('profiles')
			->queryColumn();		

		if($dataKaryawan==null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $dataKaryawan;
	}
	public function actionloadModelFirstname()
	{
		$command = Yii::app()->db->createCommand();
		$dataKaryawan = $command->select('firstname')
			->from('profiles')
			->queryColumn();		

		if($dataKaryawan==null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $dataKaryawan;
	}
	
	public function actionPdfAdmin($year,$month,$nip)
		{
			$roles=Rights::getAssignedRoles(Yii::app()->user->Id);			
		    foreach($roles as $role)
		    $cekrole = $role->name;	
			
			if($cekrole == 'employee'):
			
			$status=(Yii::app()->user->Id);
			//$nip = $this->loadModel2($status); /*User::model()->findByAttributes(array('id'=>$status));*/
		
		$command = Yii::app()->db->createCommand();
		$nipUser = $command->select('*')
			->from('profiles')
			->where('user_id=:id', array(':id'=>$status))
			->queryRow();	
			
			endif;


			
				if($cekrole != 'supervisorMorena' and $cekrole != 'Admin' and $cekrole != 'adminMorena' and $nipUser['nip'] != $nip  ){
					throw new CHttpException(403,'You are not authorized to perform this action.');}
	
					
			$pdf=new Pdf('L','mm','A4');
			$noSlip = $year.$month.$nip;
			$model=$this->loadModelPdfAdmin($noSlip);
			if( $model == null ) throw new CHttpException(772,'Salary Slip cannot be found in Database, please check NIP, Year, or Month in Payroll Management.');
			$model2=$this->loadModel2($nip);			
			if( $model2 == null ) throw new CHttpException(772,'Data Employee not found!');
			$pdf->AliasNbPages();
			$pdf->AddPage();
			$pdf->SetFont('Arial','',12);			
			
			$pdf->mySurat(
			//$model->tglsurat,
			//$tgl,
			$model2['firstname'],
			$model2['lastname'],
			$model2['position'],
			$model2['departement'],
			$model2['location'],
			$model2['class'],
			$model2['marriageStatus'],
			$model->noSlipGaji,
			$model->year,
			$model->month,
			$model->nip,
			$model->workDays,
			$model->grossSalary,
			$model->fixAllowance,
			$model->pulse,
			$model->medicalAllowance,
			$model->overtime,
			$model->bonus,
			$model->thr,
			$model->correctionPlus,
			$model->incentive,
			$model->jobAllowance,
			$model->marriageAllowance,
			$model->houseAllowance,
			$model->maternityAllowance,
			$model->glassesAllowance,
			$model->condolanceAllowance,
			$model->separationPay,
			$model->opex,
			$model->coc,
			$model->pph21,
			$model->bpjs,
			$model->jamsostek,
			$model->benefitMin,
			$model->copAllowanceMin,
			$model->koperasi,
			$model->mcs,
			$model->loan,
			$model->meal,
			$model->transport,
			$model->taskForceAllowance);
			$pdf->Output("SALARY-SLIP-".$model->nip.'-'.$model->month.'-'.$model->year.".pdf",'D');

			
	//	}
	//	else {

	 //				throw new CHttpException(403,'You are not authorized to perform this action.');
	//				}
}	
	
	public function loadModelPdfAdmin($noSlipGaji)
	{

		$model=Listgaji::model()->findByAttributes(array('noSlipGaji'=>$noSlipGaji));
		if ($model===null) {
			throw new CHttpException(772,'Salary Slip cannot be found in Database, please check NIP, Year, or Month in Payroll Management.');
		}
		return $model;
	}
	
	public function actionRemove()
	{    if(Yii::app()->request->getIsAjaxRequest())
			{
					$checkedIDs=$_GET['checked'];
					foreach($checkedIDs as $id)
							Listgaji::model()->deleteByPk($id);
			}
	}
	
	public function actionDownload()
	{
		 $path = Yii::getPathOfAlias('webroot')."/template-upload-salary.xls";
		 return Yii::app()->getRequest()->sendFile('template-upload-salary.xls', @file_get_contents($path));
	}
	public function actionMySlip()
	{

		$roles=Rights::getAssignedRoles(Yii::app()->user->Id);		
		foreach($roles as $role)
			$cekrole = $role->name;

		$model=new Listgaji;
		$slip = false;

		$id = Yii::app()->user->Id;
		$command = Yii::app()->db->createCommand();
		$dataKaryawan = $command->select('*')
			->from('profiles')
			->where('user_id=:id', array(':id'=>$id))
			->queryRow();	
			
		if (isset($_GET['month']) and isset($_GET['year'])) {
			
			$listgaji = Listgaji::model()->findByAttributes(array('month'=>$_GET['month'],'year'=>$_GET['year'], 'nip'=>$dataKaryawan['nip']));
			
			if ($listgaji == null) {
				$this->render('mySlip',array(
					'model'=>$listgaji,
					'model2'=>$dataKaryawan,
					'slip'=> true,
				));
			}else{
				$dataKaryawan = $this->loadModel2($listgaji->nip);
				
				$this->render('mySlip',array(
					'model'=>$listgaji,
					'model2'=>$dataKaryawan,
					'slip'=> true,
				));
			}
		}
		else{
		$this->render('mySlip',array(
			'model'=>$model,
			'slip'=>$slip,
			'model2'=>$dataKaryawan,
		));
		}
	}
}