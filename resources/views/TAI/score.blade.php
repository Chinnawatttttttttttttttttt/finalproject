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
        cursor: pointer;
    }
    .radio-group label:hover {
        background-color: #f0f0f0;
    }
    .radio-group input[type="radio"]:checked + label {
        background-color: #007bff;
        color: #fff;
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
        {{--  align-items: center;  --}}
    }
</style>

@if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

<div class="form-container">
    <form id="score_form" action="{{ route('score.store') }}" method="POST">
        @csrf
        <input type="hidden" name="id" value="{{ $score->id }}">
        <input type="hidden" name="elderly_id" value="{{ $elderly->id }}">
        <input type="hidden" name="user_id" value="{{ $user->id }}">

        <div id="question1" class="question active">
            <div class="form-group" style="display: flex; justify-content: space-between; align-items: center; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                <div>
                    <label for="elderly_name">ชื่อ-ผู้สูงอายุ:</label>
                    <span>{{ $elderly->FirstName }} {{ $elderly->LastName }}</span><br>
                    <input type="hidden" name="elderly_id" value="{{ $elderly->id }}">
                </div>
                <div class="user-section">
                    <label for="user_name">ผู้ประเมิน:</label>
                    <span>{{ $user->FirstName }} {{ $user->LastName }}</span>
                </div>
            </div>

            <div class="form-group">
                <label for="mobility">Mobility (0-5):</label><br>
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
            <div class="form-group">
                <label for="confuse">Confuse (0-5):</label><br>
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
            <div class="form-group">
                <label for="feed">Feed (0-5):</label><br>
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
            <div class="form-group">
                <label for="toilet">Toilet (0-5):</label><br>
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
                <label for="summary">สรุปคำตอบ:</label><br>
                <p id="summary"></p>
            </div>

            <div class="question-buttons">
                <button type="button" onclick="showQuestion(5, 4)">กลับ</button>
                <button type="button" onclick="submitForm()">บันทึก</button>
            </div>
        </div>

        <div id="summary_section" class="question">
            <div class="form-group">
                <h3>สรุปข้อมูลการประเมิน</h3>
                <p id="elderly_name_summary">ผู้สูงอายุ: {{ $elderly->FirstName }} {{ $elderly->LastName }}</p>
                <p id="user_id_summary">ผู้ประเมิน: {{ $user->FirstName }} {{ $user->LastName }}</p>
                <p id="score_summary"></p>
                <p id="group_summary"></p>
            </div>

            <div class="question-buttons">
                <button type="button" onclick="showQuestion(5, 4)">กลับ</button>
                <button type="button" onclick="submitForm()">บันทึก</button>
            </div>
        </div>

    </form>
</div>

<script>
    function showQuestion(current, target) {
        document.getElementById('question' + current).classList.remove('active');
        document.getElementById('question' + target).classList.add('active');
        summarizeAnswers();
    }

    function summarizeAnswers() {
        const summary = [];
        const fields = ['mobility', 'confuse', 'feed', 'toilet'];

        fields.forEach(field => {
            const radios = document.getElementsByName(field);
            for (const radio of radios) {
                if (radio.checked) {
                    summary.push(`${field} = ${radio.value}`);
                    break;
                }
            }
        });

        document.getElementById('summary').textContent = summary.join(', ');

        // Update summary section with evaluation details
        document.getElementById('score_summary').textContent = summary.join(', ');

        // Determine and display group
        const scoreData = {
            mobility: parseInt(document.querySelector('input[name="mobility"]:checked').value),
            confuse: parseInt(document.querySelector('input[name="confuse"]:checked').value),
            feed: parseInt(document.querySelector('input[name="feed"]:checked').value),
            toilet: parseInt(document.querySelector('input[name="toilet"]:checked').value),
        };

        const group = determineGroup(scoreData);
        document.getElementById('group_summary').textContent = `กลุ่ม: ${group}`;
    }

    function submitForm() {
        document.getElementById('score_form').submit();
    }

    document.addEventListener('DOMContentLoaded', () => {
        summarizeAnswers(); // Initialize summary when page loads
    });
</script>
@endsection
