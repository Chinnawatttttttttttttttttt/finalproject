<!DOCTYPE html>
<html>
<head>
    <title>แก้ไขคะแนนผู้สูงอายุ</title>
    <style>
        .question {
            display: none;
            text-align: center;
        }
        .question.active {
            display: block;
        }
        .question img {
            max-width: 100%;
            height: auto;
            margin-bottom: 10px;
        }
        .question label {
            display: inline-block;
            margin-bottom: 10px;
            cursor: pointer;
            width: 50px;
            text-align: center;
        }
        .question button {
            margin-top: 10px;
        }
    </style>
    <script>
        function showQuestion(current, target) {
            if (current === 5 && target === 4) {
                document.getElementById('question' + current).classList.remove('active');
                document.getElementById('question' + target).classList.add('active');
            } else {
                if (checkAnswer(current)) {
                    document.getElementById('question' + current).classList.remove('active');
                    document.getElementById('question' + target).classList.add('active');
                }
            }
        }

        function checkAnswer(questionNumber) {
            const questionId = 'question' + questionNumber;
            const questionDiv = document.getElementById(questionId);
            const inputs = questionDiv.querySelectorAll('input[type="radio"]');
            for (const input of inputs) {
                if (input.checked) {
                    return true;
                }
            }
            alert('กรุณาเลือกคำตอบก่อนที่จะไปยังคำถามถัดไป');
            return false;
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

            // เพิ่มการอัปเดต summary ให้แสดงข้อมูลการประเมิน
            document.getElementById('user_id_summary').textContent = `ผู้ประเมิน: ${document.getElementById('user_name').textContent}`;
            document.getElementById('elderly_name_summary').textContent = `ผู้สูงอายุ: ${document.getElementById('elderly_name').textContent}`;
            document.getElementById('score_summary').textContent = summary.join(', ');
        }

        function submitForm() {
            document.getElementById('score_form').submit();
        }

        document.addEventListener('DOMContentLoaded', () => {
            const fields = ['mobility', 'confuse', 'feed', 'toilet'];

            fields.forEach(field => {
                const radios = document.getElementsByName(field);
                radios.forEach(radio => {
                    radio.addEventListener('change', summarizeAnswers);
                });
            });

            summarizeAnswers(); // เรียกใช้ฟังก์ชัน summarizeAnswers เพื่อแสดงสรุปคำตอบเมื่อหน้าเว็บโหลดเสร็จ
        });
    </script>
</head>
<body>
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form id="score_form" action="{{ route('score.create', ['id' => $score->id]) }}" method="POST">
        @csrf
        @method('POST')
        <div class="form-group">
            <label for="elderly_name">ชื่อ-ผู้สูงอายุ:</label>
            <p id="elderly_name">
                {{ $elderly->FirstName }} {{ $elderly->LastName }}
            </p>
            <input type="hidden" name="elderly_id" value="{{ $elderly->id }}">
            @error('elderly_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror

            <label for="user_name">ชื่อ-ผู้ประเมิน:</label><br>
            <p id="user_name">{{ $user->FirstName }} {{ $user->LastName }}</p>
            <input type="hidden" id="user_id" name="user_id" value="{{ $user->id }}">
        </div>

        <div id="question1" class="question @if ($score->id === 1) active @endif">
            <label for="mobility">Mobility (0-5):</label><br>
            <img src="/path/to/mobility_image.jpg" alt="Mobility Image" /><br>
            @for($i = 0; $i <= 5; $i++)
                <input type="radio" id="mobility{{ $i }}" name="mobility" value="{{ $i }}" @if ($score->mobility == $i) checked @endif required>
                <label for="mobility{{ $i }}">{{ $i }}</label>
            @endfor
            <br>
            <button type="button" onclick="showQuestion(1, 2)">ถัดไป</button>
        </div>

        <div id="question2" class="question @if ($score->id === 2) active @endif">
            <label for="confuse">Confuse (0-5):</label><br>
            <img src="/path/to/confuse_image.jpg" alt="Confuse Image" /><br>
            @for($i = 0; $i <= 5; $i++)
                <input type="radio" id="confuse{{ $i }}" name="confuse" value="{{ $i }}" @if ($score->confuse == $i) checked @endif required>
                <label for="confuse{{ $i }}">{{ $i }}</label>
            @endfor
            <br>
            <button type="button" onclick="showQuestion(2, 1)">กลับ</button>
            <button type="button" onclick="showQuestion(2, 3)">ถัดไป</button>
        </div>

        <div id="question3" class="question @if ($score->id === 3) active @endif">
            <label for="feed">Feed (0-5):</label><br>
            <img src="/path/to/feed_image.jpg" alt="Feed Image" /><br>
            @for($i = 0; $i <= 5; $i++)
                <input type="radio" id="feed{{ $i }}" name="feed" value="{{ $i }}" @if ($score->feed == $i) checked @endif required>
                <label for="feed{{ $i }}">{{ $i }}</label>
            @endfor
            <br>
            <button type="button" onclick="showQuestion(3, 2)">กลับ</button>
            <button type="button" onclick="showQuestion(3, 4)">ถัดไป</button>
        </div>

        <div id="question4" class="question @if ($score->id === 4) active @endif">
            <label for="toilet">Toilet (0-5):</label><br>
            <img src="/path/to/toilet_image.jpg" alt="Toilet Image" /><br>
            @for($i = 0; $i <= 5; $i++)
                <input type="radio" id="toilet{{ $i }}" name="toilet" value="{{ $i }}" @if ($score->toilet == $i) checked @endif required>
                <label for="toilet{{ $i }}">{{ $i }}</label>
            @endfor
            <br>
            <button type="button" onclick="showQuestion(4, 3)">กลับ</button>
            <button type="button" onclick="showQuestion(4, 5)">ถัดไป</button>
        </div>

        <div id="question5" class="question @if ($score->id === 5) active @endif">
            <label for="summary">สรุปคำตอบ:</label>
            <p id="summary"></p>
            <button type="button" onclick="showQuestion(5, 4)">กลับ</button>
            <button type="button" onclick="submitForm()">บันทึก</button>
        </div>

        <!-- สรุปข้อมูลการประเมิน -->
        <div id="summary_section" class="question @if ($score->id === 5) active @endif">
            <h3>สรุปข้อมูลการประเมิน</h3>
            <p id="user_id_summary"></p>
            <p id="elderly_name_summary"></p>
            <p id="score_summary"></p>
            <button type="button" onclick="showQuestion(5, 4)">กลับ</button>
            <button type="button" onclick="submitForm()">บันทึก</button>
        </div>
    </form>

    <script>
        function showQuestion(current, target) {
            if (current === 5 && target === 4) {
                document.getElementById('question' + current).classList.remove('active');
                document.getElementById('question' + target).classList.add('active');
            } else {
                if (checkAnswer(current)) {
                    document.getElementById('question' + current).classList.remove('active');
                    document.getElementById('question' + target).classList.add('active');
                }
            }
        }

        function checkAnswer(questionNumber) {
            const questionId = 'question' + questionNumber;
            const questionDiv = document.getElementById(questionId);
            const inputs = questionDiv.querySelectorAll('input[type="radio"]');
            for (const input of inputs) {
                if (input.checked) {
                    return true;
                }
            }
            alert('กรุณาเลือกคำตอบก่อนที่จะไปยังคำถามถัดไป');
            return false;
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

            // เพิ่มการอัปเดต summary ให้แสดงข้อมูลการประเมิน
            document.getElementById('user_id_summary').textContent = `ผู้ประเมิน: ${document.getElementById('user_name').textContent}`;
            document.getElementById('elderly_name_summary').textContent = `ผู้สูงอายุ: ${document.getElementById('elderly_name').textContent}`;
            document.getElementById('score_summary').textContent = summary.join(', ');
        }

        function submitForm() {
            document.getElementById('score_form').submit();
        }

        document.addEventListener('DOMContentLoaded', () => {
            const fields = ['mobility', 'confuse', 'feed', 'toilet'];

            fields.forEach(field => {
                const radios = document.getElementsByName(field);
                radios.forEach(radio => {
                    radio.addEventListener('change', summarizeAnswers);
                });
            });

            summarizeAnswers(); // เรียกใช้ฟังก์ชัน summarizeAnswers เพื่อแสดงสรุปคำตอบเมื่อหน้าเว็บโหลดเสร็จ
        });
    </script>
</body>
</html>
