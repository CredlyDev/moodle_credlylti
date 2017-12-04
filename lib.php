<?php
/**
 * Credly LTI authentication plugin
 *
 * @package   block_credlylti
 * @copyright 2017 Credly {@link http://credly.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined('MOODLE_INTERNAL') || die();


function block_credlylti_extend_navigation_course(navigation_node $parentnode, stdClass $course, context_course $context) {
	global $PAGE;
	$coursenode = $PAGE->navigation->find($course->id, navigation_node::TYPE_COURSE);

	// Insert right before the "Badges" item, or first if "Badges" is disabled.
	$keys = $coursenode->get_children_key_list();
	$beforekey = null;
	$i = array_search('badgesview', $keys);
	if ($i === false and array_key_exists(0, $keys)) {
		$beforekey = $keys[0];
	} else {
		$beforekey = $keys[$i];
	}

	$node = $coursenode->create(get_string('entrypoint', 'block_credlylti'),
		new moodle_url('/blocks/credlylti/credlyframe.php', array('id' => $course->id)),
		navigation_node::TYPE_CUSTOM);
	$coursenode->add_node($node, $beforekey);


	//	$thingnode->make_active();
}
