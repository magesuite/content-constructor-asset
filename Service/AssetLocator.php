<?php

namespace MageSuite\ContentConstructorAsset\Service;

class AssetLocator
{
    /**
     * @var \Magento\Framework\View\Asset\Repository
     */
    private $assetRepository;
    /**
     * @var \Magento\Framework\App\State
     */
    private $state;

    public function __construct(
        \Magento\Framework\View\Asset\Repository $assetRepository,
        \Magento\Framework\App\State $state
    ) {
        $this->assetRepository = $assetRepository;
        $this->state = $state;
    }

    /**
     * Returns URL of an asset.
     * @param $assetId
     * @return string
     */
    public function getUrl(string $assetLocation)
    {
        if($this->state->getAreaCode() == 'adminhtml') {
            $assetLocation = 'MageSuite_ContentConstructorAsset::' . $assetLocation;
        }

        return $this
            ->assetRepository
            ->createAsset($assetLocation)
            ->getUrl();
    }
}