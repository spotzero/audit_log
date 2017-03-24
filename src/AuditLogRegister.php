<?php

namespace Drupal\audit_log;

use Drupal\audit_log\Register\AuditLogRegisterInterface;

/**
 * Writes audit log events to enabled logging destinations.
 *
 * @package Drupal\audit_log
 */
class AuditLogRegister {
  /**
   * An array of available log destinations to be written to.
   *
   * @var array
   */
  protected $registers;

  /**
   * Writes the audit event to each available logging destination.
   *
   * @param \Drupal\audit_log\AuditLogEventInterface $event
   *   The audit event to be logged.
   */
  public function register(AuditLogEventInterface $event) {
    foreach ($this->sortRegisters() as $register) {
      $register->save($event);
    }
  }

  /**
   * Adds a log destination to the processing pipeline.
   *
   * @param \Drupal\audit_log\Register\AuditLogRegisterInterface $register
   *   The logging destination to write events to.
   * @param int $priority
   *   A priority specification for the registers.
   *
   *   Must be a positive integer.
   *
   *   Lower number registers are processed
   *   before higher number registers.
   */
  public function addRegister(AuditLogRegisterInterface $register, $priority = 0) {
    $this->registers[$priority][] = $register;
  }

  /**
   * Sorts the available logging destinations by priority.
   *
   * @return array
   *   The sorted array of logging destinations.
   */
  protected function sortRegisters() {
    $sorted = [];
    krsort($this->registers);

    foreach ($this->registers as $registers) {
      $sorted = array_merge($sorted, $registers);
    }
    return $sorted;
  }

}
