<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Common\Models\Material;
use Modules\Common\Models\MaterialQuestion;
use Modules\Common\Models\MaterialResource;
use Modules\Common\Models\MaterialSummary;

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
        $material = Material::with('user')->findOrFail($id);
        $summary = MaterialSummary::where('material_id', $id)->first();
        $questionsCount = MaterialQuestion::where('material_id', $id)->count();
        $resourcesCount = MaterialResource::where('material_id', $id)->count();

        return view('admin::materials.show', compact('material', 'summary', 'questionsCount', 'resourcesCount'));
    }

    public function destroy($id)
    {
        try {
            $material = Material::findOrFail($id);

            MaterialSummary::where('material_id', $id)->delete();
            MaterialQuestion::where('material_id', $id)->delete();
            MaterialResource::where('material_id', $id)->delete();
            $material->delete();

            session()->flash('success', 'Material and all related data deleted successfully.');
        } catch (\Exception $e) {
            session()->flash('error', 'Unable to delete material: ' . $e->getMessage());
        }

        return redirect()->route('admin.materials.index');
    }
}
