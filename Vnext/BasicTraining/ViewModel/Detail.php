<?php
namespace Vnext\BasicTraining\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Framework\Url\Helper\Data as UrlHelper;

class Detail implements ArgumentInterface
{
    /**
     * @var UrlHelper
     */
    private $urlHelper;

    public function __construct(
        UrlHelper $urlHelper,
        \Vnext\BasicTraining\Model\StudentFactory $student_factory
    )
    {
        $this->student_factory = $student_factory;
        $this->urlHelper = $urlHelper;
    }

    public function getDetail()
    {
//        $student =$this->getRequest()->getParam('ids');
        $result = $this->student_factory->create()->load(2);
        return $result;
    }
}
