<?php
namespace Craft;

/**
 * Events - Event model
 */
class Ukplaces_PlaceModel extends BaseModel
{

	public function __toString() {
		return $this->town;
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
