<?php namespace Acme\Articles\WordAI;

class WordAI {

	protected static $console_mode =	false;

	/**
	 * @var string  $text  The text to spin
	 */
	protected $text = NULL;

	/**
	 * @var string  $spintax  The returned spintax
	 */
	protected $spintax = NULL;

	/**
	 * @var string  $uniqueness  The unique % of the returned spintax
	 */
	protected $uniqueness = NULL;

	/**
	 * @var string  $version  The version of the spinner to use. Accepts: Regular, Turing
	 */
	protected $version = 'Regular';

	/**
	 * Quality of the spin.
	 *
	 * Turing:	Very Readable, Readable, Regular, Unique, Very Unique
	 * Regular:	Any number from 1-100
	 *
	 * @var mixed  $quality  The unique % of the returned spintax
	 */
	protected $quality = 'Regular';

	/**
	 * @var string  $paragraph  Paragraph spinning settings
	 */
	protected $paragraph = 0;

	/**
	 * @var string  $sentence  Sentence spinning settings
	 */
	protected $sentence = 1;

	/**
	 * @var string  $email  Email address for your account
	 */
	protected $email = NULL;

	/**
	 * @var string  $hash  API Hash key for your account
	 */
	protected $hash = NULL;

	/**
	 * @var string  $errors  If there are errors, they will be here
	 */
	protected $errors = [];

	/**
	 * Instantiate the object
	 *
	 * @param string $email
	 * @param string $hash
	 */
	function __construct($email = NULL, $hash = NULL)
	{
		// Set the email & hash
		if(isset($email) && isset($hash)){
			$this->email = $email;
			$this->hash = $hash;
		}
	}

	/**
	 * Spin the text
	 *
	 * @return string
	 */
	public function Spin($text = NULL, $version = NULL, $quality = NULL){

		$this->errors = array();

		// Grab settings
		$text = (!isset($text)) ? $this->text : $text;
		$text = stripslashes(nl2br($text));
		$this->version = (!isset($version)) ? $this->version : $version;
		$this->quality = (!isset($quality)) ? $this->quality : $quality;

		// The correct quality settings to base off of
		$quality_regs =	array(
				'Extremely Unique' 			=> '10',
				'Very Unique' 				=> '20',
				'Unique' 					=> '35',
				'Regular'					=> '50',
				'Reable' 					=> '65',
				'Very Readable' 			=> '80',
				'Extremely Readable' 		=> '100'
			);

		// Regular API
		if($this->version == 'Regular'){
			// // API URL
			$service_url = 'http://wordai.com/users/regular-api.php';

			// Sets the quality, matched to the words
			foreach($quality_regs AS $quality_reg => $val){
				if($this->quality == $quality_reg){
					$quality = $val;
				}
			}

			// Make sure the quality is within the limits
			$quality = (!is_numeric($quality) || $quality < 1 || $quality > 100) ? '50' : $quality;

		// Turing API
		} elseif($this->version == 'Turing'){
			// API URL
			$service_url = 'http://wordai.com/users/turing-api.php';

			// Check quality
			$quality = (!in_array($quality, $quality_regs)) ? 'Regular' : $quality;
		} else {
			$this->errors[] = 'No WordAI version chosen!';
		}

		// Check Email & Hash
		if(!isset($this->email) || !isset($this->hash)){
			$this->errors[] = 'Email and/or hash isn\'t set!';
		}

		if(count($this->errors == 0)){

			self::add_debug_msg(" - Version set to $service_url");
			self::add_debug_msg(" - Quality set to $quality");
			self::add_debug_msg(" - Email set to ".$this->email);
			self::add_debug_msg(" - Hash set to ".$this->hash);
			self::add_debug_msg(" - Sentence spinning set to ".$this->sentence);
			self::add_debug_msg(" - Paragraph spinning set to ".$this->paragraph);

			$fields = array(
				's' =>			urlencode($text),
				'quality' =>	urlencode($quality),
				'sentence' =>	urlencode($this->sentence),
				'paragraph' =>	urlencode($this->paragraph),
				'email' =>		urlencode($this->email),
				'hash' =>		urlencode($this->hash),
				'output' =>		urlencode('json')
				);

			//url-ify the data for the POST
			foreach($fields as $key=>$value){
				$fields_string .= $key.'='.$value.'&';
			}
			rtrim($fields_string, '&');

			// Set the Curl Options
			$options = array(
				CURLOPT_POST => count($fields),
				CURLOPT_POSTFIELDS => $fields_string,
				CURLOPT_TIMEOUT => 600, // WordAI is slow, so 10 minutes should be enough
				CURLOPT_CONNECTTIMEOUT => 10
				);

			self::add_debug_msg(" # Sending text to WordAI for processing...");

			if($data = CurlRequest($service_url, $options)){

				$result_body = html_entity_decode($data);
				$result_json = json_decode($result_body, true);

				if($result_json['status'] == 'Success'){
					self::add_debug_msg("## Successful response!");
					$this->spintax = $result_json['text'];
					$this->uniqueness = $result_json['uniqueness'];
				} else {
					$this->errors[] = $result_json['error'];
					self::add_debug_msg("## Error response! ".$result_json['error']);
				}

				$output = $result_json;

			} else {
				$this->errors[] = 'Curl error';
			}

		}

		if(count($this->errors) > 0){
			self::add_debug_msg("## Errors have been found!");
			self::add_debug_msg("===============================");
			print_r($this->errors);
			self::add_debug_msg("===============================");
			return false;
		} else {
			self::add_debug_msg("## Success!");
			return $output;
		}

		// Return false if nothing happened
		return false;
	}
}