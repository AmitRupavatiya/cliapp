<?php
//https://github.com/AmitRupavatiya/cliapp.git
include "generalfunction.php";
$GeneralFunction = new GeneralFunction;
//if(isset($_REQUEST) && !empty($_REQUEST)){
if(isset($argv) && !empty($argv[1])){
	//$params = $_REQUEST['c'];
	$params = $argv[1];
	if(!empty($params)){
		if (preg_match('/[^A-Za-z ,]/', $params)){
			echo "Country Name should be string only";
		}else{
			//$params = explode(",",$_REQUEST['c']);
			$params = $argv;
			if(count($params) > 2){
				$result1 = $GeneralFunction->webServices("name/".$params[1]."?fullText=true");
				if(!empty($result1)){
					$lanCode1 = $GeneralFunction->getLangCode($result1);
				}
				$result2 = $GeneralFunction->webServices("name/".$params[2]."?fullText=true");
				if(!empty($result2)){
					$lanCode2 = $GeneralFunction->getLangCode($result2);
				}
				if(strcasecmp($lanCode1,$lanCode2) == 0){
					echo ucfirst($params[1])." and ".ucfirst($params[2]). " speak the same language";
				}else{
					echo ucfirst($params[1])." and ".ucfirst($params[2]). " do not speak the same language";
				}
			}else{
				$result = $GeneralFunction->webServices("name/".$params[1]."?fullText=true");
				if(!empty($result)){
					$lanCode = $GeneralFunction->getLangCode($result);
					if(!empty($lanCode)){
						echo "Country language code: ".$lanCode."\r\n";
						$results = $GeneralFunction->webServices("lang/".$lanCode);
						if(!empty($results)){
							$langCountry = $GeneralFunction->getLangCountry($results);
							if(!empty($langCountry)){
								echo ucfirst($params[1])." speaks same language with this countries: " .$langCountry;
							}
						}
					}
				}
			}
		}
	}else{
		echo "Please enter Country Name";
	}
}else{
	echo "Please enter Country Name";
}
?>