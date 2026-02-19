<div class="testimonial-card">
    <div class="testimonial-author">
        <img src="{{ asset($image) }}" alt="{{ $name }}">
        <h4>{{ $name }}</h4>
    </div>
    <p>"{{ $testimonial }}"</p>
    @if(isset($subtitle))
        <p>{{ $subtitle }}</p>
    @endif
</div> 