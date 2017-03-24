<?php

namespace Drupal\audit_log\Register;

use Drupal\audit_log\AuditLogEventInterface;

/**
 * Defines a logging register to write audit events to.
 *
 * @package Drupal\audit_log\Register
 */
interface AuditLogRegisterInterface {

  /**
   * Writes the event to the register's storage system.
   *
   * @param \Drupal\audit_log\AuditLogEventInterface $event
   *   The event to be written to the log.
   */
  public function save(AuditLogEventInterface $event);

}
