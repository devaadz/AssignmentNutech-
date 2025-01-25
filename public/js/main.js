function hitungHargaJual() {
    const hargaBeliInput = document.getElementById("hargaBeli");
    const hargaJualInput = document.getElementById("hargaJual");

    // Ambil nilai dari harga beli
    let hargaBeli = hargaBeliInput.value;

    // Validasi angka (hapus karakter selain angka)
    hargaBeli = hargaBeli.replace(/[^0-9]/g, "");

    // Perbarui input harga beli (jika ada perubahan dari validasi)
    hargaBeliInput.value = hargaBeli;

    // Jika harga beli tidak kosong, hitung 30% lebih besar
    if (hargaBeli) {
        const hargaJual = parseInt(hargaBeli) * 1.3; // Harga jual = 30% lebih besar
        hargaJualInput.value = hargaJual;
    } else {
        hargaJualInput.value = ""; // Kosongkan harga jual jika harga beli kosong
    }
}
function validateAndDisplayImage() {
    const fileInput = document.getElementById("imageUpload");
    const errorMessage = document.getElementById("error-message");
    const file = fileInput.files[0];
    const imagePreview = document.getElementById("imagePreview");
    const imagePreviewContainer = document.getElementById("imagePreviewContainer");

    if (file) {
        const fileSize = file.size / 1024; // Ukuran dalam KB
        const fileType = file.type;

        // Validasi format file (JPG/PNG)
        if (!(fileType === "image/jpeg" || fileType === "image/png")) {
            errorMessage.textContent = "Format file harus JPG atau PNG!";
            errorMessage.style.display = "block";
            fileInput.value = ""; // Hapus file yang dipilih
            imagePreviewContainer.style.display = "none"; // Sembunyikan preview jika file tidak valid
            return;
        }

        // Validasi ukuran file (maksimal 100KB)
        if (fileSize > 100) {
            errorMessage.textContent = "Ukuran file maksimal 100KB!";
            errorMessage.style.display = "block";
            fileInput.value = ""; // Hapus file yang dipilih
            imagePreviewContainer.style.display = "none"; // Sembunyikan preview jika ukuran melebihi batas
            return;
        }

        errorMessage.style.display = "none"; // Menyembunyikan pesan error jika file valid

        // Menampilkan gambar yang dipilih
        const reader = new FileReader();
        reader.onload = function(e) {
            imagePreview.src = e.target.result; // Menetapkan sumber gambar ke file yang dipilih
            imagePreviewContainer.style.display = "block"; // Menampilkan preview gambar
        };
        reader.readAsDataURL(file); // Membaca file gambar sebagai URL data
    }
}


