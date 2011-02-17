<?php

/*
 * This file is part of the Sonata project.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Liip\BlogBundle\Form;

use Liip\BlogBundle\Entity\Comment;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\CollectionField;
use Symfony\Component\Form\ChoiceField;
use Symfony\Component\Form\DateField;

class PostForm extends Form
{
    protected function configure()
    {
        // setup form here
    }
}