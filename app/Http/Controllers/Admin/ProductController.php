<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductSuggestion;
use Illuminate\Http\Request;
use App\Services\MasterService;
use App\Services\ConfigSurveyService;
use DB;
class ProductController extends Controller
{
    public function __construct(MasterService $masterService, ConfigSurveyService $configSurveyService
    ){
        $this->masterService = $masterService;
        $this->productService = $configSurveyService;
    }
     
    //TypeForm response
    public function getProductList(Request $request)
    {
       $query = Product::query();
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('product_title', 'LIKE', "%$search%")
                  ->orWhere('product_sku', 'LIKE', "%$search%")
                  ->orWhere('product_price', 'LIKE', "%$search%")
                  ->orWhere('shopify_product_id', 'LIKE', "%$search%")
                  ->orWhere('product_type', 'LIKE', "%$search%")
                  ->orWhere('product_category', 'LIKE', "%$search%")
                  ->orWhere('product_tag', 'LIKE', "%$search%");
            });
        }
        $sortField = $request->get('sort_by', 'id');
        $sortOrder = $request->get('order', 'desc');
        $query->orderBy($sortField, $sortOrder);
        $results = $query->paginate(10)->appends($request->all());
        return view('admin.products.index', compact('results'));
    }

    public function getAllProductListShopify(Request $request){
        $results = $this->masterService->getAllProductShopify($request->all());
        if(isset($results['data']->products) && !empty($results['data']->products)){
            $products = $results['data']->products;
            $productObj = new Product();
            foreach($products as $product){
                $setParams = $productObj->setParam($product); 
                $checkProAvailability = $this->productService->getProductByWhereId($product->admin_graphql_api_id);
                if(!isset($checkProAvailability) && empty($checkProAvailability)){
                    $results = $this->productService->createProduct($setParams);
                }else{
                    $shopifyProductId = $product->admin_graphql_api_id;
                    $results = $this->productService->updateProduct($shopifyProductId, $setParams);
                }
            }
            session()->flash('success', 'Shopify product get successfully.');
            return redirect()->route("product.getProductList");
        }else{
            session()->flash('error', 'Something went wrong.');
            return redirect()->back()->withInput();
        }
    }

}
