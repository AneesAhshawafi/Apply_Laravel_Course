<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Countries Management</title>
    <!-- Import Inter Font for Premium Look -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* 
         * DESIGN TOKENS & RESET 
         */
        :root {
            /* Palette */
            --primary: #6366f1;
            /* Indigo 500 */
            --primary-hover: #4f46e5;
            /* Indigo 600 */
            --secondary: #64748b;
            /* Slate 500 */
            --success: #22c55e;
            /* Green 500 */
            --danger: #ef4444;
            /* Red 500 */

            /* Backgrounds */
            --bg-body: #f8fafc;
            /* Slate 50 */
            --bg-surface: #ffffff;

            /* Typography */
            --text-main: #0f172a;
            /* Slate 900 */
            --text-muted: #64748b;
            /* Slate 500 */

            /* Borders & Shadows */
            --border-color: #e2e8f0;
            /* Slate 200 */
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --radius-md: 0.5rem;
            --radius-lg: 0.75rem;

            /* Transitions */
            --transition: all 0.2s ease-in-out;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-body);
            color: var(--text-main);
            line-height: 1.5;
            -webkit-font-smoothing: antialiased;
        }

        /* 
         * LAYOUT UTILITIES 
         */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem 1.5rem;
        }

        /* 
         * HEADER SECTION 
         */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .page-title h1 {
            font-size: 1.875rem;
            font-weight: 700;
            letter-spacing: -0.025em;
            color: var(--text-main);
        }

        .page-title p {
            color: var(--text-muted);
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        /* 
         * BUTTONS 
         */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.625rem 1.25rem;
            font-weight: 500;
            font-size: 0.875rem;
            border-radius: var(--radius-md);
            border: none;
            cursor: pointer;
            text-decoration: none;
            transition: var(--transition);
        }

        .btn-primary {
            background-color: var(--primary);
            color: white;
            box-shadow: var(--shadow-sm);
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
            transform: translateY(-1px);
            box-shadow: var(--shadow-md);
        }

        .btn-icon-only {
            padding: 0.5rem;
            border-radius: var(--radius-md);
            color: var(--text-muted);
            background: transparent;
        }

        .btn-icon-only:hover {
            color: var(--primary);
            background-color: #f1f5f9;
        }

        .btn-icon-only.delete:hover {
            color: var(--danger);
            background-color: #fef2f2;
        }

        /* 
         * CARD & TABLE 
         */
        .card {
            background: var(--bg-surface);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
            overflow: hidden;
        }

        .table-responsive {
            overflow-x: auto;
            width: 100%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        thead {
            background-color: #f8fafc;
            border-bottom: 1px solid var(--border-color);
        }

        th {
            padding: 1rem 1.5rem;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--text-muted);
        }

        tbody tr {
            border-bottom: 1px solid var(--border-color);
            transition: background-color 0.15s;
        }

        tbody tr:last-child {
            border-bottom: none;
        }

        tbody tr:hover {
            background-color: #f8fafc;
        }

        td {
            padding: 1rem 1.5rem;
            font-size: 0.875rem;
            color: var(--text-main);
            vertical-align: middle;
        }

        /* 
         * STATUS BADGES 
         */
        .badge {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .badge-active {
            background-color: #dcfce7;
            color: #166534;
        }

        .badge-inactive {
            background-color: #f1f5f9;
            color: #475569;
        }

        .badge-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            margin-right: 0.375rem;
        }

        .badge-active .badge-dot {
            background-color: #166534;
        }

        .badge-inactive .badge-dot {
            background-color: #94a3b8;
        }

        /* 
         * UTILITIES 
         */
        .text-sm {
            font-size: 0.875rem;
            color: var(--text-muted);
        }

        .flex-actions {
            display: flex;
            gap: 0.5rem;
            justify-content: flex-end;
        }

        .font-medium {
            font-weight: 500;
        }

        /* Empty State */
        .empty-state {
            padding: 4rem 1rem;
            text-align: center;
            color: var(--text-muted);
        }

        /* Responsive */
        @media (max-width: 640px) {
            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .btn-primary {
                width: 100%;
                justify-content: center;
            }

            th,
            td {
                padding: 1rem;
            }

            /* Hide less important columns on mobile if needed, or rely on scroll */
            .hidden-mobile {
                display: none;
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <header class="page-header">
            <div class="page-title">
                <h1>Countries</h1>
                <p>A list of all registered countries and their current status.</p>
            </div>
            <a href="{{ route('countries.create') }}" class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                Create New Country
            </a>
        </header>

        <div class="card">
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Country Name</th>
                            <th>Status</th>
                            <th class="hidden-mobile">Created At</th>
                            <th class="hidden-mobile">Updated At</th>
                            <th style="text-align: right;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($countries as $country)
                            <tr>
                                <td>
                                    <div class="font-medium">{{ $country->name }}</div>
                                </td>
                                <td>
                                    @if($country->active)
                                        <span class="badge badge-active">
                                            <span class="badge-dot"></span> Active
                                        </span>
                                    @else
                                        <span class="badge badge-inactive">
                                            <span class="badge-dot"></span> Inactive
                                        </span>
                                    @endif
                                </td>
                                <td class="hidden-mobile text-sm">
                                    {{ $country->created_at->format('M d, Y') }}
                                </td>
                                <td class="hidden-mobile text-sm">
                                    {{ $country->updated_at->diffForHumans() }}
                                </td>
                                <td>
                                    <div class="flex-actions">
                                        @csrf
                                        @method('GET')
                                        <a href="{{ route('countries.edit', $country->id) }}" class="btn btn-icon-only"
                                            title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                            </svg>
                                        </a>
                                        <form action="{{ route('countries.destroy', $country->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure?');" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-icon-only delete" title="Delete">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round">
                                                    <polyline points="3 6 5 6 21 6"></polyline>
                                                    <path
                                                        d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                    </path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">
                                    <div class="empty-state">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24"
                                            fill="none" stroke="#e2e8f0" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" style="margin-bottom: 1rem;">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <line x1="2" y1="12" x2="22" y2="12"></line>
                                            <path
                                                d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z">
                                            </path>
                                        </svg>
                                        <p>No countries found. Start by creating one!</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
{{ $countries->links() }}
</body>

</html>