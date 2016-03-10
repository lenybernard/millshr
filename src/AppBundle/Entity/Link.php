<?php

namespace AppBundle\Entity;

use AppBundle\Constraint\AvoidStress;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Link
 *
 * @AvoidStress()
 * @ORM\Table(name="link")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LinkRepository")
 */
class Link
{
    use TimestampableEntity;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
    }

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @Assert\NotNull()
     * @ORM\Column(name="name", type="string", length=55)
     * @Gedmo\Translatable
     */
    private $name;

    /**
     * @var Category
     *
     * @Assert\NotNull()
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Category", inversedBy="link")
     */
    private $category;

    /**
     * @var string
     *
     * @Assert\NotNull()
     * @ORM\Column(name="author", type="string", length=255)
     */
    private $author;

//     * @Assert\Regex("/^(http|https):\/\/facebook.com/", match="false")
    /**
     * @var string
     *
     * @Assert\NotNull()
     * @Assert\Url()
     * @ORM\Column(name="url", type="string", length=255)
     */
    private $url;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Tag", inversedBy="link")
     * @ORM\JoinTable(name="links_tags")
     */
    protected $tags;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Link
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set category
     * @param Category $category
     *
     * @return Link
     */
    public function setCategory(Category $category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set author
     *
     * @param string $author
     * @return Link
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string 
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return Link
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Validate the url is not from facebook
     * @Assert\IsTrue(message="Ne partagez pas de liens Facebook.")
     */
    public function isNotFromFacebook()
    {
        return !preg_match('/^https?:\/\/(www.)?facebook.com/', $this->getUrl());
    }

    /**
     * @return Tag[]
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param Tag[] $tags
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
    }
}
