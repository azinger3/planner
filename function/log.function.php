<?php

$data = "{";
$data .= sprintf("\"ApplicationID\":\"%s\",",              '2');
$data .= sprintf("\"RemoteAddress\":\"%s\",",              $_SERVER['REMOTE_ADDR']);
$data .= sprintf("\"RemoteHost\":\"%s\",",                 $_SERVER['REMOTE_HOST']);
$data .= sprintf("\"RemotePort\":\"%s\",",                 $_SERVER['REMOTE_PORT']);
$data .= sprintf("\"RemoteUser\":\"%s\",",                 $_SERVER['REMOTE_USER']);
$data .= sprintf("\"RemoteUserRedirect\":\"%s\",",         $_SERVER['REDIRECT_REMOTE_USER']);
$data .= sprintf("\"RequestMethod\":\"%s\",",              $_SERVER['REQUEST_METHOD']);
$data .= sprintf("\"RequestTime\":\"%s\",",                $_SERVER['REQUEST_TIME']);
$data .= sprintf("\"HTTPAcceptCharacterSet\":\"%s\",",     $_SERVER['HTTP_ACCEPT_CHARSET']);
$data .= sprintf("\"HTTPAcceptEncoding\":\"%s\",",         $_SERVER['HTTP_ACCEPT_ENCODING']);
$data .= sprintf("\"HTTPAcceptHeader\":\"%s\",",           $_SERVER['HTTP_ACCEPT']);
$data .= sprintf("\"HTTPAcceptLanguage\":\"%s\",",         $_SERVER['HTTP_ACCEPT_LANGUAGE']);
$data .= sprintf("\"HTTPConnection\":\"%s\",",             $_SERVER['HTTP_CONNECTION']);
$data .= sprintf("\"HTTPHost\":\"%s\",",                   $_SERVER['HTTP_HOST']);
$data .= sprintf("\"HTTPReferer\":\"%s\",",                $_SERVER['HTTP_REFERER']);
$data .= sprintf("\"HTTPSecure\":\"%s\",",                 $_SERVER['HTTPS']);
$data .= sprintf("\"HTTPUserAgent\":\"%s\",",              $_SERVER['HTTP_USER_AGENT']);
$data .= sprintf("\"AuthenticationPassword\":\"%s\",",     $_SERVER['PHP_AUTH_PW']);
$data .= sprintf("\"AuthenticationType\":\"%s\",",         $_SERVER['AUTH_TYPE']);
$data .= sprintf("\"AuthenticationUser\":\"%s\",",         $_SERVER['PHP_AUTH_USER']);
$data .= sprintf("\"ServerAddress\":\"%s\",",              $_SERVER['SERVER_ADDR']);
$data .= sprintf("\"ServerAdministrator\":\"%s\",",        $_SERVER['SERVER_ADMIN']);
$data .= sprintf("\"ServerName\":\"%s\",",                 $_SERVER['SERVER_NAME']);
$data .= sprintf("\"ServerPort\":\"%s\",",                 $_SERVER['SERVER_PORT']);
$data .= sprintf("\"ServerProtocol\":\"%s\",",             $_SERVER['SERVER_PROTOCOL']);
$data .= sprintf("\"ServerSignature\":\"%s\",",            $_SERVER['SERVER_SIGNATURE']);
$data .= sprintf("\"ServerSoftware\":\"%s\",",             $_SERVER['SERVER_SOFTWARE']);
$data .= sprintf("\"ScriptFileName\":\"%s\",",             $_SERVER['SCRIPT_FILENAME']);
$data .= sprintf("\"ScriptName\":\"%s\",",                 $_SERVER['SCRIPT_NAME']);
$data .= sprintf("\"ScriptPathTranslated\":\"%s\",",       $_SERVER['PATH_TRANSLATED']);
$data .= sprintf("\"ScriptURI\":\"%s\",",                  $_SERVER['REQUEST_URI']);
$data .= sprintf("\"PathInformation\":\"%s\",",            $_SERVER['PATH_INFO']);
$data .= sprintf("\"PathInformationOriginal\":\"%s\",",    $_SERVER['ORIG_PATH_INFO']);
$data .= sprintf("\"DocumentRoot\":\"%s\",",               $_SERVER['DOCUMENT_ROOT']);
$data .= sprintf("\"GatewayInterface\":\"%s\",",           $_SERVER['GATEWAY_INTERFACE']);
$data .= sprintf("\"PHPSelf\":\"%s\",",                    $_SERVER['PHP_SELF']);
$data .= sprintf("\"QueryString\":\"%s\"",                $_SERVER['QUERY_STRING']);
$data .= "}";

try
{
    // Setup cURL
    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL, "http://api.jordanandrobert.com/application/log");  // Set the url
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");	                                // Set Method
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);	                                    // Set body request
    curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));    // Set header
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);                                   // Enable return response

    // Execute and capture response
    $response  = curl_exec($curl);
    
    // Error Handling
    if ($error = curl_error($curl)) {
        throw new Exception($error);
    }

    // Close cURL
    curl_close($curl);
} 
catch (Exception $e) 
{
    return "";
}