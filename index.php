<?php
// https://phpqrcode.sourceforge.net/index.php#demo
// https://qr-platba.cz/pro-vyvojare/specifikace-formatu/
// https://www.cnb.cz/cs/platebni-styk/iban/iban-mezinarodni-format-cisla-uctu/
// https://www.cnb.cz/export/sites/cnb/cs/platebni-styk/.galleries/pravni_predpisy/download/vyhl_169_2011.pdf

define("_nl","<br />\n");
include "./phpqrcode/qrlib.php";

$ook = true;

function verifyModulo($accPart){
	$scales = [6,3,7,9,10,5,8,4,2,1];
}

if($_POST){
	$accPrefix = $_POST["prefix"] ? $_POST["prefix"] : "";
	$accNumber = $_POST["number"] ? $_POST["number"] : "";
	if($accNumber === ""){
		$ook=false;
	}
	if(strlen($accNumber) > 10){
		$ook=false;
	}	
}

if(!$ook){
	echo "<form>";
	echo "acc prefix<input name='prefix' value=''>"._nl;
	echo "acc number<input name='number' value=''>"._nl;
	echo "<button>submit</button>";
	echo "</form>";
	exit();
} 

$codeContents = "prdel";

// generating
$text = QRcode::text($codeContents);

// displaying
echo '<pre>';
	echo join("\n", $text);
echo '</pre>';

?>