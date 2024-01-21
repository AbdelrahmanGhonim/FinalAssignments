<?php
namespace App\Models;

class Blog implements \JsonSerializable
{
    private $contentId;
    private $contentType;
    private $title;
    private $content;
    private $imageName;

   

    // Getter and setter for $contentType
    public function getContentType()
    {
        return $this->contentType;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }
    public function getContentId()
    {
        return $this->contentId;
    }

    public function setContentId($contentId)
    {
        $this->contentId =$contentId ;
    }
    public function getImageName()
    {
        return $this->imageName;
    }

    public function setImageName($imageName)
    {
        $this->imageName =$imageName ;
    }


    public function setContentType($contentType) {
        // Check if the provided goal is one of the defined enums
        $allContentType = [ContentEnum::ARTICLE, ContentEnum::RECIPE, ContentEnum::VIDEO, ContentEnum::WORKOUT];
        if (in_array($contentType, $allContentType)) {
            $this->contentType = $contentType;
        } else {
            // Handle invalid goal (you can throw an exception, set a default, etc.)
            // For now, I'll set a default value
            $this->contentType =ContentEnum::WORKOUT;
        }
    }

    public function jsonSerialize():mixed
    {
        $vars=get_object_vars($this);
        return $vars;
    }


}
