<?php
/**
 * Credly LTI plugin for Moodle
 *
 * @package   block_credlylti
 * @copyright 2017 Credly {@link http://credly.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$plugin->version   = 2017111605; // The current module version (Date: YYYYMMDDXX).
$plugin->requires  = 2017110800; // Requires this Moodle version.
$plugin->component = 'block_credlylti'; // Full name of the plugin (used for diagnostics).
$plugin->cron      = 300;
