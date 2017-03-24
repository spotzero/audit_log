<?php

namespace Drupal\audit_log\Interpreter;

use Drupal\audit_log\AuditLogEventInterface;

/**
 * Processes node entity events.
 *
 * @package Drupal\audit_log\Interpreter
 */
class Node implements AuditLogInterpreterInterface {

  /**
   * {@inheritdoc}
   */
  public function reactTo(AuditLogEventInterface $event) {
    $entity = $event->getEntity();
    if ($entity->getEntityTypeId() != 'node') {
      return FALSE;
    }
    $event_type = $event->getEventType();
    /** @var \Drupal\node\NodeInterface $entity */
    $state = $entity->isPublished() ? 'published' : 'unpublished';
    $original_state = $entity->original->isPublished() ? 'published' : 'unpublished';
    $args = ['@title' => $entity->getTitle()];

    if ($event_type == 'insert') {
      $event
        ->setMessage('@name was created.')
        ->setMessagePlaceholders(['@name' => $entity->label()])
        ->setPreviousState(NULL)
        ->setCurrentState($state);
      return TRUE;
    }

    if ($event_type == 'update') {
      $event
        ->setMessage('@name was updated.')
        ->setMessagePlaceholders(['@name' => $entity->label()])
        ->setPreviousState($original_state)
        ->setCurrentState($state);
      return TRUE;
    }

    if ($event_type == 'delete') {
      $event
        ->setMessage('@name was deleted.')
        ->setMessagePlaceholders(['@name' => $entity->label()])
        ->setPreviousState($original_state)
        ->setCurrentState(NULL);
      return TRUE;
    }

    return FALSE;
  }

}
