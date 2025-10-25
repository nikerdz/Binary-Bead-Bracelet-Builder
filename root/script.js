
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
  ctx.clearRect(0, 0, canvas.width, canvas.height);

  const beadSize = 35;
  const spacing = 10;
  let x = 50;
  const y = canvas.height / 2;

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
    ctx.stroke();
    x += beadSize + spacing;
  }
}

downloadBtn.addEventListener("click", () => {
  const link = document.createElement("a");
  link.download = "WiCS_Binary_Bead_Layout.png";
  link.href = canvas.toDataURL("image/png");
  link.click();
});
