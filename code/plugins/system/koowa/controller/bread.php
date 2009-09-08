<?php
/**
 * @version		$Id$
 * @category	Koowa
 * @package		Koowa_Controller
 * @copyright	Copyright (C) 2007 - 2009 Johan Janssens and Mathias Verraes. All rights reserved.
 * @license		GNU GPLv2 <http://www.gnu.org/licenses/old-licenses/gpl-2.0.html>
 * @link     	http://www.koowa.org
 */

/**
 * Abstract Bread Controller Class
 *
 * @author		Mathias Verraes <mathias@koowa.org>
 * @category	Koowa
 * @package		Koowa_Controller
 */
class KControllerBread extends KControllerAbstract
{
	public function __construct(array $options = array())
	{
		parent::__construct($options);
		
		$data = KRequest::get('get', 'string');
		
		$this->getModel()
			 ->getState()
			 ->setData($data);
	}

	/**
	 * Browse a list of items
	 *
	 * @return void
	 */
	protected function _actionBrowse()
	{
		$layout	= KRequest::get('get.layout', 'cmd', 'default' );

		$this->getView()
			->setLayout($layout)
			->display();
	}

	/**
	 * Display a single item
	 *
	 * @return void
	 */
	protected function _actionRead()
	{
		$layout	= KRequest::get('get.layout', 'cmd', 'default' );

		$this->getView()
			->setLayout($layout)
			->display();
	}

	/*
	 * Generic edit action, saves over an existing item
	 *
	 * @return KDatabaseRow 	A row object containing the updated data
	 */
	protected function _actionEdit()
	{
		// Get the post data from the request
		$data = KRequest::get('post', 'string');

		// Get the id
		$id	 = KRequest::get('get.id', 'int');

		// Get the row and save
		$row		= $this->_getTable()
						->fetchRow($id)
						->setData($data)
						->save();

		return $row;
	}

	/*
	 * Generic add action, saves a new item
	 *
	 * @return KDatabaseRow 	A row object containing the new data
	 */
	protected function _actionAdd()
	{
		// Get the post data from the request
		$data = KRequest::get('post', 'string');

		// Get the row and save
		$row 		= $this->_getTable()
						->fetchRow()
						->setData($data)
						->save();

		return $row;
	}

	/*
	 * Generic delete function
	 *
	 * @return KDatabaseTableAbstract
	 */
	protected function _actionDelete()
	{
		$ids = (array) KRequest::get('post.id', 'int');

		$table = $this->_getTable()
				->delete($ids);

		return $table;
	}

	/**
	 * Method to get a table object
	 *
	 * @param	array An optional associative array of configuration settings.
	 * @return	object	The table.
	 */
	protected function _getTable(array $options = array())
	{
		// Get the table object
		$app   	 = $this->_identifier->application;
		$package = $this->_identifier->package;

		// Table names are always plural
		$name    = KInflector::pluralize($this->_identifier->name);

		$table = KFactory::get($app.'::com.'.$package.'.table.'.$name, $options);
		return $table;
	}
}