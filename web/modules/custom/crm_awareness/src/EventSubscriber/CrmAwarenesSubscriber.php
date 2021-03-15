<?php

namespace Drupal\crm_awareness\EventSubscriber;

use Drupal\hook_event_dispatcher\HookEventDispatcherInterface;
use Drupal\views_event_dispatcher\Event\Views\ViewsPostExecuteEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\Event;


/**
 * Class CrmAwarenesSubscriber.
 */
class CrmAwarenesSubscriber implements EventSubscriberInterface {

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
    \Drupal::messenger()->addMessage('Event kernel.request thrown by Subscriber in module crm_awareness.', 'status', TRUE);
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
          
          $result = $view->result;
          if(0 < count($result)){
        
              $view->element['#attached']['library'][] = 'crm_2021/leaflet-lib';
              $view->element['#attached']['library'][] = 'crm_2021/leaflet-markercluster';
              $view->element['#attached']['library'][] = 'crm_awareness/crmawarenes-styling';
              
              $view->element['#attached']['drupalSettings']['crm_awareness'] = [
                  'baseURL'     => $current_path,
                  'rows'     => $result,
                  'orows'     => ['abc'],
                  'countryCodes'=> 'abc'
              ];
          }
          
      }

  }

}
