<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pret;
use App\Models\Contrat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Carbon\Carbon;

    class RenouvellementController extends Controller
    {
        public function index(Request $request)
        {
            $query = Pret::where('partenaire', 'CORIS')->orderBy('saisiele', 'ASC')->with('adherent');
    
            // Filtre par date de saisie
            if ($request->has('saisiele') && !empty($request->saisiele)) {
                $query->whereDate('saisiele', $request->saisiele);
            }
    
            $prets = $query->get()->map(function ($pret) {
                $dateSaisie = Carbon::parse($pret->saisiele);
                $dateRenouvellement = $dateSaisie->copy()->addYear();
                $joursRestants = Carbon::now()->diffInDays($dateRenouvellement, false);
    
                $pret->date_renouvellement = $dateRenouvellement->format('d/m/Y');
                $pret->jours_restants = $joursRestants;
    
                return $pret;
            });
    
            // Filtre par plage de jours restants
            if ($request->has('jours_restants_min') && $request->has('jours_restants_max')) {
                $joursMin = (int) $request->jours_restants_min;
                $joursMax = (int) $request->jours_restants_max;
    
                $prets = $prets->filter(function ($pret) use ($joursMin, $joursMax) {
                    return $pret->jours_restants >= $joursMin && $pret->jours_restants <= $joursMax;
                });
            }
    
            return view('renouvellement.index', compact('prets'));
        }
    }
