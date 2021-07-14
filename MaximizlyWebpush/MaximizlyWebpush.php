<?php

namespace MaximizlyWebpush;

use DreiscSeo\Bootstrap\SetupServiceAttributes;
use DreiscSeo\Bootstrap\SetupServiceDatabase;
use DreiscSeo\Bootstrap\SetupServicePluginRegistry;
use Shopware\Components\Plugin;
use Shopware\Components\Plugin\Context\ActivateContext;
use Shopware\Components\Plugin\Context\InstallContext;
use Shopware\Components\Plugin\Context\UpdateContext;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class MaximizlyWebpush extends Plugin
{
    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        $container->setParameter('maximizly_webpush.plugin_dir', $this->getPath());
        parent::build($container);
    }

    /**
     * Installation / Update durch die installPlugin Methode
     *
     * @param InstallContext $installContext
     * @return array
     */
    public function install(InstallContext $installContext)
    {
        $this->installPlugin();

        return array('success' => true);
    }

    /**
     * Installation / Update durch die installPlugin Methode
     *
     * @param UpdateContext $context
     * @return bool
     */
    public function update(UpdateContext $context)
    {
        $this->installPlugin($context->getUpdateVersion());

        return true;
    }

    /**
     * Aktiviert das Plugin und löscht die erforderlichen Caches
     *
     * @return boolean
     */
    public function activate(ActivateContext $context)
    {
        $context->scheduleClearCache(InstallContext::CACHE_LIST_ALL);
    }

    /**
     * Registriert sich auf das startDispatch Event, um hier dynamisch
     * die weiteren Subscriber zu initialisieren
     *
     * @param null $currentVersion
     * @return boolean
     */
    public function installPlugin($currentVersion = null)
    {
        $this->runSetupServices();
    }

    /**
     * Startet die vorhandenen Setup Services
     */
    public function runSetupServices()
    {
        $pubDir = $_SERVER["DOCUMENT_ROOT"];

        file_put_contents($pubDir.'/maximizly-sw.js', "importScripts('https://maximizly.s3.eu-central-1.amazonaws.com/sources/webpush/develop/worker/maximizly-sw.js')");
    }
}
