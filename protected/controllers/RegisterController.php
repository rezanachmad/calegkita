<?php

class RegisterController extends Controller {

    public function actionIndex() {
        $model = new User('register');
        
        if (isset($_POST['User'])) {
            // Set attributes
            $model->attributes = $_POST['User'];
            
            if ($model->save()) {
                $this->redirect(array('site/login'));
            }
        }

        $this->render('index', array('model' => $model));
    }

}
