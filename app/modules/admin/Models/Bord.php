<?php

/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 4/5/16
 * Time: 10:16 AM
 */
class Bord
{

    public static function getInsList(){

        $install_list = [
            'locatie_list' => [
                'Maretraite' => 'Maretraite',
                'Lelydorp' => 'Lelydorp',
                'Kwatta' => 'Kwatta',
                'Munder' => 'Munder',
                'Beekhuizen' => 'Beekhuizen',
                'Domburg' => 'Domburg',
                'Leiding' => 'Leiding',
                'Geyersvlijt' => 'Geyersvlijt',
                'Clevia' => 'Clevia',
                'Combé' => 'Combé',
                'Tourtonne' => 'Tourtonne',
                'Morgenstond' => 'Morgenstond',
                'Mon_Plasir' => 'Mon Plasir',
                'Centrum' => 'Centrum',
                'Houttuin' => 'Houttuin',
                'Benispark' => 'Benispark',
                'Charlesburg' => 'Charlesburg',
                'Maikoe' => 'Maikoe',
                'Pad_van_Wanica' => 'Pad van Wanica',
                'Dijkveld' => 'Dijkveld',
                'Latour' => 'Latour',
                'Zorg_en_Hoop' => 'Zorg en Hoop',
                'Uitvlugt' => 'Uitvlugt',
                'Zanderij' => 'Zanderij',
                'Nickerie' => 'Nickerie',
                'Albina' => 'Albina'
            ],
            'achtergrond_list' => [
                'hout_gips_cementboard_verkast' => 'hout/gips/cementboard verkast',
                'steen_porceleinen_tegels' => 'steen/porceleinen tegels',
                'beton_natuurtegels_natuursteen' => 'beton/natuurtegels/natuursteen'
            ],
            'werkhoogte_list' => [
                '0m_-_3m' => '0m - 3m',
                '3m_-_12m' => '3m - 12m',
                'gt_12m' => '> 12m'
            ],
            'bracket_list' => [
                 'small' => 'small',
                 'medium' => 'medium',
                 'large' => 'large'
            ]
        ];

        return $install_list;

    }
}