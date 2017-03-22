<?php

namespace Drupal\audit_log\Interpreter;

use Drupal\audit_log\AuditLogEventInterface;

class User implements AuditLogInterpreterInterface {

  public function reactTo(AuditLogEventInterface $event) {
    $entity = $event->getEntity();
    if ($entity->getEntityTypeId() != 'user') {
      return;
    }
    $event_type = $event->getEventType();
    if ($event_type == 'insert') {
      $event
        ->setMessage(t('@name was created.', ['@name' => $entity->label()]))
        ->setPreviousState(NULL)
        ->setCurrentState($entity->status->value ? 'active' : 'blocked');
      return TRUE;
    }

    if ($event_type == 'update') {
      $event
        ->setMessage(t('@name was updated.', ['@name' => $entity->label()]))
        ->setPreviousState($entity->original->status->value ? 'active' : 'blocked')
        ->setCurrentState($entity->status->value ? 'active' : 'blocked');
      return TRUE;
    }

    if ($event_type == 'delete') {
      $event
        ->setMessage(t('@name was updated.', ['@name' => $entity->label()]))
        ->setPreviousState($entity->original->status->value ? 'active' : 'blocked')
        ->setCurrentState(NULL);
      return TRUE;
    }
  }

}
