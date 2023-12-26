<?php
/**
 * @project blue-dashboard
 * @author  Nguyen Giang
 * @email   giang8692@gmail.com
 * @date    12/18/2023
 * @time    9:54 PM
 **/

namespace app\functions;

include __DIR__ . '/../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use DateTime;

use app\helpers\ApiHelper;

use app\lib\App;

/**
 * Class ExportOrders.
 * This class handle the export orders page function
 */
class ExportOrders
{
    public bool $updateButton = false;
    /**
     * @var boolean $updateButton Update Data button
     */
    public bool $selectedDomain = false;
    /**
     * @var boolean $selectedDomain Selected Domain button
     */
    public array $domains;
    /**
     * @var array $domains Verify domain list
     */
    public string $responeUpdateButton;
    /**
     * @var string $responeUpdateButton Respone for update button
     */


    public function __construct()
    {

        $this->getPostData();
    }
    public function getDomainList()
    {
        $domainList = '../public/verify-domain/verify-domain.json';
        if (file_exists($domainList)) {
            $domainsJSON = file_get_contents($domainList);

            $this->domains = json_decode($domainsJSON, true);
        }
    }
    public function fetchData()
    {
        $domains = $this->domains;
        foreach ($domains as $domain) {
            $file = "./orders-data/" . $domain . ".json";
            if (file_exists($file)) {
                $response = ApiHelper::fetchAndSaveData($domain);
                $this->responeUpdateButton = $response;

            } else {
                $response = ApiHelper::fetchAndSaveData($domain);
                $this->responeUpdateButton = $response;

            }
        }
    }

    // Fetch orders for selected domain
    public function fetchOrders()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (isset($_POST['selectedDomain'])) {
                unset($_SESSION['filter_orders']);
                $domains = $this->domains;
                foreach ($domains as $domain) {
                    if ($domain == $_POST['selectedDomain']) {
                        $file = "./orders-data/" . $domain . ".json";
                        if (file_exists($file)) {
                            $orders = file_get_contents($file);
                            $orders_data = json_decode($orders, true);
                            $_SESSION['orders'] = $orders_data;
                        }

                    }

                }

            }

        }
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['updateButton'])) {
                $this->fetchData();

            }

        }
    }
    /**
     * Get login data.
     */
    private function getPostData()
    {

    }

    public function filterDataByDateRange()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['daterange']) && isset($_POST['updateDateRange'])) {
                $date_range = $_POST['daterange'] ?? '';
                $_SESSION['daterange'] = $date_range;

                $dates = explode(' - ', $date_range);
                $start_date = $dates[0]; // Assuming the start date is in the correct format 'MM/DD/YYYY'
                $end_date = $dates[1];
                $orders = $_SESSION['orders'];
                $filter_orders = $this->filterDataByDate($start_date, $end_date, $orders);
                $_SESSION['filter_orders'] = $filter_orders;

            }

        }
    }

    public function filterDataByDate($start_date, $end_date, $orders)
    {
        if (isset($_POST['updateDateRange'])) {
            // Array to store orders within the date range
            $filtered_orders = [];

            // Iterate through orders and filter based on date range
            foreach ($orders as $order) {
                $order_date = $order['order_date']['date'];
                $formatted_date = date("d/m/Y", strtotime($order_date));
                // Check if the order date is within the specified range
                if ($formatted_date >= $start_date && $formatted_date <= $end_date) {
                    if ($order['order_status'] === "processing") {
                        $filtered_orders[] = $order;
                    }
                }
            }
            return $filtered_orders;
        }
    }

    public function exportOdersToExcel()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['exportOrders'])) {
            // Assuming 'app' is the folder where your script resides
            $root = $_SERVER['DOCUMENT_ROOT']; // Update this if 'app' is not the correct folder

            $filePath = $root . '/export_data.php';

            if (file_exists($filePath)) {
                require_once($filePath); // Include the PHP file

                $functions = get_defined_functions(); // Get all defined functions
                foreach ($functions['user'] as $function) {
                    if ($function !== __FUNCTION__) {
                        if (function_exists($function)) {
                            call_user_func($function); // Execute each function
                        }
                    }
                }
            } else {
                echo 'The required file does not exist.';
            }
        }
    }

}
