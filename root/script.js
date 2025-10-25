
const generateBtn = document.getElementById("generate-btn");
const downloadBtn = document.getElementById("download-btn");
const canvas = document.getElementById("beadCanvas");
const ctx = canvas.getContext("2d");

generateBtn.addEventListener("click", () => {
  const first = document.getElementById("first").value.toUpperCase();
  const last = document.getElementById("last").value.toUpperCase();

  if (!first.match(/[A-Z]/) || !last.match(/[A-Z]/)) {
    alert("Please enter valid letters for both initials!");
    return;
  }

  // Convert each initial to binary (8 bits each)
  const firstBinary = first.charCodeAt(0).toString(2).padStart(8, "0");
  const lastBinary = last.charCodeAt(0).toString(2).padStart(8, "0");

  // Combine with white spacers: start, between, end
  const pattern = "S" + firstBinary + "S" + lastBinary + "S";

  drawBeads(pattern);
});

function drawBeads(pattern) {
  // Set white background
  ctx.fillStyle = "#ffffff";
  ctx.fillRect(0, 0, canvas.width, canvas.height);

  const beadSize = 35;
  const spacing = 10;

  // --- Layout calculations ---
  const topMargin = 50; // space from top for title
  const bottomMargin = 140; // space from bottom for logo

  // Title and subtitle heights
  const titleHeight = 25;   // font size of title
  const subtitleHeight = 20; // font size of subtitle
  const spacingAfterSubtitle = 40; // extra space between subtitle and beads

  const availableHeight = canvas.height - topMargin - bottomMargin - titleHeight - subtitleHeight - spacingAfterSubtitle;

  // Beads y-position: start below title + subtitle + spacing
  const y = topMargin + titleHeight + subtitleHeight + spacingAfterSubtitle + availableHeight / 2;

  // Center beads horizontally
  let x = (canvas.width - (pattern.length * (beadSize + spacing) - spacing)) / 2;

  // --- Draw title ---
  ctx.font = "bold 25px Kollektif";
  ctx.fillStyle = "#ff91c7";
  ctx.textAlign = "center";
  ctx.fillText(
    "My Binary Bead Pattern!",
    canvas.width / 2,
    topMargin
  );

  // --- Draw subtitle ---
  ctx.font = "20px Pinkyboy";
  ctx.fillStyle = "#b388eb";
  ctx.fillText(
    "UWindsor Open House – October 26, 2025",
    canvas.width / 2,
    topMargin + titleHeight + 10 // 10px below title
  );

  // --- Draw beads ---
  x = (canvas.width - (pattern.length * (beadSize + spacing) - spacing)) / 2 + 15; // shifted right
  for (let bit of pattern) {
    if (bit === "1") {
      ctx.fillStyle = "#ff91c7"; // pink for 1
    } else if (bit === "0") {
      ctx.fillStyle = "#b388eb"; // purple for 0
    } else {
      ctx.fillStyle = "#ffffff"; // white spacer
    }

    ctx.beginPath();
    ctx.arc(x, y, beadSize / 2, 0, 2 * Math.PI);
    ctx.fill();
    ctx.strokeStyle = "#ffafcc";
    ctx.lineWidth = 2;
    ctx.stroke();

    x += beadSize + spacing;
  }

  // --- Draw logo at bottom ---
  const logo = new Image();
  logo.src = "img/wics-logo.png";
  logo.onload = function () {
    const logoWidth = 200;
    const logoHeight = 100;
    const logoX = (canvas.width - logoWidth) / 2;
    const logoY = canvas.height - logoHeight - 10;
    ctx.drawImage(logo, logoX, logoY, logoWidth, logoHeight);
  };
}

downloadBtn.addEventListener("click", () => {
  const link = document.createElement("a");
  link.download = "WiCS_Binary_Bead_Layout.png";
  link.href = canvas.toDataURL("image/png");
  link.click();
});
