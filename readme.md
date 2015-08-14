# English places fieldtype for Craft

The aim of this fieldtype is to provide an easy way to list UK towns and regions for use in select fields and templates.

## Installation
Put the `englishplaces` folder into your `craft/plugins` folder and install in the admin area.

> Installation might take a few seconds due to table population

## Usage
Choose `English places` when you create a new field and choose one of the options:

- **Towns** Will display a dropdown of towns grouped by region
- **Regions** Will display a dropdown of regions

If you choose towns, the list pretty large, which if you don't want all of the towns you can limit it by region or country.

### Templates
When using this fieldtype in your templates, you will be given an instance of `Englishplaces_PlaceModel` which you can use to get various bits of information about the place you have selected. Available attributes are:

- `postcode` - The first set of chracters from postcode i.e LD7
- `eastings` - A number representing eastward distance on a map
- `northings` - A number representing northward distance on a map
- `latitude` - The general latitude of the place
- `longitude` - The general longitude of the place
- `town` - The town name in the place, if you have selected a region then this will be the first one in the database
- `region` - The region the place is in
- `country` - The country of the place
- `countryCode` - A code representation of the country e.g `WLS`, `ENG`, `SCT`

## Get a big old list in your twig templates, ready to use with the craft forms macro

Parameters you can use are:
- `town` - Get an array of towns
- `region` - Get an array of regions

For the second arguments you can pass a comma seperated string for either if you only want to display certion regions or countries.

[You can see a complete list of available filters here](https://github.com/alecritson/craft-uk-places/wiki/Place-filtering)

```twig
{% set places = craft.ukplaces.get(
	'town',
	{
		regions: 'Essex, Surrey',
		countries: 'England'
	}
) %}
```