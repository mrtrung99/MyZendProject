<?php

// module/Blog/src/Blog/Model/Blog.php

namespace Chungchi\Model;

class Chungchi {

    protected $macc;
    protected $tencc;

    public function __construct(array $options = null) {
        if (is_array($options)) {
            $this->setOptions($options);
        }
    }

    public function __set($tencc, $value) {
        $method = 'set' . $tencc;
        if (!method_exists($this, $method)) {
            throw new Exception('Invalid Method');
        }
        $this->$method($value);
    }

    public function __get($tencc) {
        $method = 'get' . $tencc;
        if (!method_exists($this, $method)) {
            throw new Exception('Invalid Method');
        }
        return $this->$method();
    }

    public function setOptions(array $options) {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (in_array($method, $methods)) {
                $this->$method($value);
            }
        }
        return $this;
    }

    public function getMacc() {
        return $this->macc;
    }

    public function setMacc($macc) {
        $this->macc = $macc;
        return $this;
    }

    public function getTencc() {
        return $this->tencc;
    }

    public function setTencc($tencc) {
        $this->tencc = $tencc;
        return $this;
    }
  
     public function exchangeArray($data)
     {
         $this->macc     = (!empty($data['macc'])) ? $data['macc'] : null;
         $this->tencc = (!empty($data['tencc'])) ? $data['tencc'] : null;
     }

}

?>