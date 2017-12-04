<?php

/**
 * A block that provides integration with Credly Open Credit API
 *
 * @package    block_credlylti
 * @copyright  2014-2017 Deds Castillo, MM Development Services (http://michaelmino.com)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined('MOODLE_INTERNAL') || die();

require_once(dirname(__FILE__).'/lib.php');

/**
 * The main class for the block.
 *
 * @package    block_credlylti
 * @copyright  2014-2017 Deds Castillo, MM Development Services (http://michaelmino.com)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class block_credlylti extends block_base {
	/**
	 * Block initialization.
	 *
	 */
	public function init() {
		$this->title = get_string('modulename', 'block_credlylti');
	}
	/**
	 * Allow the block to have multiple instances per context.
	 *
	 * @return bool
	 */
	public function instance_allow_multiple() {
		return false;
	}
	/**
	 * Allow the block to have a configuration page
	 *
	 * @return boolean
	 */
	public function has_config() {
		return true;
	}
	/**
	 * Locations where block can be displayed
	 *
	 * @return array the locations and whether to allow display
	 */
	public function applicable_formats() {
		return array(
			'admin' => false,
			'site-index' => true,
			'course-view' => true,
			'mod' => false,
			'my' => true
		);
	}
	/**
	 * Allow to configure per instance
	 *
	 * @return boolean
	 */
	public function instance_allow_config() {
		return true;
	}
	/**
	 * The script to run for this block on cron execution
	 *
	 * @return boolean
	 */
	public function cron() {
		global $DB;
		return true;
	}
	/**
	 * Return contents of credly block
	 *
	 * @return stdClass contents of block
	 */
	public function get_content() {
		error_log('get_content');
		global $CFG;
		if ($this->content !== null) {
			return $this->content;
		}
		$this->content         = new stdClass;
		$this->content->text   = 'Not working';
		return $this->content;
	}
}
