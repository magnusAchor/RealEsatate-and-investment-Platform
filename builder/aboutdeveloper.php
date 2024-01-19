<?php
include 'connect.php';
// Check if the username is set and not empty
if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Prepare and execute SQL query with prepared statements to retrieve the user ID
    $sql = "SELECT id FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $userID = $row['id'];

        // Display the retrieved user ID (escape the output for security)
       // echo "User ID: " . htmlspecialchars($userID, ENT_QUOTES, 'UTF-8');
    } else {
        // User not found or multiple users with the same username exist
        echo "Error: Unable to retrieve user ID.";
    }

   
} else {
    // Handle the case where the username is not set or empty

    header("Location: index " );
    exit();
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Magnus Achor - Full Stack Developer</title>
<style>
body {
** font-family: Arial, sans-serif;**
** line-height: 1.6;**
** margin: 20px;**
}
h1 {
** color: #333;**
** border-bottom: 2px solid #333;**
}
p {
** margin-bottom: 15px;**
}
html {
    background: lavender;
}


</style>
</head>
<body>
    <img src="https://villadin.com/XXXXR.png" alt="Profile Image" style="max-width: 600px; width: 200px; height: 200px; border-radius: 50%; margin-top:50px; margin-bottom:50px; margin-left: 450px;cursor: pointer;">
    

<h1>Magnus Achor - Full Stack Developer</h1>

<h2>About Me</h2>
<p>Hi, I'm Magnus Achor, a dedicated and skilled Full Stack Developer from Port Harcourt, Rivers State, Nigeria. I am currently pursuing my studies at NIIT Port Harcourt, where I have been honing my programming skills and expanding my knowledge in web development and software engineering.</p>

<h2>Skills</h2>
<p>With a strong passion for technology and a deep understanding of programming languages, I have acquired expertise in various areas of web development. My skillset includes:</p>
<ul>
** <li>PHP - I have hands-on experience in building dynamic and robust web applications using PHP.</li>**
** <li>Python - I am proficient in Python, leveraging its power for backend development and data analysis.</li>**
** <li>JavaScript - My extensive knowledge of JavaScript enables me to create interactive and responsive user interfaces.</li>**
** <li>AJAX Technology - I am skilled in using AJAX to create seamless and efficient data exchange between the client and server.</li>**
** <li>HTML - I possess a strong foundation in HTML, crafting the structure of websites with clean and semantic code.</li>**
** <li>CSS - My expertise in CSS allows me to create visually appealing and well-organized website layouts.</li>**
** <li>Java - I have experience in Java programming, which adds versatility to my skillset.</li>**
</ul>

<h2>Projects</h2>
<p>During my journey as a developer, I have worked on several exciting projects, including:</p>
<ul>
** <li>An E-commerce website with PHP and MySQL, providing a user-friendly shopping experience.</li>**
** <li>A Python web application for data analysis, extracting valuable insights from large datasets.</li>**
** <li>A Real-time chat application using JavaScript and AJAX for seamless communication.</li>**
** <li>A responsive and modern portfolio website showcasing my projects and skills.</li>**
</ul>

<h2>Philosophy</h2>
<p>As a developer, my philosophy is to never stop learning. Technology is ever-evolving, and I strive to stay up-to-date with the latest trends and best practices. I believe in writing clean and maintainable code, fostering collaboration in teams, and constantly seeking innovative solutions to complex problems.</p>

<h2>Contact Me</h2>
<p>If you'd like to connect or discuss any projects, feel free to reach out to me via email at rresha160@gmail.com.com or connect with me on LinkedIn.</p>

</body>
</html>