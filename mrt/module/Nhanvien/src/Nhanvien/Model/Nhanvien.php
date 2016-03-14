<?php

// module/Blog/src/Blog/Model/Blog.php

namespace Nhanvien\Model;

class Nhanvien {

    protected $manv;
    protected $tennv;
    protected $ngaysinhnv;
    protected $gioitinhnv;
    protected $diachinv;
    protected $sdtnv;
    protected $ngaybdlvnv;
    
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

    public function getManv() {
        return $this->manv;
    }

    public function setManv($manv) {
        $this->manv = $manv;
        return $this;
    }

    public function getTennv() {
        return $this->tennv;
    }

    public function setTennv($tennv) {
        $this->tennv = $tennv;
        return $this;
    }
      public function getNgaysinhnv() {
        return $this->ngaysinhnv;
    }

    public function setNgaysinhnv($ngaysinhnv) {
        $this->ngaysinhnv = $ngaysinhnv;
        return $this;
    }
      public function getGioitinhnv() {
        return $this->gioitinhnv;
    }

    public function setGioitinhnv($gioitinhnv) {
        $this->gioitinhnv = $gioitinhnv;
        return $this;
    }
      public function getDiachinv() {
        return $this->diachinv;
    }

    public function setDiachinv($diachinv) {
        $this->diachinv = $diachinv;
        return $this;
    }
      public function getSdtnv() {
        return $this->sdtnv;
    }

    public function setSdtnv($sdtnv) {
        $this->sdtnv = $sdtnv;
        return $this;
    }
      public function getNgaybdlvnv() {
        return $this->ngaybdlvnv;
    }

    public function setNgaybdlvnv($ngaybdlvnv) {
        $this->ngaybdlvnv = $ngaybdlvnv;
        return $this;
    }

     public function exchangeArray($data)
     {
         $this->manv     = (!empty($data['manv'])) ? $data['manv'] : null;
         $this->tennv = (!empty($data['tennv'])) ? $data['tennv'] : null;
         $this->ngaysinhnv    = (!empty($data['ngaysinhnv '])) ? $data['ngaysinhnv '] : null;
         $this->gioitinhnv = (!empty($data['gioitinhnv'])) ? $data['gioitinhnv'] : null;
         $this->diachinv     = (!empty($data['diachinv'])) ? $data['diachinv'] : null;
         $this->sdtnv = (!empty($data['sdtnv'])) ? $data['sdtnv'] : null;
         $this->ngaybdlvnv     = (!empty($data['ngaybdlvnv'])) ? $data['ngaybdlvnv'] : null;
     }

}

?>