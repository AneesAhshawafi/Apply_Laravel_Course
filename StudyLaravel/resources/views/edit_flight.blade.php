<style>
    .edit-flight-form {
        max-width: 400px;
        margin: 2rem auto;
        padding: 1.5rem;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-family: system-ui, -apple-system, sans-serif;
    }
    .form-group {
        margin-bottom: 1rem;
    }
    .form-group label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 600;
    }
    .form-control {
        width: 100%;
        padding: 0.5rem;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }
    .checkbox-group {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .btn-save {
        background-color: #2563eb;
        color: white;
        padding: 0.6rem 1.2rem;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        width: 100%;
    }
    .btn-save:hover {
        background-color: #1d4ed8;
    }
</style>

<form action="{{  route('flights.update',$flight->id) }}" method="POST" class="edit-flight-form">
    @csrf  
    @method('PUT')  
    <!-- <input type="hidden" name="id" value="{{ $flight->id }}"> -->
    <div class="form-group">
        <label for="name">Flight Name</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $flight->name) }}" required>
    </div>

    <div class="form-group checkbox-group">
        <input type="hidden" name="active" value="0">
        <input type="checkbox" name="active" id="active" value="1" {{ old('active', $flight->active) ? 'checked' : '' }}>
        <label for="active">Active Status</label>
    </div>
    <div class="form-group">
        <label for="notes">Notes</label>
        <input type="text" name="notes" id="notes" class="form-control" value="{{ old('notes', $flight->notes) }}">
    </div>

    <button type="submit" class="btn-save">Update Flight</button>
</form>
