<?php 

class Database 
{
// class properties
    
  public $connection;

// class functions
    
    function __construct()
    {
        $this->open_db_connection();
    }
          
    public function open_db_connection() 
    {

        $this->connection = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME); /*<--Ref. see http://php.net/manual/en/mysqli.construct.php */
        
        if($this->connection->connect_errno){
            
            die('Database failed (' . $this->connection->connect_errno . ')' . $this->connection->connect_error); /* ref: mysqli class methods mysqli::$connect_errno & mysqli::$connect_error */
        }    
    }
    
    public function query($sql)
    {
        
        /* original code --> $result = mysqli_query($this->connection, $sql);
           return $result; */

        $result = $this->connection->query($sql); // <-- same as mysqli::query();
        $this->confirm_query($result);
        return $result;
    }
    
    private function confirm_query($result)
    {
        if(!$result) {
            
            die('Query Failed' . 'Database failed (' . $this->connection->connect_errno . ')' . $this->connection->connect_error);
        }
    }
    
    public function escape_string($string)
    {
        
        $escape_string = $this->connnection->real_escape_string($string);//<-- method in mysqli class ref.: http://php.net/manual/en/mysqli.real-escape-string.php
        return $escape_string;
    }
    
    public function the_insert_id()
    {
        return $this->connection->insert_id; //<-- method in mysqli class ref.: http://php.net/manual/en/mysqli.insert-id.php
    }
    
}

$database = new Database();

?>