<?php

namespace AntiMattr\GoogleBundle\Adwords;

class Conversion
{
    private $id;
    private $label;
    private $value;
    private $format;
    private $color;
    private $language;
    private $trackingUrl = 'https://www.googleadservices.com/pagead/conversion/';

    public function __construct($id, $label, $value, $format, $color, $language)
    {
        $this->id = $id;
        $this->label = $label;
        $this->value = $value;
        $this->format = $format;
        $this->color = $color;
        $this->language = $language;
    }

    public function getColor()
    {
        return $this->color;
    }

    public function getFormat()
    {
        return $this->format;
    }

    public function getLanguage()
    {
        return $this->language;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setTrackingUrl($trackingUrl)
    {
        $this->trackingUrl = $trackingUrl;
    }

    public function getTrackingUrl()
    {
        return $this->trackingUrl;
    }


}
