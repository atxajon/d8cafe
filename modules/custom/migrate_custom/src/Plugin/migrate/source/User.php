<?php
/**
 * @file
 * Contains \Drupal\migrate_custom\Plugin\migrate\source\User.
 */

namespace Drupal\migrate_custom\Plugin\migrate\source;

use Drupal\migrate\Plugin\migrate\source\SqlBase;

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