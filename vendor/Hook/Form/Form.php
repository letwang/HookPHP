<?php
namespace Hook\Form;
use Yaf\Session;

class Form
{
    static $key;
    public static function form(string $name, string $action, string $method = 'post', string $parameters = ''): string
    {
        self::$key = $name;
        $form = '<form id="'.self::$key.'" name="'.$name.'" action="'.$action.'" method="'.$method.'"';
        if (!empty($parameters)) {
            $form .= ' '.$parameters;
        }
        $form .= '>';

        if ($method == 'post') {
            $form .= self::hidden('token', Session::getInstance()->get('user')['security']['token']);
        }
        return $form;
    }

    public static function submit(string $name, string $type = 'submit', string $value = 'Submit', string $parameters = ''): string
    {
        $field = '<input id="'.self::$key.'_'.$name.'" name="'.$name.'" type="'.$type.'" value="'.$value.'"';
        if (!empty($parameters)) {
            $field .= ' '.$parameters;
        }
        $field .= ' />';
        return $field;
    }

    public static function button(string $name, string $type = 'submit', string $value = 'Submit', string $parameters = ''): string
    {
        $field = '<button id="'.self::$key.'_'.$name.'" name="'.$name.'" type="'.$type.'"';
        if (!empty($parameters)) {
            $field .= ' '.$parameters;
        }
        $field .= '>'.$value.'</button>';
        return $field;
    }

    public static function label(string $for, string $text, string $parameters = ''): string
    {
        return '<label id="'.self::$key.'_'.$for.'_label" for="'.self::$key.'_'.$for.'" '.$parameters.'>'.$text.'</label>';
    }

    public static function input(string $name, string $value = '', string $parameters = '', string $type = 'text'): string
    {
        $field = '<input type="'.$type.'" id="'.self::$key.'_'.$name.'" name="'.$name.'" value="'.$value.'"';
        if (!empty($parameters)) {
            $field .= ' '.$parameters;
        }
        $field .= ' />';
        return $field;
    }

    public static function password(string $name, string $value = '', string $parameters = 'maxlength="40"'): string
    {
        return self::input($name, $value, $parameters, 'password');
    }

    public static function checked(string $name, string $type, string $value = '', bool $checked = false, string $parameters = ''): string
    {
        $field = '<input type="'.$type.'" id="'.self::$key.'_'.$name.'" name="'.$name.'"';
        if (!empty($value)) {
            $field .= ' value="'.$value.'"';
        }
        if ($checked === true) {
            $field .= ' checked="checked"';
        }
        if (!empty($parameters)) {
            $field .= ' '.$parameters;
        }
        $field .= ' />';

        return $field;
    }

    public static function checkbox(string $name, string $value = '', bool $checked = false, string $parameters = ''): string
    {
        return self::checked($name, 'checkbox', $value, $checked, $parameters);
    }

    public static function radio(string $name, string $value = '', bool $checked = false, string $parameters = ''): string
    {
        return self::checked($name, 'radio', $value, $checked, $parameters);
    }

    public static function textarea(string $name, int $width, int $height, string $text = '', string $parameters = ''): string
    {
        $field = '<textarea id="'.self::$key.'_'.$name.'" name="'.$name.'" cols="'.$width.'" rows="'.$height.'"';
        if (!empty($parameters)) {
            $field .= ' '.$parameters;
        }
        $field .= '>'.$text.'</textarea>';
        return $field;
    }

    public static function hidden(string $name, string $value = '', string $parameters = ''): string
    {
        $field = '<input type="hidden" id="'.self::$key.'_'.$name.'" name="'.$name.'" value="'.$value.'"';
        if (!empty($parameters)) {
            $field .= ' '.$parameters;
        }
        $field .= ' />';
        return $field;
    }

    public static function file(string $name, string $parameters = 'size="50"'): string
    {
        return self::input($name, '', $parameters, 'file');
    }

    public static function select(string $name, array $values, string $default = '', string $parameters = ''): string
    {
        $field = '<select';
        if (!strstr($parameters, 'id=')) {
            $field .= ' id="'.self::$key.'_'.$name.'"';
        }
        $field .= ' name="'.$name.'"';
        if (!empty($parameters)) {
            $field .= ' '.$parameters;
        }
        $field .= '>'."\n";

        foreach ($values as $value) {
            $field .= '  <option value="'.$value['id'].'"';
            if ($default == $value['id']) {
                $field .= ' selected="selected"';
            }
            $field .= '>'.$value['text'].'</option>'."\n";
        }

        $field .= '</select>'."\n";
        return $field;
    }
}
