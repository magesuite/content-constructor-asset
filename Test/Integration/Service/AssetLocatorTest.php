<?php

namespace MageSuite\ContentConstructorAsset\Test\Integration\Service;

class AssetLocatorTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var \MageSuite\ContentConstructor\AssetLocator
     */
    private $locator;

    /**
     * @var \Magento\TestFramework\ObjectManager
     */
    private $objectManager;

    public function setUp(): void {
        $this->objectManager = \Magento\TestFramework\ObjectManager::getInstance();

        $this->locator = $this->objectManager
            ->get(\MageSuite\ContentConstructorAsset\Service\AssetLocator::class);

    }

    /**
     * @magentoAppArea adminhtml
     */
    public function testItReturnsCorrectUrlForAdminArea() {
        $url = $this->prepareRegexUrl('http://localhost/pub/static/version([0-9]+?)/adminhtml/Magento/backend/en_US/MageSuite_ContentConstructorAsset/images/sprites.svg');

        $this->assertRegExp(
            $url,
            $this->locator->getUrl('images/sprites.svg')
        );
    }

    /**
     * @magentoAppArea frontend
     */
    public function testItReturnsCorrectUrlForFrontend() {
        $url = $this->prepareRegexUrl('http://localhost/pub/static/version([0-9]+?)/frontend/Magento/luma/en_US/images/sprites.svg');

        $this->assertRegExp(
            $url,
            $this->locator->getUrl('images/sprites.svg')
        );
    }

    protected function prepareRegexUrl($url) {
        $url = str_replace('/', '\/', $url);
        return sprintf('/%s/', $url);
    }
}
