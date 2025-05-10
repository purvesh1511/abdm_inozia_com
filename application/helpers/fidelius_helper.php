<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

// Include utilities
require_once(APPPATH . 'helpers/utils.php'); 

$fideliusVersion = getFideliusVersion();
$binPath = __DIR__ . "application/helpers/fideliuscli-$fideliusVersion/bin/fidelius-cli"; 

function execFideliusCli($args) {
	$argsStr = join(" ", $args);
	$baseCommand = $GLOBALS['binPath'];
	$fideliusCommand = "$baseCommand $argsStr";
	
	
	$result = shell_exec($fideliusCommand);
	$jsonObj = json_decode($result);
	if ($jsonObj === null && json_last_error() !== JSON_ERROR_NONE) {
		echo "ERROR · execFideliusCli · Command: $argsStr\n$result";
		return;
	}
	return $jsonObj;
}

function getEcdhKeyMaterial() {
	$result = execFideliusCli(["gkm"]);
	return $result;
}

function writeParamsToFile(...$params) {
	$fileContents = join("\n", $params);
	//copy("encdata.txt", "encrypteddata.txt");
	$filePath = "encrypteddata.txt";
	ensureDirExists($filePath);
	$fileHandle = fopen($filePath, "w");
	fwrite($fileHandle, $fileContents);
	file_put_contents($filePath,preg_replace('/\R+/',"\n",file_get_contents($filePath)));
	fclose($fileHandle);
	return $filePath;
}


function removeFileAtPath($filePath) {
	//unlink($filePath);
}

function encryptData($encryptParams){
	$paramsFilePath = writeParamsToFile(
		"encrypt",
		$encryptParams['stringToEncrypt'],
		$encryptParams['senderNonce'],
		$encryptParams['requesterNonce'],
		$encryptParams['senderPrivateKey'],
		$encryptParams['requesterPublicKey']
	);
	$result = execFideliusCli(["-f", $paramsFilePath]);
	removeFileAtPath($paramsFilePath);
	return $result;
}

function decryptData($decryptParams) {
	$paramsFilePath = writeParamsToFile(
		"d",
		$decryptParams['encryptedData'],
		$decryptParams['requesterNonce'],
		$decryptParams['senderNonce'],
		$decryptParams['requesterPrivateKey'],
		$decryptParams['senderPublicKey']
	);
	$result = execFideliusCli(["-f", $paramsFilePath]);
	removeFileAtPath($paramsFilePath);
	return $result;
}

function runExample($stringToEncrypt) {
	$requesterKeyMaterial = (array) getEcdhKeyMaterial();
	$senderKeyMaterial = (array) getEcdhKeyMaterial();
echo json_encode(['requesterKeyMaterial' => $requesterKeyMaterial], JSON_PRETTY_PRINT) . PHP_EOL;
echo '<br><br><br><br>';
echo json_encode(['senderKeyMaterial' => $senderKeyMaterial], JSON_PRETTY_PRINT) . PHP_EOL;


	$encryptionResult = (array) encryptData([
		'stringToEncrypt' => $stringToEncrypt,
		'senderNonce' =>$senderKeyMaterial['nonce'],
		'requesterNonce' => 'L1lGRKIsurZ448HScVtodA5EejlI2SL+PB1//c8keLE=',//$requesterKeyMaterial['nonce'],
		'senderPrivateKey' =>$senderKeyMaterial['privateKey'],
		'requesterPublicKey' =>'BFDS3YbsvCVlYkgvsU64B3IsFN5ITxFVPveWUtf3x/BZRD0hjPcSPqB48TR4RMMb1ZSuDhog7vRMMjbe9qf2qiU='// $requesterKeyMaterial['publicKey'],
	]);
 
	$encryptionWithX509PublicKeyResult = (array) encryptData([
		'stringToEncrypt' => $stringToEncrypt,
		'senderNonce' => $senderKeyMaterial['nonce'],
		'requesterNonce' =>'L1lGRKIsurZ448HScVtodA5EejlI2SL+PB1//c8keLE=',// $requesterKeyMaterial['nonce'],
		'senderPrivateKey' => $senderKeyMaterial['privateKey'],
		'requesterPublicKey' => 'BFDS3YbsvCVlYkgvsU64B3IsFN5ITxFVPveWUtf3x/BZRD0hjPcSPqB48TR4RMMb1ZSuDhog7vRMMjbe9qf2qiU='//$requesterKeyMaterial['x509PublicKey'],
	]);

	echo json_encode([
		'encryptedData' => $encryptionResult, 
		'encryptedDataWithX509PublicKey' => $encryptionWithX509PublicKeyResult
	], JSON_PRETTY_PRINT) . PHP_EOL;
}

