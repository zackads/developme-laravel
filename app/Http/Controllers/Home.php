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
            $welcomeMsg = "morning";
        }
        if ($hour >= 12 && $hour < 17) {
            $welcomeMsg = "afternoon";
        }
        if ($hour >= 17) {
            $welcomeMsg = "evening";
        }

        return $welcomeMsg;
    }
}
