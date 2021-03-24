<?php

namespace Drupal\crm_awareness\EventSubscriber;

use Drupal\crm_awareness\CrmAwarenesServiceInterface;
use Drupal\crm_awareness\Event\ViewTableAwarenessDashboardPreprocessEvent;
use Drupal\hook_event_dispatcher\HookEventDispatcherInterface;
use Drupal\views\Views;
use Drupal\views_event_dispatcher\Event\Views\ViewsPostExecuteEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\Event;




/**
 * Class CrmAwarenesSubscriber.
 */
class CrmAwarenesSubscriber implements EventSubscriberInterface {
   /**
    * 
    * @var \Drupal\crm_awareness\CrmAwarenesService
    */ 
   protected $crm_helper; 

  /**
   * Constructs a new CrmAwarenesSubscriber object.
   */
   public function __construct(CrmAwarenesServiceInterface $awarness_service){
       $this->crm_helper = $awarness_service;

  }

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    $events = [];  
    $events[HookEventDispatcherInterface::VIEWS_POST_EXECUTE][] = ['postExecuteAwarenesView'];
    $events[ViewTableAwarenessDashboardPreprocessEvent::name()][] = ['preprocessViewViewTable'];
    $events['kernel.request'][] = ['kernelRequest'];

    return $events;
  }

  /**
   * This method is called when the kernel.request is dispatched.
   *
   * @param \Symfony\Component\EventDispatcher\Event $event
   *   The dispatched event.
   */
  public function kernelRequest(Event $event) {
   // \Drupal::messenger()->addMessage('Event kernel.request thrown by Subscriber in module crm_awareness.', 'status', TRUE);
  }
  
  /**
   * 
   * @param ViewTableAwarenessDashboardPreprocessEvent $event
   */
  function preprocessViewViewTable(ViewTableAwarenessDashboardPreprocessEvent $event){
      $variables = $event->getVariables();
     
      
      $hook = $event->getHook();
     
      
      /**
       * 
       * @var \Drupal\views\ViewExecutable $view
       */
      $view = $event->getVariables()->get('view');
     // kint($variables);
     // exit;
      
      
      if ($view->id() == 'awareness_dashboard' && $view->current_display == 'page_1') {
          
          
          $result_sex = $view->result;
          $variables->set('myname','dnyaneshwar');
          
          //get views from total
          
          // view michine name user_quick_view
          $view = Views::getView('awareness_dashboard');
          $view->setDisplay('attachment_2');
          $view->execute();
          $result_total = $view->result[0]->node_field_data_title;
          
          //get views from age group
          $view = Views::getView('awareness_dashboard');
          $view->setDisplay('attachment_1');
          $view->execute();
          $result_age = $view->result;
          
          
          $vars['result_crm']['sex'] = $this->crm_helper->_crm_awareness_transform_sex_result($result_sex, $result_total);
          $vars['result_crm']['age'] = $this->crm_helper->_crm_awareness_transform_age_result($result_age, $result_total);
          $vars['result_crm']['total'] = $result_total;

          $variables->set('result_crm',$vars['result_crm']);
         
   
      }
      
      
    
     
  }
  
  /**
   * Post execute event handler.
   *
   * @param \Drupal\views_event_dispatcher\Event\Views\ViewsPostExecuteEvent $event
   *   The event.
   */
  public function postExecuteAwarenesView(ViewsPostExecuteEvent $event): void { 
      
      /**
       *
       * @var \Drupal\views\ViewExecutable $view
       */
      $view = $event->getView();
     
      if ($view->id() == 'awareness_raising' && $view->current_display == 'attachment_1') {
          
          $current_path = \Drupal::service('path.current')->getPath();
          $host = \Drupal::request()->getSchemeAndHttpHost();
          $location = $host.$current_path. "?field_camp_of_survivor_tid=";
     
  
          $arr_result = $view->result;
          
    
          if(0 < count($arr_result)){
              
              $arr_camp_survivor = [];
              
              foreach ($arr_result as $key => $result){
                  
                 /**
                  * 
                  * @var \Drupal\node\Entity\Node $obj_node
                  */ 
                 $obj_node=  $result->_entity;
                 
                  /**
                   *
                   * @var \Drupal\taxonomy\Entity\Term $field_camp_of_survivor
                   */
                  $field_camp_of_survivor                 = $result->_relationship_entities['field_camp_of_survivor'];
                  $arr_camp_survivor[$key]['CampId']      = $field_camp_of_survivor->id();
                  $arr_camp_survivor[$key]['CampName']    = $field_camp_of_survivor->getName();
                  $arr_camp_survivor[$key]['Longitude']   = $field_camp_of_survivor->get('field_long')->value;
                  $arr_camp_survivor[$key]['Latitude']    = $field_camp_of_survivor->get('field_lat')->value;
                  $arr_camp_survivor[$key]['Coordinates'] = [$arr_camp_survivor[$key]['Latitude'], $arr_camp_survivor[$key]['Longitude']];
                  $arr_camp_survivor[$key]['Count']       = $obj_node->getTitle();
                  $arr_camp_survivor[$key]['nid']         = $obj_node->id();
                  
                  
              }
              //echo "<pre>"; print_r($arr_camp_survivor);exit;
        
              $view->element['#attached']['library'][] = 'crm_2021/leaflet-lib';
              $view->element['#attached']['library'][] = 'crm_2021/leaflet-markercluster';
              $view->element['#attached']['library'][] = 'crm_awareness/crmawarenes-styling';
              
              $view->element['#attached']['drupalSettings']['crm_awareness'] = [
                  'location' => $location,
                  'rows'     => $arr_camp_survivor,
                  'orows'    => $result
              ];
          }
          
      }

  }

}
