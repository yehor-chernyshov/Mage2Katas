<?php


namespace ProjectEight\ServiceContractsExampleWithApi\Api\Data;

interface BeefburgerWithPicklesInterface
{

    const NAME = 'name';
    const BEEFBURGERWITHPICKLES_ID = 'beefburgerwithpickles_id';


    /**
     * Get beefburgerwithpickles_id
     * @return string|null
     */
    
    public function getBeefburgerwithpicklesId();

    /**
     * Set beefburgerwithpickles_id
     * @param string $beefburgerwithpickles_id
     * @return ProjectEight\ServiceContractsExampleWithApi\Api\Data\BeefburgerWithPicklesInterface
     */
    
    public function setBeefburgerwithpicklesId($beefburgerwithpicklesId);

    /**
     * Get name
     * @return string|null
     */
    
    public function getName();

    /**
     * Set name
     * @param string $name
     * @return ProjectEight\ServiceContractsExampleWithApi\Api\Data\BeefburgerWithPicklesInterface
     */
    
    public function setName($name);
}
