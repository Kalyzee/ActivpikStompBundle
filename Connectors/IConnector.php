<?php
namespace Activpik\StompBundle\Connectors;

interface IConnector {
	
	
	public function send($destination, $message);

}