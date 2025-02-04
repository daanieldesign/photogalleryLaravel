<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        // Načítání obrázků z public/images
        $imageFiles = \File::files(public_path('images'));
        $images = array_filter($imageFiles, function ($file) {
            return in_array($file->getExtension(), ['jpg', 'jpeg', 'png', 'gif']);
        });

        return view('welcome', ['images' => $images]);
    }

    // Metoda pro nahrání obrázku
    public function upload(Request $request)
    {
        // Validace souboru
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Max. velikost 2MB
        ]);

        // Uložení obrázku do složky images
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '-' . $image->getClientOriginalName(); // Generování jedinečného názvu souboru
            $image->move(public_path('images'), $imageName); // Uložení obrázku do public/images

            // Po úspěšném uložení přesměrování na index
            return redirect()->route('gallery.index');
        }

        return back()->with('error', 'Nahrávání selhalo.');
    }
}
