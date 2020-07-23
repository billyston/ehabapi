<?php

/**
 * @param $Appointment
 * @throws Exception
 */
function sendSMS ( $Appointment )
{
    $post =
    [
        'From' => 'Smart HCS',
        'To' => '0244637602',
        'Content' => "REMINDER: Your next service appointment is on date at time. If you can't make this, please text Cancel or Reschedule",
        'registeredDelivery' => True
    ];


    $cURLConnection = curl_init('https://api.hubtel.com/v1/messages');

    curl_setopt( $cURLConnection, CURLOPT_POSTFIELDS, $post );
    curl_setopt( $cURLConnection, CURLOPT_RETURNTRANSFER, true );
    curl_setopt( $cURLConnection, CURLOPT_USERPWD, 'fbylqrgr' . ":" . 'xlilsenv' );
    curl_setopt( $cURLConnection, CURLOPT_HTTPHEADER, array( 'header: Content-Type: application/json' ) );
    $response = curl_exec( $cURLConnection );

    if( curl_errno( $cURLConnection ) )
    {
        throw new Exception( curl_error( $cURLConnection ));
    }
    echo $response;
}
