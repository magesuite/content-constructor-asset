<?php
\Magento\Framework\Component\ComponentRegistrar::register(
    \Magento\Framework\Component\ComponentRegistrar::MODULE,
    'MageSuite_ContentConstructorAsset',
    __DIR__
);

$path = '../../../content-constructor-admin/dist';

if(!is_link(__DIR__.'/view/adminhtml/web')) {
    symlink($path, __DIR__.'/view/adminhtml/web');
}

if(!is_link(__DIR__.'/view/frontend/web')) {
    symlink($path, __DIR__.'/view/frontend/web');
}
