<?php
namespace Activpik\StompBundle\Message;

interface IMessageFactory {
 	
	function createMessage($headers, $body); 	
 	
}