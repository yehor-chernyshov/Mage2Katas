<?php


namespace ProjectEight\ServiceContractsExampleWithApi\Model;

class SaveBeefburgerWithPicklesManagement
{

    /**
     * {@inheritdoc}
     */
    public function putSaveBeefburgerWithPickles($param)
    {
        return 'hello api PUT return the $param ' . $param;
    }

    /**
     * {@inheritdoc}
     */
    public function postSaveBeefburgerWithPickles($param)
    {
        return 'hello api POST return the $param ' . $param;
    }
}
