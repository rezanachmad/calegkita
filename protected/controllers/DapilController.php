<?php

class DapilController extends Controller {

    public function actionIndex() {
        if (Yii::app()->user->isGuest) {
            $this->redirect(array('site/login'));
        }
        $userId = Yii::app()->user->getId();
        
        if (isset($_POST['Location'])) {
            $location = $_POST['Location'];
            // TODO validate
            
            // Update user
            $geolocation = $location['lat'] . ',' . $location['long'];
            $userData = array('geolocation' => $geolocation);
            if(isset($_POST['nik'])) {
                $userData['NIK'] = $_POST['nik'];
            }
            User::model()->updateByPk($userId, $userData);
            
            
            // Call /geographic/api/point
            // TODO security
            $caller = new APICaller();
            $result = $caller->call(APICaller::GEO_API_POINT, $location);
            
            // Delete all dapils
            Dapil::model()->deleteAllByAttributes(array('user_id' => $userId));
            
            // Insert new dapils
            $areas = $result->data->results->areas;
            foreach ($areas as $area) {
                $dapil = new Dapil();
                $dapil->id = $area->id;
                $dapil->user_id = $userId;
                $dapil->lembaga = $area->lembaga;
                $dapil->save();
            }
            
            // redirect to board
        }
        
        $this->render('index');
    }

}
