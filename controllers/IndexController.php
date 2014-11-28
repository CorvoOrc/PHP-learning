<?php

class IndexController extends Zend_Controller_Action
{
    public function init()
    {
        /* Initialize action controller here */
    }
    
    /*Dont work, most likely because of inheritance*/
    public function cutText($storage, $permissibleLen){
        $start = 0;
        $trailing = '...';
        $key = 'text';
        
        for($i = 0;$i < count($storage); $i++) { 
            if(strlen($storage[$i][$key]) > $permissibleLen){
                $storage[$i][$key] = substr($storage[$i][$key], $start, $permissibleLen) . $trailing;
            }
        }
        
        return $storage;
    }

    public function indexAction()
    {
        //echo "I into IndexController, into indexAction!Привет!"; <- 'Привет' is displayed than krakazyabra
        $news = new Application_Model_DbTable_News();
        
        $storage = $news->fetchAll()->toArray();
        $permissibleLen = 30;
        
        $start = 0;
        $trailing = '...';
        $key = 'text';
        
        for($i = 0;$i < count($storage); $i++) { 
            if(strlen($storage[$i][$key]) > $permissibleLen){
                $storage[$i][$key] = substr($storage[$i][$key], $start, $permissibleLen) . $trailing;
            }
        }
        
        $this->view->news = $storage;
        //$this->view->news = $news->fetchAll();
    }
    
    public function addAction()
    {   
        // Create form
        $form = new Application_Form_News();
        $form->submit->setLabel('Ok');

        // Submit form in view
        $this->view->form = $form;
        
        // If POST reuest
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
             
            if ($form->isValid($formData)) {
                $image_path = $form->getValue('image_path'); // $form ->image_path->getFileName();
                if($image_path == NULL){ $image_path = 'default.png'; }
                $header = $form->getValue('header');
                $date = date('Y-m-d H:i:s');
                $text = $form->getValue('text');
                $search = array(',', ';', '.', ' ');
                $replace = array('-', '-', '-', '-');
                $identifier_page = str_replace($search, $replace, $form->getValue('identifier_page'));
                //How to use identifier_page?
                
                // Create object of the model
                $news = new Application_Model_DbTable_News();

                // Call addMovie for insert new record
                $news->addNews($image_path, $header, $date, $text, $identifier_page);

                // Return from Home Page
                $this->_helper->redirector('index');
            } 
            else { $form->populate($formData); }
        }
    }

    public function showAction()
    {
        $form = new Application_Form_NewsShow();
 
        $this->view->form = $form;
        
        if ($this->getRequest()->isPost()){
            //echo "POST";
            $this->_helper->redirector('index');
        }
        else if ($this->getRequest()->isGet()) {
            //echo "GET";
            $news = new Application_Model_DbTable_News();
            $newsArray = $news->getNews($this->_getParam('id'));
            
            $form->image_path->setAttrib("src", '/images/' . $newsArray['image_path']);
            $form->header->setValue($newsArray['header']);
            $form->date->setValue($newsArray['date']);
            $form->text->setValue($newsArray['text']);
            
            $form->submit->setLabel('Back');   
            //$form->populate($news->getNews($this->_getParam('id')));
        }
    }
}





