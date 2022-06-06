<?php
namespace Vnext\BasicTraining\Controller\Index;

use Magento\Backend\Model\View\Result\ForwardFactory;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Store\Model\ScopeInterface;

class Index extends \Magento\Framework\App\Action\Action
{
    protected $resultPageFactory;
    protected $scopeConfig;
    protected $url;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        ScopeConfigInterface $scopeConfig
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->scopeConfig = $scopeConfig;
        parent::__construct($context);
    }

    public function execute()
    {
        $configValue = $this->scopeConfig->getValue('training/general/enable', ScopeInterface::SCOPE_WEBSITE);
        $sortKey = $this->getRequest()->getParam('key');
        if ($configValue == 0){
            $resultPage = $this->resultRedirectFactory->create();
            $resultPage->setPath('noRoute');
        }else{
            $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
            $resultPage = $this->resultPageFactory->create();
            if (!$sortKey){
                $resultPage->getConfig()->getTitle()->set(__('Custom Pagination'));
            }else{
                $resultPage->getConfig()->getTitle()->set(__('Sort Pagination'));
            }
        }
        return $resultPage;
    }
}
