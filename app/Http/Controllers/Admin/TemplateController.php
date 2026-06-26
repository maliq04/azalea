<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TemplateController extends Controller
{
    /**
     * List all templates in the admin panel.
     */
    public function index()
    {
        $templates = Template::orderBy('sort_order')->orderBy('created_at', 'desc')->get();

        return view('admin.templates.index', compact('templates'));
    }

    /**
     * Show the upload form.
     */
    public function create()
    {
        return view('admin.templates.create');
    }

    /**
     * Store a newly uploaded template.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'       => ['required', 'string', 'max:100'],
            'category'   => ['required', 'string', 'in:minimalist,floral,elegant,traditional,modern,rustic,islamic'],
            'price'      => ['required', 'integer', 'min:0'],
            'badge'      => ['nullable', 'string', 'in:popular,new,free'],
            'html_file'  => ['required', 'file', 'mimes:html,htm', 'max:5120'],  // 5 MB
            'thumbnail'  => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'is_active'  => ['boolean'],
            'sort_order' => ['integer', 'min:0'],
        ]);

        // Derive a unique slug for filenames
        $slug = Str::slug($validated['name']) . '-' . uniqid();

        // Store the HTML file privately (not publicly accessible directly)
        $htmlPath = $request->file('html_file')
            ->storeAs('templates/html', $slug . '.html', 'private');

        // Store thumbnail in the public disk so it can be served
        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')
                ->storeAs('thumbnails', $slug . '.' . $request->file('thumbnail')->extension(), 'public');
        }

        Template::create([
            'name'           => $validated['name'],
            'category'       => $validated['category'],
            'price'          => $validated['price'],
            'badge'          => $validated['badge'] ?? null,
            'html_path'      => $htmlPath,
            'thumbnail_path' => $thumbnailPath,
            'is_active'      => $request->boolean('is_active', true),
            'sort_order'     => $validated['sort_order'] ?? 0,
        ]);

        return redirect()->route('admin.templates.index')
            ->with('success', 'Template "' . $validated['name'] . '" uploaded successfully.');
    }

    /**
     * Show the edit form for a template.
     */
    public function edit(Template $template)
    {
        return view('admin.templates.edit', compact('template'));
    }

    /**
     * Update an existing template.
     */
    public function update(Request $request, Template $template)
    {
        $validated = $request->validate([
            'name'       => ['required', 'string', 'max:100'],
            'category'   => ['required', 'string', 'in:minimalist,floral,elegant,traditional,modern,rustic,islamic'],
            'price'      => ['required', 'integer', 'min:0'],
            'badge'      => ['nullable', 'string', 'in:popular,new,free'],
            'html_file'  => ['nullable', 'file', 'mimes:html,htm', 'max:5120'],
            'thumbnail'  => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'is_active'  => ['boolean'],
            'sort_order' => ['integer', 'min:0'],
        ]);

        $slug = Str::slug($validated['name']) . '-' . uniqid();

        // Replace HTML file if a new one is uploaded
        if ($request->hasFile('html_file')) {
            Storage::disk('private')->delete($template->html_path);
            $validated['html_path'] = $request->file('html_file')
                ->storeAs('templates/html', $slug . '.html', 'private');
        }

        // Replace thumbnail if a new one is uploaded
        if ($request->hasFile('thumbnail')) {
            if ($template->thumbnail_path) {
                Storage::disk('public')->delete($template->thumbnail_path);
            }
            $validated['thumbnail_path'] = $request->file('thumbnail')
                ->storeAs('thumbnails', $slug . '.' . $request->file('thumbnail')->extension(), 'public');
        }

        $template->update([
            'name'           => $validated['name'],
            'category'       => $validated['category'],
            'price'          => $validated['price'],
            'badge'          => $validated['badge'] ?? null,
            'html_path'      => $validated['html_path'] ?? $template->html_path,
            'thumbnail_path' => $validated['thumbnail_path'] ?? $template->thumbnail_path,
            'is_active'      => $request->boolean('is_active', true),
            'sort_order'     => $validated['sort_order'] ?? 0,
        ]);

        return redirect()->route('admin.templates.index')
            ->with('success', 'Template updated.');
    }

    /**
     * Delete a template and its associated files.
     */
    public function destroy(Template $template)
    {
        Storage::disk('private')->delete($template->html_path);

        if ($template->thumbnail_path) {
            Storage::disk('public')->delete($template->thumbnail_path);
        }

        $template->delete();

        return redirect()->route('admin.templates.index')
            ->with('success', 'Template deleted.');
    }

    /**
     * Serve the HTML file for preview (admin only).
     */
    public function preview(Template $template)
    {
        $path = Storage::disk('private')->path($template->html_path);

        if (!file_exists($path)) {
            abort(404);
        }

        return response()->file($path, ['Content-Type' => 'text/html']);
    }
}
