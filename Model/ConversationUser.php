<?php
class ConversationUser extends MessagingAppModel {

	public $belongsTo = array(
		'User' => array('className' => 'Users.User'),
		'Conversation' => array('className' => 'Messaging.Conversation')
	);

}