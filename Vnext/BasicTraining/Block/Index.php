<?php
namespace Vnext\BasicTraining\Block;

use Magento\Framework\View\Element\Template;

class Index extends \Magento\Framework\View\Element\Template
{
    protected $student;
    protected $studentDataCollection;

    public function __construct(
        Template\Context $context,
        \Vnext\BasicTraining\Model\Student $student, // Add your custom Model
        \Vnext\BasicTraining\Model\ResourceModel\Student\CollectionFactory $studentDataCollection, // Add your custom Model
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->student = $student;
        $this->studentDataCollection = $studentDataCollection;
    }
    protected function _prepareLayout()
    {
        $this->pageConfig->getTitle()->set(__('My Custom Pagination'));
        parent::_prepareLayout();
        $page_size = $this->getPagerCount();
        $page_data = $this->getCustomData();
        if ($this->getCustomData()) {
            $pager = $this->getLayout()->createBlock(
                \Magento\Theme\Block\Html\Pager::class,
                'custom.pager.name'
            )
                ->setAvailableLimit($page_size)
                ->setShowPerPage(true)
                ->setCollection($page_data);
            $this->setChild('pager', $pager);
            $this->getCustomData()->load();
        }
        return $this;
    }
    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }

    public function getCustomData()
    {
        // get param values
        $page = ($this->getRequest()->getParam('p')) ? $this->getRequest()->getParam('p') : 1;
        $pageSize = ($this->getRequest()->getParam('limit')) ? $this->getRequest()->getParam('limit') : 5; // set minimum records
        // get custom collection

        $key = $this->getRequest()->getParam('key');
        $id = $this->getRequest()->getParam('id');
        $name = $this->getRequest()->getParam('name');
        $gender = $this->getRequest()->getParam('gender');
        $dob = $this->getRequest()->getParam('age');
        if ($dob){
            $str = explode('-', $dob);
            $dobFrom = (int)date("Y") - (int)$str[0];
            $dobTo = (int)date("Y") - (int)$str[1];
            $dobFromQuery = date_create("{$dobFrom}-01-01");
            $dobToQuery = date_create("{$dobTo}-12-31");
        }

        $collection = $this->student->getCollection();
        if ($id){
            $collection->addFieldToFilter('entity_id', ['eq' => $id]);
        }
        if ($name){
            $collection->addFieldToFilter('name', array('like' => '%'.$name.'%'));
        }
        if ($gender){
            if($gender == 'male'){
                $collection->addFieldToFilter('gender', ['like' => 0]);
            }else{
                $collection->addFieldToFilter('gender', ['like' => 1]);
            }
        }
        if ($dob){
            $collection->addFieldToFilter('dob', array('gteq' => $dobToQuery))->addFieldToFilter('dob', array('lteq' => $dobFromQuery));
        }

        if($key == 'id'){
            $collection->setOrder('entity_id', 'DESC');
        }elseif ($key == 'name'){
            $collection->setOrder('name', 'DESC');
        }else{
            $collection->setOrder('dob', 'DESC');
        }
        $collection->setPageSize($pageSize);
        $collection->setCurPage($page);
        return $collection;
    }

    public function getPagerCount()
    {
        // get collection
        $minimum_show = 5; // set minimum records
        $page_array = [];
        $list_data = $this->studentDataCollection->create();
        $list_count = ceil(count($list_data->getData()));
        $show_count = $minimum_show + 1;
        if (count($list_data->getData()) >= $show_count) {
            $list_count = $list_count / $minimum_show;
            $page_nu = $total = $minimum_show;
            $page_array[$minimum_show] = $minimum_show;
            for ($x = 0; $x <= $list_count; $x++) {
                $total = $total + $page_nu;
                $page_array[$total] = $total;
            }
        } else {
            $page_array[$minimum_show] = $minimum_show;
            $minimum_show = $minimum_show + $minimum_show;
            $page_array[$minimum_show] = $minimum_show;
        }
        return $page_array;
    }
}
