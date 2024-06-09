<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Portfolio;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use App\Models\Type;
use App\Models\Technology;



class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $portfolios = Portfolio::all();

        $data = [
            'portfolios' => $portfolios
        ];

        return view('admin.portfolios.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $type = Type::all();

        $data = [
            'types' => $type,
        ];

        return view('admin.portfolios.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|min:6|max:150|unique:portfolios,name',
                'client_name' => 'required|min:2|max:255',
                'summary' => 'nullable|min:10|max:2000',
                'cover_image' => 'nullable|image|max:512',
                'type_id' => 'nullable|exists:types,id',
            ]
        );

        $formData = $request->all();


        if($request->hasFile('cover_image')) {

            $img_path = Storage::disk('public')->put('upload_images', $formData['cover_image']);
         
            $formData['cover_image'] = $img_path;
            
        }


        $newPortfolio = new Portfolio();
        $newPortfolio->fill($formData);
        $newPortfolio->slug = Str::slug($newPortfolio->name, '-');
        $newPortfolio->save();

        return redirect()->route('admin.portfolios.show', ['portfolio' => $newPortfolio->slug]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Portfolio $portfolio)
    {

        $data = [

            'portfolio' => $portfolio
        ];

        return view('admin.portfolios.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Portfolio $portfolio)
    {
        $type = Type::all();

        $data = [
            'types' => $type,
        ];

        return view('admin.portfolios.edit', compact('portfolio'), $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Portfolio $portfolio)
    {

        $request->validate(
            [
                'name' => [
                    'required',
                    'min:6',
                    'max:150',
                    Rule::unique('portfolios')->ignore($portfolio->id),
                ],
                'client_name' => 'required|min:2|max:255',
                'summary' => 'nullable|min:10|max:2000',
                'cover_image' => 'nullable|image|max:512',
                'type_id' => 'nullable|exists:types,id',
            ]
        );

        $formData = $request->all();

        if($request->hasFile('cover_image')) {
            if($portfolio->cover_image) {
                Storage::delete($portfolio->cover_image);
            }

            $img_path = Storage::disk('public')->put('upload_images', $formData['cover_image']);
            $formData['cover_image'] = $img_path;
        }

        $formData['slug'] = Str::slug($formData['name'], '-');
        $portfolio->update($formData); 

        return redirect()->route('admin.portfolios.show', ['portfolio' => $portfolio->slug]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Portfolio $portfolio)
    {
        $portfolio->delete();

        return redirect()->route('admin.portfolios.index');
    }
}
