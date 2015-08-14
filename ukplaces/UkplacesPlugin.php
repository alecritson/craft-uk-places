<?php
namespace Craft;

class UkplacesPlugin extends BasePlugin
{

    public function getName()
    {
        return Craft::t('UK places FieldType');
    }

    public function getVersion()
    {
        return '0.0.1';
    }

    public function getDeveloper()
    {
        return 'Alec Ritson';
    }

    public function getDeveloperUrl()
    {
        return 'itsalec.co.uk';
    }

    public function onAfterInstall()
    {
        $path = craft()->path->getPluginsPath() . 'ukplaces/data/towns.csv';

        $csvData = array_map('str_getcsv', file($path));;

        unset($csvData[0]);

        $records = array();

        foreach($csvData as $row)
        {
            $record = new Ukplaces_PlaceRecord();
            $record->postcode = $row[0];
            $record->eastings = $row[1];
            $record->northings = $row[2];
            $record->latitude = $row[3];
            $record->longitude = $row[4];
            $record->town = $row[5];
            $record->region = $row[6];
            $record->country = $row[8];
            $record->countryCode = $row[7];

            $record->save();
        }

    }
}
