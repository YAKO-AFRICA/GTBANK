<?php

function Refgenerate($table,$init,$key)
{
    $latest = $table::latest('id')->first();
    if (! $latest) {
        return $init.'-00001';
    }

    $string = preg_replace("/[^0-9\.]/", '', $latest->$key);

    return $init.'-' . sprintf('%05d',$string+1);
}

// function RefgenerateBulletin($table, $codeProduit, $key, $init)
// {
//     // Récupérer le dernier enregistrement de la table pour le code produit donné
//     $contrat = $table::where('codeproduit', $codeProduit)
//         ->where('numBullettin', '!=', null)
//         ->get();

//     $nbr = count($contrat);

//     // if (!$contrat) {
//     //     return $nbr = '1';
//     // }

//     $lastBulletin = $nbr + 1;

//     $num = $init . $lastBulletin;

//     return $num;
// }

function RefgenerateBulletin($table, $codeProduit, $key, $init)
{
    do {
        // Récupérer le dernier enregistrement de la table pour le code produit donné
        $contrats = $table::where('codeproduit', $codeProduit)
            ->where('numBullettin', '!=', null)
            ->get();

        $nbr = count($contrats);
        $lastBulletin = $nbr + 1;
        $num = $init . $lastBulletin;

        // Vérifier si ce numéro existe déjà dans la table
        $exists = $table::where('numBullettin', $num)->exists();
        
        // Si le numéro existe, on incrémente le compteur pour essayer le suivant
        if ($exists) {
            $nbr++;
        }
        
    } while ($exists); // Continuer tant que le numéro existe

    return $num;
}

function nombreEnLettre($nombre) {
    $unites = array('zero', 'un', 'deux', 'trois', 'quatre', 'cinq', 'six', 'sept', 'huit', 'neuf', 'dix', 'onze', 'douze', 'treize', 'quatorze', 'quinze', 'seize', 'dix-sept', 'dix-huit', 'dix-neuf');
    $dizaines = array('', 'dix', 'vingt', 'trente', 'quarante', 'cinquante', 'soixante', 'soixante-dix', 'quatre-vingts', 'quatre-vingt-dix');
    $centaines = array('', 'cent', 'deux cents', 'trois cents', 'quatre cents', 'cinq cents', 'six cents', 'sept cents', 'huit cents', 'neuf cents');

    if ($nombre < 20) {
        return $unites[$nombre];
    } elseif ($nombre < 100) {
        return $dizaines[floor($nombre / 10)] . ($nombre % 10 > 0 ? ' ' . $unites[$nombre % 10] : '');
    } elseif ($nombre < 1000) {
        return $centaines[floor($nombre / 100)] . ($nombre % 100 > 0 ? ' ' . nombreEnLettre($nombre % 100) : '');
    } elseif ($nombre < 1000000) {
        return nombreEnLettre(floor($nombre / 1000)) . ' mille' . ($nombre % 1000 > 0 ? ' ' . nombreEnLettre($nombre % 1000) : '');
    } elseif ($nombre < 1000000000) {
        return nombreEnLettre(floor($nombre / 1000000)) . ' million' . ($nombre % 1000000 > 0 ? ' ' . nombreEnLettre($nombre % 1000000) : '');
    } else {
        return nombreEnLettre(floor($nombre / 1000000000)) . ' milliard' . ($nombre % 1000000000 > 0 ? ' ' . nombreEnLettre($nombre % 1000000000) : '');
    }
}

if (!function_exists('displayEtatBadge')) {
    /**
     * Affiche un badge stylisé selon l'état
     *
     * @param int|null $etat
     * @return string
     */
    function displayEtatBadge(?int $etat): string
    {
        if ($etat === null) {
            return '';
        }

        $badges = [
            1 => ['text' => 'En saisie', 'class' => 'bg-primary text-white', 'icon' => 'bx bxs-edit'],
            2 => ['text' => 'Transmis', 'class' => 'bg-info ', 'icon' => 'bx bxs-paper-plane'],
            3 => ['text' => 'Accepté', 'class' => 'bg-success', 'icon' => 'bx bxs-check-circle'],
            4 => ['text' => 'Rejeté', 'class' => 'bg-danger', 'icon' => 'bx bxs-times-circle'],
        ];

        if (!array_key_exists($etat, $badges)) {
            return '<span class="badge bg-secondary">État inconnu</span>';
        }

        $badge = $badges[$etat];

        return sprintf(
            '<span class="badge rounded-pill %s bg-opacity-10 text-%s">
                <i class="fas %s me-1"></i> %s
            </span>',
            $badge['class'],
            str_replace('bg-', '', $badge['class']),
            $badge['icon'],
            $badge['text']
        );
    }
}






?>