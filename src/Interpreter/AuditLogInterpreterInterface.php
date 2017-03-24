<?php

namespace Drupal\audit_log\Interpreter;

use Drupal\audit_log\AuditLogEventInterface;

/**
 * Defines an interpreter for responding to events.
 *
 * @package Drupal\audit_log\Interpreter
 */
interface AuditLogInterpreterInterface {

  /**
   * Processes an event.
   *
   * @param \Drupal\audit_log\AuditLogEventInterface $event
   *   The audit event.
   *
   * @return bool
   *   TRUE if the interpreter handled the event.
   */
  public function reactTo(AuditLogEventInterface $event);

}
