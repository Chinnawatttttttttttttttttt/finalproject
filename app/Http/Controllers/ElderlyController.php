<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Elderly;
use App\Models\ScoreTAI;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ElderlyController extends Controller
{
    public function create()
    {
        return view('Elderlys.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'Title' =>'required|string',
            'FirstName' => 'required|string',
            'LastName' => 'required|string',
            'NickName' => 'nullable|string',
            'Birthday' => 'required|date',
            'Age' => 'required|integer',
            'Address' => 'required|string',
            'Latitude' => 'required|numeric|between:-90,90',
            'Longitude' => 'required|numeric|between:-180,180',
            'Phone' => 'required|string'
        ]);

        $elderly = new Elderly();
        $elderly->Title = $request->Title;
        $elderly->FirstName = $request->FirstName;
        $elderly->LastName = $request->LastName;
        $elderly->NickName = $request->NickName;
        $elderly->Birthday = $request->Birthday;
        $elderly->Age = $request->Age;
        $elderly->Address = $request->Address;
        $elderly->Latitude = $request->Latitude;
        $elderly->Longitude = $request->Longitude;
        $elderly->Phone = $request->Phone;
        $elderly->save();

        if ($elderly->wasRecentlyCreated) {
            $scoreTai = ScoreTAI::create([
                'elderly_id' => $elderly->id,
                'mobility' => null,
                'confuse' => null,
                'feed' => null,
                'toilet' => null,
                'user_id' => null,
            ]);

            $qrContent = url('/score/' . $scoreTai->id);
            $qrImage = QrCode::format('png')->size(300)->generate($qrContent);
            $qrPath = 'qr-codes/score_tai_' . $scoreTai->id . '.png';

            // บันทึกภาพ QR code ลงใน path สาธารณะ
            file_put_contents(public_path($qrPath), $qrImage);

            $scoreTai->qr_path = $qrPath;
            $scoreTai->save();

            return back()->with('success', 'ลงทะเบียนสำเร็จ');
        } else {
            return back()->with('fail', 'มีข้อผิดพลาดเกิดขึ้นในการลงทะเบียน');
        }
    }

    public function index()
    {
        $elderly = Elderly::all();
        return view('Elderlys.index', compact('elderly'));
    }

    public function edit($id)
    {
        $elderly = Elderly::findOrFail($id);

        // Split address
        $address = $elderly->Address;
        $addressParts = preg_split('/\s+/', $address); // Split by whitespace

        // Assuming the address structure is defined:
        $houseNumber = $addressParts[0] ?? '';
        $village = $addressParts[1] ?? '';
        $subdistrict = $addressParts[2] ?? '';
        $district = $addressParts[3] ?? '';
        $province = $addressParts[4] ?? '';
        $postalCode = $addressParts[5] ?? '';

        // Calculate age
        $age = (new \Carbon\Carbon($elderly->Birthday))->diffInYears();

        return view('Elderlys.edit', compact('elderly', 'houseNumber', 'village', 'subdistrict', 'district', 'province', 'postalCode', 'age'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());

        $request->validate([
            'Title' => 'required|string',
            'FirstName' => 'required|string|max:255',
            'LastName' => 'required|string|max:255',
            'NickName' => 'nullable|string|max:255',
            'Birthday' => 'required|date',
            'Age' => 'required|integer',
            'houseNumber' => 'nullable|string|max:255',
            'village' => 'nullable|string|max:255',
            'subdistrict' => 'nullable|string|max:255',
            'district' => 'nullable|string|max:255',
            'province' => 'nullable|string|max:255',
            'postalCode' => 'nullable|string|max:20',
            'Latitude' => 'nullable|numeric',
            'Longitude' => 'nullable|numeric',
            'Phone' => 'nullable|string|max:20',
        ]);

        $elderly = Elderly::findOrFail($id);
        $elderly->Title = $request->Title;
        $elderly->FirstName = $request->FirstName;
        $elderly->LastName = $request->LastName;
        $elderly->NickName = $request->NickName;
        $elderly->Birthday = $request->Birthday;
        $elderly->Age = $request->Age; // Make sure the age is correctly set
        $elderly->Address = $request->Address; // Save the combined address
        $elderly->Latitude = $request->Latitude;
        $elderly->Longitude = $request->Longitude;
        $elderly->Phone = $request->Phone;

        // Add other necessary fields...

        $elderly->save();

        return redirect()->route('elderlys.edit', $id)->with('success', 'ข้อมูลผู้สูงอายุถูกอัปเดตสำเร็จ');
    }

    public function destroy($id)
    {
        $elderly = Elderly::find($id);
        if ($elderly) {
            $elderly->delete();
            return redirect()->route('all-elderly')->with('success', 'ลบข้อมูลสำเร็จ');
        } else {
            return redirect()->route('all-elderly')->with('fail', 'ไม่พบข้อมูลที่ต้องการลบ');
        }
    }

    public function showMap()
    {
        $elderlies = Elderly::all(); // ดึงข้อมูลทั้งหมดของผู้สูงอายุ
        return view('dashboard.map', ['elderlies' => $elderlies]);
    }
}
