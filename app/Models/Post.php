<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'posts',
        'status',
    ];

    public function translation()
    {
//        echo Language::where('short_name', Session()->get('locale'))->first()->id; die();
//         echo '<pre>'.json_encode(Language::where('short_name', Session()->get('locale'))->first(), JSON_PRETTY_PRINT) .'</pre>';

        $locale = Session()->get('locale');
        if($locale !== null) {
            return $this->hasOne(Translation::class)->where('language_id', Language::where('short_name', Session()->get('locale'))->first()->id);
        } else {
            return $this->hasOne(Translation::class)->where('language_id',  1);
        }

//        return $this->hasMany(Translation::class);
//        $currentURL = URL::current();
//        $language = explode('/',$currentURL);
//        $languages = Language::get();
//
//        foreach ($languages as $key){
//            $short_name[] = $key['short_name'];
//            $language_id[] = $key['id'];
//        }
//
//        $map = array_combine($short_name, $language_id);
//            foreach ($map as $short_name => $language_id){
//                if ($language[3] == $short_name){
//                    return $this->hasMany(Translation::class)->where('language_id',  $language_id);
//                }
//            }
    }


    public function translations()
    {
        return $this->hasMany(Translation::class);
    }

}
