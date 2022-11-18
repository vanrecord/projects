<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;
use ProtoneMedia\LaravelQueryBuilderInertiaJs\InertiaTable;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = $request->all();
        $value_search = !empty($data['value'])?$data['value']:'';
        $products = Product::query()->when($value_search, function($query,$search){
            $query->where('name','ILIKE','%'.$search.'%')
                  ->orWhere('qty','ILIKE','%'.$search.'%')
                  ;
        })->paginate(9)->through(fn($products)=>[
            'id' => $products->id,
            'name'=> $products->name,
            'qty'=> $products->qty
        ]);
        // $globalSearch = AllowedFilter::callback('global', function ($query, $value) {
        //     $query->where(function ($query) use ($value) {
        //         Collection::wrap($value)->each(function ($value) use ($query) {
        //             $query
        //                 ->orWhere('name', 'ILIKE', "%{$value}%")
        //                 ->orWhere('qty', 'ILIKE', "%{$value}%");
        //         });
        //     });
        // });
        // $products = QueryBuilder::for(Product::class)
        // ->defaultSort('name')
        // ->allowedSorts(['name'])
        // ->allowedFilters(['name','id', $globalSearch])
        // ->paginate(10)
        // ->withQueryString();
        return Inertia::render(
            'Product/index',
            [
                'products' => $products,
                // 'filter'   => $value_search
            ]
        );
        // return Inertia::render('Product/index', ['products' => $products])->table(function (InertiaTable $table) {
        //     $table->column('id', 'ID', searchable: true, sortable: true);
        //     $table->column('name', 'User Name', searchable: true, sortable: true);
        // });
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Product/form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $request->validate([
            'name' => 'required|string|max:255',
            'qty' => 'required'
        ]);
        if($request->id){
            $Product = Product::find($request->id);
            $Product->update($data);
        }else{
            Product::create([
                'name' => $request->name,
                'qty' => $request->qty
            ]);
        }
        sleep(1);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product,Request $request)
    {
        return response()->json([
            'confirmed' => (time() - $request->session()->get('auth.password_confirmed_at', 0)) < $request->input('seconds', config('auth.password_timeout', 900)),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return Inertia::render('Product/form',['product'=>$product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('product.index')->with('message','Deleted Successfully!');
    }
}
