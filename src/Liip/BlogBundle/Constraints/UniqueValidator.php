<?php

namespace Liip\BlogBundle\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Doctrine\ORM\EntityManager;

class UniqueValidator extends ConstraintValidator
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function isValid($value, Constraint $constraint)
    {
        $this->setMessage($constraint->message);

        return false;
    }
}