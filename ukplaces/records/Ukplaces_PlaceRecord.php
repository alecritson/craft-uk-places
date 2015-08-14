<?php
namespace Craft;

/**
 * Events - Event record
 */
class Ukplaces_PlaceRecord extends BaseRecord
{
	/**
	 * @return string
	 */
	public function getTableName()
	{
		return 'uk_places';
	}

	/**
	 * @access protected
	 * @return array
	 */
	protected function defineAttributes()
	{
		return array(
			'postcode' => AttributeType::String,
			'eastings' => AttributeType::String,
			'northings' => AttributeType::String,
			'latitude' => AttributeType::String,
			'longitude' => AttributeType::String,
			'town' => AttributeType::String,
			'region' => AttributeType::String,
			'country' => AttributeType::String,
			'countryCode' => AttributeType::String,
		);
	}
}
