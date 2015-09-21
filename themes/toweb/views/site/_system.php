<table class="detail-view" width="100%">
    <tbody>
           	<tr>
			<th><?php echo Yii::t('core', 'application name'); ?></th>
			<td><?php echo Yii::app()->name; ?></td>
		</tr>
    		<tr>
			<th><?php echo Yii::t('core', 'application version'); ?></th>
			<td><?php echo Yii::app()->params->version; ?></td>
		</tr>
                <tr>
			<th><?php echo Yii::t('app', 'user'); ?></th>
			<td><?php echo Yii::app()->user->name; ?>@<?php echo $_SERVER['REMOTE_ADDR']; ?></td>
		</tr>
		<tr>
                    <th><?php echo Yii::t('app', 'host'); ?></th>
			<td><?php echo $_SERVER['SERVER_ADDR']; ?></td>
		</tr>		
                <tr>
                    <th><?php echo Yii::t('app', 'client'); ?></th>
			<td><?php echo $_SERVER['REMOTE_ADDR']; ?></td>
		</tr>
                <tr>
			<th><?php echo Yii::t('app', 'osInfo'); ?></th>
			<td><?php echo php_uname('s r v'); ?></td>
		</tr>
		<tr>
			<th><?php echo Yii::t('app', 'mysqlServerVersion'); ?></th>
			<td><?php echo Yii::app()->db->getServerVersion(); ?></td>
		</tr>
		<tr>
			<th><?php echo Yii::t('app', 'mysqlClientVersion'); ?></th>
			<td><?php echo Yii::app()->db->getClientVersion(); ?></td>
		</tr>

		<tr>
			<th><?php echo Yii::t('app', 'webserver'); ?></th>
			<td><?php echo $_SERVER['SERVER_SOFTWARE']; ?></td>
		</tr>
                <tr>
			<th><?php echo Yii::t('app', 'phpversion'); ?></th>
                        <td><?php echo phpversion(); ?></td>
		</tr>

	</tbody>
</table>