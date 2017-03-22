<?php

namespace Drupal\audit_log;

use Drupal\Core\Entity\EntityInterface;
use Drupal\audit_log\Register\AuditLogRegisterInterface;
use Drupal\audit_log\AuditLogEventInterface;

class AuditLogRegister {

  protected $registers;

  public function register(AuditLogEventInterface $event) {
    foreach ($this->sortRegisters() as $register) {
      $register->save($event);
    }
  }

  public function add_register(AuditLogRegisterInterface $register, $priority = 0) {
    $this->registers[$priority][] = $register;
  }

  protected function sortRegisters() {
    $sorted = [];
    krsort($this->registers);

    foreach ($this->registers as $registers) {
      $sorted = array_merge($sorted, $registers);
    }
    return $sorted;
  }

}
