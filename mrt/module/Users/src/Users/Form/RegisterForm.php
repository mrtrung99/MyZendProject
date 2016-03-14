<?php
namespace Users\Form;
use Zend\Form\Form;
use Zend\Form\Element;
class RegisterForm extends Form{
    public function __construct($name = null)
    {
        parent::__construct('Register');
        $this->setAttribute('method','post');
        $this->setAttribute('enctype','multipart/form-data');
        $this->add(array(
            'name' => 'name',
            'attributes' => array(
                'type' => 'text',
            ),
            'options' => array(
                'label' => 'Họ tên'
            ),
        ));
        $this->add(array(
            'name' => 'email',
            'attributes' => array(
                'type' => 'email',
            ),
            'options' => array(
                'label' => 'Email',
            ),
            'attributes' => array(
                'required' => 'required'
            ),
            'filters' => array(
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name' => 'EmailAddress',
                    'options' => array(
                        'messages' => array(
                            \Zend\Validator\EmailAddress::INVALID_FORMAT => 'Email address format is invalid'
                        ),
                    ),
                ),
            ),
        ));
        $password = new Element\Password('password');
        $password->setLabel('Nhập mật khẩu');
        $this->add($password);
        $confirm_password = new Element\Password('confirm_password');
        $confirm_password->setLabel('Xác nhận mật khẩu');
        $this->add($confirm_password);
/*
         $this->add(array(
            'name' => 'password',
            'attributes' => array(
                'type' => 'password',
            ),
            'options' => array(
                'label' => 'Mật khẩu',
            ),
            'attributes' => array(
                'required' => 'required'
            ),
            'filters' => array(
                array('name' => 'StringTrim'),
            ),
        ));
         $this->add(array(
            'name' => 'confirm_password',
            'attributes' => array(
                'type' => 'password',
            ),
            'options' => array(
                'label' => 'Xác nhận lại mật khẩu',
            ),
            'attributes' => array(
                'required' => 'required'
            ),
            'filters' => array(
                array('name' => 'StringTrim'),
            ),
        )); */
         $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'button',
            ),
            'options' => array(
                'label' => 'Submit',
            ),
        ));
    }
}

?>