<?php

class User extends Db_object {
    
    protected static $db_table = "users";
    protected static $db_table_field = array("username","password","first_name","last_name","user_image");
    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;
    public $user_image;
    public $upload_directory = "images";
    public $image_placeholder = "http://placehold.it/400*400&text = image";
    
    public function image_path_and_placeholder(){
        
        return empty($this->user_image) ? $this->image_placeholder : $this->upload_directory.DS.$this->user_image;
        
    }
    
    public static function varify_user($username,$password){
        global $database;
        
        $username = $database->escape_string($username);
        $password = $database->escape_string($password);
        
        $sql = "SELECT * FROM " .static::$db_table. " WHERE ";
        $sql .= "username = '{$username}' ";
        $sql .= "AND password = '{$password}' ";
        $sql .= "LIMIT 1";
        
       $the_result_array = static::find_by_query($sql);
        
    return !empty($the_result_array)?array_shift($the_result_array):false;
        
    }
    
    public function delete_user(){
        
        if($this->delete()){
            
            $target_path = SITE_ROOT.DS."admin".DS.$this->image_path_and_placeholder();
            return unlink($target_path) ? true : false;
            
        }else{
            
            return false;
            
        }
        
    }
    
    public function set_file($file){
        
        if(empty($file) || !$file || !is_array($file)){
            
          $this->error[] = "there was no file uploaded here..!!";
          return false;  
          
        }elseif($file["error"] != 0){
            
          $this->error[] = $this->upload_error[$file["error"]];
        return false;
            
        }else{
            
            $this->user_image = basename($file["name"]);
        $this->temp_path = $file["tmp_name"];
        $this->type = $file["type"];
        $this->size = $file["size"];
            
        }

    }
    
    
     public function upload_photo(){
    
            if(!empty($this->error)){
                
                return false;
                
            }
            
            if(empty($this->user_image ) || empty($this->temp_path)){
                
                $this->error[] = "there was no file found..!!";
                return false;
;                
            }
            
            $target_path = SITE_ROOT.DS."admin".DS.$this->upload_directory.DS.$this->user_image;
            
            if(file_exists($target_path)){
                
                $this->error[] = "the file is already exists..!!";
                return false;
                
            }
            
            if(move_uploaded_file($this->temp_path,$target_path)){
                
                    unset($this->temp_path);
                    return true;
                
            }else{
                
               $this->error[] = "the file directory does not have a probably permission";
                return false;
                
            }
            
        }
    
    public function ajax_image_save($user_image,$user_id) {
       
        global $database;
        
         $user_image = $database->escape_string($user_image);
        $user_id = $database->escape_string($user_id);
        
        $this->user_image = $user_image;
        $this->id = $user_id;
        
        $sql = "UPDATE ".self::$db_table." SET user_image = '{$this->user_image}' ";
        $sql .= "WHERE id = '{$this->id}' ";
        
        $update_image = $database->query($sql);
        
        echo $this->image_path_and_placeholder();
        
    }   
        
    }
    
    
?>