<?php
/**
 * @file
 * Contains \Drupal\migrate_custom\Plugin\migrate\source\Member.
 */

namespace Drupal\migrate_custom\Plugin\migrate\source;

use Drupal\migrate\Plugin\migrate\source\SqlBase;
use Drupal\migrate\Row;

/**
 * Extract links from Drupal 7 database.
 *
 * @MigrateSource(
 *   id = "d7cafe_member"
 * )
 */
class Member extends SqlBase {

  /**
   * {@inheritdoc}
   */
  public function query() {
    // Select node in its last revision.
    $query = $this->select('dcf_node', 'n')
      ->condition('n.type', 'member', '=')
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

    // field_short_bio
    $result = $this->getDatabase()->query('
      SELECT
        fld.field_short_bio_value as bio
      FROM
        {dcf_field_data_field_short_bio} fld
      WHERE
        fld.entity_id = :nid
    ', array(':nid' => $nid));
    foreach ($result as $record) {
      $row->setSourceProperty('field_short_bio', $record->bio);
    }

    // field_image
    $result = $this->getDatabase()->query('
      SELECT
        fld.field_image_fid,
        fld.field_image_alt,
        fld.field_image_title,
        fld.field_image_width,
        fld.field_image_height
      FROM
        {dcf_field_data_field_image} fld
      WHERE
        fld.entity_id = :nid
    ', array(':nid' => $nid));
    // Create an associative array for each row in the result. The keys
    // here match the last part of the column name in the field table.
    $images = [];
    foreach ($result as $record) {
      $images[] = [
        'target_id' => $record->field_image_fid,
        'alt' => $record->field_image_alt,
        'title' => $record->field_image_title,
        'width' => $record->field_image_width,
        'height' => $record->field_image_height,
      ];
    }
    $row->setSourceProperty('field_image', $images);

    // field_linkedin_url
    $result = $this->getDatabase()->query('
      SELECT
        fld.field_linkedin_url_url as linkedin
      FROM
        {dcf_field_data_field_linkedin_url} fld
      WHERE
        fld.entity_id = :nid
    ', array(':nid' => $nid));
    foreach ($result as $record) {
      $row->setSourceProperty('field_linkedin_url_url', $record->linkedin);
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