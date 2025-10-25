<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Binary Bead Bracelet Builder</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <h1>💻 WiCS Binary Bead Bracelet Builder 💗</h1>
    <p>Learn how computers use <strong>binary</strong> — the language of 1s and 0s — to represent information, and build your own binary bead pattern!</p>
  </header>

  <section id="about">
    <h2>What is Binary?</h2>
    <p>Computers use a simple language of 1s and 0s called <strong>binary</strong>.</p>
    <p>Each 1 or 0 is a <em>bit</em>. Eight bits make up one <em>byte</em> — enough to represent a letter or number!</p>
    <p>For example, the letter A in binary is <code>01000001</code>.</p>
  </section>

  <section id="generator">
    <h2>Generate Your Bead Pattern</h2>
    <p>Enter your initials below to see your binary code as a colorful bead pattern!</p>

    <div id="input-area">
      <input type="text" id="first" maxlength="1" placeholder="First Initial">
      <input type="text" id="last" maxlength="1" placeholder="Last Initial">
      <button id="generate-btn">Generate Pattern</button>
    </div>

    <canvas id="beadCanvas" width="900" height="315"></canvas>

    <div id="email-area">
      <input type="email" id="email" placeholder="Enter your email" required>
      <button id="email-btn">Email My Bead Layout 💌</button>
      <p id="email-status"></p>
    </div>
  </section>

  <footer>
    <p>Made with 💗 by the Women in Computer Science Club @ The University of Windsor | <a href="https://wics-uwindsor.ca/">wics-uwindsor.ca</a></p>
  </footer>

  <script src="script.js"></script>
</body>
</html>
