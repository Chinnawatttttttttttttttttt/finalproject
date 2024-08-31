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
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // ตรวจสอบไฟล์รูปภาพ
        ]);

        $newsData = [
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ];

        // ตรวจสอบว่ามีไฟล์รูปภาพที่อัปโหลดหรือไม่
        if ($request->hasFile('images')) {
            $images = $request->file('images');
            $imagePaths = [];

            // อัปโหลดรูปภาพแต่ละไฟล์
            foreach ($images as $image) {
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('image'), $imageName);
                $imagePaths[] = $imageName; // เก็บชื่อไฟล์ใน array
            }

            $newsData['images'] = implode(',', $imagePaths); // บันทึกชื่อไฟล์เป็นคอมม่าแยก
        }

        // สร้างข่าวสารใหม่ในฐานข้อมูล
        NewsVisitor::create($newsData);

        // รีไดเร็กต์ไปยังหน้า `create` พร้อมข้อความสำเร็จ
        return redirect()->route('news.create')->with('success', 'News added successfully!');
    }

    // แสดงรายการข่าวสารทั้งหมด
    public function index()
    {
        $newsItems = NewsVisitor::all();
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

            $newsData['images'] = implode(',', $imagePaths);
        }

        $news->update($newsData);

        return redirect()->route('news.index')->with('success', 'News updated successfully!');
    }

}
