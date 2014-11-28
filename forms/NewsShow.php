<?php

class Application_Form_NewsShow extends Zend_Form
{
    public function init()
    {
        $this->setName('newsshow');
        
        $options = array(
            'name' => 'image_path', 
            'label' => 'Image',
        );
        $element = new Zend_Form_Element_Image($options);
        $this->addElement($element);
    
        $element = new Zend_Form_Element_Text('header', array(
                'label' => 'Header',
                ));
        $this->addElement($element);
        
        $element = new Zend_Form_Element_Text('date');
        $element->setLabel('Date');
        $this->addElement($element);
        
        $element = new Zend_Form_Element_Textarea('text', array(
                'label' => 'Text',
                ));
        $this->addElement($element);
        
        $element = new Zend_Form_Element_Submit('submit');
        $element->setAttrib('id', 'submitbutton');
        $this->addElement($element);
    }
}

