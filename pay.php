<?php
$payflow_query = "USER[8]=tmaitest" .
"&VENDOR[8]=tmaitest".
"&PARTNER[6]=PayPal".
"&PWD[30]=NMqzyJS9toSTioRZsFu3HMJN3ZAXDB".
"&TENDER[1]=C".
"&TRXTYPE[1]=R".
"&ACCT[16]=4012888888881881".
"&CVV2[3]=617".
"&EXPDATE[4]=0214".
"&ACCTTYPE[4]=Visa".
"&AMT[1]=1".
"&CURRENCY[3]=USD".
"&FIRSTNAME[3]=Bil".
"&LASTNAME[3]=Bob".
"&STREET[7]=asd 123".
"&CITY[6]=Berlin".
"&STATE[2]=FL".
"&ZIP[5]=12345".
"&COUNTRY[2]=US".
"&EMAIL[16]=pasd@walger.name".
"&CUSTIP[14]=79.205.229.163".
"&COMMENT1[0]=".
"&INVNUM[32]=7e7c99567fa207ce58891bac6daa5566".
"&ORDERDESC[45]=Online+Contribution%3A+Payflow+pro+recur+test".
"&VERBOSITY[6]=MEDIUM".
"&BILLTOCOUNTRY[2]=US".
"&OPTIONALTRX[1]=S".
"&OPTIONALTRXAMT[1]=1".
"&ACTION[1]=A".
"&PROFILENAME[19]=RegularContribution".
"&TERM[1]=3".
"&START[8]=04252013".
"&PAYPERIOD[4]=MONT";

$submiturl = 'https://pilot-payflowpro.paypal.com';
// get data ready for API
$user_agent = $_SERVER['HTTP_USER_AGENT'];
// Here's your custom headers; adjust appropriately for your setup:
$headers[] = "Content-Type: text/namevalue";
//or text/xml if using XMLPay.

//NOTE: we habe no $data
//$headers[] = "Content-Length : " . strlen($data);

// Length of data to be passed
// Here the server timeout value is set to 45, but notice
// below in the cURL section, the timeout
// for cURL is 90 seconds.  You want to make sure the server
// timeout is less, then the connection.
$headers[] = "X-VPS-Timeout: 45";
// random unique number  - the transaction is retried using this transaction ID
// in this function but if that doesn't work and it is re- submitted
// it is treated as a new attempt. PayflowPro doesn't allow
// you to change details (e.g. card no) when you re-submit
// you can only try the same details
$headers[] = "X-VPS-Request-ID: " . rand(1, 1000000000);
// optional header field
$headers[] = "X-VPS-VIT-Integration-Product: CiviCRM";
// other Optional Headers.  If used adjust as necessary.
// Name of your OS
//$headers[] = "X-VPS-VIT-OS-Name: Linux";
// OS Version
//$headers[] = "X-VPS-VIT-OS-Version: RHEL 4";
// What you are using
//$headers[] = "X-VPS-VIT-Client-Type: PHP/cURL";
// For your info
//$headers[] = "X-VPS-VIT-Client-Version: 0.01";
// For your info
//$headers[] = "X-VPS-VIT-Client-Architecture: x86";
// Application version
//$headers[] = "X-VPS-VIT-Integration-Version: 0.01";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $submiturl);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
curl_setopt($ch, CURLOPT_HEADER, 1);
// tells curl to include headers in response
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// return into a variable
curl_setopt($ch, CURLOPT_TIMEOUT, 90);
// times out after 90 secs
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, CRM_Core_BAO_Setting::getItem(CRM_Core_BAO_Setting::SYSTEM_PREFERENCES_NAME, 'verifySSL'));
// this line makes it work under https
curl_setopt($ch, CURLOPT_POSTFIELDS, $payflow_query);
//adding POST data
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
//verifies ssl certificate
curl_setopt($ch, CURLOPT_FORBID_REUSE, TRUE);
//forces closure of connection when done
curl_setopt($ch, CURLOPT_POST, 1);
//data sent as POST

// Try to submit the transaction up to 3 times with 5 second delay.  This can be used
// in case of network issues.  The idea here is since you are posting via HTTPS there
// could be general network issues, so try a few times before you tell customer there
// is an issue.

$i = 1;
while ($i++ <= 3) {
    $responseData = curl_exec($ch);
    $responseHeaders = curl_getinfo($ch);
    if ($responseHeaders['http_code'] != 200) {
    // Let's wait 5 seconds to see if its a temporary network issue.
    sleep(5);
    }
    elseif ($responseHeaders['http_code'] == 200) {
    // we got a good response, drop out of loop.
    break;
    }
}

  /*
     * Transaction submitted -
     * See if we had a curl error - if so tell 'em and bail out
     *
     * NOTE: curl_error does not return a logical value (see its documentation), but
     *       a string, which is empty when there was no error.
     */

    if ((curl_errno($ch) > 0) || (strlen(curl_error($ch)) > 0)) {
      curl_close($ch);
      $errorNum = curl_errno($ch);
      $errorDesc = curl_error($ch);

      //Paranoia - in the unlikley event that 'curl' errno fails
      if ($errorNum == 0)
        $errorNum = 9005;

      // Paranoia - in the unlikley event that 'curl' error fails
      if (strlen($errorDesc) == 0)
      $errorDesc = "Connection to payment gateway failed";
        if ($errorNum = 60) {
          die($errorNum . "Curl error - " . $errorDesc .
            " Try this link for more information http://curl.haxx.se/d
                                         ocs/sslcerts.html");
      }

      die("Curl error - $errorDesc processor response = $processorResponse");
    }

    /*
     * If null data returned - tell 'em and bail out
     *
     * NOTE: You will not necessarily get a string back, if the request failed for
     *       any reason, the return value will be the boolean false.
     */

    if (($responseData === FALSE) || (strlen($responseData) == 0)) {
      curl_close($ch);
      die("Error: Connection to payment gateway failed - no data
                                           returned. Gateway url set to $submiturl");
    }

    /*
     * If gateway returned no data - tell 'em and bail out
     */

    if (empty($responseData)) {
      curl_close($ch);
     die("Error: No data returned from payment gateway.");
    }

    /*
     * Success so far - close the curl and check the data
     */

    curl_close($ch);
    die($responseData);
?>