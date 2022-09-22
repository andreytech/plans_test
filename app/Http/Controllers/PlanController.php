<?php

namespace App\Http\Controllers;

use App\Http\Resources\PlanResource;
use App\Models\Plan;
use Illuminate\Http\Resources\Json\JsonResource;

class PlanController extends Controller
{
    public function index(): JsonResource
    {
        return PlanResource::collection(Plan::with('features')->get());
    }
}
