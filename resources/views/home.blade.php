@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="container">

        <div class="bg-light p-3 rounded mb-4">
            <h3 class="d-flex align-items-center">
                <i class="fas fa-chart-bar me-2"></i>
                Dashboard Statistik:
                <span class="badge bg-success text-white ms-2">
                    @if (Auth::user()->hasRole('owner'))
                        Owner
                    @elseif (Auth::user()->hasRole('writer'))
                        Writer
                    @endif
                </span>
            </h3>
        </div>


        {{-- <h3 class="mb-4">Dashboard Statistik: {{ Auth::user()->name }} </h3> --}}

        <div class="row">
            <!-- Total Articles -->
            <div class="col-md-4">
                <div class="card text-white bg-primary mb-3 shadow">
                    <div class="card-body d-flex align-items-center">
                        <i class="fas fa-newspaper fa-3x me-3"></i>
                        <div>
                            <h5 class="card-title">Total Artikel</h5>
                            <h2 class="card-text">{{ $totalArticles }}</h2>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Articles -->
            <div class="col-md-4">
                <div class="card text-white bg-warning mb-3 shadow">
                    <div class="card-body d-flex align-items-center">
                        <i class="fas fa-clock fa-3x me-3"></i>
                        <div>
                            <h5 class="card-title">Artikel Pending</h5>
                            <h2 class="card-text">{{ $pendingArticles }}</h2>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Categories and Article Count -->
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-header bg-secondary text-white">
                        <i class="fas fa-tags me-2"></i>Kategori dan Total Artikel
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Kategori</th>
                                    <th class="text-center">Total Artikel</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categoryStats as $category)
                                    <tr>
                                        <td>{{ $category->name }}</td>
                                        <td class="text-center">{{ $category->articles_count }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
