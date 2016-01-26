<?php
/* @var $this ListgajiController */
/* @var $model Listgaji */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

                    <?php echo $form->textFieldControlGroup($model,'noSlipGaji',array('span'=>5,'maxlength'=>20)); ?>

                    <?php echo $form->textFieldControlGroup($model,'tahun',array('span'=>5)); ?>
					
                    <?php echo $form->textFieldControlGroup($model,'bulan',array('span'=>5,'maxlength'=>16)); ?>

                    <?php echo $form->textFieldControlGroup($model,'nip',array('span'=>5,'maxlength'=>15)); ?>

                    <?php echo $form->textFieldControlGroup($model,'ketHari',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'gajiPokok',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'tunjanganTetap',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'pulsa',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'kesehatan',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'lembur',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'bonus',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'thr',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'rapel',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'insentif',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'jabatan',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'pernikahan',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'opex',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'coc',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'pajakPenghasilan',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'jamsostek',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'tjKesehatan',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'tjCop',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'koperasi',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'mcs',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'dii',array('span'=>5)); ?>


        <div class="form-actions">
        <?php echo TbHtml::submitButton('Search',  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->