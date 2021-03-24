<?php

namespace Drupal\crm_awareness;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Database\Driver\mysql\Connection;

/**
 * Class CrmAwarenesService.
 */
class CrmAwarenesService implements CrmAwarenesServiceInterface {

  /**
   * Drupal\Core\Entity\EntityTypeManagerInterface definition.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * Drupal\Core\Database\Driver\mysql\Connection definition.
   *
   * @var \Drupal\Core\Database\Driver\mysql\Connection
   */
  protected $database;

  /**
   * Constructs a new CrmAwarenesService object.
   */
  public function __construct(EntityTypeManagerInterface $entity_type_manager, Connection $database) {
    $this->entityTypeManager = $entity_type_manager;
    $this->database = $database;
  }
  
  /**
   * 
   * @param array $results
   * @param  $result_total
   * @return array|string
   */
  public function _crm_awareness_transform_sex_result($results, $result_total){
      
      $formatted = [];
      foreach($results as $result){
          $key = strtolower($result->taxonomy_term_field_data_node_field_data_name);
          
          $formatted[$key]['image'] = $result->_relationship_entities['field_sex']->get('field_image')->entity->getFileUri();
          $count = $result->node_field_data_title;
          $formatted[$key]['percent'] = round($count/$result_total*100, 1) . '%';
          
      }

      return $formatted;
  }
  
  /**
   * 
   * @param array $results
   * @param  $result_total
   * @return array
   */
  public function _crm_awareness_transform_age_result($results, $result_total){
      $formatted = [];

      foreach($results as $result){
          $name = $result->taxonomy_term_field_data_node__field_age_group_name;
          $key = strtolower($name);
          $count = $result->node_field_data_title;
          $formatted[$key]['name'] = $name;
          $formatted[$key]['percent'] = round($count/$result_total*100, 1) . '%';
          $formatted[$key]['count'] = $result->node_field_data_title;
          $formatted[$key]['image'] = $result->_relationship_entities['field_age_group']->get('field_image')->entity->getFileUri();
          
      }
      return $formatted;
  }

}
