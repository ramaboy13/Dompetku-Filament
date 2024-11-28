// Modal functionality
const modal = document.getElementById("authModal");
const startButton = document.getElementById("startButton");
const closeBtn = document.querySelector(".close");

// Pastikan modal tersembunyi saat halaman dimuat
document.addEventListener("DOMContentLoaded", () => {
    modal.style.display = "none"; // Set initial state ke "none"
});

// Tampilkan modal saat tombol diklik
startButton.addEventListener("click", function (e) {
    e.preventDefault();
    modal.style.display = "flex"; // Gunakan "flex" agar modal tetap berada di tengah
});

// Sembunyikan modal saat tombol close diklik
closeBtn.addEventListener("click", function () {
    modal.style.display = "none";
});

// Sembunyikan modal saat area luar modal diklik
window.addEventListener("click", function (event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
});
