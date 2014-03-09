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
            
            // Delete all calegs
            Caleg::model()->deleteAllByAttributes(array('user_id' => $userId));
            
            // Insert new dapils
            $areas = $result->data->results->areas;
            foreach ($areas as $area) {
                $dapil = new Dapil();
                $dapil->id = $area->id;
                $dapil->user_id = $userId;
                $dapil->nama = $area->nama;
                $dapil->lembaga = $area->lembaga;
                
                // Get count
                $sDapil = $dapil->id;
                if (strlen($sDapil) == 2) {
                    $sDapil = "{$sDapil}00-00-0000";
                }
                $response = $caller->call(APICaller::CANDIDATE_API_CALEG, array('dapil' => $sDapil));
                $count = $response->data->results->total;
                $dapil->count = $count;
                
                $dapil->save();
            }
            
            $this->redirect(array('board/index'));
        }
        
        $this->render('index');
    }

}
