<?php

class ImagestreeController extends Controller
{
	public $layout='//layouts/column2';
	

	public function filters()
	{
		return array(
			'accessControl', 
		);
	}

	public function accessRules()
	{
		return array(
			array('allow',  
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', 
				'actions'=>array('create','update','ajaxFillTree'),
				'users'=>array('@'),
			),
			array('allow', 
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny', 
				'users'=>array('*'),
			),
		);
	}

	public function actionView()
	{
		$this->render('view',array(
			'model'=>$this->loadModel(),
		));
	}

	public function actionCreate()
	{
		$model=new Imagestree;

		$this->performAjaxValidation($model);

		if(isset($_POST['Imagestree']))
		{
			$model->attributes=$_POST['Imagestree'];
		

			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	public function actionUpdate()
	{
		$model=$this->loadModel();

		$this->performAjaxValidation($model);

		if(isset($_POST['Imagestree']))
		{
			$model->attributes=$_POST['Imagestree'];
		
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	public function actionDelete()
	{
		if(Yii::app()->request->isPostRequest)
		{
			$this->loadModel()->delete();

			if(!isset($_GET['ajax']))
				$this->redirect(array('index'));
		}
		else
			throw new CHttpException(400,
					Yii::t('app', 'Invalid request. Please do not repeat this request again.'));
	}

	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Imagestree');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	public function actionAdmin()
	{
		$model=new Imagestree('search');
		if(isset($_GET['Imagestree']))
			$model->attributes=$_GET['Imagestree'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

        
            public function actionAjaxFillTree() {

        if (!Yii::app()->request->isAjaxRequest) {
            CApplication::end();
        }
        $parentId = "0";
        if (isset($_GET['root']) && $_GET['root'] !== 'source') {
            $parentId = (int) $_GET['root'];
        }

        $sql = "SELECT m1.id, m1.title AS text, m2.id IS NOT NULL AS hasChildren,m1.beschr "
                . "FROM imagestree AS m1 LEFT JOIN imagestree AS m2 ON m1.id=m2.id_parent "
                . "WHERE m1.id_parent <=> ".$parentId
                . " GROUP BY m1.id ORDER BY m1.position ASC";
        $req = Yii::app()->db->createCommand($sql);
        $children = $req->queryAll();

        $children = $this->createLinks($children);

        echo str_replace(
                        '"hasChildren":"0"',
                        '"hasChildren":false',
                       CTreeView::saveDataAsJson($children)
                        //CTreeView::saveDataAsHtml($children)
                );
        exit();
    }

    private function createLinks($children) {
        $child = array();
        $return = array();
        foreach ($children AS $key => $value) {
            $child['id'] = $value['id'];
            $child['text'] = $value['text'];
            $child['hasChildren'] = $value['hasChildren'];
            Yii::log('$value["hasChildren"]= ' . $value['hasChildren'], 'info', 'application');
            
                $child['text'] = $this->format($value['id'], $value['text'], $value['beschr']);
            

            $return[] = $child;
            $child = array();
        }

        return $return;
    }

    private function format($id, $text, $beschr) {
        $img = '<img src="' . $this->module->assetsUrl  . '/images/icon_attachment.gif">';
        $imgAdd = '<img src="' . $this->module->assetsUrl  . '/images/page_up.gif">';

        return sprintf('<span>&nbsp;<div style="float:left">%s</div>&nbsp;&nbsp;<div style="float:right">%s</div></span>', CHtml::link(('&nbsp;&nbsp;&nbsp;&nbsp;' . $img . '  ' . $text), Yii::app()->createUrl('/imageManager/images/list', array('imagestree_id' => $id)),array('class' => 'openGallery','id' => $id)),
               CHtml::link(($imgAdd ), Yii::app()->createUrl('/imageManager/images/multiupload', array('tree_id' => $id)),array('id' => $id, 'class' => 'upload', 'data-toggle' => 'tooltip', 'title' => 'upload')) );
        /*
          CHtml::ajaxlink('Dokument anlegen',Yii::app()->createUrl('/dokumente/dokumente/createdialog',array('ref_id'=>$this->ref_id, 'ref_table'=>$this->ref_table)),array(
          'onclick'=>'$("#documentDialog").dialog("open"); return false;',
          'update'=>'#document'
          ));
         */
    }

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='imagestree-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
