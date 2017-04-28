<h1>Search User</h1>


<div class="form">
<?php $form = $this->beginWidget( 'CActiveForm', array(
	'id' => 'search-user'
));
?> 

<div class="row">
	<?php echo $form->labelEx($model,'Email'); ?>
	<?php echo $form->textField($model,'email'); ?>
</div>

<div class="row-buttons">
	<?php echo CHtml::submitButton('Submit'); ?>
</div>

<?php $this->endWidget(); ?>

</div>
