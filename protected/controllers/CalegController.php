<?php

class CalegController extends Controller {

    public function actionIndex() {
        if (Yii::app()->user->isGuest) {
            $this->redirect(array('site/login'));
        }
        $userId = Yii::app()->user->getId();
    }

    public function actionRate($id) {
        if (Yii::app()->user->isGuest) {
            $this->redirect(array('site/login'));
        }
        $userId = Yii::app()->user->getId();
        
        // TODO update rate database
    }

    public function actionRead($id) {
        if (Yii::app()->user->isGuest) {
            $this->redirect(array('site/login'));
        }
        $userId = Yii::app()->user->getId();
        $caleg = $this->findCaleg($id, $userId);
        
        if ($caleg !== NULL) {
            $caleg->is_read = 1;
            $caleg->save(false);
        } else {
            $caleg = new Caleg();
            $caleg->id = $id;
            $caleg->user_id = $userId;
            $caleg->is_read = 1;
            $caleg->save(false);
        }
    }
    
    public function actionLike($id) {
        if (Yii::app()->user->isGuest) {
            $this->redirect(array('site/login'));
        }
        $userId = Yii::app()->user->getId();
        $caleg = $this->findCaleg($id, $userId);
        
        if ($caleg !== NULL) {
            $caleg->rate = 1;
            $caleg->save(false);
        } else {
            $caleg = new Caleg();
            $caleg->id = $id;
            $caleg->user_id = $userId;
            $caleg->rate = 1;
            $caleg->is_read = 1;
            $caleg->save(false);
        }
    }
    
    public function actionUnLike($id) {
        if (Yii::app()->user->isGuest) {
            $this->redirect(array('site/login'));
        }
        $userId = Yii::app()->user->getId();
        $caleg = $this->findCaleg($id, $userId);
        
        if ($caleg !== NULL) {
            $caleg->rate = 0;
            $caleg->save(false);
        } else {
            $caleg = new Caleg();
            $caleg->id = $id;
            $caleg->user_id = $userId;
            $caleg->rate = 0;
            $caleg->is_read = 1;
            $caleg->save(false);
        }
    }
    
    private function findCaleg($id, $userId) {
        $caleg = Caleg::model()->findByAttributes(array(
            'id' => $id,
            'user_id' => $userId,
        ));
        return $caleg;
    }

}
