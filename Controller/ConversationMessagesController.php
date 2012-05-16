<?php
class ConversationMessagesController extends MessagingAppController {
	public $scaffold;

	public function getMessages($convId) {
		$this->set('messages', $this->ConversationMessage->getConversationMessages($convId));	
	}
}