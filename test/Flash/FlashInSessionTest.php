<?php

namespace Duplo\Flash;

/**
 * This class lets you easily store, retrieve and print messages from the session
 */
class FlashInSessionTest extends \PHPUnit_Framework_TestCase
{
    private function init()
    {
	$di = new \Anax\DI\CDIFactoryDefault();

        $di->set("session", function () {
            $session = new \Anax\Session\CSession();
            $session->configure(ANAX_APP_PATH . 'config/session.php');
            $session->name();
            return $session;
        });

        $flash = new FlashInSession();
	$flash->setDI($di);
	return $flash;
    }

    public function testSaveMessage()
    {
	$flashModule = $this->init();

	$exp = "I am a message";
	$flashModule->saveMessage($exp);

	$flashModule->printAll();

	$res = $flashModule->getMessages(true)[0];
	$this->assertEquals($res, $exp, "Saving a message failed..");

	$exp = [];
	$res = $flashModule->getMessages(false);
	$this->assertEquals($res, $exp, "Clearing messages when getting failed..");
    }

    public function testClearMessages()
    {
	$flashModule = $this->init();

	$flashModule->saveMessage("I am a message");
	$flashModule->clear();
	
	$exp = [];
	$res = $flashModule->getMessages(false);
	$this->assertEquals($res, $exp, "Clearing messages failed..");
    }
}