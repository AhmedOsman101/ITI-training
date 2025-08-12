// --- Task One --- //
/** biome-ignore-all lint/security/noGlobalEval: Controlled */

const appDiv = document.getElementById("app");
const nameParagraph = document.createElement("p");

// add some delay
setTimeout(() => {
  alert("Welcome to my website");

  const username = prompt("Enter your name");
  nameParagraph.textContent = `Welcome ${username}`;
  appDiv.appendChild(nameParagraph);
}, 500);

// --- Task Two --- //
function sum(num1, num2) {
  const n1 = Number.parseInt(num1);
  const n2 = Number.parseInt(num2);

  return n1 + n2;
}

function handleSumClick() {
  const num1 = prompt("Enter first number");
  const num2 = prompt("Enter second number");

  const sumParagraph = document.createElement("p");
  sumParagraph.textContent = `sum of ${num1} + ${num2} = `;
  sumParagraph.textContent += sum(num1, num2);

  appDiv.appendChild(sumParagraph);
}

// --- Task Three --- //

function handleMathClick() {
  const input = prompt("Enter a math expression");
  const result = eval(input);

  const mathParagraph = document.createElement("p");
  mathParagraph.textContent = `You entered: "${input}", and the result is: ${result}`;

  appDiv.appendChild(mathParagraph);
}
