<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elderly Individuals in Buriram</title>
    <style>
        /* CSS styles for layout */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
            background-color: #f0f0f0;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .info-box {
            margin-bottom: 20px;
            padding: 15px;
            background-color: #f9f9f9;
            border-radius: 6px;
            border: 1px solid #ccc;
        }
        .info-box h2 {
            margin-top: 0;
        }
        .district-list {
            list-style-type: none;
            padding: 0;
        }
        .district-item {
            margin-bottom: 10px;
        }
        .login-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .login-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Elderly Individuals in Buriram</h1>

        <!-- ปุ่มล็อคอิน -->
        <a href="/login" class="login-button">Login</a>

        <div class="info-box" id="total-elderly-info">
            <h2>Total Elderly Individuals in Buriram</h2>
            <p id="total-elderly-count">Loading...</p>
        </div>

        <div class="info-box" id="district-info">
            <h2>Elderly Individuals per District</h2>
            <ul class="district-list" id="district-list">
                <li class="district-item">Loading...</li>
            </ul>
        </div>
    </div>

    <script>
        // JavaScript to fetch and display elderly data
        document.addEventListener('DOMContentLoaded', () => {
            // Fetch total elderly count
            fetch('/api/elderly/count/buriram')
                .then(response => response.json())
                .then(data => {
                    const totalElderlyCount = document.getElementById('total-elderly-count');
                    totalElderlyCount.textContent = data.count;
                })
                .catch(error => console.error('Error fetching total elderly count:', error));

            // Fetch elderly count per district
            fetch('/api/elderly/per-district/buriram')
                .then(response => response.json())
                .then(data => {
                    const districtList = document.getElementById('district-list');
                    districtList.innerHTML = '';
                    data.forEach(district => {
                        const listItem = document.createElement('li');
                        listItem.classList.add('district-item');
                        listItem.textContent = `${district.district}: ${district.count}`;
                        districtList.appendChild(listItem);
                    });
                })
                .catch(error => console.error('Error fetching elderly per district:', error));
        });
    </script>
</body>
</html>
