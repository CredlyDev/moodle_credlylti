<?php
/**
 * Credly LTI plugin for Moodle
 *
 * @package   block_credlylti
 * @copyright 2017 Credly {@link http://credly.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once($CFG->libdir.'/filelib.php');
require_once(dirname(__FILE__) . '/../../lib/oauthlib.php');

class credly_oauth extends oauth_helper {
	protected $oauthRoot;

	/**
	 * credly_oauth constructor.
	 *
	 * @param bool $credly_use_api
	 */
	function __construct($credly_use_api) {
		if ($credly_use_api) {
			$this->oauthRoot = 'https://' . get_config('block_credlylti', 'enterpriseurl') . '/v1.1/cle_auth/authorize';
		}
		else {
			$this->oauthRoot = 'https://' . get_config('block_credlylti', 'enterpriseurl') . '/auth/lti';
		}

		parent::__construct([
			'api_root' => $this->oauthRoot,
			'oauth_consumer_key' => get_config('block_credlylti', 'apikey'),
			'oauth_consumer_secret' => get_config('block_credlylti', 'apisecret')
		]);

		$this->http = new curl_intercept(array('debug'=>false));
	}

	public function get_credly_redirect($user, $course) {
		$oauth_params = [
			'user_id' => $user->id,
			'integration_id' => get_config('block_credlylti', 'integrationid'),
			'tool_consumer_info_product_family_code' => 'cle',
			'context_id' => $course->id,
			'context_label' => $course->name,
			'roles' => get_ims_role($user, $course->id),
			'lis_person_name_given' => $user->firstname,
			'lis_person_name_family' => $user->lastname,
			'lis_person_name_full' => $user->firstname . ' ' . $user->lastname,
			'lis_person_contact_email_primary' => $user->email
		];

		$result = parent::request('POST', $this->oauthRoot, $oauth_params);
		return $this->http->redirect_url;
	}
}


/**
 * Override functionality in the curl class, to save the redirect header. This allows the caller to set the iframe source.
 *
 * @param array|string $url
 * @param string $params
 * @param array $options
 * @return bool|void
 */
class curl_intercept extends curl {
	public $redirect_url;


	public function post($url, $params = '', $options = array()) {
		$result = parent::post($url, $params, array_merge($options, ['CURLOPT_FOLLOWLOCATION' => false]));
		foreach ($this->get_raw_response() as $line) {
			$parts = preg_split('/:\s*/', $line, 2);
			if ($parts[0] == 'Location') {
				$this->redirect_url = $parts[1];
				break;
			}
		}
		return $result;
	}
}
