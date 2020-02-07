<?php

namespace Rasik\Custom\Model;

class CustomFactory
{
    /**
     * @var \Magento\Framework\ObjectManagerInterface
     */
    protected $_objectManager;

    /**
     * @param \Magento\Framework\ObjectManagerInterface $objectManager
     */
    public function __construct(\Magento\Framework\ObjectManagerInterface $objectManager)
    {
        $this->_objectManager = $objectManager;
    }

    /**
     *
     * @param array $arguments
     */
    public function create(array $arguments = [])
    {
        return $this->_objectManager->create('Rasik\Custom\Model\Custom', $arguments, false);
    }
}
