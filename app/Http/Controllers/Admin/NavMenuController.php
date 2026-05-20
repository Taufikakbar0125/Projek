<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NavMenu;
use Illuminate\Http\Request;

class NavMenuController extends Controller
{
    public function index()
    {
        $menus = NavMenu::with('children.children')
            ->whereNull('parent_id')
            ->orderBy('sort_order')
            ->get();

        $allMenus = NavMenu::with('parent')->orderBy('label')->get();

        return view('admin.navmenu.index', compact('menus', 'allMenus'));
    }

    public function create()
    {
        // Semua menu bisa jadi parent (bukan hanya level 1)
        // Dikelompokkan dengan indentasi agar jelas hierarkinya
        $allMenus = $this->getMenuOptionsFlat();
        return view('admin.navmenu.create', compact('allMenus'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'label'      => 'required|string|max:100',
            'url'        => 'nullable|string|max:255',
            'parent_id'  => 'nullable|exists:nav_menus,id',
            'sort_order' => 'nullable|integer|min:0',
            'is_active'  => 'boolean',
        ]);

        // Cegah lebih dari 3 level kedalaman
        if (!empty($validated['parent_id'])) {
            $parent = NavMenu::find($validated['parent_id']);
            if ($parent && !is_null($parent->parent_id)) {
                $grandParent = NavMenu::find($parent->parent_id);
                if ($grandParent && !is_null($grandParent->parent_id)) {
                    return back()->withErrors(['parent_id' => 'Maksimal 3 level menu (menu → submenu → sub-submenu).']);
                }
            }
        }

        $validated['sort_order'] = $request->input('sort_order', 0);
        $validated['is_active']  = $request->boolean('is_active', true);

        NavMenu::create($validated);

        return redirect()->route('admin.navmenu.index')
            ->with('success', 'Menu berhasil ditambahkan.');
    }

    public function edit(NavMenu $navmenu)
    {
        // Semua menu kecuali dirinya sendiri dan turunannya
        $excludeIds = $this->getDescendantIds($navmenu);
        $excludeIds[] = $navmenu->id;

        $allMenus = $this->getMenuOptionsFlat($excludeIds);
        return view('admin.navmenu.edit', compact('navmenu', 'allMenus'));
    }

    public function update(Request $request, NavMenu $navmenu)
    {
        $validated = $request->validate([
            'label'      => 'required|string|max:100',
            'url'        => 'nullable|string|max:255',
            'parent_id'  => 'nullable|exists:nav_menus,id',
            'sort_order' => 'nullable|integer|min:0',
            'is_active'  => 'boolean',
        ]);

        // Cegah circular reference
        if (!empty($validated['parent_id'])) {
            $descendantIds = $this->getDescendantIds($navmenu);
            if (in_array($validated['parent_id'], $descendantIds) || $validated['parent_id'] == $navmenu->id) {
                return back()->withErrors(['parent_id' => 'Menu tidak bisa menjadi turunan dari dirinya sendiri.']);
            }

            // Cegah lebih dari 3 level
            $parent = NavMenu::find($validated['parent_id']);
            if ($parent && !is_null($parent->parent_id)) {
                $grandParent = NavMenu::find($parent->parent_id);
                if ($grandParent && !is_null($grandParent->parent_id)) {
                    return back()->withErrors(['parent_id' => 'Maksimal 3 level menu.']);
                }
            }
        }

        $validated['is_active'] = $request->boolean('is_active');
        $navmenu->update($validated);

        return redirect()->route('admin.navmenu.index')
            ->with('success', 'Menu berhasil diperbarui.');
    }

    public function destroy(NavMenu $navmenu)
    {
        $navmenu->children()->each(function ($child) {
            $child->children()->delete();
            $child->delete();
        });
        $navmenu->delete();

        return redirect()->route('admin.navmenu.index')
            ->with('success', 'Menu berhasil dihapus.');
    }

    /**
     * Buat flat list semua menu dengan indentasi label
     * supaya dropdown di form mudah dibaca
     */
    private function getMenuOptionsFlat(array $excludeIds = []): array
    {
        $result = [];
        $level1 = NavMenu::whereNull('parent_id')
            ->orderBy('sort_order')
            ->with('children.children')
            ->get();

        foreach ($level1 as $l1) {
            if (in_array($l1->id, $excludeIds)) continue;
            $result[] = ['id' => $l1->id, 'label' => $l1->label, 'prefix' => ''];

            foreach ($l1->children as $l2) {
                if (in_array($l2->id, $excludeIds)) continue;
                $result[] = ['id' => $l2->id, 'label' => $l2->label, 'prefix' => '— '];

                foreach ($l2->children as $l3) {
                    if (in_array($l3->id, $excludeIds)) continue;
                    $result[] = ['id' => $l3->id, 'label' => $l3->label, 'prefix' => '— — '];
                }
            }
        }

        return $result;
    }

    /**
     * Ambil semua ID turunan dari sebuah menu (untuk cegah circular)
     */
    private function getDescendantIds(NavMenu $menu): array
    {
        $ids = [];
        $menu->loadMissing('children.children');
        foreach ($menu->children as $child) {
            $ids[] = $child->id;
            foreach ($child->children as $grandchild) {
                $ids[] = $grandchild->id;
            }
        }
        return $ids;
    }
}
