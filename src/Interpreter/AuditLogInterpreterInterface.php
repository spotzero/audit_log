<?php

namespace Drupal\audit_log\Interpreter;

use Drupal\audit_log\AuditLogEventInterface;

interface AuditLogInterpreterInterface {

  public function reactTo(AuditLogEventInterface $event);

}
