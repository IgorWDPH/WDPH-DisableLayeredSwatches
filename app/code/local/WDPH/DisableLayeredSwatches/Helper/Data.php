<?php
class WDPH_DisableLayeredSwatches_Helper_Data extends Mage_ConfigurableSwatches_Helper_Data
{
	public function isEnabledLayered()
	{
		return Mage::getStoreConfig(parent::CONFIG_PATH_BASE . '/general/enabled_layered');
	}
	
	public function attrIsSwatchTypeLayered($attr)
    {
        if ($attr instanceof Varien_Object) {
            $attr = $attr->getId();
        }
        $configAttrs = $this->getSwatchAttributeIdsLayered();
        return in_array($attr, $configAttrs);
    }
	
	public function getSwatchAttributeIdsLayered()
    {
        return explode(',', Mage::getStoreConfig(parent::CONFIG_PATH_BASE . '/general/swatch_attributes_layered'));
    }
}
?>