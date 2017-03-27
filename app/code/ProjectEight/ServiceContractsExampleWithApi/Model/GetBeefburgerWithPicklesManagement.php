<?php


namespace ProjectEight\ServiceContractsExampleWithApi\Model;

class GetBeefburgerWithPicklesManagement
{

    /**
     * {@inheritdoc}
     */
    public function getGetBeefburgerWithPickles($param)
    {
        return 'hello api GET return the $param ' . $param;
    }
}
