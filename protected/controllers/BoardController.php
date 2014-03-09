<?php

class BoardController extends Controller {

    public function actionIndex($lembaga = 'dpd') {
        if (Yii::app()->user->isGuest) {
            $this->redirect(array('site/login'));
        }
        $userId = Yii::app()->user->getId();
        
        // Determine view
        $view = 'dpr';
        if (strtolower($lembaga) === 'dpd') {
            $view = 'dpd';
        }
        
        // Find all dapils & current selected dapils
        $dapils = Dapil::model()->findAllByUserId($userId);
        $dapil = Dapil::model()->findByAttributes(array('lembaga' => $lembaga));
        
        // Update count read
        foreach ($dapils as $dapilItem) {
            $dapilItem->count_read = Caleg::countRead($userId, $dapilItem->id);
        }
        $dapil->count_read = Caleg::countRead($userId, $dapil->id);
        
        // partai
        $caller = new APICaller();
        $partais = $caller->getPartais();
        
        // caleg
        $calegs = array();
        $calegsGroup = array();
        if ($view === 'dpd') {
            $calegs = $caller->getCalegsDPD($dapil->id, $dapil->lembaga);
        } else {
            $calegsGroup = $caller->getCalegsGroupByPartai($dapil->id, $dapil->lembaga);
        }
        
        $this->render('index', array(
            'dapil' => $dapil,
            'view' => $view,
            'dapils' => $dapils,
            'partais' => $partais,
            'calegs' => $calegs,
            'calegsGroup' => $calegsGroup,
        ));
    }
}
