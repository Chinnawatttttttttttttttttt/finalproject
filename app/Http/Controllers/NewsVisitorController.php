<?php

namespace App\Http\Controllers;

use App\Models\NewsVisitor;
use Illuminate\Http\Request;

class NewsVisitorController extends Controller
{
    // แสดงฟอร์มการสร้างข่าวสาร
    public function create()
    {
        return view('news.create');
    }

    // จัดการการบันทึกข่าวสารใหม่
    public function store(Request $request)
    {

        // dd($request->all());

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $newsData = [
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ];

        if ($request->hasFile('images')) {
            $images = $request->file('images');
            $imagePaths = [];

            foreach ($images as $image) {
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('image'), $imageName);
                $imagePaths[] = $imageName;
            }

            $newsData['images'] = implode(',', $imagePaths); // แปลงอาเรย์เป็นสตริงก่อนบันทึก
        }

        NewsVisitor::create($newsData);

        return redirect()->route('news.create')->with('success', 'เพิ่มข่าวสารสำเร็จ');
    }

    public function index()
    {
        $newsItems = NewsVisitor::all()->map(function ($news) {
            if (is_array($news->images)) {
                // แปลงเป็นสตริงถ้าเป็นอาเรย์
                $news->images = implode(',', $news->images);
            }
            return $news;
        });
        return view('news.index', compact('newsItems'));
    }

    // แสดงข่าวสารตาม id
    public function show($id)
    {
        $news = NewsVisitor::findOrFail($id);
        return view('news.show', compact('news'));
    }

    // แสดงฟอร์มการแก้ไขข่าวสาร
    public function edit($id)
    {
        $news = NewsVisitor::findOrFail($id);
        return view('news.edit', compact('news'));
    }

    // จัดการการอัพเดตข่าวสาร
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $news = NewsVisitor::findOrFail($id);

        $newsData = [
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ];

        if ($request->hasFile('images')) {
            $images = $request->file('images');
            $imagePaths = [];

            foreach ($images as $image) {
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('image'), $imageName);
                $imagePaths[] = $imageName;
            }

            $newsData['images'] = implode(',', $imagePaths); // แปลงอาเรย์เป็นสตริงก่อนบันทึก
        }

        $news->update($newsData);

        return redirect()->route('news.index')->with('success', 'แก้ไขสำเร็จ');
    }

    public function destroy($id)
    {
        $news = NewsVisitor::find($id);

        if ($news) {
            // ตรวจสอบและแปลงเป็นสตริงหาก $news->images เป็นอาร์เรย์
            $images = is_array($news->images) ? $news->images : explode(',', $news->images);

            foreach ($images as $image) {
                $imagePath = public_path('image') . '/' . $image;
                if (file_exists($imagePath)) {
                    unlink($imagePath); // ลบไฟล์
                }
            }

            $news->delete(); // ลบรายการออกจากฐานข้อมูล

            return redirect()->route('news.index')->with('success', 'ลบข้อมูลข่าวสารสำเร็จ');
        }

        return back()->with('error', 'ลบข้อมูลข่าวสารไม่สำเร็จ');
    }
}
