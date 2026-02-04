<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SectionRegistrationController extends Controller
{
    public function toggle(Section $section)
    {
        $user = Auth::user();

        if (!$section->canRegistration()) {
            return back()->with('error', 'Registration closed');
        }

        $section->users()->toggle($user->id);

        return back()->with('success', "Registration success");
    }
}
