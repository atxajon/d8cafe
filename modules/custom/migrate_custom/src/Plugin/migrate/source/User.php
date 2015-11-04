<?php
/**
 * @file
 * Contains \Drupal\migrate_custom\Plugin\migrate\source\User.
 */

namespace Drupal\migrate_custom\Plugin\migrate\source;

use Drupal\migrate\Plugin\migrate\source\SqlBase;
use Drupal\migrate\Row;

/**
 * Extract users from Drupal 7 database.
 *
 * @MigrateSource(
 *   id = "d7cafe_users"
 * )
 */
class User extends SqlBase {

  /**
   * {@inheritdoc}
   */
  public function query() {
    return $this->select('dcf_users', 'dcf_u')
      ->fields('dcf_u', ['uid', 'status', 'created','access', 'login', 'name',
        'pass', 'mail', 'init', 'language']);
    // ->condition('uid', 1, '>');
  }

  /**
   * {@inheritdoc}
   */
  public function fields() {
    $fields = [
      'uid' => $this->t('Account ID'),
      'status' => $this->t('Blocked/Allowed'),
      'created' => $this->t('Registered date'),
      'access' => $this->t('Time of last access'),
      'login' => $this->t('Time of last login'),
      'name' => $this->t('Account name (for login)'),
      'pass' => $this->t('Account password (raw)'),
      'mail' => $this->t('Account email'),
      'init' => $this->t('init'),
      'language' => $this->t('language'),
    ];

    return $fields;
  }

  /**
   * {@inheritdoc}
   */
  public function prepareRow(Row $row) {
    $uid = $row->getSourceProperty('uid');
    // field_real_name
    $result = $this->getDatabase()->query('
      SELECT
        fld.field_real_name_value
      FROM
        {dcf_field_data_field_real_name} fld
      WHERE
        fld.entity_id = :uid
    ', array(':uid' => $uid));
    foreach ($result as $record) {
      $row->setSourceProperty('field_real_name', $record->field_real_name_value );
    }

    // field_availability
    $result = $this->getDatabase()->query('
      SELECT
        fld.field_availability_value
      FROM
        {dcf_field_data_field_availability} fld
      WHERE
        fld.entity_id = :uid
    ', array(':uid' => $uid));
    foreach ($result as $record) {
      $row->setSourceProperty('field_availability', $record->field_availability_value );
    }
    return parent::prepareRow($row);
  }

  /**
   * {@inheritdoc}
   */
  public function getIds() {
    return [
      'uid' => [
        'type' => 'integer',
        'alias' => 'dcf_u',
      ],
    ];
  }

}
?>