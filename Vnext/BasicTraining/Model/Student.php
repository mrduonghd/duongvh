<?php

namespace Vnext\BasicTraining\Model;

class Student extends \Magento\Framework\Model\AbstractModel
{
    protected function _construct()
    {
        $this->_init('Vnext\BasicTraining\Model\ResourceModel\Student');
    }
}
