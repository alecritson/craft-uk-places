<?php
namespace Craft;

class UkplacesVariable
{

    public function get($column, $filters = array())
    {
        return craft()->ukplaces->get($column, $filters);
    }
   
}