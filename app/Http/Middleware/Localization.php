<?php


namespace App\Http\Middleware;
use Closure;
use Couchbase\DesignDocument;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use App\Models\Language;
use phpDocumentor\Reflection\Type;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
//        $lan = $request->locale;
        $currentURL = URL::current();
        $language = explode('/',$currentURL);
        $languages = Language::get();
//        $languages = Language::where('short_name', $lan)->get();
//var_dump($languages);
$short_name = [];
        $first_url = [];
        $end_url = [];
        foreach ($languages as $key => $item){
            $short_name[] = $item['short_name'];
        }
//        dd($short_name);
        if (isset($language[3])){
                if (in_array($language[3], $short_name)){
                    foreach ($short_name as $it) {
                        if (in_array($it, $language)) {
                            App::setLocale($it);
                            session()->put('locale', $it);
                        }
                    }
                }else{
                    App::setLocale(Session()->get('locale'));
                    for ($i = 0; $i < 3; $i++) {
                        $first_url[] = $language[$i];
                    }
                    for ($i = 3; $i < count($language); $i++) {
                        $end_url[] = $language[$i];
                    }
//                    dd($end_url);
                    $str_first= implode("/", $first_url);
                    $str_end= implode("/", $end_url);
                    $url = $str_first . '/' . Session()->get('locale') . '/' . $str_end;
                    return redirect($url);
                }
        }else{
            App::setLocale('en');
        }
        return $next($request);
    }
}
