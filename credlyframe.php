<?php
/**
 * Host for Credly LTI IFrame
 *
 * @package    block_credlylti
 * @copyright  2017 Credly (http://credly.com)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(dirname(__FILE__) . '/../../config.php');
require_once(dirname(__FILE__) . '/lib.php');
require_once(dirname(__FILE__) . '/../../lib/oauthlib.php');
require_once('credly_oauth.php');

global $PAGE, $OUTPUT, $USER, $DB;

$credly_use_api = false; // Authenticate through the proxied API instead of enterprise.

$courseid = required_param('id', PARAM_INT);
$course = $DB->get_record('course', array('id' => $courseid));
if ($course) {
	$coursecontext = context_course::instance($courseid);
	require_login($course);
}

$PAGE->set_pagelayout('incourse');
//$PAGE->set_url('/block/credlylti/credlyframe.php', array('id' => $courseid));
$title = get_string('entrypoint', 'block_credlylti');
$PAGE->set_title($title);
$PAGE->set_heading($title);
$PAGE->add_body_class('credlylti');

echo $OUTPUT->header();
echo $OUTPUT->heading($strtitle, 2);

if ($course) {
	// Authenticate with Credly
	$oauth = new credly_oauth($credly_use_api);
	$oauth_result = $oauth->get_credly_redirect($USER, $course);

	if (!$oauth_result) {
		echo 'Failed to authenticate';
	}
	else {
		if ($credly_use_api) {
			echo '<div>Oauth result:</div>';
			echo "<div>$oauth_result</div>";
		}
		else {
			//$url = 'https://' . get_config('block_credlylti', 'enterpriseurl') . $oauth_result->url;
			echo '<iframe src="' . $oauth_result . '"></iframe>';
		}
	}
}
else {
	print_error('invalidcourseid');
}

echo $OUTPUT->footer();



/**
 * Get the IMS role parameter. This may no longer be necessary once this plugin is integrated as a proper LTI source.
 *
 * @param $user
 * @param $courseid
 * @return string
 */
function get_ims_role($user, $courseid) {
	$roles = array();

	$context = context_course::instance($courseid);

	if (has_capability('moodle/course:manageactivities', $context, $user)) {
		array_push($roles, 'Instructor');
	} else {
		array_push($roles, 'Learner');
	}

	if (is_siteadmin($user)) {
		$roles = array_diff($roles, array('Learner'));
		array_push($roles, 'urn:lti:sysrole:ims/lis/Administrator');
		array_push($roles, 'Administrator');
	}

	return join(',', $roles);
}
