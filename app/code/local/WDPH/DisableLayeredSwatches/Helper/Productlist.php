<?php
class WDPH_DisableLayeredSwatches_Helper_Productlist extends Mage_ConfigurableSwatches_Helper_Productlist
{
	public function convertLayerBlock($blockName)
    {		
        if (Mage::helper('configurableswatches')->isEnabled()
			&& Mage::helper('configurableswatches')->isEnabledLayered()
            && ($block = Mage::app()->getLayout()->getBlock($blockName))
            && $block instanceof Mage_Catalog_Block_Layer_View			
        ) {

            // First, set a new template for the attribute that should show as a swatch
            if ($layer = $block->getLayer()) {
                foreach ($layer->getFilterableAttributes() as $attribute) {
                    if (Mage::helper('configurableswatches')->attrIsSwatchType($attribute) && Mage::helper('configurableswatches')->attrIsSwatchTypeLayered($attribute)) {
                        $block->getChild($attribute->getAttributeCode() . '_filter')
                            ->setTemplate('configurableswatches/catalog/layer/filter/swatches.phtml');
                    }
                }
            }

            // Then set a specific renderer block for showing "currently shopping by" for the swatch attribute
            // (block class takes care of determining which attribute is applicable)
            if ($stateRenderersBlock = $block->getChild('state_renderers')) {
                $swatchRenderer = Mage::app()->getLayout()
                    ->addBlock('configurableswatches/catalog_layer_state_swatch', 'product_list.swatches');
                $swatchRenderer->setTemplate('configurableswatches/catalog/layer/state/swatch.phtml');
                $stateRenderersBlock->append($swatchRenderer);
            }
        }
    }
}
?>