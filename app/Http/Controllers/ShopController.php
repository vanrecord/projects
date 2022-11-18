<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;
use Inertia\Inertia;
use ProtoneMedia\LaravelQueryBuilderInertiaJs\InertiaTable;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request)
    {
        $perPage = !empty($request->perPage)?$request->perPage:9;
        $globalSearch = AllowedFilter::callback('global', function ($query, $value) {
            $query->where(function ($query) use ($value) {
                Collection::wrap($value)->each(function ($value) use ($query) {
                    $query
                        ->orWhere('name', 'LIKE', "%{$value}%")
                        ->orWhere('address', 'LIKE', "%{$value}%");
                });
            });
        });
        $shops = QueryBuilder::for(Shop::class)
        ->defaultSort('name')
        ->allowedSorts(['name', 'address','phone_number'])
        ->allowedFilters(['name', 'address','phone_number', $globalSearch])
        ->paginate($perPage)
        ->withQueryString();
        return Inertia::render('Shop/index', ['shops' => $shops,'index'=>0])->table(function (InertiaTable $table) {
            $table->pageName('companiesPage');
            $table->column('id', 'No', searchable: false, sortable: false);
            $table->column('name', 'Name', searchable: true, sortable: true);
            $table->column('phone_number', 'Phone Number', searchable: true, sortable: true);
            $table->column('address', 'Address', searchable: true, sortable: true);
            $table->column(label: 'Actions');

        });
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Shop/form');
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
            'address' => 'required|string|max:255',
            'phone_number' => 'required',
        ]);
        if($request->id){
            $shop = Shop::find($request->id);
            $shop->update($data);
            $msg = 'Shop Updated Successfully';
        }else{
            Shop::create([
                'name' => $request->name,
                'address' => $request->address,
                'phone_number' => $request->phone_number,
                'unactive'    => $request->unactive
            ]);
            $msg = 'Shop Created Successfully';
        }
        sleep(1);

        return redirect()->route('shop.index')->with('message', $msg);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function show(Shop $shop)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function edit(Shop $shop)
    {
        return Inertia::render('Shop/form',[
            'shop' => $shop
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shop $shop)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shop $shop)
    {
        $shop->delete();
        return redirect()->route('shop.index')->with('message', 'Deleted Successfully!');
    }
}
