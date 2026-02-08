<style>
    .flight-form {
        max-width: 400px;
        margin: 2rem auto;
        padding: 1.5rem;
        border: 1px solid #e2e8f0;
        border-radius: 0.5rem;
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
        border: 1px solid #cbd5e0;
        border-radius: 0.25rem;
    }
    .checkbox-group {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .btn-submit {
        background-color: #3182ce;
        color: white;
        padding: 0.5rem 1rem;
        border: none;
        border-radius: 0.25rem;
        cursor: pointer;
    }
    .btn-submit:hover {
        background-color: #2b6cb0;
    }
</style>

<div class="flight-form">
<!--    
@if($errors->any())
     <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    
    @endif
    -->
    <form action="{{ route('flights.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Flight Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" >
        </div>
        @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-group checkbox-group">
            <input type="hidden" name="active" value="0">
            <input type="checkbox" name="active" id="active" value="1">
            <label for="active">Active</label>
        </div>
       
       
        <div class="form-group">
            <label for="notes">Notes</label>
            <input type="text" name="notes" id="notes" class="form-control" value="{{ old('notes') }}">
        </div>
        
        <button type="submit" class="btn-submit">Create Flight</button>
    </form>
</div>
