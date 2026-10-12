<?php

namespace App\Http\Controllers;

use App\Helpers\CompatibilityHelper;

class CompatibilityController extends Controller
{
    // /compatibility/aries : partner ki rashi chunne ka page
    public function sign($sign)
    {
        $sign = ucfirst($sign);

        return view('compatibility-sign', [
            'sign'  => $sign,
            'meta'  => CompatibilityHelper::SIGNS[$sign],
            'ruler' => CompatibilityHelper::planetName(CompatibilityHelper::SIGNS[$sign]['ruler']),
            'signs' => CompatibilityHelper::SIGNS,
            'best'  => CompatibilityHelper::bestMatches($sign),
        ]);
    }

    // /compatibility/aries/taurus : dono rashiyon ki compatibility report
    public function pair($sign, $partner)
    {
        return view('compatibility-pair', CompatibilityHelper::report(ucfirst($sign), ucfirst($partner)) + [
            'signs' => CompatibilityHelper::SIGNS,
        ]);
    }
}
