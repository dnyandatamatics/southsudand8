<?php

namespace Drupal\crm_awareness\Factory;

use Drupal\preprocess_event_dispatcher\Event\AbstractPreprocessEvent;
use Drupal\preprocess_event_dispatcher\Factory\PreprocessEventFactoryInterface;
use Drupal\crm_awareness\Event\ViewTableAwarenessDashboardPreprocessEvent;
use Drupal\crm_awareness\Variables\ViewTableAwarenessDashboardEventVariables;

/**
 * Class ExamplePreprocessEventFactory.
 */
class ViewTableAwarenessDashboardPreprocessEventFactory implements PreprocessEventFactoryInterface {

  /**
   * Create the PreprocessEvent with the Variables object embedded.
   *
   * @param array $variables
   *   Variables.
   *
   * @return \Drupal\preprocess_event_dispatcher\Event\AbstractPreprocessEvent
   *   Created event.
   */
  public function createEvent(array &$variables): AbstractPreprocessEvent {
      return new ViewTableAwarenessDashboardPreprocessEvent(
          new ViewTableAwarenessDashboardEventVariables($variables)
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getEventHook(): string {
      return ViewTableAwarenessDashboardPreprocessEvent::getHook();
  }

}
