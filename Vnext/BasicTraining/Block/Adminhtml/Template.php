<?php
namespace Vnext\BasicTraining\Block\Adminhtml;
class Template extends \Magento\Backend\Block\Template
{
//    public function __construct(\Magento\Framework\View\Element\Template\Context $context)
//    {
//        parent::__construct($context);
//    }

    public function sayHello()
    {
        return __('Hello World');
    }

    public function edit()
    {
        return __('This is edit page');
    }

    public function delete()
    {
        return __('This is delete page');
    }
}
