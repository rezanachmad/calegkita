<?php
/* @var $this RegisterController */
/* @var $model User */
/* @var $form CActiveForm  */

$this->pageTitle = Yii::app()->name . ' - Register';
$this->breadcrumbs = array(
    'Register',
);
?>

<h1>Register</h1>

<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'login-form',
    'enableClientValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ),
    'htmlOptions' => array(
        'class' => 'form-signin',
        'role' => 'form',
    ),
        ));
?>

<div class="form-group">
    <?php echo $form->textField($model, 'email', array('class' => 'form-control', 'placeholder' => 'Email address')); ?>
    <?php echo $form->error($model, 'email'); ?>
</div>

<div class="form-group">
    <?php echo $form->textField($model, 'name', array('class' => 'form-control', 'placeholder' => 'Name')); ?>
    <?php echo $form->error($model, 'name'); ?>
</div>

<div class="form-group">
    <?php echo $form->passwordField($model, 'password', array('class' => 'form-control', 'placeholder' => 'Password')); ?>
    <?php echo $form->error($model, 'password'); ?>
</div>

<div class="form-group">
    <?php echo $form->passwordField($model, 'repassword', array('class' => 'form-control', 'placeholder' => 'Retype Password')); ?>
    <?php echo $form->error($model, 'repassword'); ?>
</div>

<button class="btn btn-default " type="submit">Submit</button>

<?php $this->endWidget(); ?>