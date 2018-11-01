<?php
    class Database
    {
        protected $link;
        function __construct() {}

        function connect()
        {
         /* Attempt to connect to MySQL database */
            $this->link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

         // Check connection
            if(!$this->link)
            {
                $response_array = array(
                                    'return_code' => 0,
                                    'return_message' => 'ERROR: Could not connect. ' . mysqli_connect_error()
                                  );
                $this->json_response($response_array);
             }
        }

        function insert($table_name, $column)
        {
            $response_array = array(
                                'return_code' => 1,
                                'return_message' => 'New Record Inserted Successfully.'
                              );

            $query = "INSERT INTO ${table_name} ";
            $column_list = $value_list = '';

            foreach($column as $key => $val)
            {
                $column_list = empty($column_list) ? $key : "${column_list}, $key";
                $value_list = empty($value_list) ? "'${val}'" : "${value_list}, '${val}'";
            }

            $query .= "(${column_list}) VALUES(${value_list})";
            $res = mysqli_query($this->link, $query);

            if(!$res)
            {
               $response_array['return_code'] = 0;
               $response_array['return_message'] = mysqli_error($this->link);
            } else {
                mysqli_commit($this->link);
            }

            $this->json_response($response_array);
        }

        function update($table_name, $column, $where_condition = null)
        {
            $response_array = array(
                                'return_code' => 1,
                                'return_message' => 'The Record Updated Successfully.'
                              );
            $query = "UPDATE ${table_name} SET ";
            $idx = 0;
            foreach($column as $key => $val)
            {
                //if(!empty($val))
                {
                    $query .= ($idx > 0) ? ", ${key} = '${val}'" : "${key} = '${val}'";
                    $idx++;
                }
            }
            if($where_condition)
            {
                $query .=" WHERE ${where_condition} ";
            }
            $res = mysqli_query($this->link, $query);

            if(!$res)
            {
               $response_array['return_code'] = 0;
               $response_array['return_message'] = mysqli_error($this->link);
            } else {
                mysqli_commit($this->link);
            }
            //$response_array['condition'] = $query;

            return $response_array;
            //$this->json_response($response_array);

        }

        function get($table_name, $where_condition = null, $order_by = null)
        {
            $query = "SELECT * FROM ${table_name}";

            if(null !== $where_condition) {
               $query .= " WHERE ${where_condition}";
            }
            if($order_by) {
                $query .= " ORDER BY ${order_by}";
            }
            $result = mysqli_query($this->link, $query);
            $record_array = array();
            $response_array = array(
                                'return_code' => 0,
                                'return_message' => 'No Record Found!'
                              );
            //$response_array['query'] = $query;
            if(mysqli_num_rows($result) > 0)
            {
                while($row = mysqli_fetch_assoc($result))
                {
                    $record_array[] = $row;
                }
                $response_array['return_code'] = 1;
                $response_array['return_message'] = $record_array;
            }
            return $response_array;
            //$this->json_response($response_array);
        }

        function get_by_query($query)
        {
            $record_array = array();
            $response_array = array(
                                'return_code' => 0,
                                'return_message' => 'No Record Found!'
                              );

            if($query == null)
                return $response_array;

            $result = mysqli_query($this->link, $query);
            if(mysqli_num_rows($result) > 0)
            {
                while($row = mysqli_fetch_assoc($result))
                {
                    $record_array[] = $row;
                }
                $response_array['return_code'] = 1;
                $response_array['return_message'] = $record_array;
            }

            return $response_array;
            //$this->json_response($response_array);
        }

        function delete($table_name, $where_condition)
        {
            $response_array = array(
                                'return_code' => 1,
                                'return_message' => 'The Record Deleted Successfully.'
                              );
            $query = "DELETE FROM ${table_name} ";

            if($where_condition)
            {
                $query .=" WHERE ${where_condition} ";
            }
            $res = mysqli_query($this->link, $query);

            if(!$res)
            {
               $response_array['return_code'] = 0;
               $response_array['return_message'] = mysqli_error($this->link);
            } else {
                mysqli_commit($this->link);
            }
            //$response_array['condition'] = $query;

            return $response_array;
        }

        // Return JSON response
        function json_response($response_array)
        {
            header('Content-Type: application/json');
            echo json_encode($response_array);
            exit();
        }

        function __destruct() { mysqli_close($this->link); }
    }

    $db = new Database();
    $db->connect();
