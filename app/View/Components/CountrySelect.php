<?php

namespace App\View\Components;

use Illuminate\Support\Facades\App;
use Illuminate\View\Component;
use Symfony\Component\Intl\Countries;

class CountrySelect extends Component
{

    public $countries;

    public $selected;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($selected = null)
    {
            $this->countries = Countries::getNames(App::currentLocale());
        /*
         * getNames(App::currentLocale()) : get from system ur current country and set it
         * getNames('ar'): show name of countries in arabic*/
        $this->selected = $selected;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.country-select');
    }
}
