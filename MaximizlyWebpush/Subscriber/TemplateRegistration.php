<?php

namespace MaximizlyWebpush\Subscriber;

use Enlight\Event\SubscriberInterface;

class TemplateRegistration implements SubscriberInterface
{
    /**
     * @var string
     */
    private $pluginDirectory;

    /**
     * @var \Enlight_Template_Manager
     */
    private $templateManager;

    /**
     * @param $pluginDirectory
     * @param \Enlight_Template_Manager $templateManager
     */
    public function __construct($pluginDirectory, \Enlight_Template_Manager $templateManager)
    {
        $this->pluginDirectory = $pluginDirectory;
        $this->templateManager = $templateManager;
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            'Theme_Inheritance_Template_Directories_Collected' => 'onCollectTemplateDir',
        ];
    }

    /**
     * Adds the template directory to the TemplateManager
     */
    public function onCollectTemplateDir(\Enlight_Event_EventArgs $args)
    {
        $dirs = $args->getReturn();
        $dirs[] = $this->pluginDirectory . '/Resources/views/';

        $args->setReturn($dirs);
    }
}
