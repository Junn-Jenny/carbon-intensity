<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Carbon\Carbon;
class CarbonIntensity extends Controller
{
    private $api;
    public function __construct() 
    {
        $this->api = env('NATIONAL_GRID_API'); 
    }

    public function intensity() 
    {
        $response = Http::get($this->api . '/intensity');
        return $response->json();
    }

    public function regionlist() 
    {
        $response = Http::get($this->api . '/regional');
        $temps = $response->json()['data'][0]['regions'];
        $data = [];
        foreach($temps as $temp) {
            $data[] = [
                'regionid' => $temp['regionid'],
                'dnoregion' => $temp['dnoregion'],
                'shortname' => $temp['shortname'],

            ];
        }
        return ['data' => $data];
        //return $response->json();
    }

    public function byregion(Request $request )
    {
        $path = '/regional/regionid/'. $request->regionid;
        $response = Http::get($this->api . $path);
        return $response->json();
    }

    public function england()
    {
        $path = '/regional/england';
        $response = Http::get($this->api . $path);
        return $response->json();
    }

    public function scotland()
    {
        $path = '/regional/scotland';
        $response = Http::get($this->api . $path);
        return $response->json();
    }

    public function wales()
    {
        $path = '/regional/wales';
        $response = Http::get($this->api . $path);
        return $response->json();
    }

    public function byenergy() 
    {
        $response = Http::get($this->api . '/regional');
        $temps = $response->json()['data'][0]['regions'];
        $data = [];
        foreach($temps as $temp) {
            foreach($temp['generationmix'] as $energy) {
                $data[$energy['fuel']][] = 
                    [ 'energy' => $energy['fuel'],
                        'data' =>[
                        'regionid' =>  $temp['regionid'],   
                        'dnoregion' => $temp['dnoregion'],
                        'shortname' => $temp['shortname'],
                        'perc' => $energy['perc'] 
                        ]
                    ];
        
            }
        }        
        return $data;
    }

    public function average(Request $request) 
    {
        $from = date('Y-m-dTH:i', strtotime($request->from) );
        $to = date('Y-m-dTH:i', strtotime($request->to));

        $path = '/intensity/'. $from.'/'. $to;
        $response = Http::get($this->api . $path);
        $data = $response->json()['data'];
        $actual = $forecast = 0;
        foreach($data as $temp) {
            $actual += $temp['intensity']['actual'];
            $forecast += $temp['intensity']['forecast'];
            
        }
       
        return response([
            'data' => $data,
            'actual' => round($actual/count($data),2),
            'forecast' => round($forecast/count($data),2)
    ]);

        
    }
}
