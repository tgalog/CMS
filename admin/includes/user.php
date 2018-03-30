<?php

class User 
{
    
    public $user_id;
    public $username;
    public $password;
    public $user_email;
    
    public static function find_this_query($sql)
    {
      global $database;
      $result_query = $database->query($sql);
      return $result_query;
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
        
        
       $result_set = self::find_this_query("SELECT * FROM users WHERE user_id=$id LIMIT 1");
       
       $found_user = mysqli_fetch_array($result_set);
       return $found_user;
       
//    return self::find_this_query("SELECT * FROM users WHERE user_id=$id LIMIT 1");
    
    }
    
    public static function instantation($found_user){

        $the_object = new self;            

        $the_object->user_id    = $found_user['user_id'];
        $the_object->username   = $found_user['username'];
        $the_object->password   = $found_user['password'];
        $the_object->user_email = $found_user['user_email'];
        
        return $the_object;

    }
      
}

?>