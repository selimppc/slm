$materiaal_input = 'aluminium';
$enkel_bubbel_input = 'enkelzijdig';
$lengte = 2;
$breedte = 2;
$model = 'RechteHoeken';

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

// G8 Calculation
if($materiaal_input == 'galvaan'){
    if($enkel_bubbel_input == 'enkelzijdig')
        $achterzijde_galvaan_1_25m_x_2_50m_1mm_aantal = floorToFraction( $oppervlakte_mica_en_sticker/3, 4);
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
    $randen_galvaan_1_25m_x_2_50m_1mm_aantal = floorToFraction( ($lengte + $breedte) * 2, 2);
}else{
    $randen_galvaan_1_25m_x_2_50m_1mm_aantal = 0;
}
$randen_galvaan_1_25m_x_2_50m_1mm_usd = $achterzijde_galvaan_1_25m_x_2_50m_1mm_usd /(3*2.44);
$randen_galvaan_1_25m_x_2_50m_1mm_srd = $randen_galvaan_1_25m_x_2_50m_1mm_usd * $usd_to_srd;
$randen_galvaan_1_25m_x_2_50m_1mm_subtotal = $randen_galvaan_1_25m_x_2_50m_1mm_aantal * $randen_galvaan_1_25m_x_2_50m_1mm_srd;

// G14 calculation
if($materiaal_input == 'aluminium'){
    if($enkel_bubbel_input == 'enkelzijdig')
        $achterzijde_aluminium_1__22_x_2__44m_1__3mm_aantal = floorToFraction( $oppervlakte_mica_en_sticker/3, 4);
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
    if($enkel_bubbel_input == 'enkelzijdig')
        $randen_aluminium_1__22_x_2__44m_1__3mm_aantal = floorToFraction( ($lengte + $breedte) * 2, 2);
    else
        $randen_aluminium_1__22_x_2__44m_1__3mm_aantal = 0;
}else{
    $randen_aluminium_1__22_x_2__44m_1__3mm_aantal = 0;
}
$randen_aluminium_1__22_x_2__44m_1__3mm_usd = $achterzijde_aluminium_1__22_x_2__44m_1__3mm_usd / (3*2.44);
$randen_aluminium_1__22_x_2__44m_1__3mm_srd = $randen_aluminium_1__22_x_2__44m_1__3mm_usd * $usd_to_srd;
$randen_aluminium_1__22_x_2__44m_1__3mm_subtotal = $randen_aluminium_1__22_x_2__44m_1__3mm_aantal * $randen_aluminium_1__22_x_2__44m_1__3mm_srd;

// G21 calculation
if(floorToFraction($oppervlakte_mica_en_sticker/3, 4) < 0.5){
    $randen_acrylaat_mica_3mm_aantal = floorToFraction($oppervlakte_mica_en_sticker/3, 4);
}else{
    $randen_acrylaat_mica_3mm_aantal = 0;
}
$randen_acrylaat_mica_3mm_usd = 102.73;
$randen_acrylaat_mica_3mm_srd = $randen_acrylaat_mica_3mm_usd * $usd_to_srd;
$randen_acrylaat_mica_3mm_subtotal = $randen_acrylaat_mica_3mm_aantal * $randen_acrylaat_mica_3mm_srd;

// G22 calculation
if(floorToFraction($oppervlakte_mica_en_sticker/3, 4) >= 0.5){
    $randen_acrylaat_mica_5mm_aantal = floorToFraction($oppervlakte_mica_en_sticker/3, 4);
}else{
    $randen_acrylaat_mica_5mm_aantal = 0;
}
$randen_acrylaat_mica_5mm_usd = 156.8;
$randen_acrylaat_mica_5mm_srd = $randen_acrylaat_mica_5mm_usd * $usd_to_srd;
$randen_acrylaat_mica_5mm_subtotal = $randen_acrylaat_mica_5mm_aantal * $randen_acrylaat_mica_5mm_srd;

// G32 calculation
if($materiaal_input == 'galvaan'){
    if($enkel_bubbel_input == 'enkelzijdig')
        $constructie_30_x_30_meubel_galvaan_buis_aantal = floorToFraction( (($lengte + $breedte) * 2) / 5.8, 4);
    elseif($enkel_bubbel_input == 'dubbelzijdig')
        $constructie_30_x_30_meubel_galvaan_buis_aantal = floorToFraction( (($lengte + $breedte) * 4) / 5.8, 4);
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
    if($enkel_bubbel_input == 'enkelzijdig')
        $constructie_25_x_25_meubel_aluminium_buis_aantal = floorToFraction( (($lengte + $breedte) * 2) / 5.8, 4);
    elseif($enkel_bubbel_input == 'dubbelzijdig')
        $constructie_25_x_25_meubel_aluminium_buis_aantal = floorToFraction( (($lengte + $breedte) * 4) / 5.8, 4);
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
$hulpmat_4__5_grinder_disc_usd = 1.63636363636364;
$hulpmat_4__5_grinder_disc_srd = $hulpmat_4__5_grinder_disc_usd * $usd_to_srd;
$hulpmat_4__5_grinder_disc_subtotal = $hulpmat_4__5_grinder_disc_aantal * $hulpmat_4__5_grinder_disc_srd;

// G81 calculation
$hulpmat_lasdraad_aantal = floorToFraction(($randen_galvaan_1_25m_x_2_50m_1mm_aantal + $randen_aluminium_1__22_x_2__44m_1__3mm_aantal) / 20, 5);
$hulpmat_lasdraad_usd = 20.9090909090909;
$hulpmat_lasdraad_srd = $hulpmat_lasdraad_usd * $usd_to_srd;
$hulpmat_lasdraad_subtotal = $hulpmat_lasdraad_aantal * $hulpmat_lasdraad_srd;

// G101 calculation
if($oppervlakte_mica_en_sticker == 0)
    $electra_kabel_3_x_2__5mm2_aantal = 0;
else
    $electra_kabel_3_x_2__5mm2_aantal = 5;
$electra_kabel_3_x_2__5mm2_usd = 1.08181818181818;
$electra_kabel_3_x_2__5mm2_srd = $electra_kabel_3_x_2__5mm2_usd * $usd_to_srd;
$electra_kabel_3_x_2__5mm2_subtotal = $electra_kabel_3_x_2__5mm2_aantal * $electra_kabel_3_x_2__5mm2_srd;

// G102 calculation
if($oppervlakte_mica_en_sticker == 0)
    $electra_kabel_klips_aantal = 0;
else
    $electra_kabel_klips_aantal = 1;
$electra_kabel_klips_usd = 2;
$electra_kabel_klips_srd = $electra_kabel_klips_usd * $usd_to_srd;
$electra_kabel_klips_subtotal = $electra_kabel_klips_aantal * $electra_kabel_klips_srd;

// G106 calculation
if($oppervlakte_mica_en_sticker == 0)
    $electra_fotocell_aantal = 0;
else
    $electra_fotocell_aantal = 1;
$electra_fotocell_usd = 11.8181818181818;
$electra_fotocell_srd = $electra_fotocell_usd * $usd_to_srd;
$electra_fotocell_subtotal = $electra_fotocell_aantal * $electra_fotocell_srd;

// G108 calculation
if($oppervlakte_mica_en_sticker == 0)
    $electra_opbouwdoos_aantal = 0;
else
    $electra_opbouwdoos_aantal = 1;
$electra_opbouwdoos_usd = 1.54545454545455;
$electra_opbouwdoos_srd = $electra_opbouwdoos_usd * $usd_to_srd;
$electra_opbouwdoos_subtotal = $electra_opbouwdoos_aantal * $electra_opbouwdoos_srd;

// G109 calculation
if($oppervlakte_mica_en_sticker == 0)
    $electra_lasdoppen_aantal = 0;
else
    $electra_lasdoppen_aantal = 3;
$electra_lasdoppen_usd = 0.154545454545455;
$electra_lasdoppen_srd = $electra_lasdoppen_usd * $usd_to_srd;
$electra_lasdoppen_subtotal = $electra_lasdoppen_aantal * $electra_lasdoppen_srd;

// G115 calculation
if(min($lengte, $breedte) < 2.44)
    $electra_led_lights_groot_hanley_lichtbakken_aantal = ceil(max($lengte, $breedte) / 0.2) * 2;
else
    $electra_led_lights_groot_hanley_lichtbakken_aantal = ceil( ($lengte * $lengte + $breedte * $breedte) / 0.2) * 2;
$electra_led_lights_groot_hanley_lichtbakken_usd = $lichtbakken_calculator_tab_one_g136 * 1.4;
$electra_led_lights_groot_hanley_lichtbakken_srd = $electra_led_lights_groot_hanley_lichtbakken_usd * $usd_to_srd;
$electra_led_lights_groot_hanley_lichtbakken_subtotal = $electra_led_lights_groot_hanley_lichtbakken_aantal * $electra_led_lights_groot_hanley_lichtbakken_srd;

// G116 calculation
$electra_led_travo_60w_aantal = ceil($electra_led_lights_groot_hanley_lichtbakken_aantal / 22);
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
$sticker_usd = 50;
$sticker_srd = $sticker_usd * $usd_to_srd;
$sticker_subtotal = $sticker_aantal * $sticker_srd;
$sticker = $sticker_subtotal;

// G133 calculation
$spuitwerk_randen_aantal =  ($randen_galvaan_1_25m_x_2_50m_1mm_aantal + $randen_aluminium_1__22_x_2__44m_1__3mm_aantal)
    + ($achterzijde_galvaan_1_25m_x_2_50m_1mm_aantal + $achterzijde_aluminium_1__22_x_2__44m_1__3mm_aantal) * 4;
$spuitwerk_randen_usd = 10;
$spuitwerk_randen_srd = $spuitwerk_randen_usd * $usd_to_srd;
$spuitwerk_randen_subtotal = $spuitwerk_randen_aantal * $spuitwerk_randen_srd;
$afwerken = $spuitwerk_randen_subtotal;

$transport_subtotal = 0;
$transport = $transport_subtotal;

// G149 calculation
$arbeid_halfwas_aantal =  ($randen_galvaan_1_25m_x_2_50m_1mm_aantal + $randen_aluminium_1__22_x_2__44m_1__3mm_aantal)
    + ($achterzijde_galvaan_1_25m_x_2_50m_1mm_aantal + $achterzijde_aluminium_1__22_x_2__44m_1__3mm_aantal) * 4;
$arbeid_halfwas_usd = 5.15;
$arbeid_halfwas_srd = $arbeid_halfwas_usd * $usd_to_srd;
$arbeid_halfwas_subtotal = $arbeid_halfwas_aantal * $arbeid_halfwas_srd;

// G150 calculation
$arbeid_handlanger_aantal =  ($randen_galvaan_1_25m_x_2_50m_1mm_aantal + $randen_aluminium_1__22_x_2__44m_1__3mm_aantal) + ($achterzijde_galvaan_1_25m_x_2_50m_1mm_aantal + $achterzijde_aluminium_1__22_x_2__44m_1__3mm_aantal) * 4;
$arbeid_handlanger_usd = 4.15;
$arbeid_handlanger_srd = $arbeid_handlanger_usd * $usd_to_srd;
$arbeid_handlanger_subtotal = $arbeid_handlanger_aantal * $arbeid_handlanger_srd;

$arbeid = $arbeid_halfwas_subtotal + $arbeid_handlanger_subtotal;

// G 154 calculation
$machine_router_aantal =  $achterzijde_galvaan_1_25m_x_2_50m_1mm_aantal + $achterzijde_aluminium_1__22_x_2__44m_1__3mm_aantal
    + $randen_acrylaat_mica_3mm_aantal + $randen_acrylaat_mica_5mm_aantal;
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
$moeilijkheidsgraad = $subtotal2 * 0.00;
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

/**
 * @param $n
 * @param int $x
 * @return float
 */
function roundUpToAny($n,$x=5) {
    return (ceil($n)%$x === 0) ? ceil($n) : round(($n+$x/2)/$x)*$x;
}


/**
 * @param $number
 * @param int $denominator : 1 for ceil, 2 for .5, 3 for .333, 4 for .25, .5, .75
 * @return float
 */
function floorToFraction($number, $denominator = 1)
{
    $x = $number * $denominator;
    $x = ceil($x);
    $x = $x / $denominator;
    return $x;
}