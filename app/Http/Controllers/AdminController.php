<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller {
    // [ページ遷移] カテゴリー
    function ShowCategory() {
        $categories = Category::all();
        return view('admin.category', compact('categories'));
    }

    // [追加] カテゴリー
    public function AddCategory(Request $request) {
        $request->validate([
            'name' => 'required',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:4096',
        ]);
        DB::beginTransaction();
        try {
            $category = new Category();
            $category->name = $request->name;
            // 画像保存
            if ($request->hasFile('img')) {
                $filePath = $request->file('img')->store('img/categories', 'public');
                $category->img = 'storage/' . $filePath;
            }
            $category->order = Category::max('order') + 1;
            $category->save();
            DB::commit();
            return redirect()->back()->with('success', 'カテゴリーを追加しました。');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e);
            return redirect()->back()->with('error', 'カテゴリー追加中にエラーが発生しました。');
        }
    }

    // [更新] カテゴリー
    public function UpdateCategory(Request $request, $id) {
        $request->validate([
            'name' => 'required',
            'img' => 'image|mimes:jpeg,png,jpg,gif|max:4096',
        ]);
        DB::beginTransaction();
        try {
            $category = Category::find($id);
            if ($category) {
                if ($request->has('name')) {
                    $category->name = $request->name;
                }
                // 画像更新
                if ($request->hasFile('img')) {
                    // 既存の画像削除
                    if ($category->img) {
                        $oldImagePath = str_replace('storage/', '', $category->img);
                        if (Storage::disk('public')->exists($oldImagePath)) {
                            Storage::disk('public')->delete($oldImagePath);
                        }
                    }
                    // 新規の画像保存
                    $filePath = $request->file('img')->store('img/categories', 'public');
                    $category->img = 'storage/' . $filePath;
                }
                $category->save();
                DB::commit();
                return redirect()->back()->with('success', 'カテゴリーを更新しました。');
            } else {
                DB::rollBack();
                return redirect()->back()->with('error', 'カテゴリーが見つかりません。');
            }
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e);
            return redirect()->back()->with('error', 'カテゴリー更新中にエラーが発生しました。');
        }
    }

    // [削除] カテゴリー
    public function DeleteCategory($id) {
        DB::beginTransaction();
        try {
            $category = Category::find($id);
            if ($category) {
                $oldImagePath = str_replace('storage/', '', $category->img);
                if (Storage::disk('public')->exists($oldImagePath)) {
                    Storage::disk('public')->delete($oldImagePath);
                }
                $category->delete();
                DB::commit();
                return redirect()->back()->with('success', 'カテゴリーを削除しました。');
            } else {
                DB::rollBack();
                return redirect()->back()->with('error', 'カテゴリーが見つかりません。');
            }
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e);
            return redirect()->back()->with('error', 'カテゴリー削除中にエラーが発生しました。');
        }
    }
}
