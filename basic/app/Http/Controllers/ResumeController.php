<?php

namespace App\Http\Controllers;

use App\Models\Resume;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class ResumeController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $resumes = auth()->user()->resumes;
        return view("resumes.index", compact("resumes"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = "testz";
        return view("resumes.create", ["data" => $data]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        
        // Verificar si un resume con el mismo título ya existe
        $existingResume = $user->resumes()->where("title", $request->title)->first();
        if ($existingResume) {
            return back()->withErrors(["title" => "This title already exists."]);
        }
    
        // Validar los datos de entrada
        $data = $request->validate([
            "title" => "required|string",
            // Incluye aquí otros campos que necesites validar
        ]);
        
        // Añadir campos adicionales que no están en la validación
        $data["name"] = $user->name;
        $data["email"] = $user->email;
    
        // Crear un nuevo resume
        $user->resumes()->create($data);
    
        return redirect()->route("resumes.index");
    }
        

    /**
     * Display the specified resource.
     */
    public function show(Resume $resume)
    {
        return view("resumes.show", compact("resume"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Resume $resume)
    {
        $this->authorize("update", $resume);
        return view("resumes.edit", compact("resume"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Resume $resume)
    {
        $data = $request->validate(
            [
                "name" => "required|string",
                "email" => "required|email",
                "website" => "nullable|url",
                "picture" => "nullable|image",
                "about" => "nullable|string",
                "title" => Rule::unique("resumes")
                    ->where(fn ($query) =>
                    $query->where("user_id", $resume->user->id))
                    ->ignore($resume->id)
            ]
        );

        if ($request->hasFile('picture')) {
            $picture = $request->file("picture")->store("pictures", "public");
            Image::make(public_path("storage/$picture"))->fit(800, 800)->save();
            $data["picture"] = $picture;
        }

        $resume->update($data);

        return redirect()->route("resumes.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Resume $resume)
    {
        $this->authorize("delete", $resume);

        $resume->delete();

        return redirect()->route("resumes.index");
    }
}
