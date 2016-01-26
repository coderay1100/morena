<?php
/* @var $this ListgajiController */
/* @var $data Listgaji */
?>

<div class="view">

    	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('noSlipGaji')); ?>:</b>
	<?php echo CHtml::encode($data->noSlipGaji); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tahun')); ?>:</b>
	<?php echo CHtml::encode($data->tahun); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('bulan')); ?>:</b>
	<?php echo CHtml::encode($data->bulan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nip')); ?>:</b>
	<?php echo CHtml::encode($data->nip); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ketHari')); ?>:</b>
	<?php echo CHtml::encode($data->ketHari); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gajiPokok')); ?>:</b>
	<?php echo CHtml::encode($data->gajiPokok); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tunjanganTetap')); ?>:</b>
	<?php echo CHtml::encode($data->tunjanganTetap); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('pulsa')); ?>:</b>
	<?php echo CHtml::encode($data->pulsa); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kesehatan')); ?>:</b>
	<?php echo CHtml::encode($data->kesehatan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lembur')); ?>:</b>
	<?php echo CHtml::encode($data->lembur); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bonus')); ?>:</b>
	<?php echo CHtml::encode($data->bonus); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('thr')); ?>:</b>
	<?php echo CHtml::encode($data->thr); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rapel')); ?>:</b>
	<?php echo CHtml::encode($data->rapel); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('insentif')); ?>:</b>
	<?php echo CHtml::encode($data->insentif); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('jabatan')); ?>:</b>
	<?php echo CHtml::encode($data->jabatan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pernikahan')); ?>:</b>
	<?php echo CHtml::encode($data->pernikahan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('opex')); ?>:</b>
	<?php echo CHtml::encode($data->opex); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('coc')); ?>:</b>
	<?php echo CHtml::encode($data->coc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pajakPenghasilan')); ?>:</b>
	<?php echo CHtml::encode($data->pajakPenghasilan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('jamsostek')); ?>:</b>
	<?php echo CHtml::encode($data->jamsostek); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tjKesehatan')); ?>:</b>
	<?php echo CHtml::encode($data->tjKesehatan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tjCop')); ?>:</b>
	<?php echo CHtml::encode($data->tjCop); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('koperasi')); ?>:</b>
	<?php echo CHtml::encode($data->koperasi); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mcs')); ?>:</b>
	<?php echo CHtml::encode($data->mcs); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dii')); ?>:</b>
	<?php echo CHtml::encode($data->dii); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('state')); ?>:</b>
	<?php echo CHtml::encode($data->state); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('createdTimeStamp')); ?>:</b>
	<?php echo CHtml::encode($data->createdTimeStamp); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('updatedTimeStamp')); ?>:</b>
	<?php echo CHtml::encode($data->updatedTimeStamp); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('createdBy')); ?>:</b>
	<?php echo CHtml::encode($data->createdBy); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('updatedBy')); ?>:</b>
	<?php echo CHtml::encode($data->updatedBy); ?>
	<br />

	*/ ?>

</div>