<style>
    .flights-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 1.5rem;
        padding: 1rem;
    }

    .flight-card {
        border: 1px solid #e2e8f0;
        border-radius: 0.5rem;
        padding: 1rem;
        background-color: #ffffff;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        position: relative;
    }

    .flight-name {

        font-weight: bold;
        color: #1a202c;
        margin-bottom: 0.5rem;
        padding-right: 1.5rem;
    }

    .flight-info {

        font-size: 0.875rem;
        color: #4a5568;
        margin-top: 0.25rem;
    }

    .status-badge {
        font-weight: 600;
        color: #2d3748;
    }

    .edit-link {
        position: absolute;
        top: 1rem;
        right: 1rem;
        color: #09101aff;
        transition: color 0.2s;
    }

    .edit-link:hover {
        color: #3560a9ff;
    }

    .delete-link {
        position: absolute;
        top: 1rem;
        right: 3rem;
        color: #ef4444;
        transition: color 0.2s;
    }

    .delete-link-soft {
        position: absolute;
        top: 1rem;
        right: 5rem;
        color: #fca5a5;
        transition: color 0.2s;
    }

    .delete-link-soft:hover {
        color: #f87171;
    }

    .delete-link:hover {
        color: #dc2626;
    }
    .restore-link {
        position: absolute;
        top: 1rem;
        right: 7rem;
        color: #22c55e;
        transition: color 0.2s;
    }
    .restore-link:hover {
        color: #16a34a;
    }
</style>
<div style="padding: 1rem; display: flex; justify-content: flex-end;">
    <a href="{{ route('flights.create') }}"
        style="background-color: #4a5568; color: white; padding: 0.5rem 1rem; border-radius: 0.375rem; text-decoration: none; font-weight: 600;">
        + Add New Flight
    </a>
</div>

<div class="flights-grid">
    @if(@isset($flights) && !@empty($flights))
        @foreach($flights as $flight)

            <div class="flight-card">
                @csrf
         
                <a href="{{ route('flights.edit', $flight->id) }}" class="edit-link" title="Edit Flight">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                        <path d="M18.5 2.5a2.121 2.121 0 1 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                    </svg>
                </a>

                <form action="{{ route('flights.destroy', $flight->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-link" title="Delete Flight Permanently" 
                        style="background: none; border: none; padding: 0; cursor: pointer;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="3 6 5 6 21 6"></polyline>
                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2-2v2"></path>
                        </svg>
                    </button>
                </form>
                @if(!$flight->deleted_at)
                <a href="{{ route('flights.delete', $flight->id) }}" class="delete-link-soft"
                    title="Soft Delete Flight(Restorable)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="3 6 5 6 21 6"></polyline>
                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2-2v2"></path>
                    </svg>
                </a>
                @endif
                @if($flight->deleted_at)
                <a href="{{ route('flights.restore', $flight->id) }}" class="restore-link"
                    title="Restore Flight">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="1 4 1 10 7 10"></polyline>
                        <path d="M3.51 15a9 9 0 1 0 2.13-9.36L1 10"></path>
                    </svg>
                </a>
                @endif
                <div class="flight-name">{{ $flight->name }}</div>
                <div class="flight-info">ID: {{ $flight->id }}</div>
                <div class="flight-info">Destination: {{ $flight->destination }}</div>
                <div class="flight-info">
                    Status: <span class="status-badge">{{ $flight->active ? 'Active' : 'Inactive' }}</span>
                </div>
                <div class="flight-info" style="margin-top: 0.5rem;">
                    Created: {{ $flight->created_at }}
                </div>
                <div class="flight-info">
                    Updated: {{ $flight->updated_at }}
                </div>
            </div>
        @endforeach
    @else
        <div class="flight-card">
            <div class="flight-name">No Flights Found</div>
        </div>
    @endif
</div>

<div class="pagination-wrapper">
    {{ $flights->links('pagination::bootstrap-5') }}
</div>