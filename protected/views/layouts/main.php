<?php Yii::app()->bootstrap->register(); ?>
<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="language" content="en">

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print">

	<?php /*
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css">
	*/ ?>

	
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body style="background-color:#f5f5f5;">
<div class="container" id="page">
	<?php $cekrole = '' ?>
	<?php $roles=Rights::getAssignedRoles(Yii::app()->user->Id);		
		   foreach($roles as $role)
		   $cekrole = $role->name;
?>

		
		<?php $this->widget('bootstrap.widgets.TbNavbar', array(

			'brandLabel' => 'Morena Payroll Web',
			'collapse' => true,
			'items' => array(
						array(
							'class' => 'bootstrap.widgets.TbNav',
							'items'=>array(
								array('label'=>Yii::t('app','Login'), 'url'=>array('/user/login/login'),'visible'=>Yii::app()->user->isGuest),
								array('label'=>Yii::t('app','Payroll Management'), 'url'=>array('/listgaji/admin'), 'visible'=>$cekrole == 'Admin' or $cekrole == 'adminMorena' or $cekrole == 'supervisorMorena'),
							/*	array('label'=>Yii::t('app','User'), 
									  'class' => 'bootstrap.widgets.TbNav',
									  'items'=>array(
											array('label'=>Yii::t('app','Create User'), 'url'=>array('user/admin/create')),
											array('label'=>Yii::t('app','Data Employee'), 'url'=>array('/user')),
											array('label'=>Yii::t('app','Management User'), 'url'=>array('/user/admin')),
											array('label'=>Yii::t('app','Profile Field'), 
												  'class' => 'bootstrap.widgets.TbNav',
												  'items'=>array(
													array('label'=>Yii::t('app','Create User'), 'url'=>array('/user/ProfileField')),
													array('label'=>Yii::t('app','Data Employee'), 'url'=>array('/user/ProfileField/Create')))),
											array('label'=>Yii::t('app','My Profile'), 'url'=>array('/user/profile')),
												)),*/
								array('label'=>Yii::t('app','Users Management'), 'url'=>array('/user/admin/admin'),'visible'=>$cekrole == 'Admin' or $cekrole == 'adminMorena'  or $cekrole == 'supervisorMorena'),
								array('label'=>Yii::t('app','My Salary Slip'), 'url'=>array('/listgaji/mySlip'),'visible'=>$cekrole == 'employee'),
								array('label'=>Yii::t('app','About'), 'url'=>array('/site/page', 'view'=>'about'), 'visible'=>Yii::app()->user->isGuest),
								array('label'=>Yii::t('app','Contact'), 'url'=>array('/site/contact'), 'visible'=>Yii::app()->user->isGuest),
								array('label'=>Yii::t('app','Logout').' ('.Yii::app()->user->name.')', 
								'url'=>array('/user/logout'), 'visible'=>!Yii::app()->user->isGuest),
									)
						),
					),
			)); ?>	
<!-- mainmenu -->
</div>	

<div class="container" style="background-color: red;">

<?php /*	<div id="header" style="background-color: red;">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->
	
		<?php /*$this->widget('zii.widgets.CMenu',array(
            'items'=>array(
                array('label'=>Yii::t('app','Home'), 'url'=>array('/site/index')),
                array('label'=>Yii::t('app','About'), 'url'=>array('/site/page', 'view'=>'about')),
                array('label'=>Yii::t('app','Contact'), 'url'=>array('/site/contact')),
                array('label'=>Yii::t('app','Login'), 'url'=>array('/user/login'),'visible'=>Yii::app()->user->isGuest),
                array('label'=>Yii::t('app','User'), 'url'=>array('/user')),
                array('label'=>Yii::t('app','Rights'), 'url'=>array('/rights')),
                array('label'=>Yii::t('app','Logout').' ('.Yii::app()->user->name.')', 'url'=>array('/user/logout'), 'visible'=>!Yii::app()->user->isGuest)
            ,
        )));*/ ?>
	</div><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>



</body>
</html>
