<?php

namespace Rasik\Custom\Model;

class Custom extends \Magento\Framework\Model\AbstractModel
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Rasik\Custom\Model\ResourceModel\Custom');
    }
}
