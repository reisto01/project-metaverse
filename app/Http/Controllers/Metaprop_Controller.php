<?php

namespace App\Http\Controllers;

use App\Models\prop_metaverse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class Metaprop_Controller extends Controller
{
    public function index(Request $request)
    {
        $search = $request->string('search_me')->trim()->toString();
        $properties = prop_metaverse::where('is_deleted', 1)
            ->when($search, fn ($query) => $query->where('title', 'like', '%'.$search.'%'))
            ->orderByDesc('created_at')
            ->paginate(10)
            ->withQueryString();

        return view('adminpage.kelolaMetaProp', [
            'Page' => 'Kelola Metaverse Properti',
            'properties' => $properties,
            'get_total' => $properties->total(),
            'page_now' => $properties->currentPage(),
            'search' => $search,
            'pagin' => $properties->lastPage(),
        ]);
    }

    public function inputMeta(Request $request)
    {
        $data = $request->validate([
            'owner_prop' => ['required', 'string', 'max:255'],
            'name_prop' => ['required', 'string', 'max:255', 'unique:tb_metaprop,title'],
            'desc_prop' => ['required', 'string', 'max:10000'],
            'url_prop' => ['required', 'url', 'starts_with:http://,https://', 'max:2048'],
            'price_prop' => ['required', 'numeric', 'min:0', 'max:999999999999.99'],
            'img_prop' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ]);

        $path = $request->file('img_prop')->store('image/properties', 'public');

        prop_metaverse::create([
            'owner' => $data['owner_prop'],
            'title' => $data['name_prop'],
            'description' => $data['desc_prop'],
            'url' => $data['url_prop'],
            'price' => $data['price_prop'],
            'image' => '/storage/'.$path,
            'is_deleted' => 1,
        ]);

        return redirect('/kelolaMetaprop');
    }

    public function getData(int $id)
    {
        return response()->json([
            'data' => prop_metaverse::where('is_deleted', 1)->findOrFail($id),
        ]);
    }

    public function updateMeta(Request $request)
    {
        $property = prop_metaverse::where('is_deleted', 1)->findOrFail($request->input('id'));
        $data = $request->validate([
            'owner' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255', Rule::unique('tb_metaprop', 'title')->ignore($property->id)],
            'desc' => ['required', 'string', 'max:10000'],
            'url' => ['required', 'url', 'starts_with:http://,https://', 'max:2048'],
            'price' => ['required', 'numeric', 'min:0', 'max:999999999999.99'],
            'img' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ]);

        $property->fill([
            'owner' => $data['owner'],
            'title' => $data['name'],
            'description' => $data['desc'],
            'url' => $data['url'],
            'price' => $data['price'],
        ]);

        if ($request->hasFile('img')) {
            $this->deleteStoredImage($property->image);
            $path = $request->file('img')->store('image/properties', 'public');
            $property->image = '/storage/'.$path;
        }

        $property->save();

        return redirect('/kelolaMetaprop');
    }

    public function delete_properties(Request $request)
    {
        $data = $request->validate(['id_data' => ['required', 'integer', 'exists:tb_metaprop,id']]);
        prop_metaverse::whereKey($data['id_data'])->update(['is_deleted' => 0]);

        return redirect('/kelolaMetaprop');
    }

    private function deleteStoredImage(?string $image): void
    {
        if ($image && str_starts_with($image, '/storage/')) {
            Storage::disk('public')->delete(substr($image, strlen('/storage/')));
        }
    }
}
