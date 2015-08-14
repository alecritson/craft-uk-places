<?php
namespace Craft;

class EnglishplacesVariable
{

    public function get($column, $filters = array())
    {
        return craft()->englishplaces->get($column, $filters);
    }
   
}