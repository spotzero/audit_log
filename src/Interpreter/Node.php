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
    $current_state = $entity->isPublished() ? 'published' : 'unpublished';
    $previous_state = '';
    if (isset($entity->original)) {
      $previous_state = $entity->original->isPublished() ? 'published' : 'unpublished';
    }
    $args = ['@title' => $entity->getTitle()];

    if ($event_type == 'insert') {
      $event
        ->setMessage('@name was created.')
        ->setMessagePlaceholders(['@name' => $entity->label()])
        ->setPreviousState(NULL)
        ->setCurrentState($current_state);
      return TRUE;
    }

    if ($event_type == 'update') {
      $event
        ->setMessage('@name was updated.')
        ->setMessagePlaceholders(['@name' => $entity->label()])
        ->setPreviousState($previous_state)
        ->setCurrentState($current_state);
      return TRUE;
    }

    if ($event_type == 'delete') {
      $event
        ->setMessage('@name was deleted.')
        ->setMessagePlaceholders(['@name' => $entity->label()])
        ->setPreviousState($previous_state)
        ->setCurrentState(NULL);
      return TRUE;
    }

    return FALSE;
  }

}
