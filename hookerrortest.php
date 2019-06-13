<?php

class HookErrorTest extends Module
{
    public function __construct($name = null, Context $context = null)
    {
        $this->name = 'hookerrortest';
        $this->author = 'Rokas';
        $this->version = '0.0.0';
        $this->displayName = 'Test new error message handling functionality in hooks. Create/update a customer to see error messages from this module.';
        parent::__construct($name, $context);
    }

    public function install()
    {
        return parent::install()
            && $this->registerHook('actionAfterCreateCustomerFormHandler')
            && $this->registerHook('actionBeforeUpdateCustomerFormHandler')
        ;
    }

    public function hookActionAfterCreateCustomerFormHandler()
    {
        throw new \PrestaShop\PrestaShop\Core\Exception\ModuleException('Error message from module, thrown after handling customer creation');
    }

    public function hookActionBeforeUpdateCustomerFormHandler()
    {
        throw \PrestaShop\PrestaShop\Core\Exception\ModuleException::buildWithMessages([
            'Multiple(1) error messages from module, thrown before handling customer update',
            'Multiple(2) error message from module, thrown before handling customer update',
            'Multiple(3) error message from module, thrown before handling customer update',
        ]);
    }
}
