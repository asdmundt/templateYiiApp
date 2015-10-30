<?php $modules = Yii::app()->metadata->getModules(); ?>

<table class="detail-view">

    <tbody>
          <?php   foreach ($modules as $module)
        { ?>
		<tr>
                    <th><?php echo Yii::app()->getModule($module)->getName(); ?></th>
			<td><?php echo "Version: ".Yii::app()->getModule($module)->$version; ?></td>
		</tr>
        <?php   }  ?>
	</tbody>
</table>