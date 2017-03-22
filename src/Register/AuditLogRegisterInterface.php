<?php

namespace Drupal\audit_log\Register;

use Drupal\audit_log\AuditLogEventInterface;

interface AuditLogRegisterInterface {

  public function save(AuditLogEventInterface $message);

}
