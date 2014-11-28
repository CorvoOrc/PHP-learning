<?php

class Application_Model_DbTable_News extends Zend_Db_Table_Abstract
{
    // Name of table from BD
    protected $_name = 'news';

    /*
     * getNews used for get news from the DB
     * id [in] - identificator of the record, which need to get
     * row [out] - returned record
     */
    public function getNews($id) {
        $id = (int)$id;
        $row = $this->fetchRow('id = '.$id);
        
        if(!$row) {throw new Exception("OMG, no news with id - $id");}
        
        return $row->toArray();
    }
    
    /*Getter*/    
    public function __get($name) {
        $method = 'get' . $name;
        return $this->$method();
    }
    
     public function getId() {
        return $this->id;
    }
    
    public function getImage_path() {
        return $this->image_path;
    }
    
    public function getHeader() {
        return $this->header;
    }
    
    public function getDate() {
        return $this->date;
    }

    public function getText() {
        return $this->text;
    }
    
    public function getIdentifier_page() {
        return $this->identifier_page;
    }
    
    /*Not need, for practic*/
    /*public function setNews($id, $image_path, $header, $date, $text, $identifier_page) {
        $id = (int)$id;
        $row = $this->fetchRow('id = '.$id);
        
        if(!$row) {throw new Exception("OMG, no news with id - $id");}
        
        $data = array(
            'image_path' => $image_path, 
            'header' => $header, 
            'date' => $date, 
            'text' => $text, 
            'identifier_page' => $identifier_page, 
        );
        
        $this->update($data, 'id = ' . (int)$id);
    }*/
    
    /*
     * addNews used for add news in the DB
     * image_path [in] - image path of the news
     * header [in] - head of the news
     * date [in] - date, when news was published
     * text [in] - text of the news
     * identifier_page [in] - identifier page,required in url, exl news/identifier_page
     */
    public function addNews($image_path, $header, $date, $text, $identifier_page) {
        $data = array(
            'image_path' => $image_path, 
            'header' => $header, 
            'date' => $date, 
            'text' => $text, 
            'identifier_page' => $identifier_page, 
        );
        
        $this->insert($data);
    }
}

