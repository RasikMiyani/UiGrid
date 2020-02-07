<?php 
namespace Rasik\Custom\Model;

use Rasik\Custom\Model\ResourceModel\Custom\CollectionFactory;

/**
 * Class DataProvider
 */
class DataProviderEdit extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @var \Magento\Cms\Model\ResourceModel\Block\Collection
     */
    protected $collection;

    
    protected $dataPersistor;

    /**
     * @var array
     */
    public    $storeManager;    

    protected $_loadedData;

    /**
     * Constructor
     *
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $blockCollectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $colorCollectionFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $colorCollectionFactory->create();
        $this->_storeManager=$storeManager;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {   
        $mediaUrl =  $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
        if (isset($this->_loadedData)) {
            return $this->_loadedData;
        }
        $items = $this->collection->getItems();
        /** @var \Magento\Cms\Model\Block $block */
        foreach ($items as $custom) {
             $temp = $custom->getData();
             /*echo "<pre>";
             print_r($temp);
             die();*/
             /*if($temp['hexswatch']):
                $img = [];
                $img[0]['image'] = $temp['hexswatch'];
                $img[0]['url'] = $mediaUrl.'test/'.$temp['hexswatch'];
                $temp['hexswatch'] = $img;
             endif;*/
            $custom->setData($temp);
            $this->_loadedData[$custom->getId()] = $temp;
            /*echo "<pre>";
            echo "helllo";
            print_r($this->_loadedData);
            die();*/
            return $this->_loadedData;
        }
    }
}