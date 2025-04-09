<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport">
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
        nav {
            background: #444;
            padding: 1rem 0;
            text-align: left;
        }
        nav a {
            display: inline-block;
            background: #555;
            color: #fff;
            text-decoration: none;
            padding: 0.5rem 1rem;
            margin: 0 0.5rem;
            border-radius: 25px;
            font-weight: bold;
            transition: background 0.3s ease;
        }
        nav a:hover {
            background: #666;
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
    <nav>
        <a href="/index.html">Home</a>
        <a href="/public/Graphing.php">Graphing Page</a>
    </nav>
    <div class="container">
        <h1>Meet Our Team</h1>
        <div class="team-member">
            <h2>Nathan McIntyre</h2>
            <img src="nathan.jpeg" alt="nathan" width ="200" height="200">
            <p>Bio: I am a senior in Computer Science at CSU, pursuing a concentration in networking and system security. I currently work 
                for CSU Housing and Dining as a networking intern. I am always eager to learn in an ever-changing environment to overcome the new
                obstacles that we face. In my free to relax with my Fiancé and our  black lab, Bella, 
                watching tv and playing video games.
  </p>
        </div>
        <div class="team-member">
            <h2>Jeffrey Markham</h2>
            <p>
                Bio: Senior in computer science at CSU, with a concentration of networking and security. Was in the U.S. Army from 2015 to 2019, then joined 
                the Colorado Air National Guard as a Client Systems Technician where I help conduct cybersecurity operations. I have a passion for technology 
                and enjoy learning about new advancements in the field.
            </p>
        </div>
        <div class="team-member">
            <h2>Quinten Roberts</h2>
            <img src="Quinnface.jpeg" alt="Face" width="200" height="300">
            <p>
                Bio: Junior in Computer Science @ CSU, concentration of AI and Machine Learning. Born in Colorado and grew up with a love of computers. I
                like to make video games, play basketball, and watch movies. I've been continuing to enjoy learning about html, css, php, and all the 
                various frameworks/addons involved with web development.
            </p>
        </div>
    </div>
</body>
</html>