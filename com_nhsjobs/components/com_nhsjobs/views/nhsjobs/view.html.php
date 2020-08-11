<?php
/**
 * @package    COM_NHSJOBS
 *
 * @author     NHS South, Central and West <webteam.scwcsu@nhs.net>
 * @copyright  Copyright (C) 2019 NHS South Central and West. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @link       https://www.scwcsu.nhs.uk
 */

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\View\HtmlView;

defined('_JEXEC') or die;

/**
 * Nhsjobs view.
 *
 * @package   COM_NHSJOBS
 * @since     1.0.0
 */
class NhsjobsViewNhsjobs extends HtmlView
{

    public function display($tpl = null)
	{
		$this->jobsmodel =$this->getModel();
		
		$app		= JFactory::getApplication();
		$params		= $app->getParams();
		$this->orgs = $params->get("orgs");
		$this->internal = $params->get("internal");
		
		parent::display($tpl);
	}

}

