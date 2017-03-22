<?php

namespace Drupal\audit_log\Register;

use Drupal\audit_log\AuditLogEventInterface;

class Database implements AuditLogRegisterInterface {

  public function save(AuditLogEventInterface $event) {
    $connection = \Drupal::database();

    $connection
      ->insert('audit_log')
      ->fields([
        'entity_id' => $event->getEntity()->id(),
        'entity_type' => $event->getEntity()->getEntityTypeId(),
        'user_id' => $event->getUser()->id(),
        'event' => $event->getEventType(),
        'previous_state' => $event->getPreviousState(),
        'current_state' => $event->getCurrentState(),
        'message' => $event->getMessage(),
        'timestamp' => \Drupal::time()->getRequestTime()
      ])
      ->execute();
  }

}
