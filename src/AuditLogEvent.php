<?php

namespace Drupal\audit_log;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;

/**
 * Represents a single auditable event for logging.
 *
 * @package Drupal\audit_log
 */
class AuditLogEvent implements AuditLogEventInterface {
  /**
   * The user that triggered the audit event.
   *
   * @var \Drupal\user\UserInterface
   */
  protected $user;

  /**
   * The entity being modified.
   *
   * @var \Drupal\Core\Entity\EntityInterface
   */
  protected $entity;

  /**
   * The audit message to write to the log.
   *
   * @var string
   */
  protected $message;

  /**
   * The type of event being reported.
   *
   * @var string
   */
  protected $eventType;

  /**
   * The original state of the object before the event occurred.
   *
   * @var string
   */
  protected $previousState;

  /**
   * The new state of the object after the event occurred.
   *
   * @var string
   */
  protected $currentState;

  /**
   * {@inheritdoc}
   */
  public function setUser(AccountInterface $user) {
    $this->user = $user;
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function setEntity(EntityInterface $entity) {
    $this->entity = $entity;
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function setMessage($message) {
    $this->message = $message;
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function setEventType($event_type) {
    $this->eventType = $event_type;
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function setPreviousState($state) {
    $this->previousState = $state;
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function setCurrentState($state) {
    $this->currentState = $state;
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getUser() {
    return $this->user;
  }

  /**
   * {@inheritdoc}
   */
  public function getEntity() {
    return $this->entity;
  }

  /**
   * {@inheritdoc}
   */
  public function getMessage() {
    return $this->message;
  }

  /**
   * {@inheritdoc}
   */
  public function getEventType() {
    return $this->eventType;
  }

  /**
   * {@inheritdoc}
   */
  public function getPreviousState() {
    return $this->previousState;
  }

  /**
   * {@inheritdoc}
   */
  public function getCurrentState() {
    return $this->currentState;
  }

}
