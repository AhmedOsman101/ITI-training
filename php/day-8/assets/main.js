const form = document.getElementById("form");

form.addEventListener("submit", e => {
  e.preventDefault();

  // biome-ignore lint/complexity/noForEach: remove previous errors
  form.querySelectorAll("p.error").forEach(el => el.remove());

  const formData = new FormData(form);

  const errors = validate(formData);
  let allValid = true;

  for (const [name, error] of Object.entries(errors)) {
    if (error) {
      allValid = false;
      const p = document.createElement("p");
      p.classList.add("mt-1", "text-sm", "text-red-900", "error");
      p.textContent = error;
      document.querySelector(`#${name}`).appendChild(p);
    }
  }

  if (allValid) alert("Valid form 🎇");
});

/** @param {FormData} data */
function validate(data) {
  const nameRegex = /^[A-Z][\w\s]*$/i;
  const emailRegex = /[A-Z0-9._%+-]+@[A-Z0-9-]+.\.[A-Z]{2,4}/i;
  const phoneRegex = /^(010|011|012|015)+\d{8}/;
  const imageRegex = /^[\w]+(\.png|\.jpeg|\.jpg)$/;
  const passwordRegex = /^(?=.*[@$!%*?&_])[A-Za-z0-9@$!%*?&_]{8,}$/;

  const name = data.get("name");
  const email = data.get("email");
  const phone = data.get("phone");
  const image = data.get("image").name; // NOTE: This is of type File
  const password = data.get("password");
  const confirmPass = data.get("confirmPass");

  const errors = {
    name: null,
    email: null,
    phone: null,
    image: null,
    password: null,
    confirmPass: null,
  };

  if (!nameRegex.test(name)) {
    errors.name = "Name must be alphanumeric characters and not empty";
  }
  if (!emailRegex.test(email)) errors.email = "Invalid email";
  if (!phoneRegex.test(phone)) errors.phone = "Invalid phone format";
  if (!imageRegex.test(image)) errors.image = "Invalid photo extension";
  if (confirmPass !== password) errors.confirmPass = "Passwords don't match";
  if (!passwordRegex.test(password)) {
    errors.password = "Password must have a symbol and minimum length 8";
  }

  return errors;
}
