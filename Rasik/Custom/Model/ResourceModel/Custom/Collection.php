<?php

namespace Rasik\Custom\Model\ResourceModel\Custom;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    protected $_idFieldName = 'rasik_custom_id';
    protected $_eventPrefix = 'rasik_custom';
  	protected $_eventObject = 'rasik_custom_collection';
    
    /**
     * Define resource model
     *
     * @return void
     */

    protected function _construct()
    {
        $this->_init('Rasik\Custom\Model\Custom', 'Rasik\Custom\Model\ResourceModel\Custom');
    }
}
