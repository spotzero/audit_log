<?php

namespace Drupal\audit_log;

class AuditLogEvent implements AuditLogEventInterface {

  protected $user;

  protected $entity;

  protected $message;

  protected $event_type;

  protected $previous_state;

  protected $current_state;

  public function setUser($user) {
    $this->user = $user;
    return $this;
  }

  public function setEntity($entity) {
    $this->entity = $entity;
    return $this;
  }

  public function setMessage($message) {
    $this->message = $message;
    return $this;
  }

  public function setEventType($event_type) {
    $this->event_type = $event_type;
    return $this;
  }

  public function setPreviousState($state) {
    $this->previous_state = $state;
    return $this;
  }

  public function setCurrentState($state) {
    $this->current_state = $state;
    return $this;
  }

  public function getUser() {
    return $this->user;
  }

  public function getEntity() {
    return $this->entity;
  }

  public function getMessage() {
    return $this->message;
  }

  public function getEventType() {
    return $this->event_type;
  }

  public function getPreviousState() {
    return $this->previous_state;
  }

  public function getCurrentState() {
    return $this->current_state;
  }

}
