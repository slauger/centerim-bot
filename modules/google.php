<?php

class CenterBot_Module_Google implements CenterBot_Module
{
	public function search($args, $referer = 'http://localhost/test/', $endpoint = 'web')
	{
	        $url = "http://ajax.googleapis.com/ajax/services/search/".$endpoint;

		if (!array_key_exists('v', $args))
                	$args['v'] = '1.0';

		$url .= '?'.http_build_query($args, '', '&');

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_REFERER, $referer);
		$body = curl_exec($ch);
		curl_close($ch);
		return json_decode($body);
	}

	
	public function execute()
	{
		if (CenterBot::getInstance()->_actionText != '') {
			$result = $this->search(array(
				'q' => CenterBot::getInstance()->_actionText
			));
			echo "Insgesamt mehr als " . $result->responseData->cursor->estimatedResultCount . " Ergebnisse";
			foreach ($result->responseData->results as $array) {
				echo "\n - " . $array->titleNoFormatting . ': ' . $array->url;
			}
		}
	}
}

$bot->registerModule('google', new CenterBot_Module_Google());
