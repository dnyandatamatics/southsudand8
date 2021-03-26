<?php

namespace Drupal\crm_complaint\EventSubscriber;

use Drupal\hook_event_dispatcher\HookEventDispatcherInterface;
use Drupal\views_event_dispatcher\Event\Views\ViewsPostExecuteEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\Event;


/**
 * Class CrmAwarenesSubscriber.
 */
class CrmComplaintSubscriber implements EventSubscriberInterface {

  /**
   * Constructs a new CrmAwarenesSubscriber object.
   */
  public function __construct() {

  }

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    $events[HookEventDispatcherInterface::VIEWS_POST_EXECUTE][] = ['postExecuteAwarenesView'];
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
    \Drupal::messenger()->addMessage('Event kernel.request thrown by Subscriber in module crm_complaint.', 'status', TRUE);
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

      if ($view->id() == 'complaints_mechanism' && $view->current_display == 'attachment_1') {
	      
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
		     // kint($result);
                  /**
                   *
                   * @var \Drupal\taxonomy\Entity\Term $field_camp_of_survivor
                   */
                  $field_camp_of_survivor                 = $result->_relationship_entities['field_location_of_incident'];
                  $arr_camp_survivor[$key]['CampId']      = $field_camp_of_survivor->id();
                  $arr_camp_survivor[$key]['CampName']    = $field_camp_of_survivor->getName();
                  $arr_camp_survivor[$key]['Longitude']   = $field_camp_of_survivor->get('field_long')->value;
                  $arr_camp_survivor[$key]['Latitude']    = $field_camp_of_survivor->get('field_lat')->value;
                  $arr_camp_survivor[$key]['Coordinates'] = [$arr_camp_survivor[$key]['Latitude'], $arr_camp_survivor[$key]['Longitude']];
                  $arr_camp_survivor[$key]['Count']       = $obj_node->getTitle();
                  $arr_camp_survivor[$key]['nid']         = $obj_node->id();
                  
                  
              }
        
              $view->element['#attached']['library'][] = 'crm_2021/leaflet-lib';
              $view->element['#attached']['library'][] = 'crm_2021/leaflet-markercluster';
              $view->element['#attached']['library'][] = 'crm_complaint/crmcomplaint-styling';
              $view->element['#attached']['drupalSettings']['crm_complaint'] = [
                  'location' => $location,
                  'rows'     => $arr_camp_survivor,
                  'orows'    => $result
              ];
          }
          
      }

  }

}
