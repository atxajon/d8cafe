<?php
/**
 * @file
 * Contains \Drupal\migrate_custom\Plugin\migrate\source\Vocabulary.
 */

namespace Drupal\migrate_custom\Plugin\migrate\source;

use Drupal\migrate_drupal\Plugin\migrate\source\DrupalSqlBase;

/**
 * Extract tags from Drupal 7 database.
 *
 * @MigrateSource(
 *   id = "d7cafe_taxonomies"
 * )
 */
class Vocabulary extends DrupalSqlBase {

  /**
   * {@inheritdoc}
   */
  public function query() {
    $query = $this->select('dcf_taxonomy_vocabulary', 'v')
      ->fields('v', array(
        'vid',
        'name',
        'description',
        'hierarchy',
        'module',
        'weight',
        'machine_name'
      ))
      ->condition('vid', 1, '>'); // vid 1 'Tags' already comes with D8, let's not bother
    return $query;
  }

  /**
   * {@inheritdoc}
   */
  public function fields() {
    return array(
      'vid' => $this->t('The vocabulary ID.'),
      'name' => $this->t('The name of the vocabulary.'),
      'description' => $this->t('The description of the vocabulary.'),
      'hierarchy' => $this->t('The type of hierarchy allowed within the vocabulary. (0 = disabled, 1 = single, 2 = multiple)'),
      'module' => $this->t('Module responsible for the vocabulary.'),
      'weight' => $this->t('The weight of the vocabulary in relation to other vocabularies.'),
      'machine_name' => $this->t('Unique achine name of the vocabulary.')
    );
  }


    /**
   * {@inheritdoc}
   */
  public function getIds() {
    $ids['vid']['type'] = 'integer';
    return $ids;
  }

}
?>