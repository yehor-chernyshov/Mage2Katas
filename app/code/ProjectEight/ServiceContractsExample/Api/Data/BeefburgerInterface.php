<?php


namespace ProjectEight\ServiceContractsExample\Api\Data;

interface BeefburgerInterface
{

    const NAME = 'name';
    const BEEFBURGER_ID = 'beefburger_id';


    /**
     * Get beefburger_id
     * @return string|null
     */
    
    public function getBeefburgerId();

    /**
     * Set beefburger_id
     * @param string $beefburger_id
     * @return ProjectEight\ServiceContractsExample\Api\Data\BeefburgerInterface
     */
    
    public function setBeefburgerId($beefburgerId);

    /**
     * Get name
     * @return string|null
     */
    
    public function getName();

    /**
     * Set name
     * @param string $name
     * @return ProjectEight\ServiceContractsExample\Api\Data\BeefburgerInterface
     */
    
    public function setName($name);
}
