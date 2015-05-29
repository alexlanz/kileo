<?php namespace Kileo\Core;

use JsonSerializable;

class MathTask implements JsonSerializable {

    protected $num1;
    protected $num2;
    protected $operation;
    protected $result;

    /**
     * @param $num1
     * @param $num2
     * @param $operation
     * @param $result
     */
    function __construct($num1, $num2, $operation, $result = null)
    {
        $this->num1 = $num1;
        $this->num2 = $num2;
        $this->operation = $operation;
        $this->result = $result;
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

    public function getResult(){
        return $this->result;
    }

    public function isSolved() {
        return ( ! is_null($this->result));
    }

    public function isCorrect() {
        return $this->checkResult();
    }

    private function checkResult()
    {
        $expectedResult = 0;
        $givenResult = $this->result;

        switch($this->operation){
            case 1:
                $expectedResult = $this->num1 + $this->num2;
                break;
            case 2:
                $expectedResult = $this->num1 - $this->num2;
                break;
            case 3:
                $expectedResult = $this->num1 * $this->num2;
                break;
            case 4:
                $expectedResult = $this->num1 / $this->num2;
                break;
        }

        return ($expectedResult == $givenResult);
    }

    function jsonSerialize()
    {
        return [
            'num1' => $this->num1,
            'num2' => $this->num2,
            'operation' => $this->operation,
            'result' => $this->result
        ];
    }
}