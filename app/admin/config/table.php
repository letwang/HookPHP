<?php
declare(strict_types=1);

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
      'type' => 'tinyint',
      'null' => 'NO',
      'key' => '',
      'default' => '0',
      'extra' => '',
      'min' => 0,
      'max' => 1,
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
  'hp_admin_country' => 
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
    'zone_id' => 
    [
      'type' => 'int unsigned',
      'null' => 'NO',
      'key' => 'MUL',
      'default' => NULL,
      'extra' => '',
      'min' => 0,
      'max' => 4294967295,
    ],
    'currency_id' => 
    [
      'type' => 'int unsigned',
      'null' => 'NO',
      'key' => '',
      'default' => '0',
      'extra' => '',
      'min' => 0,
      'max' => 4294967295,
    ],
    'iso_code' => 
    [
      'type' => 'varchar',
      'null' => 'NO',
      'key' => 'MUL',
      'default' => NULL,
      'extra' => '',
      'min' => 0,
      'max' => 3,
    ],
    'call_prefix' => 
    [
      'type' => 'int unsigned',
      'null' => 'NO',
      'key' => '',
      'default' => '0',
      'extra' => '',
      'min' => 0,
      'max' => 4294967295,
    ],
    'status' => 
    [
      'type' => 'tinyint',
      'null' => 'NO',
      'key' => '',
      'default' => '0',
      'extra' => '',
      'min' => 0,
      'max' => 1,
    ],
    'contains_states' => 
    [
      'type' => 'tinyint',
      'null' => 'NO',
      'key' => '',
      'default' => '0',
      'extra' => '',
      'min' => 0,
      'max' => 1,
    ],
    'need_identification_number' => 
    [
      'type' => 'tinyint',
      'null' => 'NO',
      'key' => '',
      'default' => '0',
      'extra' => '',
      'min' => 0,
      'max' => 1,
    ],
    'need_zip_code' => 
    [
      'type' => 'tinyint',
      'null' => 'NO',
      'key' => '',
      'default' => '1',
      'extra' => '',
      'min' => 0,
      'max' => 1,
    ],
    'zip_code_format' => 
    [
      'type' => 'varchar',
      'null' => 'NO',
      'key' => '',
      'default' => '',
      'extra' => '',
      'min' => 0,
      'max' => 12,
    ],
    'display_tax_label' => 
    [
      'type' => 'tinyint',
      'null' => 'NO',
      'key' => '',
      'default' => '0',
      'extra' => '',
      'min' => 0,
      'max' => 1,
    ],
  ],
  'hp_admin_country_lang' => 
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
    'country_id' => 
    [
      'type' => 'int unsigned',
      'null' => 'NO',
      'key' => 'MUL',
      'default' => NULL,
      'extra' => '',
      'min' => 0,
      'max' => 4294967295,
    ],
    'lang_id' => 
    [
      'type' => 'int unsigned',
      'null' => 'NO',
      'key' => '',
      'default' => NULL,
      'extra' => '',
      'min' => 0,
      'max' => 4294967295,
    ],
    'name' => 
    [
      'type' => 'varchar',
      'null' => 'NO',
      'key' => '',
      'default' => NULL,
      'extra' => '',
      'min' => 0,
      'max' => 64,
    ],
  ],
  'hp_admin_currency' => 
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
    'name' => 
    [
      'type' => 'varchar',
      'null' => 'NO',
      'key' => '',
      'default' => NULL,
      'extra' => '',
      'min' => 0,
      'max' => 64,
    ],
    'iso_code' => 
    [
      'type' => 'varchar',
      'null' => 'NO',
      'key' => 'MUL',
      'default' => '0',
      'extra' => '',
      'min' => 0,
      'max' => 3,
    ],
    'numeric_iso_code' => 
    [
      'type' => 'varchar',
      'null' => 'YES',
      'key' => '',
      'default' => NULL,
      'extra' => '',
      'min' => 0,
      'max' => 3,
    ],
    'precision' => 
    [
      'type' => 'int unsigned',
      'null' => 'NO',
      'key' => '',
      'default' => '6',
      'extra' => '',
      'min' => 0,
      'max' => 4294967295,
    ],
    'conversion_rate' => 
    [
      'type' => 'decimal',
      'null' => 'NO',
      'key' => '',
      'default' => NULL,
      'extra' => '',
      'min' => NULL,
      'max' => NULL,
    ],
    'status' => 
    [
      'type' => 'tinyint',
      'null' => 'NO',
      'key' => '',
      'default' => '1',
      'extra' => '',
      'min' => 0,
      'max' => 1,
    ],
    'unofficial' => 
    [
      'type' => 'tinyint',
      'null' => 'NO',
      'key' => '',
      'default' => '0',
      'extra' => '',
      'min' => 0,
      'max' => 1,
    ],
    'modified' => 
    [
      'type' => 'tinyint',
      'null' => 'NO',
      'key' => '',
      'default' => '0',
      'extra' => '',
      'min' => 0,
      'max' => 1,
    ],
  ],
  'hp_admin_currency_lang' => 
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
    'currency_id' => 
    [
      'type' => 'int unsigned',
      'null' => 'NO',
      'key' => 'MUL',
      'default' => NULL,
      'extra' => '',
      'min' => 0,
      'max' => 4294967295,
    ],
    'lang_id' => 
    [
      'type' => 'int unsigned',
      'null' => 'NO',
      'key' => '',
      'default' => NULL,
      'extra' => '',
      'min' => 0,
      'max' => 4294967295,
    ],
    'name' => 
    [
      'type' => 'varchar',
      'null' => 'NO',
      'key' => '',
      'default' => NULL,
      'extra' => '',
      'min' => 0,
      'max' => 255,
    ],
    'symbol' => 
    [
      'type' => 'varchar',
      'null' => 'NO',
      'key' => '',
      'default' => NULL,
      'extra' => '',
      'min' => 0,
      'max' => 255,
    ],
    'pattern' => 
    [
      'type' => 'varchar',
      'null' => 'YES',
      'key' => '',
      'default' => NULL,
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
    'status' => 
    [
      'type' => 'tinyint',
      'null' => 'NO',
      'key' => '',
      'default' => '0',
      'extra' => '',
      'min' => 0,
      'max' => 1,
    ],
    'iso_code' => 
    [
      'type' => 'varchar',
      'null' => 'NO',
      'key' => '',
      'default' => NULL,
      'extra' => '',
      'min' => 0,
      'max' => 2,
    ],
    'language_code' => 
    [
      'type' => 'varchar',
      'null' => 'NO',
      'key' => '',
      'default' => NULL,
      'extra' => '',
      'min' => 0,
      'max' => 5,
    ],
    'locale' => 
    [
      'type' => 'varchar',
      'null' => 'NO',
      'key' => '',
      'default' => NULL,
      'extra' => '',
      'min' => 0,
      'max' => 5,
    ],
    'date_format_lite' => 
    [
      'type' => 'varchar',
      'null' => 'NO',
      'key' => '',
      'default' => NULL,
      'extra' => '',
      'min' => 0,
      'max' => 32,
    ],
    'date_format_full' => 
    [
      'type' => 'varchar',
      'null' => 'NO',
      'key' => '',
      'default' => NULL,
      'extra' => '',
      'min' => 0,
      'max' => 32,
    ],
    'is_rtl' => 
    [
      'type' => 'tinyint',
      'null' => 'NO',
      'key' => '',
      'default' => '0',
      'extra' => '',
      'min' => 0,
      'max' => 1,
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
      'type' => 'tinyint',
      'null' => 'NO',
      'key' => '',
      'default' => '0',
      'extra' => '',
      'min' => 0,
      'max' => 1,
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
  'hp_admin_state' => 
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
    'country_id' => 
    [
      'type' => 'int unsigned',
      'null' => 'NO',
      'key' => 'MUL',
      'default' => NULL,
      'extra' => '',
      'min' => 0,
      'max' => 4294967295,
    ],
    'zone_id' => 
    [
      'type' => 'int unsigned',
      'null' => 'NO',
      'key' => 'MUL',
      'default' => NULL,
      'extra' => '',
      'min' => 0,
      'max' => 4294967295,
    ],
    'name' => 
    [
      'type' => 'varchar',
      'null' => 'NO',
      'key' => 'MUL',
      'default' => NULL,
      'extra' => '',
      'min' => 0,
      'max' => 80,
    ],
    'iso_code' => 
    [
      'type' => 'varchar',
      'null' => 'NO',
      'key' => '',
      'default' => NULL,
      'extra' => '',
      'min' => 0,
      'max' => 7,
    ],
    'tax_behavior' => 
    [
      'type' => 'int unsigned',
      'null' => 'NO',
      'key' => '',
      'default' => '0',
      'extra' => '',
      'min' => 0,
      'max' => 4294967295,
    ],
    'status' => 
    [
      'type' => 'tinyint',
      'null' => 'NO',
      'key' => '',
      'default' => '0',
      'extra' => '',
      'min' => 0,
      'max' => 1,
    ],
  ],
  'hp_admin_timezone' => 
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
      'type' => 'tinyint',
      'null' => 'NO',
      'key' => '',
      'default' => '0',
      'extra' => '',
      'min' => 0,
      'max' => 1,
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
      'default' => '0',
      'extra' => '',
      'min' => 0,
      'max' => 255,
    ],
    'to' => 
    [
      'type' => 'tinyint unsigned',
      'null' => 'NO',
      'key' => '',
      'default' => '0',
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
      'type' => 'tinyint',
      'null' => 'NO',
      'key' => '',
      'default' => '0',
      'extra' => '',
      'min' => 0,
      'max' => 1,
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
  'hp_admin_zone' => 
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
    'name' => 
    [
      'type' => 'varchar',
      'null' => 'NO',
      'key' => '',
      'default' => NULL,
      'extra' => '',
      'min' => 0,
      'max' => 64,
    ],
    'status' => 
    [
      'type' => 'tinyint',
      'null' => 'NO',
      'key' => '',
      'default' => '0',
      'extra' => '',
      'min' => 0,
      'max' => 1,
    ],
  ],
];