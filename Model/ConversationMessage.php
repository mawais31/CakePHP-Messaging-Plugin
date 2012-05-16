<?php
class ConversationMessage extends MessagingAppModel {

	public $belongsTo = array(
		'Conversation' => array('className' => 'Messaging.Conversation'),
		'User' => array('className' => 'Users.User')
	);
	
	public function getConversationMessages($conversationId = NULL) {
		$messages = $this->find('all', array(
			'conditions' => array('ConversationMessage.conversation_id' => $conversationId),
			'contain' => array(
				'User' => array(
					'fields' => array('id','username'),
				)
			),
			'order' => array('ConversationMessage.created DESC')
		));
		
		foreach($messages AS $i=>$message) {
			$messages[$i]['User']['Details'] = $this->User->UserDetail->getSection($messages[$i]['User']['id'], 'User');
		}
		
		return $messages;
	}

	public function createNewConversation() {
		
		$sender = AuthComponent::user('id');
		
		$conversation = array(
			'Conversation' => array(
				'user_id' => $sender,
				'title' => $title,
				'last_message_id' => $messageId
			)
		);
		
	}

}