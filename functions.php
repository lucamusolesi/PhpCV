<?php 
function months($mn){
    global $i18n;
    switch ($mn) {
        case '--01':
            return $i18n['month1'];
            break;
        case '--02':
            return $i18n['month2'];
            break;
        case '--03':
            return $i18n['month3'];
            break;
        case '--04':
            return $i18n['month4'];
            break;                                                
        case '--05':
            return $i18n['month5'];
            break;
        case '--06':
            return $i18n['month6'];
            break;
        case '--07':
            return $i18n['month7'];
            break;
        case '--08':
            return $i18n['month8'];
            break;
        case '--09':
            return $i18n['month9'];
            break;
        case '--10':
            return $i18n['month10'];
            break;
        case '--11':
            return $i18n['month11'];
            break;
        case '--12':
            return $i18n['month12'];
            break;
        default:
            return null;
            break;
    }
}
$months='months';

function isfull($field){
    global $i18n;
    if (!empty($field)) {
        return $field;
    }
    else return $i18n['now'];
}
$isfull='isfull';


function whatskill($type){
    global $i18n;
    switch ($type) {
        case 'social':
            return $i18n['social'];
            break;
        case 'organisational':
            return $i18n['organisational'];
            break;
        case 'technical':
            return $i18n['technical'];
            break;
        case 'computer':
            return $i18n['computer'];
            break;
        case 'artistic':
            return $i18n['artistic'];
            break;
        case 'other':
            return $i18n['other'];
            break;                    
        default:
            return null;
            break;
    }
}
$whatskill='whatskill';

function empty2nl($string){
    return preg_replace(array("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "/\n/"), array("<br><br>","<br>"), $string);
}
$empty2nl='empty2nl';
?>