<?php
namespace Activpik\StompBundle\Message;
use Activpik\StompBundle\Message\IMessageFactory;

class MessageFactory implements IMessageFactory {

	/**
	 * (non-PHPdoc)
	 * @see \Activpik\StompBundle\Message\IMessageFactory::createMessage()
	 */
	public function createMessage($headers, $body = "") {
		return new \StompFrame(false, $headers, $body);
	}

}
