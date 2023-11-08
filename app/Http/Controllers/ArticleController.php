<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('show');
        $this->middleware('admin')->except('show');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::paginate(10);
        //return to json
        return response()->json($articles);
        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|min:3|max:255',
            'body' => 'required|string',
        ]);

        // Simpan gambar jika ada
        if ($request->hasFile('image')) {
            // Validasi gambar
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            // Upload gambar dan dapatkan path gambar yang diupload
            $imagePath = $request->file('image')->store('public/images');

            $validated['image'] = $imagePath;
        }

        // Buat artikel baru
        $article = Article::create([
            'title' => $validated['title'],
            'body' => $validated['body'],
            'published_at' => $request->has('is_published') ? Carbon::now() : null,
            'image' => $validated['image'] ?? null,
        ]);

        return redirect()->route('articles.index')->with('success', 'Article added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        return view('articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'title' => 'required|string|min:3|max:255',
            'body' => 'required|string',
        ]);

        // Simpan gambar jika ada
        if ($request->hasFile('image')) {
            // Validasi gambar
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            // Upload gambar dan dapatkan path gambar yang diupload
            $imagePath = $request->file('image')->store('public/images');

            // Hapus gambar lama jika ada
            if ($article->image) {
                Storage::delete($article->image);
            }

            $validated['image'] = $imagePath;
        }

        // Update artikel
        $article->update([
            'title' => $validated['title'],
            'body' => $validated['body'],
            //Jika tidak ada gambar baru, gunakan gambar lama
            'published_at' => $request->has('is_published') ? Carbon::now() : null,
            'image' => $validated['image'] ?? $article->image,
        ]);
        return redirect()->route('articles.index')->with('success', 'Article updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        // Hapus gambar jika ada
        if ($article->image) {
            Storage::delete($article->image);
        }
        $article->delete();
        return redirect()->route('articles.index')->with('success', 'Article deleted successfully.');
    }
}
