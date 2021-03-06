@extends('layouts.navbar')
<!-- estilos bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

<!-- estilos tabla -->
<link rel="stylesheet" href="{{ asset('bootstrap-table-master/dist/bootstrap-table.css') }}">

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-8 p-2">
            <p class="h1 text-center">Repuestos</p>
            <table
                class="table table-sm" 
                id="table-parts" 
                data-height="472"
                data-search-highlight="true">
                <thead>
                    <tr>
                        <th scope="col">Código</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">P. Venta</th>
                    </tr>
                </thead>
            
                <tbody>
                    @foreach($productsArray['data'] as $product)
                    <tr>
                        <td><a class="nav-link hover-table" href="#edit-modal-{{ $product['idProducto'] }}" data-bs-toggle="modal" data-bs-target="#edit-modal-{{ $product['idProducto'] }}">{{ $product['codProd'] }}</a></td>
                        <td><a class="nav-link hover-table" href="#edit-modal-{{ $product['idProducto'] }}" data-bs-toggle="modal" data-bs-target="#edit-modal-{{ $product['idProducto'] }}">{{ $product['nombreProducto'] }}</a></td>
                        <td><a class="nav-link hover-table" href="#edit-modal-{{ $product['idProducto'] }}" data-bs-toggle="modal" data-bs-target="#edit-modal-{{ $product['idProducto'] }}">{{ $product['descripcion'] }}</a></td>
                        <td><a class="nav-link hover-table" href="#edit-modal-{{ $product['idProducto'] }}" data-bs-toggle="modal" data-bs-target="#edit-modal-{{ $product['idProducto'] }}">{{ $product['stock'] }}</a></td>
                        <td><a class="nav-link hover-table" href="#edit-modal-{{ $product['idProducto'] }}" data-bs-toggle="modal" data-bs-target="#edit-modal-{{ $product['idProducto'] }}">{{ $product['precioVenta'] }}</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    
        <div class="col-4 p-2">
            <p class="h3 text-center">Productos en el carrito <i class="material-icons" style="font-size:25px;">shopping_cart</i></p>
            <table class="table mt-3">

                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Handle</th>
                    </tr>
                </thead>
                
                <tbody>
                    <tr>
                        <th scope="row"></th>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            <div class="col-md-12 text-center">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-info">Realizar venta</button>
                    <button type="button" class="btn btn-danger">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- modal edit -->
@foreach($productsArray['data'] as $product)
    <div class="modal fade" id="edit-modal-{{ $product['idProducto'] }}" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">Agregar productos al carrito</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <p class="h3 text-center text-capitalize">{{ $product['nombreProducto'] }}</p>
                <div class="modal-body">
                    <form id="myform" action="{{ route('repuestos') }}/{{ $product['idProducto'] }}" method="POST">
                        @csrf
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="idModal" value="{{ $product['idProducto'] }}" hidden>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <p class="h5">Codigo: <strong>{{ $product['codProd'] }}</strong></p>
                                <br>
                                <p class="h5">Descripcion: {{ $product['descripcion'] }}</p>
                                <br>
                                <p class="h5">Stock del producto: <strong>{{ $product['stock'] }}</strong></p>
                                <br>
                                <p class="h5">Precio de Venta: <strong>{{ $product['precioVenta'] }}</strong></p>
                                <input type="text" class="form-control" name="codeModal" value="{{ $product['codProd'] }}" hidden>
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="nameModal" value="{{ $product['nombreProducto'] }}" hidden>
                                <label for="price-modal" class="col-form-label">Nuevo precio de venta:</label>
                                <input type="text" class="form-control" name="newPriceModal">
                                <label for="price-modal" class="col-form-label">Cantidad a vender:</label>
                                <input type="text" class="form-control" name="newPriceModal">
                            </div>
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" name="descriptionModal" hidden>{{ $product['descripcion'] }}</textarea>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <input type="number" class="form-control" name="stockModal" value="{{ $product['stock'] }}" hidden>
                            </div>
                            <div class="col-sm-6">
                                <input type="number" step=".01" class="form-control" name="priceModal" value="{{ $product['precioVenta'] }}" hidden>
                            </div>
                        </div>
                        <br>
                        <div class="modal-footer text-center">
                            <div class="col-md-12 text-center">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="submit" class="btn btn-info">Editar repuestos</button>
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-primary">Agregar al carrito</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<!-- Buscador -->
<script src="{{ asset('bootstrap-table-master/dist/bootstrap-table.js') }}"></script>
<script src="{{ asset('bootstrap-table-master/dist/bootstrap-table-locale-all.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/parts.js') }}"></script>
@endsection