<?php
namespace App\Models;

use Phalcon\Di\DiInterface;

class Articles extends \Phalcon\Mvc\Model{

    public function initialize(){
        $this->setSource('articles');
    }

    public function beforeCreate(){
        if($this->getDatePublish() != null && $this->getDatePublish() instanceof \DateTime){
            $this->date_publish = $this->getDatePublish()->format('Y-m-d H:i');
        }
        if($this->getDateCreated() != null && $this->getDateCreated() instanceof \DateTime){
            $this->date_created = $this->getDateCreated()->format('Y-m-d H:i');
        }
    }

    public function beforeUpdate(){
        if($this->getDatePublish() != null && $this->getDatePublish() instanceof \DateTime){
            $this->date_publish = $this->getDatePublish()->format('Y-m-d H:i');
        }
        if($this->getDateCreated() != null && $this->getDateCreated() instanceof \DateTime){
            $this->date_created = $this->getDateCreated()->format('Y-m-d H:i');
        }
    }

    protected $id;
    protected $title;
    protected $short_description;
    protected $content;
    protected $date_created;
    protected $date_publish;


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getShortDescription()
    {
        return $this->short_description;
    }

    /**
     * @param string $short_description
     */
    public function setShortDescription($short_description)
    {
        $this->short_description = $short_description;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return \DateTime
     */
    public function getDateCreated()
    {
        return $this->date_created;
    }

    /**
     * @param \DateTime
     */
    public function setDateCreated($date_created)
    {
        $this->date_created = $date_created;
    }

    /**
     * @return \DateTime
     */
    public function getDatePublish()
    {
        return $this->date_publish;
    }

    /**
     * @param \DateTime $date_publish
     */
    public function setDatePublish($date_publish)
    {
        $this->date_publish = $date_publish;
    }
}