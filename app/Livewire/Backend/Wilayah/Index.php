<?php

namespace App\Livewire\Backend\Wilayah;

use Livewire\Component;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\Village;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Province;

class Index extends Component
{

    public $provinceCode;
    public $cityCode;
    public $districtCode;
    public $villageCode;

    public function updatedProvinceCode(){
        $this->cityCode = null;
        $this->districtCode = null;
        $this->villageCode = null;
    }
    public function updatedCityCode(){
        $this->districtCode = null;
        $this->villageCode = null;
    }
    public function updatedDistrictCode(){
        $this->villageCode = null;
    }

    public function render()
    {
        return view('livewire.backend.wilayah.index',[
            'dataprovinsi' => Province::orderBy('code', 'asc')->get(),
            'datapcity' => City::where('province_code', $this->provinceCode)->orderBy('code', 'asc')->get(),
            'datadistrict' => District::where('city_code', $this->cityCode)->orderBy('code', 'asc')->get(),
            'datavillage' => Village::where('district_code', $this->districtCode)->orderBy('code', 'asc')->get(),
            'title' => 'Indonesia'
        ]);
    }

}
