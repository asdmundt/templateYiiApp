<?php
echo "<?php\n";
$nameColumn=$this->guessNameColumn($this->tableSchema->columns);
$label=$this->pluralize($this->class2name($this->modelClass));
echo "\$this->breadcrumbs=array(
	'$label'=>array('index'),
	\$model->{$nameColumn},
);\n";
?>
$this->buttonMenu=array(
	array('label'=>Yii::t('app', 'List'), 'url'=>array('index')),
	array('label'=>Yii::t('app', 'Create') , 'url'=>array('create')),
        array('label'=>Yii::t('app', 'Update'), 'url'=>array('update', 'id'=>$model-><?php echo $this->tableSchema->primaryKey; ?>)),
	array('label'=>Yii::t('app', 'View'), 'url'=>array('view', 'id'=>$model-><?php echo $this->tableSchema->primaryKey; ?>)),
	array('label'=>Yii::t('app', 'Delete'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model-><?php echo $this->tableSchema->primaryKey; ?>),'confirm'=>'Are you sure you want to delete this item?')),
        array('label'=>Yii::t('app', 'Manage'), 'url'=>array('admin'), 'visible' => Yii::app()->user->isAdmin()),
);

?>

<h1>View <?php echo $this->modelClass." #<?php echo \$model->{$this->tableSchema->primaryKey}; ?>"; ?></h1>

<?php echo "<?php"; ?> $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
<?php
foreach($this->tableSchema->columns as $column) 
{
	if($column->isForeignKey) {
		foreach($this->relations as $key => $relation) {
			if($relation[2] == $column->name) {
				$columns = CActiveRecord::model($relation[1])->tableSchema->columns;
				$suggestedfield = $this->suggestName($columns);
				echo "\t\t'{$key}.{$suggestedfield->name}',\n";
			}
		}
	}
	else
		echo "\t\t'".$column->name."',\n";
	}
?>
	),
)); ?>


<?php
	foreach(CActiveRecord::model($this->model)->relations() as $key => $relation)	
{
	if($relation[0] == 'CManyManyRelation' || $relation[0] == 'CHasManyRelation') 
	{
		$columns = CActiveRecord::model($relation[1])->tableSchema->columns;

		$suggestedtitle = $this->suggestName($columns);

		printf("<br /><h2> This %s belongs to this %s: </h2>\n", $relation[1], $this->modelClass);
		echo CHtml::openTag('ul');
		printf("<?php foreach(\$model->%s as \$foreignobj) { \n
				printf('<li>%%s</li>', CHtml::link(\$foreignobj->%s, array('%s/view', 'id' => \$foreignobj->id)));\n
				} ?>", $key, $suggestedtitle->name, strtolower($relation[1])); 
		echo CHtml::closeTag('ul');
	}
}
?>
