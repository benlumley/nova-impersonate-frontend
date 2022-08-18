<?php

namespace BenLumley\NovaImpersonateFrontend\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Laravel\Nova\Contracts\ImpersonatesUsers;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Nova;
use Laravel\Nova\Util;

class ImpersonateController extends \Laravel\Nova\Http\Controllers\ImpersonateController
{
    public function stopImpersonating(NovaRequest $request, ImpersonatesUsers $impersonator)
    {
        $ret = parent::stopImpersonating($request, $impersonator);
        return redirect($ret->getData()->redirect);
    }

}
