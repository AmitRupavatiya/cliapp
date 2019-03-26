<?php
//https://github.com/AmitRupavatiya/cliapp.git
include "generalfunction.php";
$GeneralFunction = new GeneralFunction;
if(isset($_REQUEST) && !empty($_REQUEST)){
	$params = $_REQUEST['c'];
	if(!empty($params)){
		if (preg_match('/[^A-Za-z ,]/', $params)){
			echo "Country Name should be string only";
		}else{
			$params = explode(",",$_REQUEST['c']);
			if(count($params) > 1){
				$result1 = $GeneralFunction->webServices("name/".$params[0]."?fullText=true");
				if(!empty($result1)){
					$lanCode1 = $GeneralFunction->getLangCode($result1);
				}
				$result2 = $GeneralFunction->webServices("name/".$params[1]."?fullText=true");
				if(!empty($result2)){
					$lanCode2 = $GeneralFunction->getLangCode($result2);
				}
				if(strcasecmp($lanCode1,$lanCode2) == 0){
					echo ucfirst($params[0])." and ".ucfirst($params[1]). " speak the same language";
				}else{
					echo ucfirst($params[0])." and ".ucfirst($params[1]). " do not speak the same language";
				}
			}else{
				$result = $GeneralFunction->webServices("name/".$params."?fullText=true");
				if(!empty($result)){
					$lanCode = $GeneralFunction->getLangCode($result);
					if(!empty($lanCode)){
						echo "Country language code: ".$lanCode."<br />";
						$results = $GeneralFunction->webServices("lang/".$lanCode);
						if(!empty($results)){
							$langCountry = $GeneralFunction->getLangCountry($results);
							if(!empty($langCountry)){
								echo ucfirst($params)." speaks same language with this countries: " .$langCountry;
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