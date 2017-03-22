<?php

namespace Drupal\audit_log;

interface AuditLogEventInterface {

  public function setUser($user);

  public function setMessage($message);

  public function setEventType($event_type);

  public function setPreviousState($state);

  public function setCurrentState($state);

  public function getUser();

  public function getMessage();

  public function getEventType();

  public function getPreviousState();

  public function getCurrentState();

}
