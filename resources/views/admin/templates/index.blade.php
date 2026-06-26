<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Templates – Admin · {{ config('app.name', 'Azalea') }}</title>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; background: #f9fafb; color: #111827; }

        /* ── Layout ── */
        .admin-wrap { max-width: 1200px; margin: 0 auto; padding: 2.5rem 2rem 5rem; }

        /* ── Header ── */
        .admin-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 2rem; gap: 1rem; flex-wrap: wrap; }
        .admin-header h1 { font-size: 1.5rem; font-weight: 700; color: #111827; }
        .btn-primary {
            display: inline-flex; align-items: center; gap: 0.4rem;
            padding: 0.55rem 1.25rem; background: #e02424; color: #fff;
            border-radius: 9999px; font-size: 0.875rem; font-weight: 600;
            text-decoration: none; border: none; cursor: pointer;
            transition: background 0.2s;
        }
        .btn-primary:hover { background: #c81e1e; }

        /* ── Flash messages ── */
        .flash { padding: 0.75rem 1.25rem; border-radius: 0.5rem; margin-bottom: 1.5rem; font-size: 0.875rem; font-weight: 500; }
        .flash-success { background: #d1fae5; color: #065f46; border: 1px solid #a7f3d0; }

        /* ── Table ── */
        .table-wrap { background: #fff; border: 1px solid #e5e7eb; border-radius: 0.75rem; overflow: hidden; }
        table { width: 100%; border-collapse: collapse; }
        thead { background: #f3f4f6; }
        th { padding: 0.75rem 1rem; text-align: left; font-size: 0.78rem; font-weight: 600; color: #6b7280; text-transform: uppercase; letter-spacing: 0.04em; border-bottom: 1px solid #e5e7eb; }
        td { padding: 0.85rem 1rem; font-size: 0.875rem; color: #374151; border-bottom: 1px solid #f3f4f6; vertical-align: middle; }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: #fafafa; }

        /* ── Thumbnail ── */
        .tmpl-thumb { width: 44px; height: 58px; border-radius: 0.375rem; object-fit: cover; background: #f9edf4; border: 1px solid #f3e8f0; display: flex; align-items: center; justify-content: center; color: #d1a0bc; font-size: 0.65rem; }
        .tmpl-thumb img { width: 100%; height: 100%; object-fit: cover; border-radius: 0.375rem; }

        /* ── Badge ── */
        .badge { display: inline-block; padding: 0.2rem 0.65rem; border-radius: 9999px; font-size: 0.7rem; font-weight: 600; }
        .badge-popular { background: #fee2e2; color: #991b1b; }
        .badge-new     { background: #ede9fe; color: #5b21b6; }
        .badge-free    { background: #d1fae5; color: #065f46; }
        .badge-none    { background: #f3f4f6; color: #9ca3af; }

        /* ── Status pill ── */
        .status-active   { display: inline-block; padding: 0.2rem 0.65rem; border-radius: 9999px; font-size: 0.7rem; font-weight: 600; background: #d1fae5; color: #065f46; }
        .status-inactive { display: inline-block; padding: 0.2rem 0.65rem; border-radius: 9999px; font-size: 0.7rem; font-weight: 600; background: #f3f4f6; color: #9ca3af; }

        /* ── Actions ── */
        .actions { display: flex; align-items: center; gap: 0.5rem; }
        .btn-sm { display: inline-flex; align-items: center; padding: 0.35rem 0.75rem; border-radius: 0.375rem; font-size: 0.78rem; font-weight: 500; text-decoration: none; border: none; cursor: pointer; transition: background 0.2s; }
        .btn-preview  { background: #f0f9ff; color: #0369a1; }
        .btn-preview:hover  { background: #e0f2fe; }
        .btn-edit    { background: #f9fafb; color: #374151; border: 1px solid #e5e7eb; }
        .btn-edit:hover    { background: #f3f4f6; }
        .btn-delete  { background: #fef2f2; color: #dc2626; border: 1px solid #fee2e2; }
        .btn-delete:hover  { background: #fee2e2; }

        /* ── Empty ── */
        .empty-state { text-align: center; padding: 4rem 1rem; color: #9ca3af; }
        .empty-state svg { width: 48px; height: 48px; margin: 0 auto 1rem; display: block; color: #e5d0e0; }
        .empty-state p { font-size: 0.9rem; margin-bottom: 1.25rem; }
    </style>
</head>
<body>
<div class="admin-wrap">

    <div class="admin-header">
        <h1>📄 Templates</h1>
        <a href="{{ route('admin.templates.create') }}" class="btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Upload Template
        </a>
    </div>

    @if (session('success'))
        <div class="flash flash-success">{{ session('success') }}</div>
    @endif

    @if ($templates->isEmpty())
        <div class="empty-state">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            <p>No templates uploaded yet.</p>
            <a href="{{ route('admin.templates.create') }}" class="btn-primary">Upload your first template</a>
        </div>
    @else
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Thumbnail</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Badge</th>
                        <th>Status</th>
                        <th>Order</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($templates as $template)
                        <tr>
                            <td>
                                <div class="tmpl-thumb">
                                    @if ($template->thumbnail_path)
                                        <img src="{{ $template->thumbnailUrl() }}" alt="{{ $template->name }}">
                                    @else
                                        <span>No img</span>
                                    @endif
                                </div>
                            </td>
                            <td><strong>{{ $template->name }}</strong></td>
                            <td>{{ ucfirst($template->category) }}</td>
                            <td>{{ $template->formattedPrice() }}</td>
                            <td>
                                @if ($template->badge)
                                    <span class="badge badge-{{ $template->badge }}">{{ ucfirst($template->badge) }}</span>
                                @else
                                    <span class="badge badge-none">—</span>
                                @endif
                            </td>
                            <td>
                                @if ($template->is_active)
                                    <span class="status-active">Active</span>
                                @else
                                    <span class="status-inactive">Inactive</span>
                                @endif
                            </td>
                            <td>{{ $template->sort_order }}</td>
                            <td>
                                <div class="actions">
                                    <a href="{{ route('admin.templates.preview', $template) }}" target="_blank" class="btn-sm btn-preview">Preview</a>
                                    <a href="{{ route('admin.templates.edit', $template) }}" class="btn-sm btn-edit">Edit</a>
                                    <form method="POST" action="{{ route('admin.templates.destroy', $template) }}" onsubmit="return confirm('Delete this template?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-sm btn-delete">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

</div>
</body>
</html>
