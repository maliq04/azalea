<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Upload Template – Admin · {{ config('app.name', 'Azalea') }}</title>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; background: #f9fafb; color: #111827; }

        .admin-wrap { max-width: 720px; margin: 0 auto; padding: 2.5rem 2rem 5rem; }

        .admin-header { display: flex; align-items: center; gap: 1rem; margin-bottom: 2rem; }
        .admin-header a { font-size: 0.875rem; color: #6b7280; text-decoration: none; }
        .admin-header a:hover { color: #111827; }
        .admin-header h1 { font-size: 1.5rem; font-weight: 700; }

        .card { background: #fff; border: 1px solid #e5e7eb; border-radius: 0.75rem; padding: 2rem; }

        .form-group { margin-bottom: 1.25rem; }
        label { display: block; font-size: 0.82rem; font-weight: 600; color: #374151; margin-bottom: 0.4rem; }
        .hint { font-size: 0.75rem; color: #9ca3af; margin-top: 0.25rem; }
        input[type=text], input[type=number], select {
            width: 100%; padding: 0.6rem 0.9rem; border: 1px solid #d1d5db; border-radius: 0.5rem;
            font-size: 0.875rem; color: #111827; background: #fff; outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        input:focus, select:focus { border-color: #e02424; box-shadow: 0 0 0 3px rgba(224,36,36,0.07); }

        /* File drop zone */
        .drop-zone {
            border: 2px dashed #e5d0e0; border-radius: 0.75rem; padding: 2rem 1rem;
            text-align: center; cursor: pointer; transition: border-color 0.2s, background 0.2s;
            background: #fff9fb; position: relative;
        }
        .drop-zone:hover, .drop-zone.dragover { border-color: #e02424; background: #fff1f5; }
        .drop-zone input[type=file] { position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%; height: 100%; }
        .drop-zone-icon { font-size: 2rem; margin-bottom: 0.5rem; }
        .drop-zone p { font-size: 0.82rem; color: #9ca3af; }
        .drop-zone strong { color: #e02424; }
        .file-chosen { margin-top: 0.5rem; font-size: 0.8rem; color: #374151; font-weight: 500; display: none; }

        /* Toggle */
        .toggle-wrap { display: flex; align-items: center; gap: 0.75rem; }
        .toggle { position: relative; width: 40px; height: 22px; }
        .toggle input { opacity: 0; width: 0; height: 0; }
        .toggle-slider {
            position: absolute; inset: 0; background: #d1d5db; border-radius: 9999px; cursor: pointer;
            transition: background 0.2s;
        }
        .toggle-slider::before {
            content: ''; position: absolute; width: 16px; height: 16px; left: 3px; bottom: 3px;
            background: #fff; border-radius: 9999px; transition: transform 0.2s;
        }
        .toggle input:checked + .toggle-slider { background: #e02424; }
        .toggle input:checked + .toggle-slider::before { transform: translateX(18px); }
        .toggle-label { font-size: 0.875rem; color: #374151; font-weight: 500; }

        /* Row layout */
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }

        /* Errors */
        .field-error { font-size: 0.78rem; color: #dc2626; margin-top: 0.3rem; }
        .error-box { background: #fef2f2; border: 1px solid #fee2e2; border-radius: 0.5rem; padding: 0.75rem 1rem; margin-bottom: 1.25rem; }
        .error-box ul { list-style: disc inside; }
        .error-box li { font-size: 0.82rem; color: #dc2626; line-height: 1.7; }

        /* Actions */
        .form-actions { display: flex; align-items: center; gap: 0.75rem; margin-top: 1.75rem; }
        .btn-primary { padding: 0.6rem 1.5rem; background: #e02424; color: #fff; border: none; border-radius: 9999px; font-size: 0.875rem; font-weight: 600; cursor: pointer; transition: background 0.2s; }
        .btn-primary:hover { background: #c81e1e; }
        .btn-cancel { padding: 0.6rem 1.25rem; background: #fff; color: #374151; border: 1px solid #d1d5db; border-radius: 9999px; font-size: 0.875rem; font-weight: 500; text-decoration: none; transition: background 0.2s; }
        .btn-cancel:hover { background: #f9fafb; }
    </style>
</head>
<body>
<div class="admin-wrap">

    <div class="admin-header">
        <a href="{{ route('admin.templates.index') }}">← Templates</a>
        <h1>Upload Template</h1>
    </div>

    @if ($errors->any())
        <div class="error-box">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <form method="POST" action="{{ route('admin.templates.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-row">
                <div class="form-group">
                    <label for="name">Template Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="e.g. Rosa Bloom" required>
                    @error('name')<p class="field-error">{{ $message }}</p>@enderror
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <select id="category" name="category" required>
                        <option value="">— Select —</option>
                        @foreach (['minimalist','floral','elegant','traditional','modern','rustic','islamic'] as $cat)
                            <option value="{{ $cat }}" {{ old('category') === $cat ? 'selected' : '' }}>{{ ucfirst($cat) }}</option>
                        @endforeach
                    </select>
                    @error('category')<p class="field-error">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="price">Price (IDR)</label>
                    <input type="number" id="price" name="price" value="{{ old('price', 0) }}" min="0" step="1000" placeholder="0">
                    <p class="hint">Enter 0 for free templates.</p>
                    @error('price')<p class="field-error">{{ $message }}</p>@enderror
                </div>
                <div class="form-group">
                    <label for="badge">Badge</label>
                    <select id="badge" name="badge">
                        <option value="">None</option>
                        <option value="popular" {{ old('badge') === 'popular' ? 'selected' : '' }}>Popular</option>
                        <option value="new" {{ old('badge') === 'new' ? 'selected' : '' }}>New</option>
                        <option value="free" {{ old('badge') === 'free' ? 'selected' : '' }}>Free</option>
                    </select>
                    @error('badge')<p class="field-error">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="sort_order">Sort Order</label>
                    <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', 0) }}" min="0">
                    <p class="hint">Lower numbers appear first.</p>
                </div>
                <div class="form-group" style="display:flex;align-items:flex-end;padding-bottom:0.2rem;">
                    <div class="toggle-wrap">
                        <label class="toggle">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', '1') ? 'checked' : '' }}>
                            <span class="toggle-slider"></span>
                        </label>
                        <span class="toggle-label">Active (visible to users)</span>
                    </div>
                </div>
            </div>

            <!-- HTML file upload -->
            <div class="form-group">
                <label>HTML File <span style="color:#dc2626">*</span></label>
                <div class="drop-zone" id="htmlDropZone">
                    <input type="file" name="html_file" accept=".html,.htm" id="htmlFile" required>
                    <div class="drop-zone-icon">📄</div>
                    <p><strong>Click to upload</strong> or drag and drop</p>
                    <p>.html / .htm — max 5 MB</p>
                    <p class="file-chosen" id="htmlChosen"></p>
                </div>
                @error('html_file')<p class="field-error">{{ $message }}</p>@enderror
            </div>

            <!-- Thumbnail upload -->
            <div class="form-group">
                <label>Thumbnail Image <span style="color:#9ca3af">(optional)</span></label>
                <div class="drop-zone" id="thumbDropZone">
                    <input type="file" name="thumbnail" accept="image/jpeg,image/png,image/webp" id="thumbFile">
                    <div class="drop-zone-icon">🖼️</div>
                    <p><strong>Click to upload</strong> or drag and drop</p>
                    <p>JPG / PNG / WebP — max 2 MB</p>
                    <p class="file-chosen" id="thumbChosen"></p>
                </div>
                @error('thumbnail')<p class="field-error">{{ $message }}</p>@enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-primary">Upload Template</button>
                <a href="{{ route('admin.templates.index') }}" class="btn-cancel">Cancel</a>
            </div>

        </form>
    </div>

</div>
<script>
    function bindDropZone(zoneId, inputId, chosenId) {
        const zone   = document.getElementById(zoneId);
        const input  = document.getElementById(inputId);
        const chosen = document.getElementById(chosenId);

        input.addEventListener('change', () => {
            if (input.files.length) {
                chosen.textContent = '✓ ' + input.files[0].name;
                chosen.style.display = 'block';
            }
        });

        zone.addEventListener('dragover', (e) => { e.preventDefault(); zone.classList.add('dragover'); });
        zone.addEventListener('dragleave', () => zone.classList.remove('dragover'));
        zone.addEventListener('drop', (e) => {
            e.preventDefault();
            zone.classList.remove('dragover');
            if (e.dataTransfer.files.length) {
                input.files = e.dataTransfer.files;
                chosen.textContent = '✓ ' + e.dataTransfer.files[0].name;
                chosen.style.display = 'block';
            }
        });
    }

    bindDropZone('htmlDropZone',  'htmlFile',  'htmlChosen');
    bindDropZone('thumbDropZone', 'thumbFile', 'thumbChosen');
</script>
</body>
</html>
