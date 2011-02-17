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
        $this->setDataClass('Liip\BlogBundle\Entity\Post');
        $this->add('title');
        $this->add('content');
        $this->add('abstract');
        $this->add('enabled');
        $this->add(new DateField('publicationDateStart'));
        $this->add(new ChoiceField('commentsDefaultStatus', array(
            'choices' => Comment::getStatusCodes(),
        )));
        $this->add('tags', array('expanded' => true));

        $commentForm = Form::create($this->getContext());
        $commentForm->setDataClass('Liip\BlogBundle\Entity\Comment');
        $commentForm->add('name');
        $commentForm->add('message');

        $this->add(new CollectionField('comments', array(
            'prototype' => $commentForm,
        )));
    }
}