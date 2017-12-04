<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

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
