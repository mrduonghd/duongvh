<?php
namespace Vnext\BasicTraining\Block;

use Magento\Framework\View\Element\Template\Context;

class Sort extends \Magento\Framework\View\Element\Template
{
    /** @var  \AHT\Training\Model\StudentFactory*/
    protected $student_factory;

    public function __construct(
        Context $context,
        \Vnext\BasicTraining\Model\StudentFactory $student_factory
    )
    {
        $this->student_factory = $student_factory;
        parent::__construct($context);
    }


    public function getSort()
    {
        $key =$this->getRequest()->getParam('key');
        if ($key == 'id'){
            $result = $this->student_factory->create()->getCollection()->setOrder('entity_id', 'DESC');
        }elseif ($key == 'name'){
            $result = $this->student_factory->create()->getCollection()->setOrder('name', 'DESC');
        }else {
            $result = $this->student_factory->create()->getCollection()->setOrder('dob', 'DESC');
        }
        return $result;
    }
}
