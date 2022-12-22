/* resources > views > todos.blade.php */

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Todos</div>

                    <div class="card-body">

                        @can('update', $todo)
                            <div class="btn btn-success btn-lg">
                                You can update todos
                            </div>
                        @else
                            <div class="btn btn-info btn-lg">
                                You can't update todos
                            </div>
                        @endcan

                        OR YOU CAN PASS ELOQUENT MODEL DIRECTLY

                        @can('update', App\Models\Todo::class)
                            <div class="btn btn-success btn-lg">
                                You can update todos
                            </div>
                        @else
                            <div class="btn btn-info btn-lg">
                                You can't update todos
                            </div>
                        @endcan

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection