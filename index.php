<?php
//https://github.com/AmitRupavatiya/cliapp.git
include "generalfunction.php";
$GeneralFunction = new GeneralFunction;
if(isset($_REQUEST) && !empty($_REQUEST)){
	$params = $_REQUEST['c'];
	if(!empty($params)){
		if (preg_match('/[^A-Za-z ]/', $params)){
			echo "Country Name should be string only";
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
	}else{
		echo "Please enter Country Name";
	}
}else{
	echo "Please enter Country Name";
}
?>