<?php
declare(strict_types=1);

return [
  'hp_iot_config' => 
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
      'key' => 'UNI',
      'default' => NULL,
      'extra' => '',
      'min' => 0,
      'max' => 32,
    ],
    'value' => 
    [
      'type' => 'varchar',
      'null' => 'NO',
      'key' => '',
      'default' => NULL,
      'extra' => '',
      'min' => 0,
      'max' => 255,
    ],
  ],
  'hp_iot_element' => 
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
      'max' => 32,
    ],
  ],
  'hp_iot_element_lang' => 
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
    'element_id' => 
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
      'key' => '',
      'default' => NULL,
      'extra' => '',
      'min' => 0,
      'max' => 32,
    ],
  ],
  'hp_iot_hook_hook' => 
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
    'position' => 
    [
      'type' => 'int unsigned',
      'null' => 'NO',
      'key' => '',
      'default' => '0',
      'extra' => '',
      'min' => 0,
      'max' => 4294967295,
    ],
    'key' => 
    [
      'type' => 'varchar',
      'null' => 'NO',
      'key' => 'UNI',
      'default' => NULL,
      'extra' => '',
      'min' => 0,
      'max' => 32,
    ],
  ],
  'hp_iot_hook_hook_lang' => 
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
    'hook_id' => 
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
      'max' => 32,
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
  'hp_iot_hook_hook_module' => 
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
    'position' => 
    [
      'type' => 'int unsigned',
      'null' => 'NO',
      'key' => '',
      'default' => '0',
      'extra' => '',
      'min' => 0,
      'max' => 4294967295,
    ],
    'hook_id' => 
    [
      'type' => 'int unsigned',
      'null' => 'NO',
      'key' => 'MUL',
      'default' => NULL,
      'extra' => '',
      'min' => 0,
      'max' => 4294967295,
    ],
    'module_id' => 
    [
      'type' => 'int unsigned',
      'null' => 'NO',
      'key' => 'MUL',
      'default' => NULL,
      'extra' => '',
      'min' => 0,
      'max' => 4294967295,
    ],
  ],
  'hp_iot_hook_module' => 
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
    'version' => 
    [
      'type' => 'varchar',
      'null' => 'NO',
      'key' => '',
      'default' => NULL,
      'extra' => '',
      'min' => 0,
      'max' => 8,
    ],
    'key' => 
    [
      'type' => 'varchar',
      'null' => 'NO',
      'key' => 'UNI',
      'default' => NULL,
      'extra' => '',
      'min' => 0,
      'max' => 32,
    ],
  ],
  'hp_iot_menu' => 
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
    'position' => 
    [
      'type' => 'int unsigned',
      'null' => 'NO',
      'key' => '',
      'default' => '0',
      'extra' => '',
      'min' => 0,
      'max' => 4294967295,
    ],
    'parent' => 
    [
      'type' => 'int unsigned',
      'null' => 'YES',
      'key' => 'MUL',
      'default' => NULL,
      'extra' => '',
      'min' => 0,
      'max' => 4294967295,
    ],
    'url' => 
    [
      'type' => 'varchar',
      'null' => 'NO',
      'key' => '',
      'default' => '',
      'extra' => '',
      'min' => 0,
      'max' => 32,
    ],
    'icon' => 
    [
      'type' => 'varchar',
      'null' => 'NO',
      'key' => '',
      'default' => '',
      'extra' => '',
      'min' => 0,
      'max' => 32,
    ],
  ],
  'hp_iot_menu_lang' => 
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
    'menu_id' => 
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
      'key' => '',
      'default' => NULL,
      'extra' => '',
      'min' => 0,
      'max' => 32,
    ],
  ],
  'hp_iot_rbac_group' => 
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
  ],
  'hp_iot_rbac_group_lang' => 
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
    'group_id' => 
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
      'key' => '',
      'default' => NULL,
      'extra' => '',
      'min' => 0,
      'max' => 32,
    ],
  ],
  'hp_iot_rbac_group_manager' => 
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
    'group_id' => 
    [
      'type' => 'int unsigned',
      'null' => 'NO',
      'key' => 'MUL',
      'default' => NULL,
      'extra' => '',
      'min' => 0,
      'max' => 4294967295,
    ],
    'manager_id' => 
    [
      'type' => 'int unsigned',
      'null' => 'NO',
      'key' => 'MUL',
      'default' => NULL,
      'extra' => '',
      'min' => 0,
      'max' => 4294967295,
    ],
  ],
  'hp_iot_rbac_group_role' => 
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
    'group_id' => 
    [
      'type' => 'int unsigned',
      'null' => 'NO',
      'key' => 'MUL',
      'default' => NULL,
      'extra' => '',
      'min' => 0,
      'max' => 4294967295,
    ],
    'role_id' => 
    [
      'type' => 'int unsigned',
      'null' => 'NO',
      'key' => 'MUL',
      'default' => NULL,
      'extra' => '',
      'min' => 0,
      'max' => 4294967295,
    ],
  ],
  'hp_iot_rbac_manager_role' => 
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
    'manager_id' => 
    [
      'type' => 'int unsigned',
      'null' => 'NO',
      'key' => 'MUL',
      'default' => NULL,
      'extra' => '',
      'min' => 0,
      'max' => 4294967295,
    ],
    'role_id' => 
    [
      'type' => 'int unsigned',
      'null' => 'NO',
      'key' => 'MUL',
      'default' => NULL,
      'extra' => '',
      'min' => 0,
      'max' => 4294967295,
    ],
  ],
  'hp_iot_rbac_permission' => 
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
    'role_id' => 
    [
      'type' => 'int unsigned',
      'null' => 'NO',
      'key' => 'MUL',
      'default' => NULL,
      'extra' => '',
      'min' => 0,
      'max' => 4294967295,
    ],
    'type' => 
    [
      'type' => 'int unsigned',
      'null' => 'NO',
      'key' => '',
      'default' => '0',
      'extra' => '',
      'min' => 0,
      'max' => 4294967295,
    ],
    'relation_id' => 
    [
      'type' => 'int unsigned',
      'null' => 'NO',
      'key' => '',
      'default' => NULL,
      'extra' => '',
      'min' => 0,
      'max' => 4294967295,
    ],
  ],
  'hp_iot_rbac_role' => 
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
  ],
  'hp_iot_rbac_role_lang' => 
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
    'role_id' => 
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
      'key' => '',
      'default' => NULL,
      'extra' => '',
      'min' => 0,
      'max' => 32,
    ],
  ],
  'hp_iot_theme' => 
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
      'key' => 'UNI',
      'default' => NULL,
      'extra' => '',
      'min' => 0,
      'max' => 32,
    ],
  ],
];