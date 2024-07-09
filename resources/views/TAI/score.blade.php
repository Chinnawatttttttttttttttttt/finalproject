<!DOCTYPE html>
<html>
<head>
    <title>ประเมินคะแนนผู้สูงอายุ</title>
    <style>
        .question {
            display: none;
            text-align: center; /* จัดให้เนื้อหาอยู่ตรงกลาง */
        }
        .question.active {
            display: block;
        }
        .question img {
            max-width: 100%; /* ขยายให้รูปภาพพอดีกับพื้นที่ของคำถาม */
            height: auto; /* ปรับอัตราส่วนตามอัตราส่วนของภาพ */
            margin-bottom: 10px; /* ระยะห่างของรูปภาพจากตัวเลือก */
        }
        .question label {
            display: inline-block;
            margin-bottom: 10px; /* ระยะห่างของตัวเลือกจากกัน */
            cursor: pointer; /* เปลี่ยน cursor เมื่อนำเมาส์ไปชี้ */
            width: 50px; /* กำหนดความกว้างของ label */
            text-align: center; /* จัดให้เนื้อหาอยู่ตรงกลาง */
        }
        .question button {
            margin-top: 10px; /* ระยะห่างของปุ่มไปยังคำถามถัดไป */
        }
    </style>
    <script>
        function showQuestion(current, target) {
            document.getElementById('question' + current).classList.remove('active');
            document.getElementById('question' + target).classList.add('active');
        }
    </script>
</head>
<body>
    <form action="/score_tai/evaluate" method="POST">
        @csrf
        <div class="form-group">
            <label for="elderly_name">ชื่อ-ผู้สูงอายุ:</label>
            <p id="elderly_name">
                {{ $elderly->FirstName }} {{ $elderly->LastName }}
            </p>
            <input type="hidden" name="elderly_id" value="{{ $elderly->elderly_id }}">
            @error('elderly_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div id="question1" class="question active">
            <label for="mobility">Mobility (0-5):</label><br>
            <img src="/path/to/mobility_image.jpg" alt="Mobility Image" /><br>
            @for($i = 0; $i <= 5; $i++)
                <input type="radio" id="mobility{{ $i }}" name="mobility" value="{{ $i }}" required>
                <label for="mobility{{ $i }}">{{ $i }}</label>
            @endfor
            <br>
            <button type="button" onclick="showQuestion(1, 2)">ถัดไป</button>
        </div>

        <div id="question2" class="question">
            <label for="confuse">Confuse (0-5):</label><br>
            <img src="/path/to/confuse_image.jpg" alt="Confuse Image" /><br>
            @for($i = 0; $i <= 5; $i++)
                <input type="radio" id="confuse{{ $i }}" name="confuse" value="{{ $i }}" required>
                <label for="confuse{{ $i }}">{{ $i }}</label>
            @endfor
            <br>
            <button type="button" onclick="showQuestion(2, 1)">กลับ</button>
            <button type="button" onclick="showQuestion(2, 3)">ถัดไป</button>
        </div>

        <div id="question3" class="question">
            <label for="feed">Feed (0-5):</label><br>
            <img src="/path/to/feed_image.jpg" alt="Feed Image" /><br>
            @for($i = 0; $i <= 5; $i++)
                <input type="radio" id="feed{{ $i }}" name="feed" value="{{ $i }}" required>
                <label for="feed{{ $i }}">{{ $i }}</label>
            @endfor
            <br>
            <button type="button" onclick="showQuestion(3, 2)">กลับ</button>
            <button type="button" onclick="showQuestion(3, 4)">ถัดไป</button>
        </div>

        <div id="question4" class="question">
            <label for="toilet">Toilet (0-5):</label><br>
            <img src="/path/to/toilet_image.jpg" alt="Toilet Image" /><br>
            @for($i = 0; $i <= 5; $i++)
                <input type="radio" id="toilet{{ $i }}" name="toilet" value="{{ $i }}" required>
                <label for="toilet{{ $i }}">{{ $i }}</label>
            @endfor
            <br>
            <button type="button" onclick="showQuestion(4, 3)">กลับ</button>
            <button type="button" onclick="showQuestion(4, 5)">ถัดไป</button>
        </div>

        <div id="question5" class="question">
            <label for="user_id">ID ผู้ประเมิน:</label><br>
            <img src="/path/to/user_id_image.jpg" alt="User ID Image" /><br>
            <p>กรุณากรอก ID ผู้ประเมิน</p>
            <input type="number" id="user_id" name="user_id" required><br>
            <button type="button" onclick="showQuestion(5, 4)">กลับ</button>
            <button type="submit">บันทึก</button>
        </div>
    </form>
</body>
</html>
