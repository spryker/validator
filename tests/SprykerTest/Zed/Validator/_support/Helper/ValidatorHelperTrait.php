<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerTest\Zed\Validator\Helper;

use Codeception\Module;

trait ValidatorHelperTrait
{
    protected function getValidatorHelper(): ValidatorHelper
    {
        /** @var \SprykerTest\Zed\Validator\Helper\ValidatorHelper $validatorHelper */
        $validatorHelper = $this->getModule('\\' . ValidatorHelper::class);

        return $validatorHelper;
    }

    abstract protected function getModule(string $name): Module;
}
