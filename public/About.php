<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            line-height: 1.6;
            background-color: #f4f4f4;
        }
        header {
            background: #333;
            color: #fff;
            padding: 1rem 0;
            text-align: center;
        }
        .container {
            max-width: 800px;
            margin: 2rem auto;
            background: #fff;
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .team-member {
            margin-bottom: 1.5rem;
            border-bottom: 1px solid #ccc;
            padding-bottom: 1rem;
        }
        .team-member:last-child {
            border-bottom: none;
        }
        .team-member h2 {
            margin: 0 0 0.5rem;
        }
        .team-member p {
            margin: 0;
        }
    </style>
</head>
<body>
    <header>
        <h1>About Us</h1>
    </header>
    <div class="container">
        <?php
        $team = [
            [
                "name" => "Your Name",
                "bio" => "Write a short bio about yourself here. Include your role and interests."
            ],
            [
                "name" => "Teammate 1",
                "bio" => "Write a short bio about Teammate 1 here. Include their role and interests."
            ],
            [
                "name" => "Teammate 2",
                "bio" => "Write a short bio about Teammate 2 here. Include their role and interests."
            ],
            [
                "name" => "Teammate 3",
                "bio" => "Write a short bio about Teammate 3 here. Include their role and interests."
            ]
        ];
        foreach ($team as $member) {
            echo "<div class='team-member'>";
            echo "<h2>" . htmlspecialchars($member['name'], ENT_QUOTES, 'UTF-8') . "</h2>";
            echo "<p>" . htmlspecialchars($member['bio'], ENT_QUOTES, 'UTF-8') . "</p>";
            echo "</div>";
        }
        ?>
    </div>
</body>
</html>