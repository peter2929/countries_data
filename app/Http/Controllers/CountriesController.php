<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Services\DataFetchService;
use App\Models\Country;
use App\Repositories\CountryRepository;
use Throwable;

class CountriesController extends Controller
{
    // For this data volume I decided to import right inside of the request.
    // If there was more data, we would need to import asynchronously.
    public function import(DataFetchService $fetchService, CountryRepository $repo): View
    {
        $success = true;

        try {
            $data = $fetchService->fetch();
            $repo->replaceAll($data);
        }
        catch(Throwable $e) {
            $success = false;
        }

        return view('import', [
            'success' => $success,
        ]);
    }

    public function index(): View
    {
        $countries = Country::all();
        $summary = $countries->countBy('status');

        return view('index', [
            'countries' => $countries,
            'summary' => $summary
        ]);
    }

    public function delete(): View
    {
        Country::truncate();
        return view('delete');
    }
}
