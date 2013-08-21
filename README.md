ActivpikStompBundle
====================

Symfony StompClient Integration.


Download this bundle using composer :

In your composer.json add :
"activpik/stomp-bundle": "dev-master" 

In your config.yml file add theses lines 

activpik_stomp:
  sandbox: false
  connections:
    kalyzee_messenging :
      host: localhost
      port: 61613
  producers:
      activpik_producer: 
        destination: activpik/producer
        connection: kalyzee_messenging
      activpik_producer2: 
        destination: activpik/producer2
        connection: kalyzee_messenging

You can define a connection to a message broker by adding an connections item.
You can define a producer by adding an item to "producers". 

Sandbox allows you to test your application without send message.

Usage in a Symfony2 Controller

First you have to create a message :
 $message = $this->container->get("activpik_stomp_message_factory")->createMessage(array("id" => "id", "value"=>"value"));

After you can send it with this command :
 $this->container->get("activpik_stomp")->send("activpik_producer", $message);

