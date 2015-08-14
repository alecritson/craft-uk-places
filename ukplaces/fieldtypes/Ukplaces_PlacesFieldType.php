<?php
namespace Craft;

class Ukplaces_PlacesFieldType extends BaseFieldType
{
    public function getName()
    {
        return Craft::t('UK places dropdown');
    }

    public function getInputHtml($name, $value)
    {
        return craft()->templates->render('ukplaces/input', array(
            'name'  => $name,
            'settings' => $this->getSettings(),
            'value' => $value
        ));
    }

    protected function defineSettings()
    {
        return array(
            'column' => AttributeType::String,
            'regions' => array(AttributeType::String),
            'countries' => array(AttributeType::String)
        );
    }

    public function getSettingsHtml()
    {
        return craft()->templates->render('ukplaces/inputSettings', array(
            'settings' => $this->getSettings()
        ));
    }

    public function prepValue($value)
    {
        return craft()->ukplaces->findPlaceById($value);
    }
}