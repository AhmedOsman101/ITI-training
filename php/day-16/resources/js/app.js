import ajax from "@imacrayon/alpine-ajax";
import Alpine from "alpinejs";
import Swal from "sweetalert2";

function sweetConfirm() {
  return Swal.fire({
    title: "Are you sure?",
    text: "You won't be able to revert this!",
    icon: "warning",
    showConfirmButton: false,
    showCancelButton: true,
    showDenyButton: true,
    denyButtonText: "Yes, delete it!",
  }).then(result => result.isDenied);
}

window.Alpine = Alpine;
window.Swal = Swal;
window.sweetConfirm = sweetConfirm;

Alpine.plugin(ajax);
Alpine.start();
