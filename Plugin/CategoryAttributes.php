<?php
namespace FutureActivities\Api\Plugin;

use Magento\Catalog\Api\Data\CategoryExtensionInterface;
use Magento\Catalog\Api\Data\CategoryInterface;
use Magento\Catalog\Api\Data\CategoryExtensionFactory;

class CategoryAttributes
{
    /**
     * @var CategoryExtensionFactory
     */
    private $extensionFactory;

    /**
     * @param CategoryExtensionFactory $extensionFactory
     */
    public function __construct(CategoryExtensionFactory $extensionFactory)
    {
        $this->extensionFactory = $extensionFactory;
    }

    /**
     * Loads category entity extension attributes
     *
     * @param CategoryInterface $entity
     * @param CategoryExtensionInterface|null $extension
     * @return CategoryExtensionInterface
     */
    public function afterGetExtensionAttributes(
        CategoryInterface $entity,
        CategoryExtensionInterface $extension = null
    ) {
        if ($extension === null) {
            $extension = $this->extensionFactory->create();
        }

        return $extension;
    }
}