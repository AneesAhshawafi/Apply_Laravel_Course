<div class="container">
    
    <h1>Welcome, {{ $name }}</h1>
    @if ($age<20)
    <p>Age: @{{ $age }} and your teenager</p>
    <p>Age: {{ $age }} and your teenager</p>
    @elseif($age<30)
    <p>Age: @{{ $age }} and your are an adult</p>
    <p>Age: {{ $age }} and your are an adult</p>
    @else
    <p>Age: {{ $age }} and your elderly</p>
    <p>Age: @{{ $age }} and your elderly</p>
    @endif
</div>