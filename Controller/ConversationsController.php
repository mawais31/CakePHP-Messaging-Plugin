<?php
class ConversationsController extends MessagingAppController {

	public $scaffold;
	public $components = array('Session');

	public function myConversations() {
		$userId = AuthComponent::user('id');

		$messages = $this->Conversation->ownConversations($userId);
		
		$this->set(compact('messages')); 
	}

	public function show($id) {
		$this->set('conversation', $this->Conversation->getConversation($id));
	}
	
	public function composeNew() {
		if($this->request->is('post')) {

			$this->__setConversationUsers();
						
			$this->request->data['Conversation']['user_id'] = AuthComponent::user('id');
			$this->request->data['ConversationMessage'][0]['user_id'] = AuthComponent::user('id');
		
			debug($this->request->data);

			$this->Conversation->create();
			if($this->Conversation->saveAll($this->request->data)) {
				$this->Session->setFlash('Message Sent!');	
			} else {
				$this->Session->setFlash('Failed to Send Message');
			}
		}

		$userRecipients = $this->Conversation->User->find('list');
		
		$this->set(compact('userRecipients'));
	}
	
	private function __setConversationUsers() {
		
		$conversationUser['ConversationUser'] = array(
				0 => array(
					'user_id' => AuthComponent::user('id'),
					'status' => 1
				)
			);
			
		$this->request->data['Recipients']['to'] = array_unique($this->request->data['Recipients']['to']);
			
		foreach($this->request->data['Recipients']['to'] AS $receiver) {
			$conversationUser['ConversationUser'][] = 
				array(
					'user_id' => $receiver,
					'status' => 0
				);
		} 
		unset($this->request->data['Recipients']);
		
		$this->request->data = array_merge($this->request->data, $conversationUser);
	}
}