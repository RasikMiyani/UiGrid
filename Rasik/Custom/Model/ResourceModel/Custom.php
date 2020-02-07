<?php

namespace Rasik\Custom\Model\ResourceModel;

class Custom extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('rasik_custom', 'rasik_custom_id');
    }
}
