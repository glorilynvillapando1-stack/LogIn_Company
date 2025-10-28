@extends('layouts.app')

@section('content')
<div class="container py-5">

  <h3 class="fw-bold mb-4">🧬 Explore Biochips</h3>

  <div class="row g-4">
    @php
      $biochips = [
        [
          'name' => 'DNA Microarrays (DNA Chips)',
          'desc' => 'Used for studying gene expression and detecting mutations.',
          'price' => '$150,000+',
          'image' => asset('logos/biochip.png')
        ],
        [
          'name' => 'Protein Microarrays (Protein Chips)',
          'desc' => 'Used for analyzing proteins, biomarkers, and interactions.',
          'price' => '$135,000+',
          'image' => asset('logos/biochip.png')
        ],
        [
          'name' => 'Lab-on-a-Chip (LOC)',
          'desc' => 'Miniaturized lab that automates diagnostics and analysis.',
          'price' => '$180,000+',
          'image' => asset('logos/biochip.png')
        ],
        [
          'name' => 'Cellular Microarrays (Cell Chips)',
          'desc' => 'For analyzing cell behavior, signaling, and drug screening.',
          'price' => '$165,000+',
          'image' => asset('logos/biochip.png')
        ],
        [
          'name' => 'Microfluidic Chips',
          'desc' => 'Used for DNA sequencing and manipulating picoliter fluid volumes.',
          'price' => '$120,000+',
          'image' => asset('logos/biochip.png')
        ],
        [
          'name' => 'Organ-on-a-Chip',
          'desc' => 'Mimics human organs for drug testing and disease modeling.',
          'price' => '$200,000+',
          'image' => asset('logos/biochip.png')
        ],
      ];
    @endphp

    @foreach ($biochips as $chip)
    <div class="col-md-4 col-lg-3">
      <div class="card shadow-sm border-0 h-100 text-center p-3 hover-scale" style="border-radius:16px;">
        <img src="{{ $chip['image'] }}" class="rounded mx-auto mb-3" width="100" alt="Biochip">
        <h6 class="fw-semibold mb-1">{{ $chip['name'] }}</h6>
        <p class="text-muted small mb-2">{{ $chip['desc'] }}</p>
        <div class="fw-bold text-primary">{{ $chip['price'] }}</div>
      </div>
    </div>
    @endforeach
  </div>
</div>

<style>
.hover-scale:hover {
  transform: scale(1.04);
  transition: 0.25s ease;
}
</style>
@endsection
