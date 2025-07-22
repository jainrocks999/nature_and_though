@extends('layouts.admin')
@section('content')
<div class="content">
	<div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="card-title" >Product List</div>
                <div class="row">
                    <div class="col-lg-10">
                        <form method="GET" action="">
                            <div class="row">
                                <div class="col-md-4">
                                    <input type="text" name="search" class="form-control" placeholder="Search..." value="{{ request('search') }}">
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary">Search</button>
                                    <a href="{{ route('product.getProductList') }}" class="btn btn-secondary">Reset</a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-2">
                        <a   href="{{route('product.getAllProductListShopify')}}">
                            <button class="btn btn-success create-btn" id="refreshBtn"><i class="la la-refresh"></i>Sync</button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th><a href="{{ request()->fullUrlWithQuery(['sort_by' => 'id', 'order' => (request('order') === 'asc' ? 'desc' : 'asc')]) }}">#</a></th>
                              <th>Product Image</th>
                              <th><a href="{{ request()->fullUrlWithQuery(['sort_by' => 'product_variants', 'order' => (request('order') === 'asc' ? 'desc' : 'asc')]) }}">Product Sku</a></th>
                            <th><a href="{{ request()->fullUrlWithQuery(['sort_by' => 'product_title', 'order' => (request('order') === 'asc' ? 'desc' : 'asc')]) }}">Product Title</a></th>
                            <th><a href="{{ request()->fullUrlWithQuery(['sort_by' => 'product_type', 'order' => (request('order') === 'asc' ? 'desc' : 'asc')]) }}">Product Type</a></th>
                            <!-- <th><a href="{{ request()->fullUrlWithQuery(['sort_by' => 'type_form_type', 'order' => (request('order') === 'asc' ? 'desc' : 'asc')]) }}">Typeform Type</a></th>
                            <th><a href="{{ request()->fullUrlWithQuery(['sort_by' => 'created_at', 'order' => (request('order') === 'asc' ? 'desc' : 'asc')]) }}">Typeform Response</a></th> -->
                            <!-- <th>Last Updated</th> -->
                            <!-- <th>#</th>
                            <th>Images</th>
                            <th>Sku</th>
                            <th>Title</th>
                            <th>Type</th> -->
                            <th>Product Description</th>
                            <th>Product Category</th>
                              <th><a href="{{ request()->fullUrlWithQuery(['sort_by' => 'product_tag', 'order' => (request('order') === 'asc' ? 'desc' : 'asc')]) }}">Product Tag</a></th>
                             <th><a href="{{ request()->fullUrlWithQuery(['sort_by' => 'product_variants', 'order' => (request('order') === 'asc' ? 'desc' : 'asc')]) }}">Product Price</a></th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                            @forelse ($results as $index => $product)
                                @php 
                                    $prod = $product->product_desc;
                                    $clean = str_replace("\u{A0}", ' ', $prod);
                                    $cleanText = strip_tags($clean);
                                    $cleanText = html_entity_decode($cleanText);
                                    $cleanText = trim(preg_replace('/\s+/', ' ', $cleanText));
                                    $varient = json_decode($product->product_variants);
                                    $pimages = json_decode($product->product_images);
                                    $productImg = isset($pimages[$index]->src) ? $pimages[$index]->src : '';
                                    $pCategories = json_decode($product->product_category);
                                @endphp
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td><image src="{{$productImg}}" height="100px" width="150px"></td>
                                    <td>{{ $varient[0]->sku }}</td>
                                    <td>{{ $product->product_title }}</td>
                                    <td>{{ $product->product_type }}</td>
                                    <td>{{ Str::limit($cleanText, 50) }}</td>
                                    <td>{{ isset($pCategories->name) ? $pCategories->name : "" }}</td>
                                    <td>{{ $product->product_tag }}</td>
                                    <td>{{ $varient[0]->price }}</td>
                                    <td>{{ $product->created_at }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="13" class="text-center">No products found.</td>
                                </tr>
                            @endforelse
                    </tbody>
                </table>
                 <div class="d-flex justify-content-center">
                    {{ $results->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.footer')
