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
      $key = strtolower($result->taxonomy_term_field_data_node__field_sex_name);
          
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
  
  /**
   * 
   * @return NULL[][]
   */
  public function _crm_awareness_get_comprehension(){
      $formatted = [];
      $terms = $this->entityTypeManager->getStorage('taxonomy_term')->loadTree('level_of_comprehension');
      foreach ($terms as $term){
          $formatted[] = array(
              'tid' => $term->tid,
              'name' => $term->name,
          );
      }
      return $formatted;
  }
  
  public function _crm_complaints_get_camps(){
      $formatted = [];
      $terms = $this->entityTypeManager->getStorage('taxonomy_term')->loadTree('camp');
      foreach ($terms as $term){
          $formatted[] = array(
              'tid' => $term->tid,
              'name' => $term->name,
          );
      }
      return $formatted;
  }
  
  function _crm_awareness_get_sector(){
      $formatted = [];
      $terms = $this->entityTypeManager->getStorage('taxonomy_term')->loadTree('work_sector');
      foreach ($terms as $term){
          $formatted[] = array(
              'tid' => $term->tid,
              'name' => $term->name,
          );
      }
      return $formatted;
  }
  
  public function _crm_awareness_transform_compre_meaning($results, $compre){
 
      $formatted = [];
      foreach ($compre as $c) {
          $name = $c['name'];
          $found = false;
          foreach($results as $result){
              $_name = $result->taxonomy_term_field_data_node__field_meaning_of_sea_name;
              if($_name == $name){
                  $count = intval($result->node_field_data_title);
                  $formatted[] = array($_name, $count);
                  $found = true;
                  break;
              }
          }
          if(!$found){
              $formatted[] = array($name, 0);
          }
      }
      return $formatted;
  }
  
  public function _crm_awareness_transform_compre_risk($results, $compre){ 
      $formatted = [];
      foreach ($compre as $c) {
          $name = $c['name'];
          $found = false;
          foreach($results as $result){
              $_name = $result->taxonomy_term_field_data_node__field_risk_sea_name;
              if($_name == $name){
                  $count = intval($result->node_field_data_title);
                  $formatted[] = array($_name, $count);
                  $found = true;
                  break;
              }
          }
          if(!$found){
              $formatted[] = array($name, 0);
          }
      }
      
      return $formatted;
  }
  
  public function _crm_awareness_transform_compre_refugee($results, $compre){ 
      $formatted = [];
      foreach ($compre as $c) {
          $name = $c['name'];
          $found = false;
          foreach($results as $result){
              $_name = $result->taxonomy_term_field_data_node__field_refugee_rights_sea_name;
              if($_name == $name){
                  $count = intval($result->node_field_data_title);
                  $formatted[] = array($_name, $count);
                  $found = true;
                  break;
              }
          }
          if(!$found){
              $formatted[] = array($name, 0);
          }
      }
      
      return $formatted;
  }
  
  public function _crm_awareness_transform_compre_complaint($results, $compre){ 
      $formatted = [];
      foreach ($compre as $c) {
          $name = $c['name'];
          $found = false;
          foreach($results as $result){
              $_name = $result->taxonomy_term_field_data_node__field_how_to_file_a_complaint ;
              if($_name == $name){
                  $count = intval($result->node_field_data_title);
                  $formatted[] = array($_name, $count);
                  $found = true;
                  break;
              }
          }
          if(!$found){
              $formatted[] = array($name, 0);
          }
      }
      
      return $formatted;
  }
  
  public function _crm_awareness_transform_issues_per_camp($results, $camps){ 
      $formatted = [];
      foreach ($camps as $c) {
          $name = $c['name'];
          $found = false;
          foreach($results as $result){
              $_name = $result->taxonomy_term_field_data_node__field_camp_of_survivor_name  ;
              if($_name == $name){
                  $count = intval($result->node_field_data_title);
                  $formatted[] = array($_name, $count);
                  $found = true;
                  break;
              }
          }
          if(!$found){
              $formatted[] = array($name, 0);
          }
      }
      
      return $formatted;
  }
  
  public function _crm_awareness_transform_sector($results, $sector){
      $formatted = [];
      foreach ($sector as $c) {
          $name = $c['name'];
          $found = false;
          foreach($results as $result){
              $_name = $result->taxonomy_term_field_data_node__field_work_sector_of_accused_  ;
              if($_name == $name){
                  $count = intval($result->node_field_data_title);
                  $formatted[] = array($_name, $count);
                  $found = true;
                  break;
              }
          }
          if(!$found){
              $formatted[] = array($name, 0);
          }
      }
      
      return $formatted;
  }

}
