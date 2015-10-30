<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


            Yii::import('application.modules.message.models.*');
?>

<table class="detail-view">
	
	<tbody>
		
		<tr>
			<th><?php echo Yii::t('app', 'webserver'); ?></th>
			<td><?php echo $_SERVER['SERVER_SOFTWARE']; ?></td>
		</tr>
		<tr>
			<th><?php echo Yii::t('app', 'new messages'); ?></th>
			<td><?php echo Mailbox::newMsgs(Yii::app()->user->id); ?></td>
		</tr>
	</tbody>
</table>
