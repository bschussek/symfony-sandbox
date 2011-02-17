<?php

/*
 * This file is part of the Sonata project.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Liip\BlogBundle\Entity;

/**
 * @orm:Entity
 * @orm:HasLifecycleCallbacks
 */
class Tag
{
    /**
     * @orm:Id
     * @orm:Column(type="integer")
     * @orm:GeneratedValue
     * @validation:AssertType("integer")
     */
    protected $id;

    /**
     * @orm:Column(type="string", length="255")
     * @validation:AssertType("string")
     * @validation:MaxLength(255)
     * @validation:NotNull
     */
    protected $name;

    /**
     * @orm:Column(type="string", length="255")
     * @validation:AssertType("string")
     * @validation:MaxLength(255)
     * @validation:NotNull
     */
    protected $slug;

    /**
     * @orm:Column(type="datetime")
     * @validation:AssertType("\DateTime")
     * @validation:NotNull(groups="PrePersist")
     */
    protected $createdAt;

    /**
     * @orm:Column(type="datetime")
     * @validation:AssertType("\DateTime")
     * @validation:NotNull(groups="PrePersist")
     */
    protected $updatedAt;

    /**
     * @orm:Column(type="boolean")
     * @validation:AssertType("boolean")
     * @validation:NotNull
     */
    protected $enabled;

    /**
     * @orm:ManyToMany(targetEntity="Post", inversedBy="tags")
     */
    protected $posts;

    /**
     * @orm:PrePersist
     */
    public function prePersist()
    {
        $this->setCreatedAt(new \DateTime);
        $this->setUpdatedAt(new \DateTime);
    }

    /**
     * @orm:PreUpdate
     */
    public function preUpdate()
    {
        $this->setUpdatedAt(new \DateTime);
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;

        $this->setSlug(self::slugify($name));
    }

    /**
     * Get name
     *
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
    }

    /**
     * Get enabled
     *
     * @return boolean $enabled
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Set slug
     *
     * @param integer $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * Get slug
     *
     * @return integer $slug
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set created_at
     *
     * @param datetime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * Get created_at
     *
     * @return datetime $createdAt
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updated_at
     *
     * @param datetime $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * Get updated_at
     *
     * @return datetime $updatedAt
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * source : http://snipplr.com/view/22741/slugify-a-string-in-php/
     *
     * @static
     * @param  $text
     * @return mixed|string
     */
    static public function slugify($text)
    {

        // replace non letter or digits by -
        $text = preg_replace('~[^\\pL\d]+~u', '-', $text);

        // trim
        $text = trim($text, '-');

        // transliterate
        if (function_exists('iconv'))
        {
            $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        }

        // lowercase
        $text = strtolower($text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        if (empty($text))
        {
            return 'n-a';
        }

        return $text;
    }
    /**
     * Add posts
     *
     * @param Liip\BlogBundle\Entity\Post $posts
     */
    public function addPosts(\Liip\BlogBundle\Entity\Post $posts)
    {
        $this->posts[] = $posts;
    }

    /**
     * Get posts
     *
     * @return Doctrine\Common\Collections\Collection $posts
     */
    public function getPosts()
    {
        return $this->posts;
    }

    public function __toString()
    {
        return $this->getName();
    }
}