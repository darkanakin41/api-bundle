<?php
/**
 * Created by PhpStorm.
 * User: darka
 * Date: 09/01/2019
 * Time: 21:06
 */

namespace PLejeune\ApiBundle\Nomenclature;


use PLejeune\CoreBundle\Nomenclature\AbstractNomenclature;

class EndPointNomenclature extends AbstractNomenclature
{
    const CARD = 'card';
    const FUT_CHAMPION = 'fut_champion';
    const GAMES = 'games';
    const PLAYER = 'player';
    const PRICE = 'price';
    const STREAM = 'stream';
    const YOUTUBE = 'youtube';
}