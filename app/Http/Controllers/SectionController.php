<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Section;
use Illuminate\Support\Facades\Auth;

class SectionController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $sections = Section::all()->map(function ($section) use ($user) {
            return array_merge($section->toArray(), [
                'status' => $section->status->value,
                'status_label' => $section->status->label(),
                'can_registration' => $section->canRegistration(),
                'is_joined' => $section->hasParticipant($user),
                'can_create_thesis' => $section->canCreateThesis()
            ]);
        });

        return Inertia::render('Sections/Index', [
            'sections' => $sections,
            'user' => $user,
        ]);
    }

    public function show(Section $section)
    {
        $user = Auth::user();

        $sectionData = array_merge($section->toArray(), [
            'status' => $section->status->value,
            'status_label' => $section->status->label(),
            'can_registration' => $section->canRegistration(),
            'is_joined' => $section->hasParticipant($user),
        ]);

        return Inertia::render('Sections/Show', [
            'section' => $sectionData,
            'user' => $user,
        ]);
    }
}