<?php
/**
 * @version		$Id$
 * @category	Koowa
 * @package     Koowa_View
 * @subpackage  Html
 * @copyright	Copyright (C) 2007 - 2009 Johan Janssens and Mathias Verraes. All rights reserved.
 * @license		GNU GPLv2 <http://www.gnu.org/licenses/old-licenses/gpl-2.0.html>
 * @link     	http://www.koowa.org
 */

/**
 * View HTML Class
 *
 * @author		Johan Janssens <johan@koowa.org>
 * @category	Koowa
 * @package     Koowa_View
 * @subpackage  Html
 */
class KViewHtml extends KViewAbstract
{
	public function __construct($options = array())
	{
		$options = $this->_initialize($options);

		// Add a rule to the template for form handling and secrity tokens
		KTemplate::addRules(array(KFactory::get('lib.koowa.template.filter.form')));

		// Set base and media urls for use by the view
		$this->assign('baseurl' , $options['base_url'])
			 ->assign('mediaurl', $options['media_url']);

		parent::__construct($options);
	}

	public function display()
	{
		$app 		= $this->_identifier->application;
		$package 	= $this->_identifier->package;
		$name 		= $this->_identifier->name;
		
		$toolbar = KFactory::get($app.'::com.'.$package.'.toolbar.'.$name);

		//Render the toolbar title
		KFactory::get('lib.koowa.application')
			->set('JComponentTitle', $toolbar->renderTitle());
		
		//Render the toolbar and push it into the document buffer
		$this->_document->setBuffer($toolbar->render(), 'modules', 'toolbar');

		parent::display();
	}
}