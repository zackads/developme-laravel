<?php

namespace App\Http\Controllers;

class Home extends Controller
{
    public function index()
    {
        return view("welcome", [
            "timeOfDay" => $this->timeOfDay(),
        ]);
    }

    public function timeOfDay()
    {
        // Returns "morning", "afternoon" or "evening"
        // depending on current time in the *server* timezone

        $hour = date('H');

        if ($hour < 12) {
            return "morning";
        }
        if ($hour >= 12 && $hour < 17) {
            return "afternoon";
        }
        if ($hour >= 17) {
            return "evening";
        }
    }
}
