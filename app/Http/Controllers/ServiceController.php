<?php

namespace App\Http\Controllers;

use App\Models\Service;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::query()
            ->where('status', 'published')
            ->orderBy('sort_order')
            ->orderBy('created_at')
            ->get();

        return view('services', [
            'services' => $services,
        ]);
    }

    public function show(string $slug)
    {
        $service = Service::query()
            ->where('slug', $slug)
            ->firstOrFail();

        return view('service-detail', [
            'service' => $service,
        ]);
    }

    public function showLegacy(string $slug)
    {
        return $this->show($slug);
    }
}
