const form = document.getElementById("form");
const display = document.getElementById("display");

/** @type {HTMLImageElement} */
const img = document.getElementById("img");

form.addEventListener("submit", (e) => {
	e.preventDefault();
	img.classList.add("hidden");
	const data = new FormData(form);
	console.log(data);

	const result = validate(data);
	if (result.error) {
		display.textContent = result.error;
		display.classList.add("error");
	} else {
		display.textContent = result.message;
		display.classList.remove("error");
		display.style.fontSize = result.data.select;

		img.classList.remove("hidden");
		img.src = `assets/${result.data.image}`;
		img.alt = result.data.image;
	}
});

/**
 *
 * @param {FormData} data
 */
function validate(data) {
	/** @type {string} */
	const name = data.get("username")?.trim();

	/** @type {string} */
	const image = data.get("image")?.trim();
	const extension = image.split(".")[1];

	/** @type {string} */
	const select = data.get("select")?.trim();

	const result = {
		error: null,
		message: `Welcome ${name}`,
		data: {
			name,
			image,
			select,
		},
	};

	if (name.length === 0) result.error = "Name cannot be empty";
	else if (/^\d+$/.test(name)) {
		/* Matches a string that only contains numbers
		 * ^ -> matches the start of the string
		 * \d -> means digits, same as [0-9]
		 * + -> means one or more
		 * $ -> asserts the match is at the end of the string
		 */
		result.error = "Name cannot be only numbers";
	} else if (image.length === 0) result.error = "Image cannot be empty";
	else if (!extension) result.error = "This image doesn't have an extension";
	else if (!["png", "jpg", "jpeg"].includes(extension)) {
		result.error = `Invalid extension: '${extension}'`;
	}

	return result;
}

/**
 *
 * @param {"image" | "font"} field
 */
function plus(field) {
	if (field === "font") {
		const size = parseInt(display.style.fontSize);
		display.style.fontSize = `${size + 2}px`;
	} else {
		const size = parseInt(img.style.width);
		if (window.innerWidth <= size) {
			alert("Image reached max width");
		} else {
			img.style.width = `${size + 200}px`;
		}
	}
}

/**
 *
 * @param {PointerEvent} event
 */
function minus(event) {
	const size = parseInt(display.style.fontSize);
	display.style.fontSize = `${size - 2}px`;
}
