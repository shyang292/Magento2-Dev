<?php
namespace Abm\RemoveDashForCustomOption\Block;

class Renderer extends \Magento\Checkout\Block\Cart\Item\Renderer{
    /**
     * Retrieve current product model
     *
     * @return \Magento\Catalog\Model\Product
     */
    public function getProductSku(){
        return $this->getItem()->getSku();
    }
}
