<?php

namespace Drupal\audit_log\Interpreter;

use Drupal\audit_log\AuditLogEventInterface;

class Node implements AuditLogInterpreterInterface {

  public function reactTo(AuditLogEventInterface $event) {
    $entity = $event->getEntity();
    if ($entity->getEntityTypeId() != 'node') {
      return;
    }
    $event_type = $event->getEventType();
    if ($event_type == 'insert') {
      $event
        ->setMessage(t('@title was created.', ['@title' => $entity->getTitle()]))
        ->setPreviousState(NULL)
        ->setCurrentState($entity->isPublished() ? 'published' : 'unpublished');
      return TRUE;
    }

    if ($event_type == 'update') {
      $event
        ->setMessage(t('@title was updated.', ['@title' => $entity->getTitle()]))
        ->setPreviousState($entity->original->isPublished() ? 'published' : 'unpublished')
        ->setCurrentState($entity->isPublished() ? 'published' : 'unpublished');
      return TRUE;
    }

    if ($event_type == 'delete') {
      $event
        ->setMessage(t('@title was updated.', ['@title' => $entity->getTitle()]))
        ->setPreviousState($entity->original->isPublished() ? 'published' : 'unpublished')
        ->setCurrentState(NULL);
      return TRUE;
    }
  }

}
