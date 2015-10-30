<?php
foreach (Yii::app()->user->getFlashes() as $key => $message) {
    echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
}
?>

<h2><?php echo str_replace(array($basePath . '/', '/'), array('', ' / '), $currentPath); ?></h2>

<?php
// echo "<li>basePath: $basePath";
// echo "<li>currentPath: $currentPath";
$relativePath = str_replace($basePath . '/', '', $currentPath);
if ($relativePath == $currentPath)
    $relativePath = '';
// echo "<li>relativePath: $relativePath";
$subDirs = explode('/', $relativePath);
if ($subDirs == array(''))
    $subDirs = array();
// echo "<h3>subDirs</h3>";
// var_dump($subDirs);
$dirsBreadcrumbs = $dirsBreadcrumbs2 = $links = array();
foreach ($subDirs as $n => $subDir) {
    $dirsBreadcrumbs[$n] = $subDir;
    if (isset($dirsBreadcrumbs[$n - 1]))
        $dirsBreadcrumbs[$n] = $dirsBreadcrumbs[$n - 1] . '/' . $dirsBreadcrumbs[$n];
}
// echo "<h3>dirsBreadcrumbs</h3>";
// var_dump($dirsBreadcrumbs);
foreach ($dirsBreadcrumbs as $n => $subDir) {
    $dirsBreadcrumbs2[basename($subDir)] = $subDir;
}
// echo "<h3>dirsBreadcrumbs2</h3>";
// var_dump($dirsBreadcrumbs2);
$links[] = array(
    'link' => CHtml::link(
            Yii::t('main', 'Base Path'), array('index')),
    'subDirs' => DDMediaDirectory::getSubDirs($basePath)
);
foreach ($dirsBreadcrumbs2 as $title => $subDir) {
    $links[] = array(
        'path' => urlencode($subDir),
        'link' => CHtml::link($title, array('index', 'p' => urlencode($subDir))),
        'subDir' => $title,
        'subDirs' => DDMediaDirectory::getSubDirs($basePath . '/' . $subDir)
    );
}
// echo "<h3>links</h3>";
// var_dump($links);

echo '<form id="dirForm" method="get" action="' . $this->createUrl('index') . '">';
echo '<input type="hidden" id="r" name="r" value="media" />';
echo '<input type="hidden" id="p" name="p" size="20" />';


echo '<ul class="breadcrumb">';
foreach ($links as $i => $link) {
    echo '<li>' . $link['link'] . '<span class="divider">/</span></li>';
//    if (isset($links[$i + 1]))
  //      echo '<li class="active">/</li>';
}
echo "</ul></form>";
?>

<?php if (trim($msg) !== '') : ?>
    <p>
    <?php echo $msg; ?>
    </p>
    <?php endif; ?>

<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
   <table class="items table table-striped table-bordered">
        <thead>
            <tr>
                <th><input type="checkbox" value="" onclick="toggleAll(this.checked);" /></th>
                <th><?php echo CHtml::encode(Yii::t('main', 'Icon')); ?></th>
                <th><?php echo CHtml::encode(Yii::t('main', 'Name')); ?></th>
                <th><?php echo CHtml::encode(Yii::t('main', 'Date')); ?></th>
                <th><?php echo CHtml::encode(Yii::t('main', 'Type')); ?></th>
                <th><?php echo CHtml::encode(Yii::t('main', 'Size')); ?></th>
                <th><?php echo CHtml::encode(Yii::t('main', 'Action')); ?></th>
            </tr>
        </thead>
        <tbody>
            <!-- {{{ Dirs -->
<?php foreach ($files['dirs'] as $dirPath => $stats) : ?>
    <?php /* $onclick=""; if(!in_array($stats['name'],array('.', '..'))) */ $onclick = ' onclick="selectMedia(\'directory\',\'' . $dirPath . '\',\'' . $stats['name'] . '\');"'; ?>
                <tr class="dirsFilesRows"<?php echo $onclick; ?>>
                    <td>
                <?php if (!in_array($stats['name'], array('.', '..'))) : ?>
                            <input type="checkbox" name="chSelectedItem[]" value="<?php echo $stats['name']; ?>" class="chSelectedItems" />
                        <?php endif; ?>
                    </td>
                    <td class="folder"><?php echo CHtml::image($this->module->assetsUrl . '/filetypeicons/folder.png', $stats['name']); ?></td>
                    <td><?php echo CHtml::link($stats['name'], '',array(
        'style'=>'cursor: pointer; text-decoration:none;',
        'onclick'=>"updateDir('".Yii::app()->createUrl('/dokumente/default/index',array('p'=>urlencode($path . '/' . $stats['name'])))."','".urlencode($path . "/" . $stats['name'])."')")); ?></td>
                    <td>&ndash;</td>
                    <td><?php echo CHtml::encode(Yii::t('main', 'Directory')); ?></td>
                    <td style="white-space:nowrap;font-size:smaller;text-align:right"><?php echo $stats['size']; ?></td>
                    <td style="white-space:nowrap;font-size:smaller">
    <?php if (!in_array($stats['name'], array('..'))) : ?>
                            <a href="javascript:void(0)" onclick="selectMedia('directory', '<?php echo $dirPath; ?>', '<?php echo $stats['name']; ?>');
                                showDialog('rename');" title="<?php echo Yii::t('main', 'Rename directory {dir}', array('{dir}' => $stats['name'])); ?>"><?php echo CHtml::image($this->module->assetsUrl . '/filetypeicons/page_edit.gif', ""); ?></a>&nbsp;
                            <a href="javascript:void(0)" onclick="selectMedia('directory', '<?php echo $dirPath; ?>', '<?php echo $stats['name']; ?>');
                                showDialog('copy');" title="<?php echo Yii::t('main', 'Copy directory {dir}', array('{dir}' => $stats['name'])); ?>"><?php echo CHtml::image($this->module->assetsUrl . '/filetypeicons/copy.gif', ""); ?></a>&nbsp;
                            <a href="javascript:void(0)" onclick="selectMedia('directory', '<?php echo $dirPath; ?>', '<?php echo $stats['name']; ?>');
                                showDialog('move');" title="<?php echo Yii::t('main', 'Move directory {dir}', array('{dir}' => $stats['name'])); ?>"><?php echo CHtml::image($this->module->assetsUrl . '/filetypeicons/cut.gif', ""); ?></a>&nbsp;
                            <a href="javascript:void(0)" onclick="selectMedia('directory', '<?php echo $dirPath; ?>', '<?php echo $stats['name']; ?>');
                                showDialog('delete');" title="<?php echo Yii::t('main', 'Delete directory {dir}', array('{dir}' => $stats['name'])); ?>"><?php echo CHtml::image($this->module->assetsUrl . '/filetypeicons/folder_delete.gif', ""); ?></a>
    <?php endif; ?>
                    </td>
                </tr>
<?php endforeach; ?>
            <!-- }}} -->
            <!-- {{{ Files -->
            <?php foreach ($files['files'] as $filePath => $stats) : ?>
    <?php $onclick = "";
    if (!in_array($stats['name'], array('.', '..'))) $onclick = ' onclick="selectMedia(\'file\',\'' . $filePath . '\',\'' . $stats['name'] . '\');"'; ?>
                <tr class="dirsFilesRows"<?php echo $onclick; ?>>
                    <td>
                        <?php if (!in_array($stats['name'], array('.', '..'))) : ?>
                            <input type="checkbox" name="chSelectedItem[]" value="<?php echo $stats['name']; ?>" onclick="collectChSelectedItems();" class="chSelectedItems" />
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php
                        if (preg_match("/image\/(.*)/", $stats['mimeType'], $matches))
                            echo CHtml::image($this->createUrl('thumbnail', array('path' => urlencode($stats['path']), 'x' => 75)));
                        else
                            echo CHtml::image($this->module->assetsUrl . '/filetypeicons/'.preg_replace('/^.*\./', '', $stats['name']).'.png', $stats['name']);
                        ?>
                    </td>
                    <td>
                        <?php
                        if (preg_match("/image\/(.*)/", $stats['mimeType'], $matches))
                            echo CHtml::link($stats['name'], 'javascript:void(0)', array('onclick' => "jQuery('#imagePreview').dialog('open');jQuery('#imagePlaceholder').html('" . CHtml::image($this->createUrl('thumbnail', array('path' => urlencode($stats['path']), 'x' => 480))) . "');"));
                        elseif (preg_match("/text\/plain/", $stats['mimeType'], $matches)) {
                            echo CHtml::link($stats['name'], 'javascript:void(0)', array('onclick' => '
$.ajax({
    url: "' . $this->createUrl('preview', array('path' => urlencode($stats['path']))) . '",
}).done(function(data) { 
    $("#imagePreview").dialog("open");
    $("#imagePreview").html(data);
});'));
                        }
                       else
                            echo CHtml::link($stats['name'], array('download', 'path' => urlencode($stats['path'])), array('target' => '_blank'));
                        ?></td>
                    <td><?php echo date("Y-m-d H:i:s", $stats['mTime']); ?></td>
                    <td><?php echo preg_replace('/^.*\./', '', $stats['name']); ?></td>
                    <td style="white-space:nowrap;font-size:smaller;text-align:right"><?php echo $stats['sizeFormatted']; ?></td>
                    <td style="white-space:nowrap;font-size:smaller">
                        <a href="javascript:void(0)" onclick="selectMedia('file', '<?php echo $filePath; ?>', '<?php echo $stats['name']; ?>');
                            showDialog('rename');" title="<?php echo Yii::t('main', 'Rename file {file}', array('{file}' => $stats['name'])); ?>"><?php echo CHtml::image($this->module->assetsUrl . '/filetypeicons/page_edit.gif', ""); ?></a>&nbsp;
                        <a href="javascript:void(0)" onclick="selectMedia('file', '<?php echo $filePath; ?>', '<?php echo $stats['name']; ?>');
                            showDialog('copy');" title="<?php echo Yii::t('main', 'Copy file {file}', array('{file}' => $stats['name'])); ?>"><?php echo CHtml::image($this->module->assetsUrl . '/filetypeicons/copy.gif', ""); ?></a>&nbsp;
                        <a href="javascript:void(0)" onclick="selectMedia('file', '<?php echo $filePath; ?>', '<?php echo $stats['name']; ?>');
                            showDialog('move');" title="<?php echo Yii::t('main', 'Move file {file} to another location', array('{file}' => $stats['name'])); ?>"><?php echo CHtml::image($this->module->assetsUrl . '/filetypeicons/cut.gif', ""); ?></a>&nbsp;
                        <a href="javascript:void(0)" onclick="selectMedia('file', '<?php echo $filePath; ?>', '<?php echo $stats['name']; ?>');
                            showDialog('delete');" title="<?php echo Yii::t('main', 'Delete file {file}', array('{file}' => $stats['name'])); ?>"><?php echo CHtml::image($this->module->assetsUrl . '/filetypeicons/folder_delete.gif', ""); ?></a>
                    </td>
                </tr>
<?php endforeach; ?>
            <!-- }}} -->
            <!-- {{{ Batch Selection Row -->
            <tr>
                <td colspan="7">
                    <input type="text" name="path" value="<?php echo $path; ?>" size="20" />
                    <select name="batchAction" id="batchAction" onchange="if (this.value !== '') {
                            doBatchJob = true;
                            doShowDialog = true;
                            showDialog(this.value);
                        }">
                        <option value="">(Batch Action)</option>
                        <option value="move">Move</option>
                        <option value="delete">Delete</option>
                    </select>
                </td>
            </tr>
            <!-- }}} -->
        </tbody>
    </table>

