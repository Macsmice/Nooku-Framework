<?php
/**
 * @version		$Id$
 * @category	Koowa
 * @package     Koowa_Database
 * @copyright	Copyright (C) 2007 - 2009 Joomlatools. All rights reserved.
 * @license		GNU GPLv2 <http://www.gnu.org/licenses/old-licenses/gpl-2.0.html>
 * @link     	http://www.koowa.org
 */

/**
 * Asbtract Database Adapter
 *
 * @author		Johan Janssens <johan@koowa.org>
 * @category	Koowa
 * @package     Koowa_Database
 */
class KDatabase extends KObject
{
	/**
	 * Database operations
	 */
	const OPERATION_SELECT = 1;
	const OPERATION_INSERT = 2;
	const OPERATION_UPDATE = 4;
	const OPERATION_DELETE = 8;    
}