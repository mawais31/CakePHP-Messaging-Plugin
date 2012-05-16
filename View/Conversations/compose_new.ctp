<?php 
	echo $this->Html->css('/messaging/css/chosen.jquery');
	echo $this->Html->script('/messaging/js/jquery.1.6.2.min');
	echo $this->Html->script('/messaging/js/chosen.jquery.min');
?>
<script>
	jQuery(document).ready(function($) {
		$('.i-select').chosen();
	});
</script>
From: <?php echo AuthComponent::user('username'); ?>
<?php
	echo $this->Form->create('Conversation', array('action' => 'composeNew'));
		echo $this->Form->input('Recipients.to', 
			array(
				'type' => 'select', 
				'multiple' => true, 
				'class' => 'i-select', 
				'data-placeholder' => 'Recipients', 
				'tabindex' => 1,
				'options' => array(
					'Groups' => array(
						'admins' => 'Admins'
					),
					'Individuals' => $userRecipients
				)
			));
		echo '<hr />';
		echo $this->Form->input('Conversation.title', array('type' => 'text', 'label' => 'Subject'));
		echo $this->Form->input('ConversationMessage.0.message', array('type' => 'textarea'));
	echo $this->Form->end('Send');
?>