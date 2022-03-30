<?php
return [
  'hp_admin_app' => 
  [
    'id' => 
    [
      'type' => 'int unsigned',
      'null' => 'NO',
      'key' => 'PRI',
      'default' => NULL,
      'extra' => 'auto_increment',
      'min' => 0,
      'max' => 4294967295,
    ],
    'status' => 
    [
      'type' => 'tinyint unsigned',
      'null' => 'NO',
      'key' => '',
      'default' => '0',
      'extra' => '',
      'min' => 0,
      'max' => 255,
    ],
    'date_add' => 
    [
      'type' => 'int unsigned',
      'null' => 'NO',
      'key' => '',
      'default' => NULL,
      'extra' => '',
      'min' => 0,
      'max' => 4294967295,
    ],
    'date_upd' => 
    [
      'type' => 'int unsigned',
      'null' => 'NO',
      'key' => '',
      'default' => NULL,
      'extra' => '',
      'min' => 0,
      'max' => 4294967295,
    ],
    'key' => 
    [
      'type' => 'varchar',
      'null' => 'NO',
      'key' => '',
      'default' => NULL,
      'extra' => '',
      'min' => 0,
      'max' => 16,
    ],
  ],
  'hp_admin_app_lang' => 
  [
    'id' => 
    [
      'type' => 'int unsigned',
      'null' => 'NO',
      'key' => 'PRI',
      'default' => NULL,
      'extra' => 'auto_increment',
      'min' => 0,
      'max' => 4294967295,
    ],
    'lang_id' => 
    [
      'type' => 'int unsigned',
      'null' => 'NO',
      'key' => 'MUL',
      'default' => NULL,
      'extra' => '',
      'min' => 0,
      'max' => 4294967295,
    ],
    'app_id' => 
    [
      'type' => 'int unsigned',
      'null' => 'NO',
      'key' => 'MUL',
      'default' => NULL,
      'extra' => '',
      'min' => 0,
      'max' => 4294967295,
    ],
    'title' => 
    [
      'type' => 'varchar',
      'null' => 'NO',
      'key' => '',
      'default' => '',
      'extra' => '',
      'min' => 0,
      'max' => 64,
    ],
    'description' => 
    [
      'type' => 'varchar',
      'null' => 'NO',
      'key' => '',
      'default' => '',
      'extra' => '',
      'min' => 0,
      'max' => 255,
    ],
  ],
  'hp_admin_lang_i18n' => 
  [
    'id' => 
    [
      'type' => 'int unsigned',
      'null' => 'NO',
      'key' => 'PRI',
      'default' => NULL,
      'extra' => 'auto_increment',
      'min' => 0,
      'max' => 4294967295,
    ],
    'status' => 
    [
      'type' => 'tinyint unsigned',
      'null' => 'NO',
      'key' => '',
      'default' => '0',
      'extra' => '',
      'min' => 0,
      'max' => 255,
    ],
    'date_add' => 
    [
      'type' => 'int unsigned',
      'null' => 'NO',
      'key' => '',
      'default' => NULL,
      'extra' => '',
      'min' => 0,
      'max' => 4294967295,
    ],
    'date_upd' => 
    [
      'type' => 'int unsigned',
      'null' => 'NO',
      'key' => '',
      'default' => NULL,
      'extra' => '',
      'min' => 0,
      'max' => 4294967295,
    ],
    'iso' => 
    [
      'type' => 'char',
      'null' => 'NO',
      'key' => '',
      'default' => NULL,
      'extra' => '',
      'min' => 0,
      'max' => 2,
    ],
    'lang' => 
    [
      'type' => 'char',
      'null' => 'NO',
      'key' => '',
      'default' => NULL,
      'extra' => '',
      'min' => 0,
      'max' => 5,
    ],
    'name' => 
    [
      'type' => 'varchar',
      'null' => 'NO',
      'key' => '',
      'default' => NULL,
      'extra' => '',
      'min' => 0,
      'max' => 32,
    ],
  ],
  'hp_admin_manager' => 
  [
    'id' => 
    [
      'type' => 'int unsigned',
      'null' => 'NO',
      'key' => 'PRI',
      'default' => NULL,
      'extra' => 'auto_increment',
      'min' => 0,
      'max' => 4294967295,
    ],
    'app_id' => 
    [
      'type' => 'int unsigned',
      'null' => 'NO',
      'key' => 'MUL',
      'default' => NULL,
      'extra' => '',
      'min' => 0,
      'max' => 4294967295,
    ],
    'status' => 
    [
      'type' => 'tinyint unsigned',
      'null' => 'NO',
      'key' => '',
      'default' => '0',
      'extra' => '',
      'min' => 0,
      'max' => 255,
    ],
    'date_add' => 
    [
      'type' => 'int unsigned',
      'null' => 'NO',
      'key' => '',
      'default' => NULL,
      'extra' => '',
      'min' => 0,
      'max' => 4294967295,
    ],
    'date_upd' => 
    [
      'type' => 'int unsigned',
      'null' => 'NO',
      'key' => '',
      'default' => NULL,
      'extra' => '',
      'min' => 0,
      'max' => 4294967295,
    ],
    'lang_id' => 
    [
      'type' => 'int unsigned',
      'null' => 'NO',
      'key' => 'MUL',
      'default' => NULL,
      'extra' => '',
      'min' => 0,
      'max' => 4294967295,
    ],
    'user' => 
    [
      'type' => 'varchar',
      'null' => 'NO',
      'key' => '',
      'default' => NULL,
      'extra' => '',
      'min' => 0,
      'max' => 64,
    ],
    'email' => 
    [
      'type' => 'varchar',
      'null' => 'NO',
      'key' => '',
      'default' => '',
      'extra' => '',
      'min' => 0,
      'max' => 64,
    ],
    'phone' => 
    [
      'type' => 'varchar',
      'null' => 'NO',
      'key' => '',
      'default' => '',
      'extra' => '',
      'min' => 0,
      'max' => 16,
    ],
    'pass' => 
    [
      'type' => 'varchar',
      'null' => 'NO',
      'key' => '',
      'default' => NULL,
      'extra' => '',
      'min' => 0,
      'max' => 100,
    ],
    'lastname' => 
    [
      'type' => 'varchar',
      'null' => 'NO',
      'key' => '',
      'default' => '',
      'extra' => '',
      'min' => 0,
      'max' => 16,
    ],
    'firstname' => 
    [
      'type' => 'varchar',
      'null' => 'NO',
      'key' => '',
      'default' => '',
      'extra' => '',
      'min' => 0,
      'max' => 16,
    ],
  ],
  'hp_admin_translation' => 
  [
    'id' => 
    [
      'type' => 'int unsigned',
      'null' => 'NO',
      'key' => 'PRI',
      'default' => NULL,
      'extra' => 'auto_increment',
      'min' => 0,
      'max' => 4294967295,
    ],
    'status' => 
    [
      'type' => 'tinyint unsigned',
      'null' => 'NO',
      'key' => '',
      'default' => '0',
      'extra' => '',
      'min' => 0,
      'max' => 255,
    ],
    'date_add' => 
    [
      'type' => 'int unsigned',
      'null' => 'NO',
      'key' => '',
      'default' => NULL,
      'extra' => '',
      'min' => 0,
      'max' => 4294967295,
    ],
    'date_upd' => 
    [
      'type' => 'int unsigned',
      'null' => 'NO',
      'key' => '',
      'default' => NULL,
      'extra' => '',
      'min' => 0,
      'max' => 4294967295,
    ],
    'from' => 
    [
      'type' => 'tinyint unsigned',
      'null' => 'NO',
      'key' => 'MUL',
      'default' => NULL,
      'extra' => '',
      'min' => 0,
      'max' => 255,
    ],
    'to' => 
    [
      'type' => 'tinyint unsigned',
      'null' => 'NO',
      'key' => '',
      'default' => NULL,
      'extra' => '',
      'min' => 0,
      'max' => 255,
    ],
    'crc32' => 
    [
      'type' => 'int unsigned',
      'null' => 'NO',
      'key' => '',
      'default' => NULL,
      'extra' => '',
      'min' => 0,
      'max' => 4294967295,
    ],
    'key' => 
    [
      'type' => 'text',
      'null' => 'NO',
      'key' => '',
      'default' => NULL,
      'extra' => '',
      'min' => 0,
      'max' => 65535,
    ],
    'data' => 
    [
      'type' => 'text',
      'null' => 'NO',
      'key' => '',
      'default' => NULL,
      'extra' => '',
      'min' => 0,
      'max' => 65535,
    ],
  ],
  'hp_admin_user' => 
  [
    'id' => 
    [
      'type' => 'int unsigned',
      'null' => 'NO',
      'key' => 'PRI',
      'default' => NULL,
      'extra' => 'auto_increment',
      'min' => 0,
      'max' => 4294967295,
    ],
    'app_id' => 
    [
      'type' => 'int unsigned',
      'null' => 'NO',
      'key' => 'MUL',
      'default' => NULL,
      'extra' => '',
      'min' => 0,
      'max' => 4294967295,
    ],
    'status' => 
    [
      'type' => 'tinyint unsigned',
      'null' => 'NO',
      'key' => '',
      'default' => '0',
      'extra' => '',
      'min' => 0,
      'max' => 255,
    ],
    'date_add' => 
    [
      'type' => 'int unsigned',
      'null' => 'NO',
      'key' => '',
      'default' => NULL,
      'extra' => '',
      'min' => 0,
      'max' => 4294967295,
    ],
    'date_upd' => 
    [
      'type' => 'int unsigned',
      'null' => 'NO',
      'key' => '',
      'default' => NULL,
      'extra' => '',
      'min' => 0,
      'max' => 4294967295,
    ],
    'lang_id' => 
    [
      'type' => 'int unsigned',
      'null' => 'NO',
      'key' => 'MUL',
      'default' => NULL,
      'extra' => '',
      'min' => 0,
      'max' => 4294967295,
    ],
    'user' => 
    [
      'type' => 'varchar',
      'null' => 'NO',
      'key' => '',
      'default' => NULL,
      'extra' => '',
      'min' => 0,
      'max' => 64,
    ],
    'email' => 
    [
      'type' => 'varchar',
      'null' => 'NO',
      'key' => '',
      'default' => '',
      'extra' => '',
      'min' => 0,
      'max' => 64,
    ],
    'phone' => 
    [
      'type' => 'varchar',
      'null' => 'NO',
      'key' => '',
      'default' => '',
      'extra' => '',
      'min' => 0,
      'max' => 16,
    ],
    'pass' => 
    [
      'type' => 'varchar',
      'null' => 'NO',
      'key' => '',
      'default' => NULL,
      'extra' => '',
      'min' => 0,
      'max' => 100,
    ],
    'lastname' => 
    [
      'type' => 'varchar',
      'null' => 'NO',
      'key' => '',
      'default' => '',
      'extra' => '',
      'min' => 0,
      'max' => 16,
    ],
    'firstname' => 
    [
      'type' => 'varchar',
      'null' => 'NO',
      'key' => '',
      'default' => '',
      'extra' => '',
      'min' => 0,
      'max' => 16,
    ],
  ],
];