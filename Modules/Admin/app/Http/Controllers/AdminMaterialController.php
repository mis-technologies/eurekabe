<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Common\Models\Material;
use Modules\Common\Models\MaterialQuestion;

class AdminMaterialController extends Controller
{
    public function index(Request $request)
    {
        $query = Material::with('user')->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $materials = $query->paginate(20)->withQueryString();

        return view('admin::materials.index', compact('materials'));
    }

    public function show($id)
    {
        $material = Material::with('user')->withCount('questions')->findOrFail($id);

        return view('admin::materials.show', compact('material'));
    }

    public function destroy($id)
    {
        try {
            $material = Material::findOrFail($id);

            MaterialQuestion::where('material_id', $id)->delete();
            $material->delete();

            session()->flash('success', 'Material and all related data deleted successfully.');
        } catch (\Exception $e) {
            session()->flash('error', 'Unable to delete material: ' . $e->getMessage());
        }

        return redirect()->route('admin.materials.index');
    }
}
