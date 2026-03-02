<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Validator;

use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class ValidatorDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const PLUGINS_VALIDATOR = 'PLUGINS_VALIDATOR';

    /**
     * @var string
     */
    public const PLUGINS_CONSTRAINT = 'PLUGINS_CONSTRAINT';

    public function provideCommunicationLayerDependencies(Container $container): Container
    {
        $container = $this->addValidatorPlugins($container);
        $container = $this->addConstraintPlugins($container);

        return $container;
    }

    protected function addValidatorPlugins(Container $container): Container
    {
        $container->set(static::PLUGINS_VALIDATOR, function () {
            return $this->getValidatorPlugins();
        });

        return $container;
    }

    /**
     * @return array<\Spryker\Shared\ValidatorExtension\Dependency\Plugin\ValidatorPluginInterface>
     */
    protected function getValidatorPlugins(): array
    {
        return [];
    }

    protected function addConstraintPlugins(Container $container): Container
    {
        $container->set(static::PLUGINS_CONSTRAINT, function () {
            return $this->getConstraintPlugins();
        });

        return $container;
    }

    /**
     * @return array<\Spryker\Shared\ValidatorExtension\Dependency\Plugin\ConstraintPluginInterface>
     */
    protected function getConstraintPlugins(): array
    {
        return [];
    }
}
