<?php

namespace Rasik\Custom\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;
use Rasik\Custom\Custom\Model\Custom;
use Magento\Backend\Model\Session;

class Delete extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $sampleTypeDataPersistor;

    /**
     * @var Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var Rasik\Custom\Custom\Model\Custom
     */
    protected $customModel;

    /**
     * @param Magento\Backend\App\Action\Context                   $context    
     * @param Magento\Framework\View\Result\PageFactory            $resultPageFactory
     * @param Magento\Framework\App\Request\DataPersistorInterface $sampleTypeDataPersistor
     * @param Rasik\Custom\Custom\Model\Custom              $customModel
     */
     public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        DataPersistorInterface $sampleTypeDataPersistor,
        Custom $customModel
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->dataPersistor = $sampleTypeDataPersistor;
        $this->customModel = $customModel;
        parent::__construct($context); 
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        if (!($customModel = $this->customModel->load($id))) {
            $this->messageManager->addError(__('Unable to proceed. Please, try again.'));
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/*/index', array('_current' => true));
        }
        try{
            $customModel->delete();
            $this->messageManager->addSuccess(__('data has been deleted !'));
        } catch (Exception $e) {
            $this->messageManager->addError(__('Error while trying to delete data'));
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/*/index', array('_current' => true));
        }
        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('*/*/index', array('_current' => true));
    }
}
