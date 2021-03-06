<?php
/**
 * @package   com_zoo
 * @author    YOOtheme http://www.yootheme.com
 * @copyright Copyright (C) YOOtheme GmbH
 * @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

// register ElementRepeatable class
App::getInstance('zoo')->loader->register('ElementRepeatable', 'elements:repeatable/repeatable.php');

/*
   Class: ElementText
       The text element class
*/
class ElementAdvpoll extends ElementRepeatable implements iRepeatSubmittable {

	/*
		Function: _hasValue
			Checks if the repeatables element's value is set.

	   Parameters:
			$params - render parameter

		Returns:
			Boolean - true, on success
	*/

			public function hasValue($params = array()) {
				$value = $this->get('value');
				return !empty($value);
			}

			public function render($params = array()) {
				$value = $this->get('value');
				$value = trim($value);
				$value = "{advpoll id='{$value}' view_result='0' width='0' position='center'}";
				$result = $this->app->zoo->triggerContentPlugins($value, array('item_id' => $this->_item->id), 'com_zoo.element.textarea');
				return $result;
			}

	/*
		Function: _getSearchData
			Get repeatable elements search data.

		Returns:
			String - Search data
	*/
	protected function _getSearchData() {
		return $this->get('value', $this->config->get('default'));
	}

	/*
	   Function: _edit
	       Renders the repeatable edit form field.

	   Returns:
	       String - html
	*/
	protected function _edit() {
		return $this->app->html->_('control.text', $this->getControlName('value'), $this->get('value', $this->config->get('default')), 'size="60" maxlength="255"');
	}


	/*
		Function: _renderSubmission
			Renders the element in submission.

	   Parameters:
            $params - AppData submission parameters

		Returns:
			String - html
	*/
	public function _renderSubmission($params = array()) {
        return $this->_edit();
	}



}
