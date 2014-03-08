<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle = Yii::app()->name . ' - Login';
$this->breadcrumbs = array(
    'Login',
);
?>

<h1>Login</h1>

<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'login-form',
    'enableClientValidation' => true,
    'htmlOptions' => array(
        'class' => 'form-signin',
        'role' => 'form',
    ),
));
?>

<div class="form-group">
    <?php echo $form->textField($model, 'username', array('class' => 'form-control', 'placeholder' => 'Email address')); ?>
    <?php echo $form->error($model,'username'); ?>
</div>

<div class="form-group">
    <?php echo $form->passwordField($model, 'password', array('class' => 'form-control', 'placeholder' => 'Password')); ?>
    <?php echo $form->error($model,'password'); ?>
</div>

<div class="checkbox">
    <label>
        <?php echo $form->checkBox($model, 'rememberMe'); ?> Remember me
        <?php echo $form->error($model,'rememberMe'); ?>
    </label>
</div>

<button class="btn btn-default" type="submit">Login</button>

<?php $this->endWidget(); ?>