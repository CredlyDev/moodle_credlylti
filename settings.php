<?php
/**
 * Credly LTI plugin for Moodle
 *
 * @package   block_credlylti
 * @copyright 2017 Credly {@link http://credly.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

if ($ADMIN->fulltree) {
	$settings->add(new admin_setting_configtext('block_credlylti/apikey',
		get_string('apikey', 'block_credlylti'),
		get_string('apikeydesc', 'block_credlylti'),
		'',
		PARAM_RAW_TRIMMED));
	$settings->add(new admin_setting_configtext('block_credlylti/apisecret',
		get_string('apisecret', 'block_credlylti'),
		get_string('apisecretdesc', 'block_credlylti'),
		'',
		PARAM_RAW_TRIMMED));
	$settings->add(new admin_setting_configtext('block_credlylti/enterpriseurl',
		get_string('enterpriseurl', 'block_credlylti'),
		get_string('enterpriseurldesc', 'block_credlylti'),
		'credly.com',
		PARAM_HOST));
	$settings->add(new admin_setting_configtext('block_credlylti/integrationid',
		get_string('integrationid', 'block_credlylti'),
		get_string('integrationiddesc', 'block_credlylti'),
		'',
		PARAM_HOST));
}
