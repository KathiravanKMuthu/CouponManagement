<?php
//require_once 'api/config/app_config.php';

class DealInfo{

    // database connection and table name
    private $conn;
    private $table_name = "deal_info";
    private $m_fields = "deal_id, parent_deal_id, merchant_id, title, description, deal_amount, currency, actual_amount, start_date, end_date, is_active, redemption_count, percentage, image_dir";
    private $m_mapped_fields = "$deal_id, $parent_deal_id, $merchant_id, $title, $description, $deal_amount, $currency, $actual_amount, $start_date, $end_date, $is_active, $redemption_count, $percentage, $image_dir";

    // object properties
    public $deal_id;
    public $parent_deal_id;
    public $merchant_id;
    public $title;
    public $description;
    public $deal_amount;
    public $currency;
    public $actual_amount;
    public $start_date;
    public $end_date;
    public $is_active;
    public $redemption_count;
    public $percentage;
    public $image_dir;

    // constructor with $db as database connection
    public function __construct($db){
      echo "inside constructor";
        $this->conn = $db;
    }

    public function getAllDeals($offset=0, $limit=20) {
      $query = "SELECT " + $m_fields + " FROM " + $table_name + ORDER BY end_date DESC LIMIT " . $offset . ", " . $limit;
      // prepare query statement
      $stmt = $this->conn->prepare($query);
      //$stmt->bind_param("s", $msg_type);

      // execute query
      $stmt->execute();
      echo "query executed";
      $stmt->store_result(); // Store the prepared statement for later checking

      $result = array();
      // Check to make sure if any data is returned
      if($stmt->num_rows) {
        // Create and append variables to the appropriate columns
        $stmt->bind_result($m_mapped_fields);

        // Create a while loop
        while($stmt->fetch()) {

            // Create an array with keys and reference the variables we just created in bind_result()
            // This is an alternative way to get_result()
            $temp = array(
              'deal_id' => $deal_id,
              'parent_deal_id' => $parent_deal_id,
              'merchant_id' => $merchant_id,
              'title' => $title,
              'description' => $description,
              'deal_amount' => $deal_amount,
              'currency' => $currency,
              'actual_amount' => $actual_amount,
              'start_date' => $start_date,
              'end_date' => $end_date,
              'is_active' => $is_active,
              'redemption_count' => $redemption_count,
              'percentage' => $percentage,
              'image_dir' => $image_dir
            );

            array_push($result, $temp);
        }
      }
      return $result;

    }

    public function getAllUserDeals($offset=0, $limit=20) {
      $query = "SELECT " + $m_fields + " FROM " + $table_name + ORDER BY end_date DESC LIMIT " . $offset . ", " . $limit;
      // prepare query statement
      $stmt = $this->conn->prepare($query);
      //$stmt->bind_param("s", $msg_type);

      // execute query
      $stmt->execute();
      echo "query executed";
      $stmt->store_result(); // Store the prepared statement for later checking

      $result = array();
      // Check to make sure if any data is returned
      if($stmt->num_rows) {
        // Create and append variables to the appropriate columns
        $stmt->bind_result($m_mapped_fields);

        // Create a while loop
        while($stmt->fetch()) {

            // Create an array with keys and reference the variables we just created in bind_result()
            // This is an alternative way to get_result()
            $temp = array(
              'deal_id' => $deal_id,
              'parent_deal_id' => $parent_deal_id,
              'merchant_id' => $merchant_id,
              'title' => $title,
              'description' => $description,
              'deal_amount' => $deal_amount,
              'currency' => $currency,
              'actual_amount' => $actual_amount,
              'start_date' => $start_date,
              'end_date' => $end_date,
              'is_active' => $is_active,
              'redemption_count' => $redemption_count,
              'percentage' => $percentage,
              'image_dir' => $image_dir
            );

            array_push($result, $temp);
        }
      }
      return $result;

    }
?>
