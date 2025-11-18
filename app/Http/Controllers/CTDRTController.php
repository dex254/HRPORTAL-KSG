<?php

namespace App\Http\Controllers;

use App\Models\County;
use App\Models\Nomination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CTDRTController extends Controller
{
    //
      public function ctdrt()
    {
        // Fetch distinct county names from database
  $counties = County::select('CountyName')
            ->distinct()
            ->orderBy('CountyName')
            ->get();
            return view('CTDRT.Form', compact('counties'));
    }

    /**
     * AJAX: get SubCounty values for a given CountyName
     */
  public function getSubCounties(Request $request)
    {
        $countyName = $request->get('county'); // matches value sent from JS

        if (!$countyName) {
            return response()->json([]);
        }

        // Fetch all subcounties for this county
        $subCounties = County::where('CountyName', $countyName)
            ->orderBy('SubCounty')
            ->pluck('SubCounty');

        return response()->json($subCounties);
    }
     public function autocompleteNominee(Request $request)
{
    $county = $request->get('county');
    $subcounty = $request->get('subcounty');
    $query = $request->get('q');

    if (!$county || !$subcounty || !$query) {
        return response()->json([]);
    }

    $suggestions = Nomination::where('county', $county)
        ->where('subcounty', $subcounty)
        ->where('nominee_name', 'LIKE', "%{$query}%")
        ->limit(10)
        ->pluck('nominee_name');

    return response()->json($suggestions);
}

}
