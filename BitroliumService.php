<?php



//Get Token From Bitrolium Serivce for Authentication
function GetToken($apikey)
{
  //  global $apikey;
    $curl = curl_init();


    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://www.bitrolium.net/api/app/Gettoken?ApiKey=" . $apikey,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "ApiKey=" . $apikey,
        CURLOPT_HTTPHEADER => array(
            "Cache-Control: no-cache",
            "Content-Type: application/x-www-form-urlencoded",

        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        return "Error #:" . $err;
    } else {
        return $token = trim($response, '"');
    }
}


//Create Transaction ( address = recepient, Amount = birolium , Desc = Discription
// Response
// {"Success":true or false ,"Message":null,"Error":null,"TransactionIds" }

function CreateTransaction($token, $Address, $Amount, $Desc,$passphrase,$secondPassphrase)
{
    global $token;
    global $pp;
    global $sp;
    $pp=str_replace(" ","%20",$pp);
    $sp=str_replace(" ","%20",$sp);
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://www.bitrolium.net/api/app/CreateTransaction?recepient=" . $Address . "&amount=" . $Amount . "&description=" . $Desc . "&passphrase=" . $passphrase . "&secondPassphrase=" . $secondPassphrase,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "recepient=" . $Address . "&amount=" . $Amount . "&description=" . $Desc . "&passphrase=" . $passphrase . "&secondPassphrase=" . $secondPassphrase,
        CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer " . $token,
            "Cache-Control: no-cache",
            "Content-Type: multipart/form-data",

        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        return "cURL Error #:" . $err;
    } else {
        return $response;
    }

}



function CreateAccountAutoPassword($token)
{

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://bitrolium.net/api/app/CreateAccountWithPassPhrase",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer " . $token,
            "Cache-Control: no-cache",

        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        return "cURL Error #:" . $err;
    } else {
        return $response . "<br />";
    }
}

function CreateAccount($token, $password)
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://bitrolium.net/api/app/CreateAccount/" . $password,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer " . $token,
            "Cache-Control: no-cache",

        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        return "cURL Error #:" . $err;
    } else {
        $result = str_replace('"','',$response);
        return $result;
    }

}

function GetBalance($token, $address)
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://bitrolium.net/api/app/GetBalance/" . $address,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer " . $token,
            "Cache-Control: no-cache",

        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        return "cURL Error #:" . $err;
    } else {
        return $response;
    }

}


function GetInvoice($token, $invoiceNumber)
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://bitrolium.net/api/app/getinvoice/" . $invoiceNumber,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer " . $token,
            "Cache-Control: no-cache",

        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        return "cURL Error #:" . $err;
    } else {
        return $response;
    }

}

function GetInvoiceBySerial($token, $serial)
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://bitrolium.net/api/app/GetInvoiceBySerial/" . $serial,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer " . $token,
            "Cache-Control: no-cache",

        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        return "cURL Error #:" . $err;
    } else {
        return $response;
    }

}

function GetTransactions($token, $address)
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://bitrolium.net/api/app/GetTransaction/" . $address,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer " . $token,
            "Cache-Control: no-cache",

        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
      return "cURL Error #:" . $err;
    } else {

        $responseDecode = json_decode($response, true);
        $arr_transactions = array();
        $arr_transactions = $responseDecode['Transactions'];
       return $arr_transactions;
    }

}

?>