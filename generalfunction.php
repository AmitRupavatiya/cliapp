<?php
class GeneralFunction{
	private $service_url = "https://restcountries.eu/rest/v2/";
	private $lanCode = "";
	private $cname = array();
	public function webServices($post){
		// Get cURL resource
		$curl = curl_init();
		// Set some options - we are passing in a args by user input
		curl_setopt_array($curl, [
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL => $this->service_url.$post,
		]);
		// Send the request & save response to $resp
		$resp = curl_exec($curl);
		// Close request to clear up some resources
		curl_close($curl);
		//return response
		return $resp;
	}
	public function getLangCode($result){
		if(!empty($result)){
			$output = json_decode($result);
			$this->lanCode = $output[0]->languages[0]->iso639_1;
		}
		return $this->lanCode;
	}
	public function getLangCountry($result){
		if(!empty($result)){
			$output = json_decode($result);
			if(!empty($output)){
				foreach ($output as $op){
					$this->cname[] = $op->name;
				}
			}
		}
		return implode(", ",$this->cname);
	}
}
?>