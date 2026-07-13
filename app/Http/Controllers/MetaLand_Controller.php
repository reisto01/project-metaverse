<?php

namespace App\Http\Controllers;

use App\Models\maps_metaverse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class MetaLand_Controller extends Controller
{
    public function index(Request $request)
    {
        $search = $request->string('search_me')->trim()->toString();
        $landmarks = maps_metaverse::where('is_deleted', 1)
            ->when($search, fn ($query) => $query->where('title', 'like', '%'.$search.'%'))
            ->orderByDesc('created_at')
            ->paginate(10)
            ->withQueryString();

        return view('adminpage.kelolaMeta', [
            'Page' => 'Kelola Metaverse Land',
            'landmark' => $landmarks,
            'get_total' => $landmarks->total(),
            'page_now' => $landmarks->currentPage(),
            'search' => $search,
            'pagin' => $landmarks->lastPage(),
        ]);
    }

    public function inputMeta(Request $request)
    {
        $data = $request->validate([
            'owner_land' => ['required', 'string', 'max:255'],
            'name_land' => ['required', 'string', 'max:255', 'unique:tb_metamap,title'],
            'desc_land' => ['required', 'string', 'max:10000'],
            'url_land' => ['required', 'url', 'starts_with:http://,https://', 'max:2048'],
            'price_land' => ['required', 'numeric', 'min:0', 'max:999999999999.99'],
            'img_land' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ]);

        $path = $request->file('img_land')->store('image/landmark', 'public');

        maps_metaverse::create([
            'owner' => $data['owner_land'],
            'title' => $data['name_land'],
            'description' => $data['desc_land'],
            'url' => $data['url_land'],
            'price' => $data['price_land'],
            'image' => '/storage/'.$path,
            'is_deleted' => 1,
        ]);

        return redirect('/kelolaMetaland');
    }

    public function getData(int $id)
    {
        return response()->json([
            'data' => maps_metaverse::where('is_deleted', 1)->findOrFail($id),
        ]);
    }

    public function updateMeta(Request $request)
    {
        $landmark = maps_metaverse::where('is_deleted', 1)->findOrFail($request->input('id'));
        $data = $request->validate([
            'owner' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255', Rule::unique('tb_metamap', 'title')->ignore($landmark->id)],
            'desc' => ['required', 'string', 'max:10000'],
            'url' => ['required', 'url', 'starts_with:http://,https://', 'max:2048'],
            'price' => ['required', 'numeric', 'min:0', 'max:999999999999.99'],
            'img' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ]);

        $landmark->fill([
            'owner' => $data['owner'],
            'title' => $data['name'],
            'description' => $data['desc'],
            'url' => $data['url'],
            'price' => $data['price'],
        ]);

        if ($request->hasFile('img')) {
            $this->deleteStoredImage($landmark->image);
            $path = $request->file('img')->store('image/landmark', 'public');
            $landmark->image = '/storage/'.$path;
        }

        $landmark->save();

        return redirect('/kelolaMetaland');
    }

    public function delete_landmark(Request $request)
    {
        $data = $request->validate(['id_data' => ['required', 'integer', 'exists:tb_metamap,id']]);
        maps_metaverse::whereKey($data['id_data'])->update(['is_deleted' => 0]);

        return redirect('/kelolaMetaland');
    }

    private function deleteStoredImage(?string $image): void
    {
        if ($image && str_starts_with($image, '/storage/')) {
            Storage::disk('public')->delete(substr($image, strlen('/storage/')));
        }
    }
}
