<?php
/**
 * @project blue-dashboard
 * @author  Giang
 * @email   giang8692@gmail.com
 * @date    12/13/2023
 * @time    6:29 AM
 **/
namespace app\helpers;



use DateInterval;
use DateTime;

class ApiHelper
{

    public static function fetchAndSaveData($domain)
    {
        $apiUrl = "https://$domain/wp-admin/admin.php/orders_api";
        // Initialize cURL session
        $curl = curl_init();
        // Set cURL options
        curl_setopt_array($curl, [
            CURLOPT_URL            => $apiUrl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true, // Follow redirects
            CURLOPT_MAXREDIRS      => 10, // Max number of redirects
            CURLOPT_TIMEOUT        => 30, // Timeout in seconds
            CURLOPT_SSL_VERIFYPEER => false, // Disable SSL verification
        ]);
        // Execute cURL request and get the response
        $apiResponse = curl_exec($curl);
        // Check for errors
        if ($apiResponse === false) {
            $error = curl_error($curl);

            // Handle the error appropriately, log, or throw an exception
            return 'cURL Error: '.$error;
        }
        // Close cURL session
        curl_close($curl);
        // Decode JSON response
        $decodedApiResponse = json_decode($apiResponse, true);
        $file        = "./orders-data/".$domain.".json";
        $encodedData = json_encode($decodedApiResponse, JSON_PRETTY_PRINT);
        // Save data to file
        $result = file_put_contents($file, $encodedData);
        if ($result !== false) {
            return 'Data update successfully!';
        } else {
            return 'Error saving data for '.$domain.' to file.';
        }

    }

}


