<?php

namespace Duplo\Flash;

/**
 * This class lets you easily store, retrieve and print messages from the session
 */
class FlashInSession implements \Anax\DI\IInjectionAware
{
    use \Anax\DI\TInjectable;

    /**
    *	Save a message to the session
    *
    *	@param $msg The message to store
    *	@return void
    */
    public function saveMessage($msg)
    {
	$messages = $this->session->get("FlashInSession", []);
	$messages[] = $msg;
	$this->session->set("FlashInSession", $messages);
    }
    /**
    *	Retrievs all stored messages.
    *	@param $removeOnGet boolean If the messages should be removed.
    *	@return array with all the stored messages
    */
    public function getMessages($removeOnGet = false){
	$messages = $this->session->get("FlashInSession", []);
	if($removeOnGet){
	    $this->clear();
	}
	return $messages;
    }
    /**
    *	Prints all stored messages
    *	@return void
    */
    public function printAll(){
	$messages = $this->session->get("FlashInSession", []);
	dump($messages);
    }

    /**
    *	Removes all stored messages from the session
    *	@return void
    */
    public function clear(){
	$this->session->set("FlashInSession", []);
    }
}