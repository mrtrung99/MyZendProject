<?php

// module/Blog/src/Blog/Model/Blog.php

namespace Ngonngu\Model;

class Ngonngu {

    protected $mann;
    protected $tennn;

    public function __construct(array $options = null) {
        if (is_array($options)) {
            $this->setOptions($options);
        }
    }

    public function __set($tennn, $value) {
        $method = 'set' . $tennn;
        if (!method_exists($this, $method)) {
            throw new Exception('Invalid Method');
        }
        $this->$method($value);
    }

    public function __get($tennn) {
        $method = 'get' . $tennn;
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

    public function getMann() {
        return $this->mann;
    }

    public function setMann($mann) {
        $this->mann = $mann;
        return $this;
    }

    public function getTennn() {
        return $this->tennn;
    }

    public function setTennn($tennn) {
        $this->tennn = $tennn;
        return $this;
    }

     public function exchangeArray($data)
     {
         $this->mann     = (!empty($data['mann'])) ? $data['mann'] : null;
         $this->tennn = (!empty($data['tennn'])) ? $data['tennn'] : null;
     }

}

?>