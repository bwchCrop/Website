<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('my_token')) {
    function my_token()
    {
        $curl = curl_init();

        @curl_setopt_array($curl, array(
            CURLOPT_URL => API_URL . '/login',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => 'username=' . USERNAME_API . '&password=' . PASSWORD_API,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $toArray = json_decode($response, true);

        return $toArray;
    }
}
