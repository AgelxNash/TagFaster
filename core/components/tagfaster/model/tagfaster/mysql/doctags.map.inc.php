<?php
$xpdo_meta_map['DocTags']= array (
  'package' => 'tagfaster',
  'version' => '1.1',
  'table' => 'site_content_tags',
  'extends' => 'xPDOObject',
  'fields' => 
  array (
    'doc_id' => NULL,
    'tag_id' => NULL,
    'tv_id' => 0,
  ),
  'fieldMeta' => 
  array (
    'doc_id' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'integer',
      'null' => false,
      'index' => 'pk',
    ),
    'tag_id' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'integer',
      'null' => false,
      'index' => 'pk',
    ),
    'tv_id' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
      'index' => 'pk',
    ),
  ),
  'indexes' => 
  array (
    'PRIMARY' => 
    array (
      'alias' => 'PRIMARY',
      'primary' => true,
      'unique' => true,
      'type' => 'BTREE',
      'columns' => 
      array (
        'tag_id' => 
        array (
          'length' => '',
          'collation' => 'A',
          'null' => false,
        ),
        'doc_id' => 
        array (
          'length' => '',
          'collation' => 'A',
          'null' => false,
        ),
        'tv_id' => 
        array (
          'length' => '',
          'collation' => 'A',
          'null' => false,
        ),
      ),
    ),
    'dtt' => 
    array (
      'alias' => 'dtt',
      'primary' => false,
      'unique' => true,
      'type' => 'BTREE',
      'columns' => 
      array (
        'doc_id' => 
        array (
          'length' => '',
          'collation' => 'A',
          'null' => false,
        ),
        'tag_id' => 
        array (
          'length' => '',
          'collation' => 'A',
          'null' => false,
        ),
        'tv_id' => 
        array (
          'length' => '',
          'collation' => 'A',
          'null' => false,
        ),
      ),
    ),
    'doc_id' => 
    array (
      'alias' => 'doc_id',
      'primary' => false,
      'unique' => false,
      'type' => 'BTREE',
      'columns' => 
      array (
        'doc_id' => 
        array (
          'length' => '',
          'collation' => 'A',
          'null' => false,
        ),
      ),
    ),
    'tag_id' => 
    array (
      'alias' => 'tag_id',
      'primary' => false,
      'unique' => false,
      'type' => 'BTREE',
      'columns' => 
      array (
        'tag_id' => 
        array (
          'length' => '',
          'collation' => 'A',
          'null' => false,
        ),
      ),
    ),
    'tv_id' => 
    array (
      'alias' => 'tv_id',
      'primary' => false,
      'unique' => false,
      'type' => 'BTREE',
      'columns' => 
      array (
        'tv_id' => 
        array (
          'length' => '',
          'collation' => 'A',
          'null' => false,
        ),
      ),
    ),
  ),
);
