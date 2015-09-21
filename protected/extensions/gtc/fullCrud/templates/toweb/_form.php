

<?php echo "<?php echo \$form->errorSummary(\$model); ?>\n"; ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<?php
foreach($this->tableSchema->columns as $column)
{
	if($column->isPrimaryKey)
		continue;
?>
	<tr>
                       
		<?php 
		if(!$column->isForeignKey) 
		{ ?>
			<td width="50%"><?php  echo "<?php echo ".$this->generateActiveLabel($this->modelClass,$column)."; ?>\n"; ?></td>
			<td width="50%"><?php echo "<?php ".$this->generateActiveField($this->modelClass,$column)."; ?>\n"; ?>
			<?php echo "<?php echo \$form->error(\$model,'{$column->name}'); ?>\n"; ?></td>
		<?php } ?>

	</tr>

<?php
}
?>
</table>
<?php
foreach($this->getRelations() as $key => $relation)
{
	if($relation[0] == 'CBelongsToRelation' 
			or $relation[0] == 'CHasOneRelation' 
			or $relation[0] == 'CManyManyRelation')
	{
		printf('<label for="%s">Belonging %s</label>', $relation[1], $relation[1]);
		echo "<?php ". $this->generateRelation($this->modelClass, $key, $relation)."; ?>\n"; ?>
			<?php
	}
}
?>
