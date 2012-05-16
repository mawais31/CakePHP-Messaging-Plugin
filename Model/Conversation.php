<?php
class Conversation extends MessagingAppModel {

	public $hasMany = array(
		'ConversationUser' => array('className' => 'Messaging.ConversationUser'),
		'ConversationMessage' => array('className' => 'Messaging.ConversationMessage')
	);
	
	public $belongsTo = array(
		'LastMessage' => array(
			'className' => 'ConversationMessage',
			'foreignKey' => 'last_message_id'
		),
		'User' => array('className' => 'Users.User')
	);

	public function ownConversations($id, $type = 'all') { 
     	$options = array(
     		'conditions' => array('ConversationUser.status <= 1'), 
            'group' => array('ConversationUser.conversation_id HAVING SUM(case when ConversationUser.`user_id` in (\''.$id.'\') then 1 else 0 end) = '.count($id).''), 
            'contain' => array('Conversation' => array('LastMessage')), 
            'order' => array('Conversation.last_message_id'=>'DESC')
        ); 
		
		return $this->ConversationUser->find($type, $options); 
	}

	public function getConversation($id) {
		$conversation = $this->find('first', array(
			'conditions' => array('Conversation.id' => $id),
			'contain' => array(
				'ConversationUser',
			)
		));
		
		if(!empty($conversation)) {			
			$conversation['Messages'] = $this->ConversationMessage->getConversationMessages($id);
		
			return $conversation;
		} else {
			return false;
		}
	}
}