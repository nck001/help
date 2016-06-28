<?php

include_once("connection.php");

//curd class (the abstract data layer)

class Crud
{
    private $result = array();


    public function __construct()
    {
    }

    //insert query
    protected function insert($table, $data)
    {

        $db = Connection::getInstance();
        $mysqli = $db->getConnection();

       // $result = $mysqli->query($sql_query);

        $insert = sprintf('INSERT INTO %s (%s) VALUES ("%s")', $table,
            implode(', ', array_map(array($this, 'array_map_callback'), array_keys($data))),
            implode('", "', array_map(array($this, 'array_map_callback'), $data)));

        if ($mysqli->query($insert)) {
            return true;
        } else {
            return false;
        }
    }


    // callback function for insert method
    function array_map_callback($a)
    {
        $db = Connection::getInstance();
        $mysqli = $db->getConnection();

        return mysqli_real_escape_string($mysqli, $a);
    }

    //select query
    protected function select($table, $column = NULL, $data = NULL)
    {
        $db = Connection::getInstance();
        $mysqli = $db->getConnection();

        if (!empty($data)) {
            $query = "SELECT " . implode(', ', $column) . " FROM `$table`" . $this->where_list($data);

        } else {
            $query = "SELECT * FROM `$table`" . $this->where_list($data);
        }
        $query = $mysqli->query($query);

        if ($query) {
            $this->numResults = mysqli_num_rows($query);
            for ($i = 0; $i < $this->numResults; $i++) {
                $r = mysqli_fetch_assoc($query);
                $key = array_keys($r);
                for ($x = 0; $x < count($key); $x++) {
                    // Sanitizes keys so only alphavalues are allowed
                    if (!is_int($key[$x])) {
                        if (mysqli_num_rows($query) > 0)
                            $this->result[$i][$key[$x]] = htmlentities($r[$key[$x]]);
                        else if (mysqli_num_rows($query) < 1)
                            $this->result = null;
                        else
                            $this->result[$key[$x]] = htmlentities($r[$key[$x]]);
                    }
                }
            }
            return true;
        } else {
            return false;
        }
    }

    //get query results
    protected function getResult()
    {
        return $this->result;
    }

    //query result count
    protected function doCount($table, $data = array())
    {
        $db = Connection::getInstance();
        $mysqli = $db->getConnection();
        $query = $mysqli->query("SELECT COUNT(id) FROM `$table`" . $this->where_list($data));
        list($row) = mysqli_fetch_assoc($query);
        return $row;
    }

    //update query
    protected function doUpdate($table, $data = array(), $where = array())
    {
        //print_r($where);
        $db = Connection::getInstance();
        $mysqli = $db->getConnection();
        foreach ($data as $key => $value) {
            $query = "UPDATE $table " . $this->column_list($data) . $this->where_list($where);
            //echo $query;
            return $mysqli->query($query);
        }

    }

    //delete query
    protected function delete($table, $where = array())
    {

        $db = Connection::getInstance();
        $mysqli = $db->getConnection();
        $query = "DELETE FROM $table "  . $this->where_list($where);
        return $mysqli->query($query);

    }


    //column list query
    private function column_list($conditions = array())
    {
        $output = " SET ";
        foreach ((array)$conditions as $column => $value) {
            //If the value is an aray it must be an IN clause
            if (is_array($value)) {
                $output .= "`" . $column . "`" . "'$value'";
            } else {
                $output .= "`" . $column . "`" . " = "
                    . ($value == '?' ? $value : "'$value'") . ", ";
            }
        }

        return rtrim($output, ", ");
    }

    //where list query
    private function where_list($conditions = array())
    {
        $output = " WHERE ";
        foreach ($conditions as $column => $value) {
            //If the value is an aray it must be an IN clause
            if (is_array($value)) {
                $output .= $column . "'$value'";
            } else {
                $output .= $column . " = "
                    . ($value == '?' ? $value : "'$value'") . " AND ";
            }
        }
        return rtrim($output, " AND ");
    }

    //select all query
    protected function select_all_posts($table)
    {
        $db = Connection::getInstance();
        $mysqli = $db->getConnection();


            $query = "SELECT * FROM `$table` ORDER  BY `id` DESC" ;
        $query = $mysqli->query($query);

        if ($query) {
            $this->numResults = mysqli_num_rows($query);
            for ($i = 0; $i < $this->numResults; $i++) {
                $r = mysqli_fetch_assoc($query);
                $key = array_keys($r);
                for ($x = 0; $x < count($key); $x++) {
                    // Sanitizes keys so only alphavalues are allowed
                    if (!is_int($key[$x])) {
                        if (mysqli_num_rows($query) > 0)
                            $this->result[$i][$key[$x]] = htmlentities($r[$key[$x]]);
                        else if (mysqli_num_rows($query) < 1)
                            $this->result = null;
                        else
                            $this->result[$key[$x]] = htmlentities($r[$key[$x]]);
                    }
                }
            }
            return true;
        } else {
            return false;
        }
    }

    //search result selection query
    protected function select_search($table, $column = NULL,$type, $location, $price)
    {
       // print_r($price);


        $db = Connection::getInstance();
        $mysqli = $db->getConnection();



            $query = "SELECT " . implode(', ', $column) . " FROM `$table`" . " WHERE service_type = '".$type. "' AND location LIKE '%".$location."%' AND hourly_price BETWEEN '" .$price[0][0]."' AND '" .$price[0][1]."'";

        //echo $query ;

        $query = $mysqli->query($query);



        if ($query) {
            $this->numResults = mysqli_num_rows($query);
            for ($i = 0; $i < $this->numResults; $i++) {
                $r = mysqli_fetch_assoc($query);
                $key = array_keys($r);
                for ($x = 0; $x < count($key); $x++) {
                    // Sanitizes keys so only alphavalues are allowed
                    if (!is_int($key[$x])) {
                        if (mysqli_num_rows($query) > 0)
                            $this->result[$i][$key[$x]] = htmlentities($r[$key[$x]]);
                        else if (mysqli_num_rows($query) < 1)
                            $this->result = null;
                        else
                            $this->result[$key[$x]] = htmlentities($r[$key[$x]]);
                    }
                }
            }
            return true;
        } else {
            return false;
        }
    }

}
