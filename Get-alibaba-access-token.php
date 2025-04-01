<?php



$appKey = '';

$appSecret = '';

$code = '';

$signName = 'sha256';

$apiName = '/auth/token/create';

$baseUrl = 'https://open-api.alibaba.com/rest';

$timestamp = round(microtime(true) * 1000);



#基础参数

$commonParam = [

'sign_method' => $signName,

'app_key' => $appKey,

'timestamp' =>$timestamp,//'1737096118246',

];

#api参数

$queryParam = [

'code' => $code,

];

function signApiRequest($apiName, $signParams, $appSecret, $sign) {

ksort(array: $signParams);

$signString = $apiName; // Include the API path

foreach ($signParams as $key => $value) {

$signString .= $key . $value; // Concatenate key and value

}

echo $signString . PHP_EOL;



$sign = strtoupper(hmacSHA256($signString, $appSecret, $sign));

echo $sign . PHP_EOL;



return $sign;

}



function hmacSHA256($data, $key, $sign) {

// 计算HMAC

$hmacResult = hash_hmac($sign, $data, $key, binary: true);



// 转换为十六进制字符串

return bin2hex($hmacResult);

}

$params = array_merge($commonParam, $queryParam);



$signStr = signApiRequest($apiName, $params, $appSecret, $signName);



echo $signStr . PHP_EOL;

$commonParam['sign'] = $signStr; // 以键值对的方式添加新参数

$queryString = http_build_query($commonParam);

echo $queryString . PHP_EOL;

$finalUrl = $baseUrl.$apiName.'?' . $queryString;



echo PHP_EOL;



echo $finalUrl . PHP_EOL;

$headers = [

'Accept-Encoding: gzip'

];

$curl = curl_init();



curl_setopt_array($curl, array(

CURLOPT_URL => $finalUrl,

CURLOPT_RETURNTRANSFER => true,

CURLOPT_ENCODING => '',

CURLOPT_MAXREDIRS => 10,

CURLOPT_TIMEOUT => 0,

CURLOPT_FOLLOWLOCATION => true,

CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,

CURLOPT_CUSTOMREQUEST => 'POST',

CURLOPT_POSTFIELDS => http_build_query($queryParam),

CURLOPT_HTTPHEADER => array(

'Accept-Encoding: gzip',

'Content-Type: application/x-www-form-urlencoded'

),

));



$response = curl_exec($curl);

curl_close($curl);

echo $response;

?>

这个是php实现的获取授权的代码

