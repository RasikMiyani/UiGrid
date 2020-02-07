<?php
namespace Rasik\Custom\Controller\Adminhtml\Index;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;
use Rasik\Custom\Model\Custom;

class Save extends \Magento\Backend\App\Action
{
  
  /**
   * @var PageFactory
   */
  private $resultPageFactory;

  /**
   * @var Custom
   */
  private $customModel;

  /**
   * @param Context $context
   * @param PageFactory $resultPageFactory
   * @param Custom $customModel
   */
  public function __construct(
    Context $context,
    PageFactory $resultPageFactory,
    Custom $customModel
  ) {
    
    $this->resultPageFactory = $resultPageFactory;
    $this->customModel = $customModel;
    parent::__construct($context); 
  }

  public function execute()
  {
      $postData = $this->getRequest()->getParams();
      $refererUrl = $this->_redirect->getRefererUrl();
      if ($postData) {
        $customModel = $this->customModel;
        $id = $this->getRequest()->getParam('id');
        $customModel->load($id);
        $customModel->setData('name', $postData['name'])
                        ->setData('email', $postData['email']);
        try {
          $customModel->save();
          $this->messageManager->addSuccess(__('The data has been saved.'));
          $this->_objectManager->get('Magento\Backend\Model\Session')->setFormData(false);
          if ($this->getRequest()->getParam('back')) {
            $this->_redirect('*/*/edit', array('id' => $customModel->getId(), '_current' => true));
            return;
          }
          $this->_redirect('*/*/');
          return;
        } catch (\Magento\Framework\Model\Exception $e) {
          $this->messageManager->addError($e->getMessage());
        } catch (\RuntimeException $e) {
          $this->messageManager->addError($e->getMessage());
        } catch (\Exception $e) {
          $this->messageManager->addException($e, __('Something went wrong while saving the color.'));

        }
        return;
      }
      $this->_redirect('*/*/');
  }
}
