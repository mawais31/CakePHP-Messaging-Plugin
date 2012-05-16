<?php
	if(isset($this->request->params['named']['show'])) {
		debug($conversation);
	}
?>
<?php 
	echo $conversation['Conversation']['title']; 
?>
<ul>
<?php foreach($conversation['Messages'] AS $message) { ?>
		<li><?php echo $message['ConversationMessage']['message']; ?> -- 
			<?php echo $message['User']['Details']['User']['first_name'] . ' ' . $message['User']['Details']['User']['last_name']; ?> -- 
			<?php echo $message['ConversationMessage']['created']; ?></li>
<?php } ?>
</ul>