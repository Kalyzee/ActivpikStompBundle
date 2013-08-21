<?php
namespace Activpik\StompBundle\Connectors;

use Activpik\StompBundle\Exceptions\HostNotFoundException;
use Activpik\StompBundle\Exceptions\ProducerNotFoundException;

class StompConnector implements IConnector{

	private $connections;
	
	/**
	 * 
	 * @param Connections array : $connections
	 * [sandbox] => 
	 * [connections] 
	 * 		=> Array 
	 * 			( [kalyzee_messenging] => Array ( [host] => localhost [port] => 61313 ) ) 
	 * 	[producers] 
	 * 		=> Array 
	 * 		( [activpik_account_created] 
	 * 				=> Array ( [destination] => activpik/account/account-created [name] => localhost [connection] => default ) 
	 * 		  [activpik_account_deleted] 
	 * 				=> Array ( [destination] => activpik/account/account-deleted [name] => localhost [connection] => default ) 
	 * 		)
	 */
	public function __construct($connections){
		$this->connections = $connections;
	}
	
	/**
	 * @param String / StompFrame $message see MessageFactory  
	 * @see \Activpik\StompBundle\Connectors\IConnector::send()
	 */
	public function send($destination, $message){
		if (isset($this->connections["producers"][$destination])){
			$producer = $this->connections["producers"][$destination];
			if (isset($this->connections["connections"][$producer["connection"]])){
				$connection = $this->connections["connections"][$producer["connection"]];
				if ($this->connections["sandbox"] == false){
					$stomp = new \Stomp("tcp://".$connection["host"].":".$connection["port"]);
					$stomp->send($producer["destination"], $message);
				}
			}else {
				throw new HostNotFoundException();
			}
		}else {
			throw new ProducerNotFoundException();
		}
		
	}
	
}
