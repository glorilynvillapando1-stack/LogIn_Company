@extends('layouts.app')

@section('content')
<div class="container py-5">
  <h3 class="fw-bold mb-4">🌍 International Biochips</h3>
  <p class="text-muted">These are globally recognized biochip technologies from international labs and manufacturers.</p>

  <ul class="list-group shadow-sm">
    <li class="list-group-item d-flex justify-content-between">
      <span>DNA Microarrays — USA</span>
      <span class="fw-bold text-primary">$150,000+</span>
    </li>
    <li class="list-group-item d-flex justify-content-between">
      <span>Protein Microarrays — Germany</span>
      <span class="fw-bold text-primary">$135,000+</span>
    </li>
    <li class="list-group-item d-flex justify-content-between">
      <span>Organ-on-a-Chip — Japan</span>
      <span class="fw-bold text-primary">$200,000+</span>
    </li>
  </ul>
</div>
@endsection
