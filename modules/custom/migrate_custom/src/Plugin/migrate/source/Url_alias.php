<?php
/**
 * @file
 * Contains \Drupal\migrate_custom\Plugin\migrate\source\Url_alias.
 */

namespace Drupal\migrate_custom\Plugin\migrate\source;

use Drupal\migrate\Plugin\migrate\source\SqlBase;
use Drupal\migrate\Row;

/**
 * Extract articles from Drupal 7 database.
 *
 * @MigrateSource(
 *   id = "d7cafe_url_alias"
 * )
 */
class Url_alias extends SqlBase {

  /**
   * {@inheritdoc}
   */
  public function query() {
    // Select node in its last revision.
    $query = $this->select('dcf_url_alias', 'ua')
      ->fields('ua', array(
        'pid',
        'source',
        'alias',
        'language',
      ));
    return $query;
  }

  /**
   * {@inheritdoc}
   */
  public function fields() {
    $fields = $this->baseFields();
    return $fields;
  }


  /**
   * {@inheritdoc}
   */
  public function getIds() {
    $ids['pid']['type'] = 'integer';
    $ids['pid']['alias'] = 'ua';
    return $ids;
  }

  protected function baseFields() {
    $fields = array(
      'pid' => $this->t('P ID'),
      'source' => $this->t('Source'),
      'alias' => $this->t('Alias'),
      'language' => $this->t('Language'),
    );
    return $fields;
  }

}
?>