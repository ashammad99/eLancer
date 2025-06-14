<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class SetAppLocale
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
//        $locale = $request->query('lang', Session::get('lang', 'en'));
//        Session::put('lang', $locale);
//        App::setLocale($locale);
        $user = Auth::user();


        if ($user) {
            $locale = $user->language;

        } else {
            $accept_language = $request->header('accept-language');
            $lang_array = explode(',', $accept_language);
            $locale = $lang_array[0] ?? App::getLocale();

            // $locale = $request->query('lang', Session::get('lang', $locale));
            // Session::put('lang', $locale);

            $locale = $request->route('locale', $locale);
        }
        $locales = ['en', 'ar'];

        if (!in_array($locale, $locales)) {
            abort(404);
        }

        App::setLocale($locale);

        URL::defaults([
            'locale' => $locale,
        ]);
        Route::current()->forgetParameter('locale');

        return $next($request);
    }
}
