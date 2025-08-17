const form = document.getElementById("form");
const tbody = document.getElementById("tableBody");

/** @typedef { {id: number; done: boolean; title: string;} } Todo */

/** @type {Todo[]}*/
const todos = [];

function* generateId() {
  let id = 1;
  while (true) yield id++;
}

const idGenerator = generateId();
const getId = () => idGenerator.next().value;

/** @param {Todo} todo */
function row(todo) {
  return `<tr class="hover:bg-zinc-700/40" data-id="${todo.id}">
<td class="px-4 py-2 text-center">
  <input type="checkbox" class="w-4 h-4 accent-zinc-500" ${todo.done ? "checked" : ""} onchange="toggle(${todo.id})" />
</td>
<td class="px-4 py-2">
  <span class="${todo.done ? "line-through text-zinc-400" : ""}" id="title-${todo.id}">${todo.title}</span>
</td>
<td class="px-4 py-2 text-center">
  <button
    type="button"
    class="text-zinc-400 hover:text-red-500 focus:outline-none text-2xl cursor-pointer"
    aria-label="Delete"
    title="Delete"
    onclick="remove(${todo.id})"
  >
    󰆴
  </button>
</td>
</tr>`;
}

function render() {
  tbody.innerHTML = todos.map(row).join("\n");
}

/** @param {number} id */
function remove(id) {
  if (confirm("Are you sure?")) {
    const idx = todos.findIndex(t => t.id === id);
    if (idx !== -1) {
      todos.splice(idx, 1);
      render();
    }
  }
}

/** @param {number} id */
function toggle(id) {
  const idx = todos.findIndex(t => t.id === id);
  if (idx !== -1) {
    todos[idx].done = !todos[idx].done;
    render();
  }
}

// expose the function to the global scope
window.remove = remove;
window.toggle = toggle;

form.addEventListener("submit", e => {
  e.preventDefault();

  const formData = new FormData(form);

  const title = formData.get("title").trim();
  if (!title) {
    alert("Title cannot be empty!");
    return;
  }

  todos.push({ id: getId(), title, done: false });
  render();
});
