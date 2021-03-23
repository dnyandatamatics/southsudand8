<?php

namespace Drupal\crm_awareness\Event;

use Drupal\preprocess_event_dispatcher\Event\AbstractPreprocessEvent;

/**
 * Class ViewTablePreprocessEvent.
 */
final class ViewTableAwarenessDashboardPreprocessEvent extends AbstractPreprocessEvent {

  /**
   * {@inheritdoc}
   */
  public static function getHook(): string {
    return 'views_view_table__awareness_dashboard__page_1';
  }

}
