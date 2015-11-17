<?php
/**
 * @file
 * Contains \Drupal\migrate_custom\Plugin\migrate\source\Term.
 */

namespace Drupal\migrate_custom\Plugin\migrate\source;

use Drupal\migrate\Plugin\migrate\source\SqlBase;
use Drupal\migrate\Row;

/**
 * Extract tags from Drupal 7 database.
 *
 * @MigrateSource(
 *   id = "d7cafe_terms"
 * )
 */
class Term extends SqlBase {

  /**
   * {@inheritdoc}
   */
  public function query() {
    $query = $this->select('dcf_taxonomy_term_data', 'td')
      ->fields('td', array('tid', 'vid', 'name', 'description', 'weight', 'format'))
      ->distinct();
    return $query;
  }

  /**
   * {@inheritdoc}
   */
  public function fields() {
    $fields = array(
      'tid' => $this->t('The term ID.'),
      'vid' => $this->t('Existing term VID'),
      'name' => $this->t('The name of the term.'),
      'description' => $this->t('The term description.'),
      'weight' => $this->t('Weight'),
      'parent' => $this->t("The Drupal term IDs of the term's parents."),
    );
    if ($this->getModuleSchemaVersion('taxonomy') >= 7000) {
      $fields['format'] = $this->t('Format of the term description.');
    }
    return $fields;
  }

  /**
   * {@inheritdoc}
   */
  public function prepareRow(Row $row) {
    // Find parents for this row.
    $parents = $this->select('dcf_taxonomy_term_hierarchy', 'th')
      ->fields('th', array('parent', 'tid'))
      ->condition('tid', $row->getSourceProperty('tid'))
      ->execute()
      ->fetchCol();
    $row->setSourceProperty('parent', $parents);
    return parent::prepareRow($row);
  }

  /**
   * {@inheritdoc}
   */
  public function getIds() {
    $ids['tid']['type'] = 'integer';
    return $ids;
  }

}
?>