<?php
$this->beginContent($this->baseLayout);
$this->widget('ext.loading.LoadingWidget');

?>
<?php $modelname = 'file'; ?>


<div id="content">

<?php  echo $content; ?>
</div>

<?php $this->endContent(); ?>



