<?php

namespace App\Http\Controllers;

use App\Http\Requests\sClassCreateRequest;
use App\Models\sClass;
use Illuminate\Http\Request;

class SClassController extends Controller
{

    public function index()
    {
        $sClasses = sClass::with('teacher', 'subject', 'student')->orderBy('created_at', 'desc')->paginate(6);
        if ($sClasses->count() > 0) {
            return response()->json([
                'sClasses' => $sClasses
            ], 200);
        } else {
            return response()->json([
                'message' => 'No Classes found'
            ], 404);
        }
    }

    public function store(sClassCreateRequest $request)
    {
        try {
            $sClassExists = sClass::where('teacher_id', $request->teacher_id)->where('day', $request->day)->where('hour', $request->hour)->get();
            if ($sClassExists->count() > 0) {
                return response()->json([
                    'message' => 'El profesor ya tiene una clase ese dia y hora'
                ], 405);
            } else {
                $sClass = sClass::create($request->all());
                return response()->json([
                    'sClass' => $sClass,
                    'message' => 'Class created successfully'
                ], 201);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error creating class'
            ], 500);
        }
    }

    public function show(){
        $sClasses = sClass::with('teacher', 'subject')->orderBy('created_at', 'desc')->get();
        foreach ($sClasses as $sClass) {
            $sClass->name = $sClass->subject->name . ' - ' . $sClass->teacher->name;
        }
        if ($sClasses->count() > 0) {
            return response()->json([
                'sClasses' => $sClasses
            ], 200);
        } else {
            return response()->json([
                'message' => 'No Classes found'
            ], 404);
        }
    }

}
