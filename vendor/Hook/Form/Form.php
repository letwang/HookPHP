<?php
namespace Hook\Form;
use Yaf\Session;

class Form
{
    public static $key;
    public static function form(string $name, string $action, string $method = 'post', string $param = ''): string
    {
        self::$key = $name;
        $form = '<form id="'.$name.'" name="'.$name.'" action="'.$action.'" method="'.$method.'"';
        if (!empty($param)) {
            $form .= ' '.$param;
        }
        $form .= '>';

        if ($method !== 'get') {
            $form .= self::hidden('token', Session::getInstance()->get('user')['security']['token']);
        }
        return $form;
    }

    public static function label(string $name, string $param = ''): string
    {
        return '<label id="'.self::$key.'.'.$name.'.label" for="'.self::$key.'.'.$name.'" '.$param.'>'.l(self::$key.'.'.$name).'</label>';
    }

    public static function input(string $name, string $value = '', string $param = '', string $type = 'text'): string
    {
        $field = '<input type="'.$type.'" id="'.self::$key.'.'.$name.'" name="'.$name.'" value="'.$value.'" placeholder="'.l(self::$key.'.'.$name).'"';
        if (!empty($param)) {
            $field .= ' '.$param;
        }
        $field .= ' />';
        return $field;
    }

    public static function hidden(string $name, string $value = '', string $param = ''): string
    {
        return self::input($name, $value, $param, 'hidden');
    }

    public static function password(string $name, string $value = '', string $param = ''): string
    {
        return self::input($name, $value, $param, 'password');
    }

    public static function file(string $name, string $param = ''): string
    {
        return self::input($name, '', $param, 'file');
    }

    public static function submit(string $name, string $param = '', string $type = 'submit'): string
    {
        return self::input($name, l(self::$key.'.'.$name), $param, $type);
    }

    public static function button(string $name, string $param = '', string $type = 'submit'): string
    {
        $field = '<button id="'.self::$key.'.'.$name.'" name="'.$name.'" type="'.$type.'"';
        if (!empty($param)) {
            $field .= ' '.$param;
        }
        $field .= '>'.l(self::$key.'.'.$name).'</button>';
        return $field;
    }

    public static function checked(string $name, string $value, bool $default = false, string $param = '', string $type = 'checkbox'): string
    {
        $field = '<input type="'.$type.'" id="'.self::$key.'.'.$name.'" name="'.$name.'"';
        if (!empty($value)) {
            $field .= ' value="'.$value.'"';
        }
        if ($default === true) {
            $field .= ' checked="checked"';
        }
        if (!empty($param)) {
            $field .= ' '.$param;
        }
        $field .= ' />';

        return $field;
    }

    public static function checkbox(string $name, string $value, bool $default = false, string $param = ''): string
    {
        return self::checked($name, $value, $default, $param, 'checkbox');
    }

    public static function radio(string $name, string $value, bool $default = false, string $param = ''): string
    {
        return self::checked($name, $value, $default, $param, 'radio');
    }

    public static function select(string $name, array $value, string $default = '', string $param = ''): string
    {
        $field = '<select';
        if (!strstr($param, 'id=')) {
            $field .= ' id="'.self::$key.'.'.$name.'"';
        }
        $field .= ' name="'.$name.'"';
        if (!empty($param)) {
            $field .= ' '.$param;
        }
        $field .= '>'."\n";

        foreach ($value as $id) {
            $field .= '  <option value="'.$id.'"';
            if ($default === $id) {
                $field .= ' selected="selected"';
            }
            $field .= '>'.l(self::$key.'.'.$name.'_'.$id).'</option>'."\n";
        }

        $field .= '</select>'."\n";
        return $field;
    }

    public static function textarea(string $name, string $value = '', string $param = ''): string
    {
        $field = '<textarea id="'.self::$key.'.'.$name.'" name="'.$name.'"';
        if (!empty($param)) {
            $field .= ' '.$param;
        }
        $field .= '>'.$value.'</textarea>';
        return $field;
    }
}