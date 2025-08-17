function taskOne() {
  const namePara = window.username;
  const birthYearPara = window.birth;
  const agePara = window.age;

  const username = prompt("Enter your name");
  const birthYear = prompt("Enter your birth year");
  const age = new Date().getFullYear() - Number.parseInt(birthYear);

  namePara.textContent += username;
  birthYearPara.textContent += birthYear;

  agePara.textContent += Number.isNaN(age) ? "Invalid birth year" : age;
}

// --- Task Three --- //
function taskThree() {
  const appDiv = window.app;
  const imageName = prompt("Enter image name");
  const color = prompt("Enter a color");

  const para = document.createElement("p");
  para.textContent = "This is your image";
  appDiv.appendChild(para);

  const image = document.createElement("img");
  image.src = `assets/${imageName}`;
  image.alt = imageName;
  appDiv.appendChild(image);
  appDiv.style = `color: ${color}; border: 10px solid ${color};`;
}

// --- Task Four --- //

function taskFour() {
  const table = window.taskFourTable;
  const studentInfo = [
    ["Maria", "wet@subkem.vg", "1-894-489-8947", "html", "Maria.png"],
    ["Connor", "je@tuwpun.ck", "338-237-9696 x478", "css", "Connor.png"],
    ["Daisy", "siekoguz@no.net", "(740) 569-6168 x2914", "js", "Daisy.png"],
    ["Josie", "egip@kic.eu", "785-434-1562", "php", "Josie.png"],
  ];

  for (const row of studentInfo) {
    const tr = document.createElement("tr");
    for (const cell of row) {
      const td = document.createElement("td");
      td.textContent = cell;
      tr.appendChild(td);
    }

    table.appendChild(tr);
  }
}

// --- Task Five --- //

const tipPara = window.tip;
const randomIndex = Math.floor(Math.random() * 10);
const tips = [
  "Use const instead of let for array and object definitions",
  "Each html element that has an id has a variable for it in the window object",
  "Use normal functions instead of arrow functions inside objects to preserve the `this` object",
  "Use the for-of loop with arrays and for-in loop with objects",
  "Avoid using var, use let or const instead",
  "Use the built-in array methods instead of looping manually",
  "Use array.map() to transform values of an array into a new one",
  "Use array.forEach() loop on items without returning a new array",
  "Use `new Date().getFullYear()` to get the current year",
  "Use `Math.round(Math.random() * N)` to get a number between 1 and N",
];

tipPara.textContent = `Task 5 ==> ${tips[randomIndex]}`;

// --- Task Six --- //

// DD–MM–YYYY
function taskSix() {
  const input = prompt(
    "Enter a data in the following format: 'DD–MM–YYYY'"
  ).trim();
  const resultPara = window.result;

  const validate = date => {
    const parts = date.split("-");
    if (parts.length !== 3) return `Invalid format: ${date}`;

    if (date.length !== 10) return "Date must be exactly 10 characters";

    for (let i = 0; i < parts.length; i++) {
      const part = parts[i];
      if (i < 2 && part.length === 2) continue;
      if (i === 2 && part.length === 4) continue;
      return `Part ${i + 1} is invalid`;
    }

    return `${date} is a valid date!`;
  };

  resultPara.textContent = validate(input);
}

// --- Task Seven --- //
function taskSeven() {
  const characters = ["a", "b", "c", "d", "e"];
  const char = prompt("Choose a character from a to e").trim();

  const exclude = (array, value) => {
    const filteredArray = array.filter(c => c !== value);
    return array.includes(char)
      ? `[ ${filteredArray.join(", ")} ]`
      : `Invalid Character "${char}"`;
  };

  const bonusOne = window.bonusOne;
  bonusOne.textContent = exclude(characters, char);
}

// --- Task Eight --- //
function taskEight() {
  const numbers = prompt("Enter some numbers separated with a space")
    .trim()
    .split(" ");

  const number = prompt("Enter a number to count").trim();

  const counter = (array, value) => {
    let count = 0;
    if (array.includes(value)) {
      for (const item of array) {
        if (item === value) count++;
      }
    }

    return `The array [ ${array.join(", ")} ] contains the element ${value} ==> ${count} times`;
  };

  const bonusTwo = window.bonusTwo;
  bonusTwo.textContent = counter(numbers, number);
}
