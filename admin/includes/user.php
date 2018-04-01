<?php

class User 
{
    
    public $user_id;
    public $username;
    public $firstname;
    public $lastname;
    
    public static function find_this_query($sql)
    {
      global $database;
      $result_set = $database->query($sql);
      $the_object_array = array();
      
      while($row = mysqli_fetch_array($result_set)){
          $the_object_array[] = self::instantiation($row);
      }
                
      return $the_object_array;
    }
    
    public static function find_all_users() 
    {
       
//       global $database;        
//       $result_set = $database->query("SELECT * FROM users");
//       return $result_set;
       
         return self::find_this_query("SELECT * FROM users");
    }

    public static function find_user_by_id($id)
    {
//       global $database; 
//       $result_set = $database->query("SELECT * FROM users WHERE user_id=$id LIMIT 1");
        
        
       $the_result_array = self::find_this_query("SELECT * FROM users WHERE user_id=$id LIMIT 1");
       
       return !empty($the_result_array) ? array_shift($the_result_array) : false;
       
//    return self::find_this_query("SELECT * FROM users WHERE user_id=$id LIMIT 1");
    
    }
    
    public static function instantiation($the_record)
    {

        $the_object = new self;            

//        $the_object->user_id    = $found_user['user_id'];
//        $the_object->username   = $found_user['username'];
//        $the_object->firstname  = $found_user['firstname'];
//        $the_object->lastname   = $found_user['lastname'];
        
        foreach ($the_record as $the_attribute => $value) {
            if($the_object->has_the_attribute($the_attribute)){
                $the_object->$the_attribute = $value;
            }
        }
        
        return $the_object;

    }

    private function has_the_attribute($the_attribute)
    {
    
    $object_properties = get_object_vars($this);
    return array_key_exists($the_attribute, $object_properties);    
        
    }
    
    
}


































?>