<?php

namespace VS7\CustomEntityAttributeSet\Block\Set\Plugin;

use Magento\Framework\Exception\NoSuchEntityException;

class View
{
    private $attributeSetRepository;

    public function __construct(
        \Magento\Eav\Api\AttributeSetRepositoryInterface $attributeSetRepository
    )
    {
        $this->attributeSetRepository = $attributeSetRepository;
    }

    public function afterGetAttributeSet(\Smile\CustomEntity\Block\Set\View $subject, $result)
    {
        $attributeSetId = (int)$subject->getData('attributeSetId');
        if (empty($attributeSetId)) return $result;

        try {
            $attributeSet = $this->attributeSetRepository->get($attributeSetId);
        } catch (NoSuchEntityException $exception) {
            return null;
        }

        return $attributeSet;
    }
}
