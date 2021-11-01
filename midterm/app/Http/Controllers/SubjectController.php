<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\SubjectUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::paginate(5);

        return Inertia::render('Subject/Index', [
            'subjects' => $subjects,
        ]);
    }

    public function show(Subject $subject)
    {
        $isApply = DB::table('subject_user')->where('user_id', Auth::user()->id)->where('subject_id', $subject->id)->exists();

        return Inertia::render('Subject/Show', [
            'subject' => $subject,
            'isApply' => $isApply,
        ]);
    }

    public function create()
    {
        return Inertia::render('Subject/Create');
    }

    public function edit(Subject $subject)
    {
        return Inertia::render('Subject/Edit', [
            'subject' => $subject
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'grade' => 'required|integer',
        ]);

        $subject = Subject::create([
            'name' => $request->name,
            'description' => $request->description,
            'grade' => $request->grade,
        ]);

        return redirect()->route('subject.show', ["subject" => $subject]);
    }

    public function update(Request $request, Subject $subject)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'grade' => 'required|integer',
        ]);

        $subject->name = $request->name;
        $subject->description = $request->description;
        $subject->grade = $request->grade;
        $subject->save();

        return redirect()->route('subject.show', ["subject" => $subject]);
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();

        return redirect()->route('subject.index');
    }
    public function apply(Subject $subject)
    {
        Auth::user()->subjects()->attach($subject->id);
        return response()->json(['message'=>'apply success']);
    }
    public function unapply(Subject $subject)
    {
        Auth::user()->subjects()->toggle($subject->id);
        return response()->json(['message'=>'cancle success']);
    }
}
