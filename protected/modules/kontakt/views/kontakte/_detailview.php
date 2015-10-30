   <?php
                $this->widget('zii.widgets.CDetailView', array(
                    'id' => 'kontakte_'.$model->id,
                    'data' => $model,
                    'cssFile' => Yii::app()->request->baseUrl . '/css/detailview/graystyles.css',
                    'attributes' => array(
                        'bez',
                        'kundennr',
                        'titel',
                        'anrede',
                        'name',
                        'vorname',
                        'gebdatum',
                        'art',
                        'erfassid',
                        'erfassdatum',
                    ),
                ));
                ?>


            <fieldset class="fieldset">
                <legend class="legend">Adress Daten</legend>
                    <?php //echo $this->renderPartial('/adresse/table', array('dataProvider' => Adresse::getAddresses($model->id),'kontakte_id' => $model->id)); ?>
            </fieldset>
            <br />
            <fieldset class="fieldset">
                <legend class="legend">Kommunikations Daten</legend>
                    <?php //echo $this->renderPartial('/kommunikation/table', array('dataProvider' => Kommunikation::getList($model->id),'kontakte_id' => $model->id)); ?>
            </fieldset> 
                        <br />
            <fieldset class="fieldset">
                <legend class="legend">Konto Verbindung</legend>
                    <?php // echo $this->renderPartial('/bankdaten/table', array('dataProvider' => Bankdaten::getList($model->id),'kontakte_id' => $model->id)); ?>
            </fieldset> 
