<?php
/**
 * @file
 * Hook implemenations for the Audit database logging module.
 */

/**
 * Render admin form to select roles.
 */
function audit_log_filter_by_role_form($form, &$form_state) {
  $form['audit_log_filter_exclude_roles'] = array(
    '#title' => 'Exclude roles',
    '#description' => 'Select the roles which should be excluded from logging',
    '#type' => 'checkboxes',
    '#options' => user_roles(),
    '#default_value' => variable_get('audit_log_filter_exclude_roles', array()),
  );
  return system_settings_form($form);
}
