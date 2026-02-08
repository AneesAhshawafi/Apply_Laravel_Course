<style>
    .country-edit-container {
        max-width: 600px;
        margin: 2rem auto;
        padding: 2rem;
        background-color: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
    }

    .form-header {
        margin-bottom: 2rem;
        border-bottom: 2px solid #f3f4f6;
        padding-bottom: 1rem;
    }

    .form-header h2 {
        color: #111827;
        margin: 0;
        font-size: 1.5rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        display: block;
        font-size: 0.875rem;
        font-weight: 600;
        color: #374151;
        margin-bottom: 0.5rem;
    }

    .form-input {
        width: 100%;
        padding: 0.625rem 0.875rem;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        font-size: 1rem;
        transition: border-color 0.2s, box-shadow 0.2s;
    }

    .form-input:focus {
        outline: none;
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    .status-toggle {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        cursor: pointer;
    }

    .status-toggle input[type="checkbox"] {
        width: 1.25rem;
        height: 1.25rem;
        cursor: pointer;
    }

    .btn-group {
        display: flex;
        justify-content: flex-end;
        gap: 1rem;
        margin-top: 2rem;
    }

    .btn {
        padding: 0.625rem 1.25rem;
        border-radius: 6px;
        font-weight: 500;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .btn-primary {
        background-color: #2563eb;
        color: white;
        border: none;
    }

    .btn-primary:hover {
        background-color: #1d4ed8;
    }

    .btn-secondary {
        background-color: #f3f4f6;
        color: #374151;
        border: 1px solid #d1d5db;
        text-decoration: none;
        display: inline-block;
        text-align: center;
    }

    .btn-secondary:hover {
        background-color: #e5e7eb;
    }

    @media (max-width: 640px) {
        .country-edit-container {
            margin: 1rem;
            padding: 1.5rem;
        }
    }
</style>

<div class="country-edit-container">
    <div class="form-header">
        <h2>Update Country Details</h2>
    </div>

    <form action="{{ route('countries.update', $country->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name" class="form-label">Country Name</label>
            <input type="text" 
                   id="name" 
                   name="name" 
                   class="form-input" 
                   value="{{ old('name', $country->name) }}" 
                   placeholder="Enter country name" 
                   required>
            @error('name')
                <span style="color: #dc2626; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label class="status-toggle">
                <input type="hidden" name="active" value="0">
                <input type="checkbox" 
                       name="active" 
                       value="1" 
                       {{ old('active', $country->active) ? 'checked' : '' }}>
                <span class="form-label" style="margin-bottom: 0;">Mark as Active</span>
            </label>
        </div>

        <div class="btn-group">
            <a href="{{ route('countries.index') }}" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary">Update Country</button>
        </div>
    </form>
</div>


