<?php

class Photo extends Db_object{
    
    protected static $db_table = "photos";
    protected static $db_table_field = array("id","title","caption","description","filename","alternate_text","type","size");
    public $id;
    public $title;
    public $caption;
    public $description;
    public $filename;
    public $alternate_text;
    public $type;
    public $size;
    
    public $temp_path;
    public $directory = "images";
    
    
    
    public function picture_path(){
        
       return $this->directory.DS.$this->filename;
        
    }
    
    public function set_file($file){
        
        if(empty($file) || !$file || !is_array($file)){
            
          $this->error[] = "there was no file uploaded here..!!";
          return false;  
          
        }elseif($file["error"] != 0){
            
          $this->error[] = $this->upload_error[$file["error"]];
        return false;
            
        }else{
            
            $this->filename = basename($file["name"]);
        $this->temp_path = $file["tmp_name"];
        $this->type = $file["type"];
        $this->size = $file["size"];
            
        }

    }
    
    
    public function save(){
        
        if($this->id){
            
            $this->update();
            
        }else{
            
            if(!empty($this->error)){
                
                return false;
                
            }
            
            if(empty($this->filename ) || empty($this->temp_path)){
                
                $this->error[] = "there was no file found..!!";
                return false;
;                
            }
            
            $target_path = SITE_ROOT.DS."admin".DS.$this->directory.DS.$this->filename;
            
            if(file_exists($target_path)){
                
                $this->error[] = "the file is already exists..!!";
                return false;
                
            }
            
            if(move_uploaded_file($this->temp_path,$target_path)){
                
                if($this->create()){
                    
                    unset($this->temp_path);
                    return true;
                    
                }
                
            }else{
                
               $this->error[] = "the file directory does not have a probably permission";
                return false;
                
            }
            
        }
        
    }
    
    public function delete_photo(){
        
        if($this->delete()){
            
            $target_path = SITE_ROOT.DS."admin".DS.$this->picture_path();
            return unlink($target_path) ? true : false;
            
        }else{
            
            return false;
            
        }
        
    }
    
    public static function display_sidebar_data($photo_id){
        
        $photo = Photo::find_by_id($photo_id);
        
        $output = "<a class = 'thumbnail' href = ''><img width = '100' src = '{$photo->picture_path()}' alt = ''></a>";
        $output .= "<p>{$photo->filename}</p>";
        $output .= "<p>{$photo->type}</p>";
        $output .= "<p>{$photo->size}</p>";
        
        echo $output;
        
    }
    
}

?>