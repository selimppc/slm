<?php

namespace App\Helpers;

/**
 * Created by PhpStorm.
 * User: Selim Reza
 * Date: 30/3/15
 * Time: 5:19 PM
 */

use DB;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Show a list of all of the application's users.
     *
     * @return Response
     */
    public function index()
    {
        $users = DB::table('currency')->get();

//        return view('user.index', ['users' => $users]);
    }
}

class ChannelLetter
{
    public static function calculation_3d($tekst, $letter_hoogte, $lengte_tekst, $model, $installment_param = array()){
        // Inputs
        /*$tekst = 'Zacharias';
        $tekst = str_replace(' ', '', $tekst);
        $letter_length = strlen($tekst);
        $letter_hoogte = 2;
        $lengte_tekst = $letter_length * $letter_hoogte;
        $model = 'front_back'; // block, front, front_back, back*/

        $tekst = str_replace(' ', '', $tekst);
        $letter_length = strlen($tekst);

        /*$materiaal_list = [
            'aluminium' => 'aluminium wht/wht with vinyl 1.22 x 2.44m    1mm',
            'acrylaat' => 'acrylaat (mica)   5mm',
            'trim_cap' => 'Trim Cap 1"x150',
            'accubend_coil' => 'Accubend coil 5.3"x270\'x 0.04"',
            'silicone' => 'Silicone',
            'kabel' => 'kabel 3 x 2.5mm2',
            'fotocell' => 'Fotocell',
            'opbdoosouw' => 'opbouwdoos',
            'lasdoppen' => 'lasdoppen',
            'led_lights' => 'LED lights 2 dot Hanley',
            'led_travo' => 'LED travo 60W',
            'spuitwerk_randen' => 'spuitwerk randen',
            'volwas' => 'volwas',
            'halfwas' => 'halfwas',
            'handlanger' => 'handlanger',
            'router' => 'router',
            'accubend' => 'Accubend'
        ];*/
        $materiaal_list = null;

        // Define currency
//        $usd_to_srd = 5.5;
		$usd_to_srd = DB::table('currency')->where('title', 'US$')->pluck('value');
		
//        $euro_to_srd = 5.85;
		$euro_to_srd = DB::table('currency')->where('title', 'Euro')->pluck('value');

        $leds_per_meter_stuks = 15;
        $factor_per_meter = 2.5;



        // This values are in USD
        $galvaan_1__25_m_x_2__50_m_1__5_m_m = 37.83;// G 38
        $foam = 153; // G 51
        $clear_mica_12mm = 70; // G 49
        $fotocell = 1.22; // G 135
        $opbouwdoos = 4.98; // G 137
        $lasdoppen = 25; // G 138
        $led_lights_2_dot_hanley = 50; // G 142

        // G14 Calculation
        $aluminium_aantal = ChannelLetter::floorToFraction( (($letter_hoogte * $lengte_tekst) / 2.98), 4);
        $aluminium_usd = $galvaan_1__25_m_x_2__50_m_1__5_m_m * 1.4;
        $aluminium_srd = $aluminium_usd * $usd_to_srd;
        $aluminium_subtotal = $aluminium_aantal * $aluminium_srd;
        if($aluminium_aantal > 0) {
            $materiaal_list [] = [
                'label' => 'aluminium wht/wht with vinyl 1.22 x 2.44m    1mm',
                'aantal' => $aluminium_aantal,
                'eenheid' => 'st'
            ];
        }

        // G20 calculation. it is only for front and front_back
        if($model == 'front' || $model == 'front_back') {
            $acrylaat_mica_5_mm_aantal = ChannelLetter::floorToFraction( (($letter_hoogte * $lengte_tekst) / 2.98), 4);
            $acrylaat_mica_5_mm_usd = 156.80;
            $acrylaat_mica_5_mm_srd = $acrylaat_mica_5_mm_usd * $usd_to_srd;
            $acrylaat_mica_5_mm_subtotal = $acrylaat_mica_5_mm_aantal * $acrylaat_mica_5_mm_srd;
            if($acrylaat_mica_5_mm_aantal > 0) {
                $materiaal_list [] = [
                    'label' => 'acrylaat (mica)   5mm',
                    'aantal' => $acrylaat_mica_5_mm_aantal,
                    'eenheid' => 'st'
                ];
            }
        }else{
            $acrylaat_mica_5_mm_subtotal = 0;
        }

        // G25 calculation. it is only for front and front_back
        if($model == 'front' || $model == 'front_back') {
            $trim_cap_1_x_150_aantal = ceil($letter_hoogte * $letter_length * $factor_per_meter);
            $trim_cap_1_x_150_usd = (($clear_mica_12mm * 1.4) / 150) * 3.2808399;
            $trim_cap_1_x_150_srd = $trim_cap_1_x_150_usd * $usd_to_srd;
            $trim_cap_1_x_150_subtotal = $trim_cap_1_x_150_aantal * $trim_cap_1_x_150_srd;
            if($trim_cap_1_x_150_aantal > 0) {
                $materiaal_list [] = [
                    'label' => 'Trim Cap 1"x150"',
                    'aantal' => $trim_cap_1_x_150_aantal,
                    'eenheid' => 'm'
                ];
            }
        }else{
            $trim_cap_1_x_150_subtotal = 0;
        }

        // G27 calculation. it is only for front and front_back
        $accubend_coil_5__3_x270_x_0__04_aantal = ceil($letter_hoogte * $letter_length * $factor_per_meter);
        $accubend_coil_5__3_x270_x_0__04_usd = (($foam *1.4)/270)*3.2808399;
        $accubend_coil_5__3_x270_x_0__04_srd = $accubend_coil_5__3_x270_x_0__04_usd * $usd_to_srd;
        $accubend_coil_5__3_x270_x_0__04_subtotal = $accubend_coil_5__3_x270_x_0__04_aantal * $accubend_coil_5__3_x270_x_0__04_srd;
        if($accubend_coil_5__3_x270_x_0__04_aantal > 0) {
            $materiaal_list [] = [
                'label' => 'Accubend coil 5.3"x270 x 0.04"',
                'aantal' => $accubend_coil_5__3_x270_x_0__04_aantal,
                'eenheid' => 'm'
            ];
        }

        // G83 calculation
        $silicone_aantal = ChannelLetter::roundUpToAny(($accubend_coil_5__3_x270_x_0__04_aantal / 5), 1);
        $silicone_usd = 3.54545454545455;
        $silicone_srd = $silicone_usd * $usd_to_srd;
        $silicone_subtotal = $silicone_aantal * $silicone_srd;
        if($silicone_aantal > 0) {
            $materiaal_list [] = [
                'label' => 'Silicone',
                'aantal' => $silicone_aantal,
                'eenheid' => 'tube'
            ];
        }


        // G 102 calculation
        if($letter_hoogte > 0) {
            $kabel_3_x_2__5mm2_aantal = 5;
            $kabel_3_x_2__5mm2_usd = 1.08181818181818;
            $kabel_3_x_2__5mm2_srd = $kabel_3_x_2__5mm2_usd * $usd_to_srd;
            $kabel_3_x_2__5mm2_subtotal = $kabel_3_x_2__5mm2_aantal * $kabel_3_x_2__5mm2_srd;
            if($kabel_3_x_2__5mm2_aantal > 0) {
                $materiaal_list [] = [
                    'label' => 'kabel 3 x 2.5mm2',
                    'aantal' => $kabel_3_x_2__5mm2_aantal,
                    'eenheid' => 'm'
                ];
            }
        }else{
            $kabel_3_x_2__5mm2_subtotal = 0;
        }

        // G 114 calculation
        if($model == 'front' || $model == 'back') {
            $led_lights_2_dot_hanley_aantal = ceil($letter_hoogte * $letter_length * $factor_per_meter * 15);
        }elseif($model == 'front_back'){
            $led_lights_2_dot_hanley_aantal = ceil($letter_hoogte * $letter_length * $factor_per_meter * 30);
        }

        if(isset($led_lights_2_dot_hanley_aantal)){
            $led_lights_2_dot_hanley_usd = $fotocell * 1.4;
            $led_lights_2_dot_hanley_srd = $led_lights_2_dot_hanley_usd * $usd_to_srd;
            $led_lights_2_dot_hanley_subtotal = $led_lights_2_dot_hanley_aantal * $led_lights_2_dot_hanley_srd;
            if($led_lights_2_dot_hanley_aantal > 0) {
                $materiaal_list [] = [
                    'label' => 'LED lights 2 dot Hanley',
                    'aantal' => $led_lights_2_dot_hanley_aantal,
                    'eenheid' => 'st'
                ];
            }
        }else{
            $led_lights_2_dot_hanley_subtotal = 0;
        }

        // G 117 calculation
        if(isset($led_lights_2_dot_hanley_aantal ))
            $led_travo_60w_aantal = ceil($led_lights_2_dot_hanley_aantal / 60);
        else
            $led_travo_60w_aantal = 0;
        $led_travo_60w_usd = $lasdoppen * 1.4;
        $led_travo_60w_srd = $led_travo_60w_usd * $usd_to_srd;
        $led_travo_60w_subtotal = $led_travo_60w_aantal * $led_travo_60w_srd;
        if($led_travo_60w_aantal > 0) {
            $materiaal_list [] = [
                'label' => 'LED travo 60W',
                'aantal' => $led_travo_60w_aantal,
                'eenheid' => 'st'
            ];
        }


        // G 107 calculation
        $fotocell_aantal = ChannelLetter::roundUpToAny(($led_travo_60w_aantal / 4), 1);
        $fotocell_usd = 11.8181818181818;
        $fotocell_srd = $fotocell_usd * $usd_to_srd;
        $fotocell_subtotal = $fotocell_aantal * $fotocell_srd;
        if($fotocell_aantal > 0) {
            $materiaal_list [] = [
                'label' => 'Fotocell',
                'aantal' => $fotocell_aantal,
                'eenheid' => 'st'
            ];
        }

        // G 109 calculation
        $opbdoosouw_aantal = $fotocell_aantal;
        $opbdoosouw_usd = 1.54545454545455;
        $opbdoosouw_srd = $opbdoosouw_usd * $usd_to_srd;
        $opbdoosouw_subtotal = $opbdoosouw_aantal * $opbdoosouw_srd;
        if($opbdoosouw_aantal > 0) {
            $materiaal_list [] = [
                'label' => 'opbouwdoos',
                'aantal' => $opbdoosouw_aantal,
                'eenheid' => 'st'
            ];
        }

        // G 110 calculation
        $lasdoppen_aantal = $opbdoosouw_aantal * 3;
        $lasdoppen_usd = 0.154545454545455;
        $lasdoppen_srd = $lasdoppen_usd * $usd_to_srd;
        $lasdoppen_subtotal = $lasdoppen_aantal * $lasdoppen_srd;
        if($lasdoppen_aantal > 0) {
            $materiaal_list [] = [
                'label' => 'lasdoppen',
                'aantal' => $lasdoppen_aantal,
                'eenheid' => 'st'
            ];
        }

        $materiaal_subtotal = $aluminium_subtotal + $acrylaat_mica_5_mm_subtotal + $trim_cap_1_x_150_subtotal
            + $accubend_coil_5__3_x270_x_0__04_subtotal + $silicone_subtotal + $kabel_3_x_2__5mm2_subtotal
            + $led_lights_2_dot_hanley_subtotal + $led_travo_60w_subtotal + $fotocell_subtotal
            + $opbdoosouw_subtotal + $lasdoppen_subtotal;
        $materiaal = $materiaal_subtotal + $materiaal_subtotal * 0.20;

        $sticker_subtotal = 0;
        $sticker = $sticker_subtotal + $sticker_subtotal * 0.00;

        //=+IF(OR('3DChannelCalculator'!B14="back",'3DChannelCalculator'!B14="front&back",'3DChannelCalculator'!B14="block"),C27,0)
        // G 134 calculation
        if($model == 'back' || $model == 'front_back' || $model == 'block') {
            $spuitwerk_randen_aantal = $accubend_coil_5__3_x270_x_0__04_aantal;
            $spuitwerk_randen_usd = 10.00;
            $spuitwerk_randen_srd = $spuitwerk_randen_usd * $usd_to_srd;
            $spuitwerk_randen_subtotal = $spuitwerk_randen_aantal * $spuitwerk_randen_srd;
            if($spuitwerk_randen_aantal > 0) {
                $materiaal_list [] = [
                    'label' => 'spuitwerk randen',
                    'aantal' => $spuitwerk_randen_aantal,
                    'eenheid' => 'st'
                ];
            }
        }else{
            $spuitwerk_randen_subtotal = 0;
        }
        #exit($spuitwerk_randen_subtotal);

        $afwerken_subtotal = $spuitwerk_randen_subtotal;
        $afwerken = $afwerken_subtotal + $afwerken_subtotal * 0.20;

        $transport_subtotal = 0;
        $transport = $transport_subtotal + $transport_subtotal * 0.30;

        // G 149 calculation.
        $volwas_subtotal = 0;

        // G 150 calculation
        $halfwas_aantal = ceil($accubend_coil_5__3_x270_x_0__04_aantal / 3);
        $halfwas_usd =  5.15;
        $halfwas_srd = $halfwas_usd * $usd_to_srd;
        $halfwas_subtotal = $halfwas_aantal * $halfwas_srd;
        if($halfwas_aantal > 0) {
            $materiaal_list [] = [
                'label' => 'halfwas',
                'aantal' => $halfwas_aantal,
                'eenheid' => 'uren'
            ];
        }


        // G 151 calculation
        $handlanger_aantal = ceil($accubend_coil_5__3_x270_x_0__04_aantal / 3);
        $handlanger_usd =  4.15;
        $handlanger_srd = $handlanger_usd * $usd_to_srd;
        $handlanger_subtotal = $handlanger_aantal * $handlanger_srd;
        if($handlanger_aantal > 0) {
            $materiaal_list [] = [
                'label' => 'handlanger',
                'aantal' => $handlanger_aantal,
                'eenheid' => 'uren'
            ];
        }


        $arbeid_subtotal = $volwas_subtotal + $halfwas_subtotal + $handlanger_subtotal;
        $arbeid = $arbeid_subtotal + $arbeid_subtotal * 1.00;

        // G 154 calculation
        $plasma_subtotal = 0;

        // G 155 calculation
        if(isset($acrylaat_mica_5_mm_aantal)) {
            $router_aantal = ($aluminium_aantal + $acrylaat_mica_5_mm_aantal) * 2;
        }else{
            $router_aantal = ($aluminium_aantal) * 2;
        }
        $router_usd =  20;
        $router_srd = $router_usd * $usd_to_srd;
        $router_subtotal = $router_aantal * $router_srd;
        if($router_aantal > 0) {
            $materiaal_list [] = [
                'label' => 'router',
                'aantal' => $router_aantal,
                'eenheid' => 'uren'
            ];
        }

        // G 156 calculation
        $accubend_aantal = ceil($accubend_coil_5__3_x270_x_0__04_aantal / 5);
        $accubend_usd =  40;
        $accubend_srd = $accubend_usd * $usd_to_srd;
        $accubend_subtotal = $accubend_aantal * $accubend_srd;
        if($accubend_aantal > 0) {
            $materiaal_list [] = [
                'label' => 'Accubend',
                'aantal' => $accubend_aantal,
                'eenheid' => 'uren'
            ];
        }

        $machine_subtotal = $plasma_subtotal + $router_subtotal + $accubend_subtotal;
        $machine = $machine_subtotal + $machine_subtotal * 0.30;

        $subtotal = $materiaal + $sticker + $afwerken + $transport + $arbeid + $machine;

        $winst = $subtotal * 0.20;
        $onvoorzien = $subtotal * 0.10;
        $moeilijkheidsgraad = $subtotal * 0.00;
        $totaal = ceil($subtotal + $winst + $onvoorzien + $moeilijkheidsgraad);


        // Calculations for show
        $prijs_srd = $totaal;
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
                        'aantal' => 8
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
            $achtergrond_subtotal = $achtergrond * $letter_length;

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
                $werkhoogte_subtotal = $werkhoogte * $letter_length;
            }else {
                $werkhoogte_usdtosrd = $installment_arr['WERKHOOGTE'][$werkhoogte_materiaal]['usd'] * $usd_to_srd;
                $werkhoogte = $werkhoogte_usdtosrd * $installment_arr['WERKHOOGTE'][$werkhoogte_materiaal]['aantal'];
                $werkhoogte_subtotal = $werkhoogte * $letter_length;
            }

            $bracket_materiaal = $installment_param['bracket'];
            $bracket_usdtosrd = $installment_arr['BRACKET'][$bracket_materiaal]['usd'] * $usd_to_srd;
            $bracket = $bracket_usdtosrd * $installment_arr['BRACKET'][$bracket_materiaal]['aantal'];
            $bracket_subtotal = $bracket * $letter_length;

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
            'materiaal_amount' => $material_return,
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