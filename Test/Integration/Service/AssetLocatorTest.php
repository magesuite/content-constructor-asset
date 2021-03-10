<?php

namespace MageSuite\ContentConstructorAsset\Test\Integration\Service;

class AssetLocatorTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var \Magento\TestFramework\ObjectManager
     */
    protected $objectManager;

    /**
     * @var \MageSuite\ContentConstructor\AssetLocator
     */
    protected $locator;

    public function setUp(): void
    {
        $this->objectManager = \Magento\TestFramework\ObjectManager::getInstance();

        $this->locator = $this->objectManager
            ->get(\MageSuite\ContentConstructorAsset\Service\AssetLocator::class);
    }

    /**
     * @magentoAppArea adminhtml
     */
    public function testItReturnsCorrectUrlForAdminArea()
    {
        $expectedUrl = $this->prepareRegexUrl('http://localhost/static/version([0-9]+?)/adminhtml/Magento/backend/en_US/MageSuite_ContentConstructorAsset/images/sprites.svg');

        $assertRegExp = method_exists($this, 'assertMatchesRegularExpression') ? 'assertMatchesRegularExpression' : 'assertRegExp';

        $url = $this->locator->getUrl('images/sprites.svg');
        $url = str_replace('pub/', '', $url);
        $this->$assertRegExp(
            $expectedUrl,
            $url
        );
    }

    /**
     * @magentoAppArea frontend
     */
    public function testItReturnsCorrectUrlForFrontend()
    {
        $expectedUrl = $this->prepareRegexUrl('http://localhost/static/version([0-9]+?)/frontend/Magento/luma/en_US/images/sprites.svg');

        $assertRegExp = method_exists($this, 'assertMatchesRegularExpression') ? 'assertMatchesRegularExpression' : 'assertRegExp';

        $url = $this->locator->getUrl('images/sprites.svg');
        $url = str_replace('pub/', '', $url);
        $this->$assertRegExp(
            $expectedUrl,
            $url
        );
    }

    protected function prepareRegexUrl($url)
    {
        $url = str_replace('/', '\/', $url);
        return sprintf('/%s/', $url);
    }
}
