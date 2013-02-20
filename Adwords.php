<?php

namespace AntiMattr\GoogleBundle;

use AntiMattr\GoogleBundle\Adwords\Conversion;
use Symfony\Component\DependencyInjection\ContainerInterface;

class Adwords
{
    const CONVERSION_KEY = 'google_adwords/conversion';

    private $activeConversion;
    private $container;
    private $conversions;

    public function __construct(ContainerInterface $container, array $conversions = array())
    {
        $this->container = $container;
        $this->conversions = $conversions;
    }

    /**
     * @param string $key
     */
    public function activateConversionByKey($key)
    {
        if (array_key_exists($key, $this->conversions)) {
            $this->container->get('session')->set(self::CONVERSION_KEY, $key);
        }
    }	

    /**
     * @return Conversion $conversion
     */
    public function getActiveConversion()
    {
        if ($this->hasActiveConversion()) {
            $key = $this->container->get('session')->get(self::CONVERSION_KEY);
            $this->container->get('session')->remove(self::CONVERSION_KEY);
            $config = array_merge(
                array(
                    'label' => null,
                    'value' => null,
                ),
                $this->conversions[$key]
            );
            $this->activeConversion = new Conversion($config['id'], $config['label'], $config['value']);
            if (isset($config['tracking_url'])) {
                $this->activeConversion->setTrackingUrl($config['tracking_url']);
            }
            unset($config['id'], $config['label'], $config['value'], $config['tracking_url']);
            foreach ($config as $key => $value) {
                $this->activeConversion->setParameter($key, $value);
            }
        }
        return $this->activeConversion;
    }

    /**
     * @param boolean $hasActiveConversion
     */
    public function hasActiveConversion()
    {
        return $this->container->get('session')->has(self::CONVERSION_KEY);
    }
}
