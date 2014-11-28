<?php

class Application_Form_News extends Zend_Form
{
    public function init()
    {
        $isEmptyMessage = 'Fill the form!';
        $this->setName('news');
        
        // Create hidden for id
        /*$element = new Zend_Form_Element_Hidden('id');
        $element->addFilter('Int');
        $this->addElement($element);*/
        
        $element = new Zend_Form_Element_File('image_path', array(
                'label' => 'Upload image',
                ));
        $path = '/images';
        $element->setDestination(APPLICATION_PATH /*. $path*/)
                ->addValidator('Extension', false, 'jpg,png,gif');
        $this->addElement($element);
    
        $element = new Zend_Form_Element_Text('header', array(
                'label' => 'Header',
                ));
        $element->setRequired(true)
                ->addValidator('NotEmpty', true,
                array('messages' => array('isEmpty' => $isEmptyMessage))
                );
        $this->addElement($element);
        
        /*Delete*/
        /*$element = new Zend_Form_Element_Text('date');
        $element->setLabel('Date');
        $this->addElement($element);*/
        
        $element = new Zend_Form_Element_Textarea('text', array(
                'label' => 'Text',
                ));
        $element->setRequired(true)
                ->addValidator('NotEmpty', true,
                array('messages' => array('isEmpty' => $isEmptyMessage)
                ));
        $this->addElement($element);
        
        $element = new Zend_Form_Element_Text('identifier_page', array(
                'label' => 'Enter keys',
                ));
        $element->setRequired(true)
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty', true,
                array('messages' => array('isEmpty' => $isEmptyMessage))
                );
        $this->addElement($element);
        
        // Create submit
        $element = new Zend_Form_Element_Submit('submit');
        // Create attrib id = submitbutton
        $element->setAttrib('id', 'submitbutton');
        $this->addElement($element);
 
        // Best single addiction
        //$this->addElements(array($id, $image_path, $header, $date, $text, $identifier_page, $submit));
    }
}

