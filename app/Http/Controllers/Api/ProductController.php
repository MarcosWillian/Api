<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\API\ApiMessage;

use App\Product;
use phpDocumentor\Reflection\Types\Integer;

class ProductController extends Controller
{

    private $product; 

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * Display a listing of the data.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = ['data' => $this->product->all()];
        return response()->json(ApiMessage::returnMessage($data, 'Operação realizada com sucesso', '001'), 200);
    }

    /**
     * Display the specified data.
     *
     * @param request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Product $id)
    {
        $data = ['data' => $id];
        return response()->json(ApiMessage::returnMessage($data, 'Operação realizada com sucesso', '001'), 200);
    }

    /**
     * Storage a new data.
     *
     * @param request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $productData = $request->all();
            $this->product->create( $productData );

            return response()->json(ApiMessage::returnMessage($this->product, 'Operação realizada com sucesso', '002'), 201);
        
        } catch (\Exception $e) {
            if(config('app.debug')){
                return response()->json(ApiMessage::returnMessage(null, $e->getMessage(), '101'), 500);
            } 
            
            return response()->json(ApiMessage::returnMessage(null, 'Houve um erro ao realizar operação', '101'), 500);
        }   
    }

    /**
     * Updates the specified data.
     *
     * @param request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        try {
            $productData = $request->all();
            $product     = $this->product->find($id);
            $product->update( $productData );

            return response()->json(ApiMessage::returnMessage($product, 'Operação realizada com sucesso', '003'), 201);
        
        } catch (\Exception $e) {
            if(config('app.debug')){
                return response()->json(ApiMessage::returnMessage(null, $e->getMessage(), '102'), 500);
            } 
            
            return response()->json(ApiMessage::returnMessage(null, 'Houve um erro ao realizar operação', '101'), 500);
        }   
    }

    /**
     * Deletes the specified data.
     *
     * @param request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function delete(Product $id)
    {
        try {
            $id->delete();
            return response()->json(ApiMessage::returnMessage(null, 'Operação realizada com sucesso', '003'), 200);
        } catch (\Exception $e) {
            if(config('app.debug')){
                return response()->json(ApiMessage::returnMessage(null, $e->getMessage(), '103'), 500);
            } 
            
            return response()->json(ApiMessage::returnMessage(null, 'Houve um erro ao realizar operação', '102'), 500);
        }
    }
}
