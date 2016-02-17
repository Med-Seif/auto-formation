<?php
/**
 * Description of ReverseString
 *
 * @author Med_Seif <bromdhane@gail.com>
 */
namespace Tests\Filter;
class ReverseString implements \Zend\Filter\FilterInterface{
    public function filter($value) {
        $arr = str_split($value);
        $arr = array_reverse($arr);
        return implode('',$arr);
    }
    public function __invoke() {
        return $this->filter(func_get_arg(0));
    }
}
