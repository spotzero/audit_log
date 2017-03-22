<?php

namespace Drupal\audit_log;

use Drupal\Core\Entity\EntityInterface;
use Drupal\audit_log\Interpreter\AuditLogInterpreterInterface;

class AuditLogLogger {

  protected $entity_event_interpreters;

  public function log($event_type, EntityInterface $entity) {
    ksort($this->entity_event_interpreters);
    $event = new AuditLogEvent();
    $event->setUser(\Drupal::service('current_user'));
    $event->setEntity($entity);
    $event->setEventType($event_type);

    foreach ($this->sortInterpreters() as $interpreter) {
      if ($interpreter->reactTo($event)) {
        \Drupal::service('audit_log.register')->register($event);
        break;
      }
    }

  }

  public function add_interpreter(AuditLogInterpreterInterface $interpreter, $priority = 0) {
    $this->entity_event_interpreters[$priority][] = $interpreter;
  }

  protected function sortInterpreters() {
    $sorted = [];
    krsort($this->entity_event_interpreters);

    foreach ($this->entity_event_interpreters as $entity_event_interpreters) {
      $sorted = array_merge($sorted, $entity_event_interpreters);
    }
    return $sorted;
  }

}
