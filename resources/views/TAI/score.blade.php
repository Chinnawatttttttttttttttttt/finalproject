@extends('layouts.app')

@section('content')
<title>แบบฟอร์มการประเมิน TAI</title>
<style>
    .form-container {
        max-width: 600px;
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
        align-items: center;
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
    .radio-group input[type="radio"]:checked + label {
        background-color: #007bff;
        color: #fff;
    }
    .summary-container {
        text-align: center; /* จัดให้อยู่กลาง */
        margin-top: 20px;
        border: 1px solid #ccc; /* เพิ่มกรอบให้กับสรุป */
        border-radius: 5px;
        padding: 10px;
        background-color: #f9f9f9; /* พื้นหลังให้กับสรุป */
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
    .image-upload {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }
    .image-preview {
        margin-top: 10px;
        max-width: 100%;
        height: auto;
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

        <div id="question1" class="question active">
            <div class="form-group" style="display: flex; justify-content: space-between; align-items: center; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                <div>
                    <label for="elderly_name">ชื่อ-ผู้สูงอายุ:</label>
                    <span>{{ $elderly->Title.$elderly->FirstName }} {{ $elderly->LastName }}</span><br>
                    <input type="hidden" name="elderly_id" value="{{ $elderly->id }}">
                </div>
                <div class="user-section">
                    <label for="user_name">ผู้ประเมิน:</label>
                    <span>{{ $user->Title.$user->FirstName }} {{ $user->LastName }}</span>
                </div>
            </div>

            <div class="form-group">
                <label for="mobility">Mobility (0-5):</label><br>
                <img src="{{ asset('assets/img/Mobility.png') }}" alt="Mobility" style="max-width: 100%; height: auto;">
                <div class="radio-group">
                    @for ($i = 0; $i <= 5; $i++)
                    <input type="radio" id="mobility{{ $i }}" name="mobility" value="{{ $i }}" @if ($score->mobility == $i) checked @endif required>
                    <label for="mobility{{ $i }}">{{ $i }}</label>
                    @endfor
                </div>
            </div>

            <div class="question-buttons">
                <button type="button" onclick="showQuestion(1, 2)">ถัดไป</button>
            </div>
        </div>

        <div id="question2" class="question">
            <div class="form-group" style="display: flex; justify-content: space-between; align-items: center; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                <div>
                    <label for="elderly_name">ชื่อ-ผู้สูงอายุ:</label>
                    <span>{{ $elderly->Title.$elderly->FirstName }} {{ $elderly->LastName }}</span><br>
                    <input type="hidden" name="elderly_id" value="{{ $elderly->id }}">
                </div>
                <div class="user-section">
                    <label for="user_name">ผู้ประเมิน:</label>
                    <span>{{ $user->Title.$user->FirstName }} {{ $user->LastName }}</span>
                </div>
            </div>

            <div class="form-group">
                <label for="confuse">Confuse (0-5):</label><br>
                <img src="{{ asset('assets/img/MentalStatus.png') }}" alt="Mental Status" style="max-width: 100%; height: auto;">
                <div class="radio-group">
                    @for ($i = 0; $i <= 5; $i++)
                    <input type="radio" id="confuse{{ $i }}" name="confuse" value="{{ $i }}" @if ($score->confuse == $i) checked @endif required>
                    <label for="confuse{{ $i }}">{{ $i }}</label>
                    @endfor
                </div>
            </div>

            <div class="question-buttons">
                <button type="button" onclick="showQuestion(2, 1)">กลับ</button>
                <button type="button" onclick="showQuestion(2, 3)">ถัดไป</button>
            </div>
        </div>

        <div id="question3" class="question">
            <div class="form-group" style="display: flex; justify-content: space-between; align-items: center; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                <div>
                    <label for="elderly_name">ชื่อ-ผู้สูงอายุ:</label>
                    <span>{{ $elderly->Title.$elderly->FirstName }} {{ $elderly->LastName }}</span><br>
                    <input type="hidden" name="elderly_id" value="{{ $elderly->id }}">
                </div>
                <div class="user-section">
                    <label for="user_name">ผู้ประเมิน:</label>
                    <span>{{ $user->Title.$user->FirstName }} {{ $user->LastName }}</span>
                </div>
            </div>

            <div class="form-group">
                <label for="feed">Feed (0-5):</label><br>
                <img src="{{ asset('assets/img/Eating.png') }}" alt="Eating" style="max-width: 100%; height: auto;">
                <div class="radio-group">
                    @for ($i = 0; $i <= 5; $i++)
                    <input type="radio" id="feed{{ $i }}" name="feed" value="{{ $i }}" @if ($score->feed == $i) checked @endif required>
                    <label for="feed{{ $i }}">{{ $i }}</label>
                    @endfor
                </div>
            </div>

            <div class="question-buttons">
                <button type="button" onclick="showQuestion(3, 2)">กลับ</button>
                <button type="button" onclick="showQuestion(3, 4)">ถัดไป</button>
            </div>
        </div>

        <div id="question4" class="question">
            <div class="form-group" style="display: flex; justify-content: space-between; align-items: center; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                <div>
                    <label for="elderly_name">ชื่อ-ผู้สูงอายุ:</label>
                    <span>{{ $elderly->Title.$elderly->FirstName }} {{ $elderly->LastName }}</span><br>
                    <input type="hidden" name="elderly_id" value="{{ $elderly->id }}">
                </div>
                <div class="user-section">
                    <label for="user_name">ผู้ประเมิน:</label>
                    <span>{{ $user->Title.$user->FirstName }} {{ $user->LastName }}</span>
                </div>
            </div>

            <div class="form-group">
                <label for="toilet">Toilet (0-5):</label><br>
                <img src="{{ asset('assets/img/Toilet.png') }}" alt="Toilet" style="max-width: 100%; height: auto;">
                <div class="radio-group">
                    @for ($i = 0; $i <= 5; $i++)
                    <input type="radio" id="toilet{{ $i }}" name="toilet" value="{{ $i }}" @if ($score->toilet == $i) checked @endif required>
                    <label for="toilet{{ $i }}">{{ $i }}</label>
                    @endfor
                </div>
            </div>

            <div class="question-buttons">
                <button type="button" onclick="showQuestion(4, 3)">กลับ</button>
                <button type="button" onclick="showQuestion(4, 5)">ถัดไป</button>
            </div>
        </div>

        <div id="question5" class="question">
            <div class="form-group">
                <h3>สรุปข้อมูลการประเมิน</h3>
                <p id="user_id_summary">ผู้ประเมิน: {{ $user->FirstName }} {{ $user->LastName }}</p>
                <p id="elderly_name_summary">ผู้สูงอายุ: {{ $elderly->FirstName }} {{ $elderly->LastName }}</p>
                <label for="summary">สรุปคำตอบ:</label><br>
                <p id="summary"></p>
                {{--  <p id="score_summary"></p>  --}}
                <p id="group_summary"></p>
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
            const mobility = document.querySelector('input[name="mobility"]:checked').value;
            const confuse = document.querySelector('input[name="confuse"]:checked').value;
            const feed = document.querySelector('input[name="feed"]:checked').value;
            const toilet = document.querySelector('input[name="toilet"]:checked').value;

            const summary = `Mobility: ${mobility}, Confuse: ${confuse}, Feed: ${feed}, Toilet: ${toilet}`;
            document.getElementById('summary').innerText = summary;
            {{--  document.getElementById('score_summary').innerText = summary;  --}}
            console.log(summary);

            // Additional logic to determine group summary based on scores
            let group = '';
            if (mobility === 5 && confuse === 5 && feed === 5 && toilet === 5) {
                group = 'B5 เป็นกลุ่มปกติ';
            } else if (mobility >= 4 && confuse >= 4 && feed >= 4 && toilet >= 4) {
                group = 'B4 เป็นกลุ่มปกติ';
            } else if (mobility >= 3 && confuse >= 4 && feed <= 3 && toilet <= 3) {
                group = 'B3 เป็นกลุ่มติดบ้าน';
            } else if (mobility >= 3 && confuse <= 3 && feed >= 4 && toilet >= 4) {
                group = 'C4 เป็นกลุ่มติดบ้าน';
            } else if (mobility >= 3 && confuse <= 3 && feed === 3 && toilet === 4) {
                group = 'C3 เป็นกลุ่มติดบ้าน';
            } else if (mobility >= 3 && confuse <= 3 && feed <= 3 && toilet <= 3) {
                group = 'C2 เป็นกลุ่มติดบ้าน';
            } else if (mobility <= 2 && feed >= 4) {
                group = 'I3 เป็นกลุ่มติดเตียง';
            } else if (mobility <= 2 && feed === 3) {
                group = 'I2 เป็นกลุ่มติดเตียง';
            } else if (mobility <= 2 && feed <= 2) {
                group = 'I1 เป็นกลุ่มติดเตียง';
            }

            document.getElementById('group_summary').innerText = 'กลุ่ม: ' + group;

        }
    }

    function submitForm() {
        document.getElementById('score_form').submit();
    }

</script>
@endsection
