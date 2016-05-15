<?php
$url = "https://www.skrill.com/app/payment.pl";

$post_data = array (  
        "prepare_only" => 1,  
        "amount" => 10,
        "currency" => 'USD',
        "detail1_description" => "Description",
        "detail1_text" => "Text",
        "pay_to_email" => "isoftwareph@yahoo.com" 
    );  


$head = get_web_page($url, $post_data);
echo "<pre>";
print_r($head);
echo "</pre>";

function get_web_page( $url, $post_data )
{
    $options = array(
        CURLOPT_RETURNTRANSFER => true,     // return web page
        CURLOPT_HEADER         => false,    // don't return headers
        CURLOPT_FOLLOWLOCATION => true,     // follow redirects
        CURLOPT_ENCODING       => "",       // handle all encodings
        CURLOPT_USERAGENT      => "spider", // who am i
        CURLOPT_AUTOREFERER    => true,     // set referer on redirect
        CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
        CURLOPT_TIMEOUT        => 120,      // timeout on response
        CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
    );

    $ch      = curl_init( $url );
    curl_setopt_array( $ch, $options );
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
     //we are doing a POST request  
    curl_setopt($ch, CURLOPT_POST, 1);  
     //adding the post variables to the request  
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    $content = curl_exec( $ch );
    $err     = curl_errno( $ch );
    $errmsg  = curl_error( $ch );
    $header  = curl_getinfo( $ch );
    curl_close( $ch );

    $header['errno']   = $err;
    $header['errmsg']  = $errmsg;
    $header['content'] = $content;
    return $header;
}
?>