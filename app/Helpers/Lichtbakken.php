<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 4/7/16
 * Time: 10:52 AM
 */

namespace App\Helpers;


class Lichtbakken
{
    public  static function calculation_lichtbakken($materiaal_input,$enkel_bubbel_input,$lengte,$breedte,$model, $installment_param = null)
    {

        // $materiaal_input = 'aluminium';
        // $enkel_bubbel_input = 'enkelzijdig';
        //$lengte = 2;
        //$breedte = 2;
        //$model = 'RechteHoeken';

        if(strtolower($enkel_bubbel_input) == 'enkelzijdig'){
            $oppervlakte_mica_en_sticker = ceil($lengte * $breedte);
        }else{
            $oppervlakte_mica_en_sticker = ceil($lengte * $breedte) * 2;
        }
        $omtrek = $lengte * 2 + $breedte * 2;

        // Define currency
        $usd_to_srd = 5.5;
        $euro_to_srd = 5.85;

        $leds_per_meter_stuks = 15;
        $factor_per_meter = 2.5;


        // This values are in USD
        $lichtbakken_calculator_tab_one_g136 = 4.98;
        $lichtbakken_calculator_tab_one_g137 = 25;

        $materiaal_list = null;

        // G8 Calculation
        if($materiaal_input == 'galvaan'){
            if($enkel_bubbel_input == 'enkelzijdig'){
                $achterzijde_galvaan_1_25m_x_2_50m_1mm_aantal = Lichtbakken::floorToFraction( $oppervlakte_mica_en_sticker/3, 4);
                $materiaal_list []= [
                    'label' => 'achterzijde galvaan 1.25m x 2.50m 1 mm',
                    'aantal' => $achterzijde_galvaan_1_25m_x_2_50m_1mm_aantal,
                    'eenheid' => 'st'
                ];
            }
            else
                $achterzijde_galvaan_1_25m_x_2_50m_1mm_aantal = 0;
        }else{
            $achterzijde_galvaan_1_25m_x_2_50m_1mm_aantal = 0;
        }
        $achterzijde_galvaan_1_25m_x_2_50m_1mm_usd = 32.3181818181818;
        $achterzijde_galvaan_1_25m_x_2_50m_1mm_srd = $achterzijde_galvaan_1_25m_x_2_50m_1mm_usd * $usd_to_srd;
        $achterzijde_galvaan_1_25m_x_2_50m_1mm_subtotal = $achterzijde_galvaan_1_25m_x_2_50m_1mm_aantal * $achterzijde_galvaan_1_25m_x_2_50m_1mm_srd;

        // G9 Calculation
        if($materiaal_input == 'galvaan'){
            $randen_galvaan_1_25m_x_2_50m_1mm_aantal = Lichtbakken::floorToFraction( ($lengte + $breedte) * 2, 2);
            $materiaal_list []= [
                'label' => 'randen galvaan 1.25m x 2.50m 1 mm',
                'aantal' => $randen_galvaan_1_25m_x_2_50m_1mm_aantal,
                'eenheid' => 'st'
            ];
        }else{
            $randen_galvaan_1_25m_x_2_50m_1mm_aantal = 0;
        }
        $randen_galvaan_1_25m_x_2_50m_1mm_usd = $achterzijde_galvaan_1_25m_x_2_50m_1mm_usd /(3*2.44);
        $randen_galvaan_1_25m_x_2_50m_1mm_srd = $randen_galvaan_1_25m_x_2_50m_1mm_usd * $usd_to_srd;
        $randen_galvaan_1_25m_x_2_50m_1mm_subtotal = $randen_galvaan_1_25m_x_2_50m_1mm_aantal * $randen_galvaan_1_25m_x_2_50m_1mm_srd;

        // G14 calculation
        if($materiaal_input == 'aluminium'){
            if($enkel_bubbel_input == 'enkelzijdig'){
                $achterzijde_aluminium_1__22_x_2__44m_1__3mm_aantal = Lichtbakken::floorToFraction( $oppervlakte_mica_en_sticker/3, 4);
                $materiaal_list []= [
                    'label' => 'achterzijde	aluminium 1.22 x 2.44m 1.3mm',
                    'aantal' => $achterzijde_aluminium_1__22_x_2__44m_1__3mm_aantal,
                    'eenheid' => 'st'
                ];
            }
            else
                $achterzijde_aluminium_1__22_x_2__44m_1__3mm_aantal = 0;
        }else{
            $achterzijde_aluminium_1__22_x_2__44m_1__3mm_aantal = 0;
        }
        $achterzijde_aluminium_1__22_x_2__44m_1__3mm_usd = 90;
        $achterzijde_aluminium_1__22_x_2__44m_1__3mm_srd = $achterzijde_aluminium_1__22_x_2__44m_1__3mm_usd * $usd_to_srd;
        $achterzijde_aluminium_1__22_x_2__44m_1__3mm_subtotal = $achterzijde_aluminium_1__22_x_2__44m_1__3mm_aantal * $achterzijde_aluminium_1__22_x_2__44m_1__3mm_srd;

        // G15 calculation
        if($materiaal_input == 'aluminium'){
            $randen_aluminium_1__22_x_2__44m_1__3mm_aantal = Lichtbakken::floorToFraction( ($lengte + $breedte) * 2, 2);
            $materiaal_list []= [
                'label' => 'randen	aluminium 1.22 x 2.44m    1.3mm',
                'aantal' => $randen_aluminium_1__22_x_2__44m_1__3mm_aantal,
                'eenheid' => 'st'
            ];
        }else{
            $randen_aluminium_1__22_x_2__44m_1__3mm_aantal = 0;
        }
        $randen_aluminium_1__22_x_2__44m_1__3mm_usd = $achterzijde_aluminium_1__22_x_2__44m_1__3mm_usd / (3*2.44);
        $randen_aluminium_1__22_x_2__44m_1__3mm_srd = $randen_aluminium_1__22_x_2__44m_1__3mm_usd * $usd_to_srd;
        $randen_aluminium_1__22_x_2__44m_1__3mm_subtotal = $randen_aluminium_1__22_x_2__44m_1__3mm_aantal * $randen_aluminium_1__22_x_2__44m_1__3mm_srd;

// G21 calculation
        if(Lichtbakken::floorToFraction($oppervlakte_mica_en_sticker/3, 4) < 0.5){
            $randen_acrylaat_mica_3mm_aantal = Lichtbakken::floorToFraction($oppervlakte_mica_en_sticker/3, 4);
            $materiaal_list []= [
                'label' => 'Randen acrylaat (mica)   3mm' ,
                'aantal' => $randen_acrylaat_mica_3mm_aantal,
                'eenheid' => 'st'
            ];
        }else{
            $randen_acrylaat_mica_3mm_aantal = 0;
        }
        $randen_acrylaat_mica_3mm_usd = 102.73;
        $randen_acrylaat_mica_3mm_srd = $randen_acrylaat_mica_3mm_usd * $usd_to_srd;
        $randen_acrylaat_mica_3mm_subtotal = $randen_acrylaat_mica_3mm_aantal * $randen_acrylaat_mica_3mm_srd;

// G22 calculation
        if(Lichtbakken::floorToFraction($oppervlakte_mica_en_sticker/3, 4) >= 0.5){
            $randen_acrylaat_mica_5mm_aantal = Lichtbakken::floorToFraction($oppervlakte_mica_en_sticker/3, 4);
            $materiaal_list []= [
                'label' => 'Randen acrylaat (mica)   5mm',
                'aantal' => $randen_acrylaat_mica_5mm_aantal,
                'eenheid' => 'st'
            ];
        }else{
            $randen_acrylaat_mica_5mm_aantal = 0;
        }
        $randen_acrylaat_mica_5mm_usd = 156.8;
        $randen_acrylaat_mica_5mm_srd = $randen_acrylaat_mica_5mm_usd * $usd_to_srd;
        $randen_acrylaat_mica_5mm_subtotal = $randen_acrylaat_mica_5mm_aantal * $randen_acrylaat_mica_5mm_srd;

// G32 calculation
        if($materiaal_input == 'galvaan'){
            if($enkel_bubbel_input == 'enkelzijdig'){
                $constructie_30_x_30_meubel_galvaan_buis_aantal = Lichtbakken::floorToFraction( (($lengte + $breedte) * 2) / 5.8, 4);
                $materiaal_list []= [
                    'label' => 'constructie	30 x 30 meubel galvaan buis',
                    'aantal' => $constructie_30_x_30_meubel_galvaan_buis_aantal,
                    'eenheid' => 'st'
                ];
            }
            elseif($enkel_bubbel_input == 'dubbelzijdig'){
                $constructie_30_x_30_meubel_galvaan_buis_aantal = Lichtbakken::floorToFraction( (($lengte + $breedte) * 4) / 5.8, 4);
                $materiaal_list []= [
                    'label' => 'constructie	30 x 30 meubel galvaan buis',
                    'aantal' => $constructie_30_x_30_meubel_galvaan_buis_aantal,
                    'eenheid' => 'st'
                ];
            }
            else
                $constructie_30_x_30_meubel_galvaan_buis_aantal = 0;
        }else{
            $constructie_30_x_30_meubel_galvaan_buis_aantal = 0;
        }
        $constructie_30_x_30_meubel_galvaan_buis_usd = 7.10909090909091;
        $constructie_30_x_30_meubel_galvaan_buis_srd = $constructie_30_x_30_meubel_galvaan_buis_usd * $usd_to_srd;
        $constructie_30_x_30_meubel_galvaan_buis_subtotal = $constructie_30_x_30_meubel_galvaan_buis_aantal * $constructie_30_x_30_meubel_galvaan_buis_srd;

// G34 calculation
        if($materiaal_input == 'aluminium'){
            if($enkel_bubbel_input == 'enkelzijdig'){
                $constructie_25_x_25_meubel_aluminium_buis_aantal = Lichtbakken::floorToFraction( (($lengte + $breedte) * 2) / 5.8, 4);
                $materiaal_list []= [
                    'label' => 'constructie 25 x 25 meubel aluminium buis',
                    'aantal' => $constructie_25_x_25_meubel_aluminium_buis_aantal,
                    'eenheid' => 'st'
                ];
            }
            elseif($enkel_bubbel_input == 'dubbelzijdig'){
                $constructie_25_x_25_meubel_aluminium_buis_aantal = Lichtbakken::floorToFraction( (($lengte + $breedte) * 4) / 5.8, 4);
                $materiaal_list []= [
                    'label' => 'constructie 25 x 25 meubel aluminium buis',
                    'aantal' => $constructie_25_x_25_meubel_aluminium_buis_aantal,
                    'eenheid' => 'st'
                ];
            }
            else
                $constructie_25_x_25_meubel_aluminium_buis_aantal = 0;
        }else{
            $constructie_25_x_25_meubel_aluminium_buis_aantal = 0;
        }
        $constructie_25_x_25_meubel_aluminium_buis_usd = 13.6818181818182;
        $constructie_25_x_25_meubel_aluminium_buis_srd = $constructie_25_x_25_meubel_aluminium_buis_usd * $usd_to_srd;
        $constructie_25_x_25_meubel_aluminium_buis_subtotal = $constructie_25_x_25_meubel_aluminium_buis_aantal * $constructie_25_x_25_meubel_aluminium_buis_srd;

// G79 calculation
        $hulpmat_4__5_grinder_disc_aantal = ceil(($randen_galvaan_1_25m_x_2_50m_1mm_aantal + $randen_aluminium_1__22_x_2__44m_1__3mm_aantal) / 5);
        $materiaal_list []= [
            'label' => 'hulpmat. 4,5" grinder disc',
            'aantal' => $hulpmat_4__5_grinder_disc_aantal,
            'eenheid' => 'st'
        ];
        $hulpmat_4__5_grinder_disc_usd = 1.63636363636364;
        $hulpmat_4__5_grinder_disc_srd = $hulpmat_4__5_grinder_disc_usd * $usd_to_srd;
        $hulpmat_4__5_grinder_disc_subtotal = $hulpmat_4__5_grinder_disc_aantal * $hulpmat_4__5_grinder_disc_srd;

// G81 calculation
        $hulpmat_lasdraad_aantal = Lichtbakken::floorToFraction(($randen_galvaan_1_25m_x_2_50m_1mm_aantal + $randen_aluminium_1__22_x_2__44m_1__3mm_aantal) / 20, 5);
        $materiaal_list []= [
            'label' => 'hulpmat. lasdraad',
            'aantal' => $hulpmat_lasdraad_aantal,
            'eenheid' => 'pk (5 kg)'
        ];
        $hulpmat_lasdraad_usd = 20.9090909090909;
        $hulpmat_lasdraad_srd = $hulpmat_lasdraad_usd * $usd_to_srd;
        $hulpmat_lasdraad_subtotal = $hulpmat_lasdraad_aantal * $hulpmat_lasdraad_srd;

// G101 calculation
        if($oppervlakte_mica_en_sticker == 0)
            $electra_kabel_3_x_2__5mm2_aantal = 0;
        else{
            $electra_kabel_3_x_2__5mm2_aantal = 5;
            $materiaal_list []= [
                'label' => 'electra	kabel 3 x 2.5mm2',
                'aantal' => $electra_kabel_3_x_2__5mm2_aantal,
                'eenheid' => 'm'
            ];
        }
        $electra_kabel_3_x_2__5mm2_usd = 1.08181818181818;
        $electra_kabel_3_x_2__5mm2_srd = $electra_kabel_3_x_2__5mm2_usd * $usd_to_srd;
        $electra_kabel_3_x_2__5mm2_subtotal = $electra_kabel_3_x_2__5mm2_aantal * $electra_kabel_3_x_2__5mm2_srd;

// G102 calculation
        if($oppervlakte_mica_en_sticker == 0)
            $electra_kabel_klips_aantal = 0;
        else{
            $electra_kabel_klips_aantal = 1;
            $materiaal_list []= [
                'label' => 'electra kabel klips',
                'aantal' => $electra_kabel_klips_aantal,
                'eenheid' => 'p/pr'
            ];
        }
        $electra_kabel_klips_usd = 2;
        $electra_kabel_klips_srd = $electra_kabel_klips_usd * $usd_to_srd;
        $electra_kabel_klips_subtotal = $electra_kabel_klips_aantal * $electra_kabel_klips_srd;

// G106 calculation
        if($oppervlakte_mica_en_sticker == 0)
            $electra_fotocell_aantal = 0;
        else{
            $electra_fotocell_aantal = 1;
            $materiaal_list []= [
                'label' => 'electra Fotocell',
                'aantal' => $electra_fotocell_aantal,
                'eenheid' => 'st'
            ];
        }
        $electra_fotocell_usd = 11.8181818181818;
        $electra_fotocell_srd = $electra_fotocell_usd * $usd_to_srd;
        $electra_fotocell_subtotal = $electra_fotocell_aantal * $electra_fotocell_srd;

// G108 calculation
        if($oppervlakte_mica_en_sticker == 0)
            $electra_opbouwdoos_aantal = 0;
        else{
            $electra_opbouwdoos_aantal = 1;
            $materiaal_list []= [
                'label' => 'electra opbouwdoos',
                'aantal' => $electra_opbouwdoos_aantal,
                'eenheid' => 'st'
            ];
        }
        $electra_opbouwdoos_usd = 1.54545454545455;
        $electra_opbouwdoos_srd = $electra_opbouwdoos_usd * $usd_to_srd;
        $electra_opbouwdoos_subtotal = $electra_opbouwdoos_aantal * $electra_opbouwdoos_srd;

// G109 calculation
        if($oppervlakte_mica_en_sticker == 0)
            $electra_lasdoppen_aantal = 0;
        else{
            $electra_lasdoppen_aantal = 3;
            $materiaal_list []= [
                'label' => 'electra lasdoppen',
                'aantal' => $electra_lasdoppen_aantal,
                'eenheid' => 'st'
            ];
        }
        $electra_lasdoppen_usd = 0.154545454545455;
        $electra_lasdoppen_srd = $electra_lasdoppen_usd * $usd_to_srd;
        $electra_lasdoppen_subtotal = $electra_lasdoppen_aantal * $electra_lasdoppen_srd;

// G115 calculation
        if(min($lengte, $breedte) < 2.44)
            $electra_led_lights_groot_hanley_lichtbakken_aantal = ceil(max($lengte, $breedte) / 0.2) * 2;
        else
            $electra_led_lights_groot_hanley_lichtbakken_aantal = ceil( ($lengte * $lengte + $breedte * $breedte) / 0.2) * 2;
        $materiaal_list []= [
            'label' => 'electra LED lights groot Hanley (Lichtbakken)',
            'aantal' => $electra_led_lights_groot_hanley_lichtbakken_aantal,
            'eenheid' => 'st'
        ];
        $electra_led_lights_groot_hanley_lichtbakken_usd = $lichtbakken_calculator_tab_one_g136 * 1.4;
        $electra_led_lights_groot_hanley_lichtbakken_srd = $electra_led_lights_groot_hanley_lichtbakken_usd * $usd_to_srd;
        $electra_led_lights_groot_hanley_lichtbakken_subtotal = $electra_led_lights_groot_hanley_lichtbakken_aantal * $electra_led_lights_groot_hanley_lichtbakken_srd;

// G116 calculation
        $electra_led_travo_60w_aantal = ceil($electra_led_lights_groot_hanley_lichtbakken_aantal / 22);
        $materiaal_list []= [
            'label' => 'electra LED travo 60W',
            'aantal' => $electra_led_travo_60w_aantal,
            'eenheid' => 'st'
        ];
        $electra_led_travo_60w_usd = $lichtbakken_calculator_tab_one_g137 * 1.4;
        $electra_led_travo_60w_srd = $electra_led_travo_60w_usd * $usd_to_srd;
        $electra_led_travo_60w_subtotal = $electra_led_travo_60w_aantal * $electra_led_travo_60w_srd;

        $materiaal_subtotal = $achterzijde_galvaan_1_25m_x_2_50m_1mm_subtotal + $randen_galvaan_1_25m_x_2_50m_1mm_subtotal
            + $achterzijde_aluminium_1__22_x_2__44m_1__3mm_subtotal + $randen_aluminium_1__22_x_2__44m_1__3mm_subtotal
            + $randen_acrylaat_mica_3mm_subtotal + $randen_acrylaat_mica_5mm_subtotal + $constructie_30_x_30_meubel_galvaan_buis_subtotal
            + $constructie_25_x_25_meubel_aluminium_buis_subtotal + $hulpmat_4__5_grinder_disc_subtotal + $hulpmat_lasdraad_subtotal
            + $electra_kabel_3_x_2__5mm2_subtotal + $electra_kabel_klips_subtotal + $electra_fotocell_subtotal + $electra_opbouwdoos_subtotal +
            $electra_lasdoppen_subtotal + $electra_led_lights_groot_hanley_lichtbakken_subtotal + $electra_led_travo_60w_subtotal;
        $materiaal = $materiaal_subtotal;

// G126 calculation
        $sticker_aantal = $oppervlakte_mica_en_sticker;
        $materiaal_list []= [
            'label' => 'sticker',
            'aantal' => $sticker_aantal,
            'eenheid' => 'm2'
        ];
        $sticker_usd = 50;
        $sticker_srd = $sticker_usd * $usd_to_srd;
        $sticker_subtotal = $sticker_aantal * $sticker_srd;
        $sticker = $sticker_subtotal;

// G133 calculation
        $spuitwerk_randen_aantal =  ($randen_galvaan_1_25m_x_2_50m_1mm_aantal + $randen_aluminium_1__22_x_2__44m_1__3mm_aantal)
            + ($achterzijde_galvaan_1_25m_x_2_50m_1mm_aantal + $achterzijde_aluminium_1__22_x_2__44m_1__3mm_aantal) * 4;
        $materiaal_list []= [
            'label' => 'afwerken spuitwerk randen',
            'aantal' => $spuitwerk_randen_aantal,
            'eenheid' => 'set'
        ];
        $spuitwerk_randen_usd = 10;
        $spuitwerk_randen_srd = $spuitwerk_randen_usd * $usd_to_srd;
        $spuitwerk_randen_subtotal = $spuitwerk_randen_aantal * $spuitwerk_randen_srd;
        $afwerken = $spuitwerk_randen_subtotal;

        $transport_subtotal = 0;
        $transport = $transport_subtotal;

// G149 calculation
        $arbeid_halfwas_aantal =  ($randen_galvaan_1_25m_x_2_50m_1mm_aantal + $randen_aluminium_1__22_x_2__44m_1__3mm_aantal)
            + ($achterzijde_galvaan_1_25m_x_2_50m_1mm_aantal + $achterzijde_aluminium_1__22_x_2__44m_1__3mm_aantal) * 4;
        $materiaal_list []= [
            'label' => 'arbeid halfwas',
            'aantal' => $arbeid_halfwas_aantal,
            'eenheid' => 'uren'
        ];
        $arbeid_halfwas_usd = 5.15;
        $arbeid_halfwas_srd = $arbeid_halfwas_usd * $usd_to_srd;
        $arbeid_halfwas_subtotal = $arbeid_halfwas_aantal * $arbeid_halfwas_srd;

// G150 calculation
        $arbeid_handlanger_aantal =  ($randen_galvaan_1_25m_x_2_50m_1mm_aantal + $randen_aluminium_1__22_x_2__44m_1__3mm_aantal) + ($achterzijde_galvaan_1_25m_x_2_50m_1mm_aantal + $achterzijde_aluminium_1__22_x_2__44m_1__3mm_aantal) * 4;
        $materiaal_list []= [
            'label' => 'arbeid handlanger',
            'aantal' => $arbeid_handlanger_aantal,
            'eenheid' => 'uren'
        ];
        $arbeid_handlanger_usd = 4.15;
        $arbeid_handlanger_srd = $arbeid_handlanger_usd * $usd_to_srd;
        $arbeid_handlanger_subtotal = $arbeid_handlanger_aantal * $arbeid_handlanger_srd;

        $arbeid = $arbeid_halfwas_subtotal + $arbeid_handlanger_subtotal;

// G 154 calculation
        $machine_router_aantal =  $achterzijde_galvaan_1_25m_x_2_50m_1mm_aantal + $achterzijde_aluminium_1__22_x_2__44m_1__3mm_aantal
            + $randen_acrylaat_mica_3mm_aantal + $randen_acrylaat_mica_5mm_aantal;
        $materiaal_list []= [
            'label' => 'machine router',
            'aantal' => $machine_router_aantal,
            'eenheid' => 'uren'
        ];
        $machine_router_usd = 20;
        $machine_router_srd = $machine_router_usd * $usd_to_srd;
        $machine_router_subtotal = $machine_router_aantal * $machine_router_srd;

        $machine = $machine_router_subtotal;

        $materiaal_subtotal2 = $materiaal + $materiaal * 0.20;
        $sticker_subtotal2 = $sticker + $sticker * 0.00;
        $afwerken_subtotal2 = $afwerken + $afwerken * 0.20;
        $transport_subtotal2 = $transport + $transport * 0.20;
        $arbeid_subtotal2 = $arbeid + $arbeid * 1.00;
        $machine_subtotal2 = $machine + $machine * 0.30;

        $subtotal2 = $materiaal_subtotal2 + $sticker_subtotal2 + $afwerken_subtotal2 + $transport_subtotal2 + $arbeid_subtotal2 + $machine_subtotal2;
        $winst = $subtotal2 * 0.20;
        $onvoorzien = $subtotal2 * 0.10;
        if($model == 'bollehoeken')
            $percent_model = 0.15;
        elseif($model == 'vrijevorm')
            $percent_model = 0.40;
        else
            $percent_model = 0.00;
        $moeilijkheidsgraad = $subtotal2 * $percent_model;

        $subtotal = ceil($subtotal2 + $winst + $onvoorzien + $moeilijkheidsgraad);

        // Calculations for show
        $prijs_srd = $subtotal;
        $prijs_usd = $prijs_srd / $usd_to_srd ;
        $prijs_euro = $prijs_srd / $euro_to_srd;

        $prijs_srd_tax = $prijs_srd * 0.10;
        $prijs_usd_tax = $prijs_usd * 0.10;
        $prijs_euro_tax = $prijs_euro * 0.10;

        $prijs_srd_subtotal = $prijs_srd + $prijs_srd_tax;
        $prijs_usd_subtotal = $prijs_usd + $prijs_usd_tax;
        $prijs_euro_subtotal = $prijs_euro + $prijs_euro_tax;

        $material_return = [
            'srd' => [
                'price' => $prijs_srd,
                'subtotal' => $prijs_srd_subtotal,
                'tax' => $prijs_srd_tax
            ],
            'usd' => [
                'price' => $prijs_usd,
                'subtotal' => $prijs_usd_subtotal,
                'tax' => $prijs_usd_tax
            ],
            'euro' => [
                'price' => $prijs_euro,
                'subtotal' => $prijs_euro_subtotal,
                'tax' => $prijs_euro_tax
            ]
        ];

        // Installment calculation
        $installment_return = null;
        $final_total = null;
        /*$installment_param = [
            'locatie' => 'Nickerie',
            'achtergrond' => 'beton_natuurtegels_natuursteen',
            'werkhoogte' => 'gt_12m',
            'bracket' => 'small'
        ];*/
        if($installment_param) {
            $installment_arr = [
                'LOCATIE' => [
                    'Maretraite' => [
                        'usd' => 10,
                        'aantal' => 1
                    ],
                    'Lelydorp' => [
                        'usd' => 10,
                        'aantal' => 5
                    ],
                    'Kwatta' => [
                        'usd' => 10,
                        'aantal' => 2
                    ],
                    'Munder' => [
                        'usd' => 10,
                        'aantal' => 2
                    ],
                    'Beekhuizen' => [
                        'usd' => 10,
                        'aantal' => 3
                    ],
                    'Domburg' => [
                        'usd' => 10,
                        'aantal' => 5
                    ],
                    'Leiding' => [
                        'usd' => 10,
                        'aantal' => 3
                    ],
                    'Geyersvlijt' => [
                        'usd' => 10,
                        'aantal' => 1
                    ],
                    'Clevia' => [
                        'usd' => 10,
                        'aantal' => 1
                    ],
                    'Combé' => [
                        'usd' => 10,
                        'aantal' => 1
                    ],
                    'Tourtonne' => [
                        'usd' => 10,
                        'aantal' => 1
                    ],
                    'Morgenstond' => [
                        'usd' => 10,
                        'aantal' => 1
                    ],
                    'Mon Plasir' => [
                        'usd' => 10,
                        'aantal' => 1
                    ],
                    'Centrum' => [
                        'usd' => 10,
                        'aantal' => 1
                    ],
                    'Houttuin' => [
                        'usd' => 10,
                        'aantal' => 4
                    ],
                    'Benispark' => [
                        'usd' => 10,
                        'aantal' => 2
                    ],
                    'Charlesburg' => [
                        'usd' => 10,
                        'aantal' => 1
                    ],
                    'Maikoe' => [
                        'usd' => 10,
                        'aantal' => 1
                    ],
                    'Pad_van_Wanica' => [
                        'usd' => 10,
                        'aantal' => 4
                    ],
                    'Dijkveld' => [
                        'usd' => 10,
                        'aantal' => 4
                    ],
                    'Latour' => [
                        'usd' => 10,
                        'aantal' => 4
                    ],
                    'Zorg_en_Hoop' => [
                        'usd' => 10,
                        'aantal' => 3
                    ],
                    'Uitvlugt' => [
                        'usd' => 10,
                        'aantal' => 3
                    ],
                    'Zanderij' => [
                        'usd' => 10,
                        'aantal' => 6
                    ],
                    'Nickerie' => [
                        'usd' => 10,
                        'aantal' => 9
                    ],
                    'Albina' => [
                        'usd' => 10,
                        'aantal' => 10
                    ]
                ],
                'ACHTERGROND' => [
                    'hout_gips_cementboard_verkast' => [
                        'usd' => 5,
                        'aantal' => 2
                    ],
                    'steen_porceleinen_tegels' => [
                        'usd' => 5,
                        'aantal' => 3
                    ],
                    'beton_natuurtegels_natuursteen' => [
                        'usd' => 5,
                        'aantal' => 4
                    ]
                ],
                'WERKHOOGTE' => [
                    '0m_-_3m' => [
                        'usd' => 5,
                        'aantal' => 1
                    ],
                    '3m_-_12m' => [
                        'usd' => 5,
                        'aantal' => 3
                    ],
                    'gt_12m' => [
                        'usd' => 5,
                        'aantal' => 10
                    ]
                ],
                'BRACKET' => [
                    'small' => [
                        'usd' => 10,
                        'aantal' => 1
                    ],
                    'medium' => [
                        'usd' => 10,
                        'aantal' => 3
                    ],
                    'large' => [
                        'usd' => 10,
                        'aantal' => 8
                    ]
                ],
            ];
            $locatie_materiaal = $installment_param['locatie'];
            $locatie_usdtosrd = $installment_arr['LOCATIE'][$locatie_materiaal]['usd'] * $usd_to_srd;
            $locatie_subtotal = $locatie_usdtosrd * $installment_arr['LOCATIE'][$locatie_materiaal]['aantal'];

            $achtergrond_materiaal = $installment_param['achtergrond'];
            $achtergrond_usdtosrd = $installment_arr['ACHTERGROND'][$achtergrond_materiaal]['usd'] * $usd_to_srd;
            $achtergrond = $achtergrond_usdtosrd * $installment_arr['ACHTERGROND'][$achtergrond_materiaal]['aantal'];
            $achtergrond_subtotal = $achtergrond * $oppervlakte_mica_en_sticker;

            $werkhoogte_materiaal = $installment_param['werkhoogte'];
            if($werkhoogte_materiaal == 'gt_12m'){
                $st = 0;
                $werkhoogte_materiaal = '0m_-_3m';
                $werkhoogte_usdtosrd = $installment_arr['WERKHOOGTE'][$werkhoogte_materiaal]['usd'] * $usd_to_srd;
                $werkhoogte = $werkhoogte_usdtosrd * $installment_arr['WERKHOOGTE'][$werkhoogte_materiaal]['aantal'];
                $st = $werkhoogte;

                $werkhoogte_materiaal = '3m_-_12m';
                $werkhoogte_usdtosrd = $installment_arr['WERKHOOGTE'][$werkhoogte_materiaal]['usd'] * $usd_to_srd;
                $werkhoogte = $werkhoogte_usdtosrd * $installment_arr['WERKHOOGTE'][$werkhoogte_materiaal]['aantal'];
                $st += $werkhoogte;

                $werkhoogte_materiaal = 'gt_12m';
                $werkhoogte_usdtosrd = $installment_arr['WERKHOOGTE'][$werkhoogte_materiaal]['usd'] * $usd_to_srd;
                $werkhoogte = $werkhoogte_usdtosrd * $installment_arr['WERKHOOGTE'][$werkhoogte_materiaal]['aantal'];
                $st += $werkhoogte;

                $werkhoogte = $st;
                $werkhoogte_subtotal = $werkhoogte * ($oppervlakte_mica_en_sticker / 0.5);
            }else {
                $werkhoogte_usdtosrd = $installment_arr['WERKHOOGTE'][$werkhoogte_materiaal]['usd'] * $usd_to_srd;
                $werkhoogte = $werkhoogte_usdtosrd * $installment_arr['WERKHOOGTE'][$werkhoogte_materiaal]['aantal'];
                $werkhoogte_subtotal = $werkhoogte  * ($oppervlakte_mica_en_sticker / 0.5);
            }

            $bracket_materiaal = $installment_param['bracket'];
            $bracket_usdtosrd = $installment_arr['BRACKET'][$bracket_materiaal]['usd'] * $usd_to_srd;
            $bracket = $bracket_usdtosrd * $installment_arr['BRACKET'][$bracket_materiaal]['aantal'];
            $bracket_subtotal = $bracket * $oppervlakte_mica_en_sticker;

            $installment_prijs_srd = $locatie_subtotal + $achtergrond_subtotal + $werkhoogte_subtotal + $bracket_subtotal;
            $installment_prijs_usd = $installment_prijs_srd / $usd_to_srd ;
            $installment_prijs_euro = $installment_prijs_srd / $euro_to_srd;

            $installment_prijs_srd_tax = $installment_prijs_srd * 0.08;
            $installment_prijs_usd_tax = $installment_prijs_usd * 0.08;
            $installment_prijs_euro_tax = $installment_prijs_euro * 0.08;

            $installment_prijs_srd_subtotal = $installment_prijs_srd + $installment_prijs_srd_tax;
            $installment_prijs_usd_subtotal = $installment_prijs_usd + $installment_prijs_usd_tax;
            $installment_prijs_euro_subtotal = $installment_prijs_euro + $installment_prijs_euro_tax;

            $installment_return = [
                'srd' => [
                    'price' => $installment_prijs_srd,
                    'subtotal' => $installment_prijs_srd_subtotal,
                    'tax' => $installment_prijs_srd_tax
                ],
                'usd' => [
                    'price' => $installment_prijs_usd,
                    'subtotal' => $installment_prijs_usd_subtotal,
                    'tax' => $installment_prijs_usd_tax
                ],
                'euro' => [
                    'price' => $installment_prijs_euro,
                    'subtotal' => $installment_prijs_euro_subtotal,
                    'tax' => $installment_prijs_euro_tax
                ]
            ];

            $final_total = [
                'srd' => [
                    'price' => $prijs_srd + $installment_prijs_srd,
                    'total' => $prijs_srd_subtotal + $installment_prijs_srd_subtotal,
                    'tax' => $prijs_srd_tax + $installment_prijs_srd_tax
                ],
                'usd' => [
                    'price' => $prijs_usd + $installment_prijs_usd,
                    'total' => $prijs_usd_subtotal + $installment_prijs_usd_subtotal,
                    'tax' => $prijs_usd_tax + $installment_prijs_usd_tax
                ],
                'euro' => [
                    'price' => $prijs_euro + $installment_prijs_euro,
                    'total' => $prijs_euro_subtotal + $installment_prijs_euro_subtotal,
                    'tax' => $prijs_euro_tax + $installment_prijs_euro_tax
                ]
            ];
        }

        return array(
            'materiaal_amount'=>$material_return,
            'materiaal_list_details' => $materiaal_list,
            'installment_amount' => $installment_return,
            'final_amount' => $final_total
        );
    }
        /**
         * @param $n
         * @param int $x
         * @return float
         */
        public static function roundUpToAny($n,$x=5) {
            return (ceil($n)%$x === 0) ? ceil($n) : round(($n+$x/2)/$x)*$x;
        }



        /**
         * @param $number
         * @param int $denominator : 1 for ceil, 2 for .5, 3 for .333, 4 for .25, .5, .75
         * @return float
         */
        public static function floorToFraction($number, $denominator = 1)
        {
            $x = $number * $denominator;
            $x = ceil($x);
            $x = $x / $denominator;
            return $x;
        }

}