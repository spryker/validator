<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Validator\Communication\Plugin\Form;

use Spryker\Service\Container\ContainerInterface;
use Spryker\Shared\FormExtension\Dependency\Plugin\FormPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Form\FormFactoryBuilderInterface;

/**
 * @method \Spryker\Zed\Validator\Communication\ValidatorCommunicationFactory getFactory()
 */
class ValidatorFormPlugin extends AbstractPlugin implements FormPluginInterface
{
    /**
     * @var string
     */
    protected const SERVICE_VALIDATOR = 'validator';

    /**
     * {@inheritDoc}
     * - Adds `Symfony\Component\Form\Extension\Validator\ValidatorExtension`.
     *
     * @api
     *
     * @param \Symfony\Component\Form\FormFactoryBuilderInterface $formFactoryBuilder
     * @param \Spryker\Service\Container\ContainerInterface $container
     *
     * @return \Symfony\Component\Form\FormFactoryBuilderInterface
     */
    public function extend(FormFactoryBuilderInterface $formFactoryBuilder, ContainerInterface $container): FormFactoryBuilderInterface
    {
        $formFactoryBuilder->addExtension(
            $this->createValidatorExtension($container),
        );

        return $formFactoryBuilder;
    }

    /**
     * @param \Spryker\Service\Container\ContainerInterface $container
     *
     * @return \Symfony\Component\Form\Extension\Validator\ValidatorExtension
     */
    protected function createValidatorExtension(ContainerInterface $container): ValidatorExtension
    {
        return new ValidatorExtension(
            $container->get(static::SERVICE_VALIDATOR),
        );
    }
}
