<?php

namespace Liip\BlogBundle\Constraints;

use Symfony\Component\Validator\Constraint;

class Unique extends Constraint
{
    public $message = 'This value is not unique';

    public function validatedBy()
    {
        return 'liip.validator.unique';
    }

    public function targets()
    {
        return self::PROPERTY_CONSTRAINT;
    }
}