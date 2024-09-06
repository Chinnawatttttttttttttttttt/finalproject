@extends('layouts.app')

@section('content')
    <title>แบบฟอร์มการประเมิน TAI</title>
    <style>
        .form-container {
            max-width: 1000px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            margin-right: 5px;
        }

        .radio-group {
            display: flex;
            flex-direction: column;
            /* จัดให้อยู่ในแนวตั้ง */
            gap: 10px;
            /* เพิ่มช่องว่างระหว่างกลุ่ม */
        }

        .radio-item {
            display: flex;
            /* จัดให้อยู่ในแนวนอนสำหรับแต่ละกลุ่ม */
            align-items: center;
            /* จัดแนวรายการภายในให้อยู่ตรงกลาง */
            gap: 10px;
            /* เพิ่มช่องว่างระหว่าง radio และ label */
        }

        .radio-group .description {
            color: #666;
            /* สีของข้อความกำกับ */
            font-size: 1.2em;
            /* ขนาดตัวอักษรของข้อความกำกับ */
        }


        .radio-group input[type="radio"] {
            display: none;
        }

        .radio-group label {
            margin-right: 10px;
            padding: 10px 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            cursor: pointerc;
        }

        .radio-group label:hover {
            background-color: #f0f0f0;
        }

        .radio-group input[type="radio"]:checked+label {
            background-color: #007bff;
            color: #fff;
        }

        .summary-container {
            text-align: center;
            /* จัดให้อยู่กลาง */
            margin-top: 20px;
            border: 1px solid #ccc;
            /* เพิ่มกรอบให้กับสรุป */
            border-radius: 5px;
            padding: 10px;
            background-color: #f9f9f9;
            /* พื้นหลังให้กับสรุป */
        }

        .question {
            display: none;
        }

        .question.active {
            display: block;
        }

        .question-buttons {
            margin-top: 10px;
            text-align: center;
        }

        .user-section {
            display: flex;
        }
    </style>

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="form-container">
        <form id="score_form" action="{{ route('score.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $score->id }}">
            <input type="hidden" name="elderly_id" value="{{ $elderly->id }}">
            <input type="hidden" name="user_id" value="{{ $user->id }}">
            <div>
                <h1>การประเมินภาวะสุขภาพผู้สูงอาย</h1>
                <h4>การประเมินสภาวะสุขภาพผู้สูงอาย (การเคลื่อนไหว การตัดสินใจ การกินอาหาร และการใช้ห้องน้ำ)
                    โดยในแต่ละด้านแบ่งเป็น 6 ระดับ ตามความสามารถในการทำกิจกรรมนั้นโดยค่าระดับ 0
                    เป็นระดับที่ทำกิจกรรมนั้นได้น้อยที่สุดและ ค่าระดับ 5 เป็นระดับที่ทำกิจกรรมนั้นได้มากที่สุด</h4>
            </div>

            <div id="question1" class="question active">
                <div class="form-group"
                    style="display: flex; justify-content: space-between; align-items: center; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                    <div>
                        <label for="elderly_name">ชื่อ-ผู้สูงอายุ:</label>
                        <span>{{ $elderly->Title . $elderly->FirstName }} {{ $elderly->LastName }}</span><br>
                        <input type="hidden" name="elderly_id" value="{{ $elderly->id }}">
                    </div>
                    <div class="user-section">
                        <label for="user_name">ผู้ประเมิน:</label>
                        <span>{{ $user->Title . $user->FirstName }} {{ $user->LastName }}</span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="mobility">ด้านการเคลื่อนไหว (0-5):</label>
                    <div class="row">
                        <!-- Radio Buttons Column -->
                        <div class="col-md-8">
                            <div class="radio-group">
                                @php
                                    $descriptions = [
                                        '0' => 'ไม่สามารถเคลื่อนไหวเองได้',
                                        '1' => 'Roll over',
                                        '2' => 'นั่งข้างเตียง',
                                        '3' => 'Move around ใช่เครื่องช่วย',
                                        '4' => 'เดินทางราบ',
                                        '5' => 'ขึ้นบันได',
                                    ];
                                @endphp
                                @for ($i = 0; $i <= 5; $i++)
                                    <div class="radio-item d-flex align-items-center mb-2">
                                        <!-- Added d-flex for alignment -->
                                        <input type="radio" id="mobility{{ $i }}" name="mobility"
                                            value="{{ $i }}" @if ($score->mobility == $i) checked @endif
                                            required>
                                        <label for="mobility{{ $i }}"
                                            class="ml-2 mr-2">{{ $i }}</label>
                                        <span class="description">{{ $descriptions[$i] }}</span>
                                    </div>
                                @endfor
                            </div>
                        </div>

                        <!-- Image Column -->
                        <div class="col-md-4 d-flex align-items-center justify-content-center">
                            <img src="{{ asset('assets/img/M.png') }}" alt="Mental Status"
                                style="max-width: 100%; height: auto;">
                        </div>
                    </div>
                </div>

                <div class="question-buttons">
                    <button type="button" class="btn btn-primary" onclick="showQuestion(1, 2)">ถัดไป</button>
                </div>
            </div>

            <div id="question2" class="question">
                <div class="form-group"
                    style="display: flex; justify-content: space-between; align-items: center; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                    <div>
                        <label for="elderly_name">ชื่อ-ผู้สูงอายุ:</label>
                        <span>{{ $elderly->Title . $elderly->FirstName }} {{ $elderly->LastName }}</span><br>
                        <input type="hidden" name="elderly_id" value="{{ $elderly->id }}">
                    </div>
                    <div class="user-section">
                        <label for="user_name">ผู้ประเมิน:</label>
                        <span>{{ $user->Title . $user->FirstName }} {{ $user->LastName }}</span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="confuse">ด้านการตัดสินใจ (0-5):</label>
                    <div class="row">
                        <!-- Radio Buttons Column -->
                        <div class="col-md-8">
                            <div class="radio-group">
                                @php
                                    $descriptions = [
                                        '0' => 'ไม่มีการตอบสนองต่อสิ่งเร้า',
                                        '1' => 'มีการตอบสนองต่อสิ่งเร้า',
                                        '2' => 'ไม่มีพฤติกรรมที่สร้างปัญหา',
                                        '3' => 'Orientation ดี',
                                        '4' => 'ไม่มีปัญหาการตัดสินใจจนสร้างความรำคาญ',
                                        '5' => 'Cognitive Function ดี',
                                    ];
                                @endphp
                                @for ($i = 0; $i <= 5; $i++)
                                    <div class="radio-item mb-2"> <!-- Margin bottom for spacing -->
                                        <input type="radio" id="confuse{{ $i }}" name="confuse"
                                            value="{{ $i }}" @if ($score->confuse == $i) checked @endif
                                            required>
                                        <label for="confuse{{ $i }}" class="mr-2">{{ $i }}</label>
                                        <span class="description">{{ $descriptions[$i] }}</span>
                                    </div>
                                @endfor
                            </div>
                        </div>

                        <!-- Image Column -->
                        <div class="col-md-4 d-flex align-items-center justify-content-center">
                            <img src="{{ asset('assets/img/C.png') }}" alt="Mental Status"
                                style="max-width: 100%; height: auto;">
                        </div>
                    </div>

                    <div class="question-buttons mt-3"> <!-- Added margin-top for spacing -->
                        <button type="button" class="btn btn-secondary" onclick="showQuestion(2, 1)">กลับ</button>
                        <button type="button" class="btn btn-primary" onclick="showQuestion(2, 3)">ถัดไป</button>
                    </div>
                </div>
            </div>

            <div id="question3" class="question">
                <div class="form-group"
                    style="display: flex; justify-content: space-between; align-items: center; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                    <div>
                        <label for="elderly_name">ชื่อ-ผู้สูงอายุ:</label>
                        <span>{{ $elderly->Title . $elderly->FirstName }} {{ $elderly->LastName }}</span><br>
                        <input type="hidden" name="elderly_id" value="{{ $elderly->id }}">
                    </div>
                    <div class="user-section">
                        <label for="user_name">ผู้ประเมิน:</label>
                        <span>{{ $user->Title . $user->FirstName }} {{ $user->LastName }}</span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="feed">ด้านการกินอาหาร (0-5):</label>
                    <div class="row">
                        <!-- Radio Buttons Column -->
                        <div class="col-md-8">
                            <div class="radio-group">
                                @php
                                    $descriptions = [
                                        '0' => 'มีการให้ IVF',
                                        '1' => 'ไม่ IVF',
                                        '2' => 'ไม่ NG',
                                        '3' => 'ไม่มีปัญหาการกลืน',
                                        '4' => 'ไม่ต้องช่วยเหลือ',
                                        '5' => 'กินเองได้ไม่หกเลอะเทอะ',
                                    ];
                                @endphp
                                @for ($i = 0; $i <= 5; $i++)
                                    <div class="radio-item mb-2"> <!-- Margin bottom for spacing -->
                                        <input type="radio" id="feed{{ $i }}" name="feed"
                                            value="{{ $i }}" @if ($score->feed == $i) checked @endif
                                            required>
                                        <label for="feed{{ $i }}" class="mr-2">{{ $i }}</label>
                                        <span class="description">{{ $descriptions[$i] }}</span>
                                    </div>
                                @endfor
                            </div>
                        </div>

                        <!-- Image Column -->
                        <div class="col-md-4 d-flex align-items-center justify-content-center">
                            <img src="{{ asset('assets/img/F.png') }}" alt="Eating Status"
                                style="max-width: 100%; height: auto;">
                        </div>
                    </div>

                    <div class="question-buttons mt-3"> <!-- Added margin-top for spacing -->
                        <button type="button" class="btn btn-secondary" onclick="showQuestion(3, 2)">กลับ</button>
                        <button type="button" class="btn btn-primary" onclick="showQuestion(3, 4)">ถัดไป</button>
                    </div>
                </div>
            </div>

            <div id="question4" class="question">
                <div class="form-group"
                    style="display: flex; justify-content: space-between; align-items: center; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                    <div>
                        <label for="elderly_name">ชื่อ-ผู้สูงอายุ:</label>
                        <span>{{ $elderly->Title . $elderly->FirstName }} {{ $elderly->LastName }}</span><br>
                        <input type="hidden" name="elderly_id" value="{{ $elderly->id }}">
                    </div>
                    <div class="user-section">
                        <label for="user_name">ผู้ประเมิน:</label>
                        <span>{{ $user->Title . $user->FirstName }} {{ $user->LastName }}</span>
                    </div>
                </div>

                {{--  <div class="form-group">
                    <label for="toilet">Toilet (0-5):</label><br>
                    <img src="{{ asset('assets/img/Toilet.png') }}" alt="Toilet"
                        style="max-width: 100%; height: auto;">
                    <div class="radio-group">
                        @for ($i = 0; $i <= 5; $i++)
                            <input type="radio" id="toilet{{ $i }}" name="toilet"
                                value="{{ $i }}" @if ($score->toilet == $i) checked @endif required>
                            <label for="toilet{{ $i }}">{{ $i }}</label>
                        @endfor
                    </div>
                </div>  --}}

                <div class="form-group">
                    <label for="toilet">ด้านการใช้ห้องน้ำ (0-5):</label>
                    <div class="row">
                        <!-- Radio Buttons Column -->
                        <div class="col-md-8">
                            <div class="radio-group">
                                @php
                                    $descriptions = [
                                        '0' => 'Ratain foley’s cath',
                                        '1' => 'no foley’s cath',
                                        '2' => 'เปลี่ยนผ้าอ้อมคนเดียวได้',
                                        '3' => 'ใช้ผ้าอ้อมแค่บางครั้ง',
                                        '4' => 'ต้องช่วยเหลือ',
                                        '5' => 'ทำได้เอง และทำความสะอาดเองได้อย่างน้อย 2 สัปดาห์ที่ผ่านมา',
                                    ];
                                @endphp
                                @for ($i = 0; $i <= 5; $i++)
                                    <div class="radio-item mb-2"> <!-- Margin bottom for spacing -->
                                        <input type="radio" id="toilet{{ $i }}" name="toilet"
                                            value="{{ $i }}" @if ($score->toilet == $i) checked @endif
                                            required>
                                        <label for="toilet{{ $i }}"
                                            class="mr-2">{{ $i }}</label>
                                        <span class="description">{{ $descriptions[$i] }}</span>
                                    </div>
                                @endfor
                            </div>
                        </div>

                        <!-- Image Column -->
                        <div class="col-md-4 d-flex align-items-center justify-content-center">
                            <img src="{{ asset('assets/img/T.png') }}" alt="Toilet Usage"
                                style="max-width: 100%; height: auto;">
                        </div>
                    </div>

                    <div class="question-buttons mt-3"> <!-- Added margin-top for spacing -->
                        <button type="button" class="btn btn-secondary" onclick="showQuestion(4, 3)">กลับ</button>
                        <button type="button" class="btn btn-primary" onclick="showQuestion(4, 5)">ถัดไป</button>
                    </div>
                </div>

            </div>

            <div id="question5" class="question">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group border p-3 rounded">
                                <h3>สรุปข้อมูลการประเมิน</h3>
                                <p id="user_id_summary">ผู้ประเมิน: {{ $user->FirstName }} {{ $user->LastName }}</p>
                                <p id="elderly_name_summary">ผู้สูงอายุ: {{ $elderly->FirstName }}
                                    {{ $elderly->LastName }}</p>
                                <label for="summary">สรุปคำตอบ:</label><br>
                                <p id="summary"></p>
                                {{--  <p id="score_summary"></p>  --}}
                                <p id="group_summary"></p>
                            </div>
                        </div>
                        <div class="col-md-4 d-flex align-items-center justify-content-center">
                            {{--  <div class="border p-2 rounded">  --}}
                                <img src="{{ asset('assets/img/MCFT.png') }}" alt="Toilet Usage"
                                    style="max-width: 100%; height: auto;">
                            {{--  </div>  --}}
                        </div>
                    </div>
                </div>

                <!-- สิ้นสุดการเพิ่มเนื้อหาจาก div ที่สอง -->

                <div class="question-buttons">
                    <button type="button" onclick="showQuestion(5, 4)">กลับ</button>
                    <button type="button" onclick="submitForm()">บันทึก</button>
                </div>
            </div>

        </form>
    </div>

    <script>
        function previewImage(event) {
            const imagePreview = document.getElementById('image_preview');
            imagePreview.src = URL.createObjectURL(event.target.files[0]);
            imagePreview.style.display = 'block';
        }

        function showQuestion(current, target) {
            document.getElementById('question' + current).classList.remove('active');
            document.getElementById('question' + target).classList.add('active');

            if (target === 5) {
                // ตรวจสอบว่ามีการเลือกตัวเลือกในแต่ละด้านหรือไม่
                const mobilityInput = document.querySelector('input[name="mobility"]:checked');
                const confuseInput = document.querySelector('input[name="confuse"]:checked');
                const feedInput = document.querySelector('input[name="feed"]:checked');
                const toiletInput = document.querySelector('input[name="toilet"]:checked');
                console.log(document.querySelector('input[name="mobility"]:checked'));
                console.log(document.querySelector('input[name="confuse"]:checked'));
                console.log(document.querySelector('input[name="feed"]:checked'));
                console.log(document.querySelector('input[name="toilet"]:checked'));

                if (mobilityInput && confuseInput && feedInput && toiletInput) {
                    const mobility = mobilityInput.value;
                    const confuse = confuseInput.value;
                    const feed = feedInput.value;
                    const toilet = toiletInput.value;

                    const summary =
                        `การเคลื่อนไหว : ${mobility}, สับสน : ${confuse}, การกินอาหาร : ${feed}, การเข้าห้องน้ำ : ${toilet}`;
                    document.getElementById('summary').innerText = summary;
                    console.log(summary);

                    // Additional logic to determine group summary based on scores
                    let group = '';
                    if (mobility === '5' && confuse === '5' && feed === '5' && toilet === '5') {
                        group = 'B5 เป็นกลุ่มปกติ';
                    } else if (mobility >= '3' && confuse >= '4' && feed >= '4' && toilet >= '4') {
                        group = 'B4 เป็นกลุ่มปกติ';
                    } else if (mobility >= '3' && confuse >= '4' && feed <= '3' && toilet <= '3') {
                        group = 'B3 เป็นกลุ่มปกติ';
                    } else if (mobility >= '3' && confuse <= '3' && feed >= '4' && toilet >= '4') {
                        group = 'C4 เป็นกลุ่มติดบ้าน';
                    } else if (mobility >= '3' && confuse <= '3' && feed === '3' && toilet === '4') {
                        group = 'C3 เป็นกลุ่มติดบ้าน';
                    } else if (mobility >= '3' && confuse <= '3' && feed === '4' && toilet === '3') {
                        group = 'C3 เป็นกลุ่มติดบ้าน';
                    } else if (mobility >= '3' && confuse <= '3' && feed <= '3' && toilet <= '3') {
                        group = 'C2 เป็นกลุ่มติดบ้าน';
                    } else if (mobility <= '2' && feed >= '4') {
                        group = 'I3 เป็นกลุ่มติดเตียง';
                    } else if (mobility <= '2' && feed === '3') {
                        group = 'I2 เป็นกลุ่มติดเตียง';
                    } else if (mobility <= '2' && feed <= '2') {
                        group = 'I1 เป็นกลุ่มติดเตียง ';
                    }

                    document.getElementById('group_summary').innerText = 'กลุ่ม :' + group;

                } else {
                    // หากไม่พบการเลือกตัวเลือกใดๆ
                    document.getElementById('summary').innerText = 'กรุณาเลือกตัวเลือกทั้งหมด';
                    document.getElementById('group_summary').innerText = '';
                }
            }
        }


        function submitForm() {
            document.getElementById('score_form').submit();
        }
    </script>
@endsection
