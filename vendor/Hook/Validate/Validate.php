<?php
namespace Hook\Validate;

use Yaconf;

class Validate
{
    public static function isEmpty(?string $value): bool
    {
        return $value === '' || $value === null;
    }

    public static function isIp2Long(string $value): bool
    {
        return preg_match('/^-?[0-9]+$/', (string) $value);
    }

    public static function isEmail(string $value): bool
    {
        return preg_match('/^'.Yaconf::get('regexp')['core']['email'].'$/', $value);
    }

    public static function isUrl(string $value): bool
    {
        return preg_match('/^'.Yaconf::get('regexp')['core']['url'].'$/', $value);
    }

    public static function isMd5(string $value): bool
    {
        return preg_match('/^[a-f0-9A-F]{32}$/', $value);
    }

    public static function isSha1(string $value): bool
    {
        return preg_match('/^[a-fA-F0-9]{40}$/', $value);
    }

    public static function isFloat(string $value): bool
    {
        return preg_match('/^'.Yaconf::get('regexp')['core']['float'].'$/', $value);
    }

    public static function isBool(string $value): bool
    {
        return filter_var($value, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) !== null;
    }

    public static function isInt(string $value): bool
    {
        return preg_match('/^'.Yaconf::get('regexp')['core']['int'].'$/', $value);
    }

    public static function isPrice(string $value): bool
    {
        return preg_match('/^[0-9]{1,10}(\.[0-9]{1,9})?$/', $value);
    }

    public static function isIsoCode(string $value): bool
    {
        return preg_match('/^[a-zA-Z]{2,3}$/', $value);
    }

    public static function isLanguageCode(string $value): bool
    {
        return preg_match('/^[a-zA-Z]{2}(-[a-zA-Z]{2})?$/', $value);
    }

    public static function isPhone(string $value): bool
    {
        return preg_match('/^'.Yaconf::get('regexp')['core']['phone'].'$/', $value);
    }

    public static function isMobile(string $value): bool
    {
        return preg_match('/^'.Yaconf::get('regexp')['core']['mobile'].'$/', $value);
    }

    public static function isGenericName(string $value): bool
    {
        return preg_match('/^[^<>={}]*$/u', $value);
    }

    public static function isZh(string $value): bool
    {
        return preg_match('/^'.Yaconf::get('regexp')['core']['zh'].'$/', $value);
    }

    public static function isMb(string $value): bool
    {
        return preg_match('/^'.Yaconf::get('regexp')['core']['mb'].'$/', $value);
    }

    public static function isQq(string $value): bool
    {
        return preg_match('/^'.Yaconf::get('regexp')['core']['qq'].'$/', $value);
    }

    public static function isPostal(string $value): bool
    {
        return preg_match('/^'.Yaconf::get('regexp')['core']['postal'].'$/', $value);
    }

    public static function isIpv4(string $value): bool
    {
        return preg_match('/^'.Yaconf::get('regexp')['core']['ipv4'].'$/', $value);
    }

    public static function isCard(string $value): bool
    {
        return preg_match('/^'.Yaconf::get('regexp')['core']['card'].'$/', $value);
    }

    public static function isDate(string $value): bool
    {
        return preg_match('/^'.Yaconf::get('regexp')['core']['date'].'$/', $value);
    }

    public static function isName(string $value): bool
    {
        return preg_match('/^'.Yaconf::get('regexp')['core']['name'].'$/', $value);
    }
}