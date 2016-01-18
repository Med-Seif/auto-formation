<?php

/**
 * Description of ConnexionsPerUser
 *
 * @author Med_Seif <bromdhane@gail.com>
 */

namespace Admin\Plugin\Chart;

class Users implements ChartsInterface{

    public function getData() {
        return array('r');
    }

}
