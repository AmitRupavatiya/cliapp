<?php
class GeneralFunction{
	private $service_url = "https://restcountries.eu/rest/v2/";
	private $lanCode = "";
	private $cname = array();
	private $output = array();
	public function webServices($post){
		// Get cURL resource
		$curl = curl_init();
		// Set some options - we are passing in a args by user input
		curl_setopt_array($curl, [
			CURLOPT_URL => $this->service_url.$post,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache"
            ),
		]);
		curl_setopt($curl, CURLOPT_FAILONERROR, true);
		// Send the request & save response to $resp
		$resp = curl_exec($curl);
		// Close request to clear up some resources
		curl_close($curl);
		//return response
		return $resp;
	}
	public function resultExtract($result){
		if(!empty($result)){
			$output = json_decode($result);
		}
		return $output;
	}
	public function getLangCode($result){
		if(!empty($result)){
			$output = $this->resultExtract($result);
			$this->lanCode = $output[0]->languages[0]->iso639_1;
		}
		return $this->lanCode;
	}
	public function getLangCountry($result){
		if(!empty($result)){
			$output = $this->resultExtract($result);
			if(!empty($output)){
				foreach ($output as $op){
					$this->cname[] = $op->name;
				}
			}
		}
		//Combined name with comma separated
		return implode(", ",$this->cname);
	}
}
?>