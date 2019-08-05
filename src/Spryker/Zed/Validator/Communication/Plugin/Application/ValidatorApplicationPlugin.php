<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Validator\Communication\Plugin\Application;

use Spryker\Service\Container\ContainerInterface;
use Spryker\Shared\ApplicationExtension\Dependency\Plugin\ApplicationPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Symfony\Component\Validator\ValidatorBuilderInterface;

/**
 * @method \Spryker\Zed\Validator\Communication\ValidatorCommunicationFactory getFactory()
 */
class ValidatorApplicationPlugin extends AbstractPlugin implements ApplicationPluginInterface
{
    protected const SERVICE_VALIDATOR = 'validator';

    /**
     * {@inheritdoc}
     * - Adds `validator` service.
     *
     * @api
     *
     * @param \Spryker\Service\Container\ContainerInterface $container
     *
     * @return \Spryker\Service\Container\ContainerInterface
     */
    public function provide(ContainerInterface $container): ContainerInterface
    {
        $container = $this->addValidatorService($container);

        return $container;
    }

    /**
     * @param \Spryker\Service\Container\ContainerInterface $container
     *
     * @return \Spryker\Service\Container\ContainerInterface
     */
    protected function addValidatorService(ContainerInterface $container): ContainerInterface
    {
        $container->set(static::SERVICE_VALIDATOR, function (ContainerInterface $container) {
            $validatorBuilder = $this->getFactory()->createValidatorBuilder();

            $validatorBuilder = $this->extendValidator($validatorBuilder, $container);

            return $validatorBuilder->getValidator();
        });

        return $container;
    }

    /**
     * @return \Spryker\Shared\ValidatorExtension\Dependency\Plugin\ValidatorPluginInterface[]
     */
    protected function getValidatorPlugins(): array
    {
        return array_merge($this->getFactory()->getCoreValidatorPlugins(), $this->getFactory()->getValidatorPlugins());
    }

    /**
     * @param \Symfony\Component\Validator\ValidatorBuilderInterface $validatorBuilder
     * @param \Spryker\Service\Container\ContainerInterface $container
     *
     * @return \Symfony\Component\Validator\ValidatorBuilderInterface
     */
    protected function extendValidator(ValidatorBuilderInterface $validatorBuilder, ContainerInterface $container): ValidatorBuilderInterface
    {
        foreach ($this->getValidatorPlugins() as $validatorPlugin) {
            $validatorBuilder = $validatorPlugin->extend($validatorBuilder, $container);
        }

        return $validatorBuilder;
    }
}
