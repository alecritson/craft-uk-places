<?php

namespace Craft;

class UkplacesService extends BaseApplicationComponent
{
    protected $record;
    protected $model;
    protected $query;
    protected $filters;

    public function __construct($record = null)
    {
      $this->record = $record;
      $this->query = craft()->db->createCommand()->from('uk_places');
      $this->model = new Ukplaces_PlaceModel();
      if(is_null($this->record))
      {
        $this->record = Ukplaces_PlaceRecord::model();
      }
    }

    public function get($column, $filters = array())
    {
      // Set our filters for ease of reuse
      $this->filters = $filters;


      if($column == 'town') {
        return $this->getTowns();
      }
      elseif($column == 'region')
      {
        return $this->getRegions();
      }
      return null;
    }

    public function getTowns($heading = 'town') {

      $query = $this->query->select("id, {$heading}, region");

      if($this->filters)
      {
       if($this->filters['regions'])
       {
          $regions = explode(',',$this->filters['regions']);

          foreach($regions as $region)
          {
            $query = $query->orWhere(array('region' => trim($region)));
          }
       }
       elseif($this->filters['countries'])
       {
          $countries = explode(',',$this->filters['countries']);

          foreach($countries as $country)
          {
            $query = $query->orWhere(array('country' => trim($country)));
          }
       }
      }

      $columns = $query->order("region asc, {$heading} asc")->queryAll();

      $results = array();

      foreach($columns as $key => $column)
      {
          if($column[$heading] != '') {
              $results[$column['region']][$column[$heading]] = $column['id'];
          }
      }  

      $options = array();
        
      foreach($results as $key => $values)
      {
          $options[] = array('optgroup' => $key);
          foreach($values as $label => $value)
          {
            $options[] = array('label' => $label, 'value' => $value);
          }
      }

      return $options;
    }

    public function getRegions()
    {
      $query = $this->query->select("id, region, country");

      if($this->filters)
      {
       if(array_key_exists('countries', $this->filters) and $this->filters['countries'])
       {
          $countries = explode(',',$this->filters['countries']);

          foreach($countries as $country)
          {
            $query = $query->orWhere(array('country' => trim($country)));
          }
       }
      }

      $columns = $query->order("country asc, region asc")->queryAll();
      $results = array();

      foreach($columns as $key => $column)
      {
          if($column['region'] != '') {
              $results[$column['country']][$column['region']] = $column['id'];
          }
      } 

      foreach($results as $key => $values)
      {
          $options[] = array('optgroup' => $key);
          foreach($values as $label => $value)
          {
            $options[] = array('label' => $label, 'value' => $value);
          }
      }
      return $options;
    }

    public function findPlaceById($id)
    {
      if($record = $this->record->findByPk($id))
      {
          return $this->model->populateModel($record);
      }
      return null;
    }
}