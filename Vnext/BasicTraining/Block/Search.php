<?php
namespace Vnext\BasicTraining\Block;

use Magento\Framework\View\Element\Template\Context;

class Search extends \Magento\Framework\View\Element\Template
{
    /** @var  \Vnext\BasicTraining\Model\StudentFactory*/


    protected $student_factory;
    protected $collection_factory;

    public function __construct(
        Context $context,
        \Vnext\BasicTraining\Model\StudentFactory $student_factory,
        \Vnext\BasicTraining\Model\ResourceModel\Student\CollectionFactory $collection_factory
    )
    {
        $this->student_factory = $student_factory;
        $this->collection_factory = $collection_factory;
        parent::__construct($context);
    }


    public function getSearch()
    {
        $entity_id = $this->getRequest()->getPostValue('id');
        $name = $this->getRequest()->getPostValue('name');
        $gender = $this->getRequest()->getPostValue('gender');
        $dob = $this->getRequest()->getPostValue('age');
        if ($dob){
            $str = explode('-', $dob);
            $dobFrom = (int)date("Y") - (int)$str[0];
            $dobTo = (int)date("Y") - (int)$str[1];
            $dobFromQuery = date_create("{$dobFrom}-01-01");
            $dobToQuery = date_create("{$dobTo}-12-31");
        }

        if($entity_id){
            $data = $this->collection_factory->create()->addFieldToFilter('entity_id', ['like' => $entity_id]);
        }elseif($name){
            $data = $this->collection_factory->create()->addFieldToFilter('name', array('like' => '%'.$name.'%'));
        }elseif($gender){
            if ($gender == 'male'){
                $data = $this->collection_factory->create()->addFieldToFilter('gender', ['like' => 0]);
            }else{
                $data = $this->collection_factory->create()->addFieldToFilter('gender', ['like' => 1]);
            }
        }elseif($dob){
            $data = $this->collection_factory->create()->addFieldToFilter('dob', array('gteq' => $dobToQuery))->addFieldToFilter('dob', array('lteq' => $dobFromQuery));
        }
        return $data;
    }
}
