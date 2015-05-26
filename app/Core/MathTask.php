<?php namespace Kileo\Core;

class MathTask {

    protected $num1;
    protected $num2;
    protected $operation;

    /**
     * @param $num1
     * @param $num2
     * @param $operation
     */
    function __construct($num1, $num2, $operation)
    {
        $this->num1 = $num1;
        $this->num2 = $num2;
        $this->operation = $operation;
    }

    public function getNum1(){
        return $this->num1;
    }

    public function getNum2(){
        return $this->num2;
    }

    public function getOperation(){

        switch($this->operation){
            case 1:
                return '+';
            case 2:
                return '-';
            case 3:
                return '*';
            case 4:
                return '/';
        }

    }
}