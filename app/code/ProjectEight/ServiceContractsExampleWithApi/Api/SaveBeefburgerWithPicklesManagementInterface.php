<?php


namespace ProjectEight\ServiceContractsExampleWithApi\Api;

interface SaveBeefburgerWithPicklesManagementInterface
{


    /**
     * PUT for saveBeefburgerWithPickles api
     * @param string $param
     * @return string
     */
    
    public function putSaveBeefburgerWithPickles($param);

    /**
     * POST for saveBeefburgerWithPickles api
     * @param string $param
     * @return string
     */
    
    public function postSaveBeefburgerWithPickles($param);
}
