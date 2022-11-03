<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Http\Requests\StoreImageRequest;
use App\Http\Requests\UpdateImageRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return view
     */
    public function index()
    {

        // if (View::exists('formcsrssf')) {
        //     dd('Có');
        // }
        // return response('Hello World', 200)->header('Content-Type', 'text/plain');
        return view('formcsrf', ['name' => 'James']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // $url = $request->url();
        // $urlWithQueryString = $request->fullUrl();

        // $host = $request->host();
        // $httpHost = $request->httpHost();
        // $schemeAndHttpHost = $request->schemeAndHttpHost();
        // $method = $request->method();

        // $xHeaderName = $request->header('X-Header-Name');

        // $xHeaderNameAndDefault = $request->header('X-Header-Name', 'default');
        // $token = $request->bearerToken();
        // $ipAddress = $request->ip();
        // dd( $ipAddress, $token);

        // $input = $request->collect();
        // $name = $request->input('name', 'Sally');

        $name = $request->query('name');
        $flash = $request->flash();
        dd($flash);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreImageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreImageRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function show(Image $image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function edit(Image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateImageRequest  $request
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateImageRequest $request, Image $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {
        //
    }
}
