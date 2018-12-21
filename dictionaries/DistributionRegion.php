<?php

namespace app\dictionaries;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * Description of DistributionRegion
 *
 * @author Fredy Nurman Saleh <email@fredyns.net>
 */
class DistributionRegion
{
    const A = 'A';
    const B = 'B';
    const C = 'C';
    const D = 'D';
    const E = 'E';
    const F = 'F';
    const G = 'G';
    const H = 'H';
    const I = 'I';
    const J = 'J';
    const K = 'K';
    const L = 'L';
    const M = 'M';
    const N = 'N';
    const O = 'O';
    const P = 'P';
    const Q = 'Q';
    const R = 'R';
    const S = 'S';
    const T = 'T';
    const U = 'U';
    const V = 'V';

    /**
     * @param int $value
     * @return string
     */
    public static function getLabel($value)
    {
        return ArrayHelper::getValue(static::all(), $value, $value);
    }

    /**
     * @return array
     */
    public static function map()
    {
        return [
            static::A => 'Wilayah Aceh',
            static::B => 'Wilayah Sumatera Utara',
            static::C => 'Wilayah Sumatera Barat',
            static::D => 'Wilayah Riau dan Kepulauan Riau',
            static::E => 'Wilayah Bangka Belitung',
            static::F => 'Wilayah Sumatera Selatan, Jambi dan Bengkulu',
            static::G => 'Wilayah Kalimantan Barat',
            static::H => 'Wilayah Kalimantan Selatan dan Tengah',
            static::I => 'Wilayah Kalimantan Timur dan Utara',
            static::J => 'Wilayah Sulawesi Utara, Tengah dan Gorontalo',
            static::K => 'Wilayah Sulawesi Selatan, Tenggara dan Barat',
            static::L => 'Wilayah Maluku dan Maluku Utara',
            static::M => 'Wilayah Nusa Tenggara Barat',
            static::N => 'Wilayah Nusa Tenggara Timur',
            static::O => 'Wilayah Papua dan Papua Barat',
            static::P => 'Distribusi Jakarta Raya',
            static::Q => 'Distribusi Jawa Barat',
            static::R => 'Distribusi Jawa Timur',
            static::S => 'Distribusi Jawa Tengah dan DI Yogyakarta',
            static::T => 'Distribusi Bali',
            static::U => 'Distribusi Lampung',
            static::V => 'Distribusi Banten',
        ];
    }

}