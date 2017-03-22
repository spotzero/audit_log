<?php

namespace Drupal\audit_log\Kernel;

use Drupal\KernelTests\KernelTestBase;
use Drupal\user\Entity\User;

class AuditLogDatabaseTest extends KernelTestBase {

  public static $modules = ['system', 'user', 'audit_log'];

  protected function setUp() {
    parent::setUp();

    $this->installSchema('system', 'sequences');
    $this->installEntitySchema('user');
    $this->installSchema('audit_log', ['audit_log']);
  }

  public function testUserAuditLog() {
    $count = db_query('SELECT COUNT(id) FROM {audit_log}')->fetchField();
    $this->assertEquals(0, $count);

    $user = User::create(['name' => 'test name']);
    $user->save();

    $count = db_query('SELECT COUNT(id) FROM {audit_log}')->fetchField();
    $this->assertEquals(1, $count);
    $user->save();

    $count = db_query('SELECT COUNT(id) FROM {audit_log}')->fetchField();
    $this->assertEquals(2, $count);
  }

}
