<?php
/**
 * @version		$Id$
 * @category	Koowa
 * @package		Koowa_Command
 * @copyright	Copyright (C) 2007 - 2010 Johan Janssens and Mathias Verraes. All rights reserved.
 * @license		GNU GPLv2 <http://www.gnu.org/licenses/old-licenses/gpl-2.0.html>
 * @link     	http://www.koowa.org
 */

/**
 * Event Command
 * 
 * The event commend will translate the command name to a onCommandName format 
 * and let the event dispatcher dispatch to any registered event handlers.
 *
 * @author		Johan Janssens <johan@koowa.org>
 * @category	Koowa
 * @package     Koowa_Command
 * @uses 		KFactory
 * @uses 		KEventDispatcher
 * @uses 		KInflector
 */
class KCommandEvent extends KObject implements KCommandInterface 
{
	/**
	 * Command handler
	 * 
	 * @param 	string  	The command name
	 * @param 	object   	The command context
	 * @return 	boolean		Always returns true
	 */
	final public function execute( $name, KCommandContext $context) 
	{
		$type = '';
		
		if($context->caller)
		{
			$identifier = clone $context->caller->getIdentifier();
			
			if($identifier->path) {
				$type = array_shift($identifier->path);
			} else {
				$type = $identifier->name;
			}
		}
		
		$parts = explode('.', $name);	
		$event = 'on'.ucfirst($type.KInflector::implode($parts));
				
		$dispatcher = KFactory::get('lib.koowa.event.dispatcher');
		$dispatcher->dispatch($event, clone($context));
		
		return true;
	}
}
