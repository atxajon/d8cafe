<?php
/**
 * @file
 * Contains \Drupal\migrate_custom\Plugin\migrate\source\Link.
 */

namespace Drupal\migrate_custom\Plugin\migrate\source;

use Drupal\migrate\Plugin\migrate\source\SqlBase;
use Drupal\migrate\Row;

/**
 * Extract links from Drupal 7 database.
 *
 * @MigrateSource(
 *   id = "d7cafe_links"
 * )
 */
class Link extends SqlBase {

  /**
   * {@inheritdoc}
   */
  public function query() {
    // Select node in its last revision.
    $query = $this->select('dcf_node', 'n')
      ->condition('n.type', 'links', '=')
      ->fields('n', array(
        'nid',
        'vid',
        'type',
        'language',
        'title',
        'uid',
        'status',
        'created',
        'changed',
        'promote',
        'sticky',
      ));
    return $query;
  }

  /**
   * {@inheritdoc}
   */
  public function fields() {
    $fields = $this->baseFields();
    $fields['alias'] = $this->t('URL alias');
    return $fields;
  }

  /**
   * {@inheritdoc}
   */
  public function prepareRow(Row $row) {
    $nid = $row->getSourceProperty('nid');


    // url alias
    $result = $this->getDatabase()->query('
      SELECT
        ua.alias
      FROM
        {dcf_url_alias} ua
      WHERE
        ua.source = :nid
    ', array(':nid' => 'node/'.$nid));
    foreach ($result as $record) {
      $row->setSourceProperty('alias', $record->alias);
      // returns the right alias, but TODO: fix destination, as it's not inserting into url_alias table
      //  drush_print_r($record);

    }

    // taxonomy term IDs
    // (here we use MySQL's GROUP_CONCAT() function to merge all values into one row.)
    $result = $this->getDatabase()->query('
      SELECT
        GROUP_CONCAT(fld.field_links_tags_tid) as tids
      FROM
        {dcf_field_data_field_links_tags} fld
      WHERE
        fld.entity_id = :nid
    ', array(':nid' => $nid));
    foreach ($result as $record) {
      if (!is_null($record->tids)) {
        $row->setSourceProperty('tags', explode(',', $record->tids) );
      }
    }

    // field_url
    $result = $this->getDatabase()->query('
      SELECT
        fld.field_url_url as url,
        fld.field_url_title as title
      FROM
        {dcf_field_data_field_url} fld
      WHERE
        fld.entity_id = :nid
    ', array(':nid' => $nid));
    foreach ($result as $record) {
      $row->setSourceProperty('field_url_url', $record->url);
      $row->setSourceProperty('field_url_title', $record->title);
    }

    return parent::prepareRow($row);
  }

  /**
   * {@inheritdoc}
   */
  public function getIds() {
    $ids['nid']['type'] = 'integer';
    $ids['nid']['alias'] = 'n';
    return $ids;
  }

  protected function baseFields() {
    $fields = array(
      'nid' => $this->t('Node ID'),
      'vid' => $this->t('Version ID'),
      'type' => $this->t('Type'),
      'title' => $this->t('Title'),
      'format' => $this->t('Format'),
      'teaser' => $this->t('Teaser'),
      'uid' => $this->t('Authored by (uid)'),
      'created' => $this->t('Created timestamp'),
      'changed' => $this->t('Modified timestamp'),
      'status' => $this->t('Published'),
      'promote' => $this->t('Promoted to front page'),
      'sticky' => $this->t('Sticky at top of lists'),
      'language' => $this->t('Language (fr, en, ...)'),
    );
    return $fields;
  }

}
?>