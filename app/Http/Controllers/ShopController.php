<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request)
    {
        $data = $request->all();
        $data_search = !empty($data['value'])?$data['value']:'';
        $shops = Shop::query()->when($data_search,function($query,$search){
            $query->where('name','ILIKE','%'.$search.'%');
        })->paginate(10)->through(fn($shops)=>[
            'id' => $shops->id,
            'name'=> $shops->name,
            'address'=> $shops->address,
            'phone_number'=>$shops->phone_number,
            'unactive'=>$shops->unactive
        ]);

        return Inertia::render(
            'Shop/index',
            [
                'shops' => $shops,
                'filter'   => $data_search
            ]
        );
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
