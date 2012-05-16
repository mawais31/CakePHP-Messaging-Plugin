<?php
	if(isset($this->request->params['named']['show'])) {
		debug($messages);
	}
?>
<ul>
<?php if(!empty($messages)) { ?>
	<?php foreach($messages AS $conversation) { ?>
		<li><a href="/conversations/show/<?php echo $conversation['Conversation']['id']; ?>"><?php echo $conversation['Conversation']['title']; ?></a>
	<?php } ?>
<?php } else {
			echo 'No Conversations';
		}
?>
</ul>