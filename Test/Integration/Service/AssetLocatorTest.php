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

    protected ?\Magento\Framework\View\DesignInterface $design;

    public function setUp(): void
    {
        $this->objectManager = \Magento\TestFramework\ObjectManager::getInstance();
        $this->locator = $this->objectManager
            ->get(\MageSuite\ContentConstructorAsset\Service\AssetLocator::class);
        $this->design = $this->objectManager->get(\Magento\Framework\View\DesignInterface::class);
    }

    /**
     * @magentoAppArea adminhtml
     */
    public function testItReturnsCorrectUrlForAdminArea()
    {
        $theme = $this->design->getDesignTheme();
        $expectedUrl = $this->prepareRegexUrl("http://localhost/static/version([0-9]+?)/adminhtml/{$theme->getCode()}/en_US/MageSuite_ContentConstructorAsset/images/sprites.svg");

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
        $theme = $this->design->getDesignTheme();
        $expectedUrl = $this->prepareRegexUrl("http://localhost/static/version([0-9]+?)/frontend/{$theme->getCode()}/en_US/images/sprites.svg");

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
