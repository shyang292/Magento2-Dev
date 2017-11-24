<?php
namespace Abm\RemoveDashForCustomOption\Plugin;
 
 
class AbstractType{

    public function afterGetOptionSku(\Magento\Catalog\Model\Product\Type\AbstractType $abstractType, $result)
    {
        return str_replace('-','',$result);
    }
}