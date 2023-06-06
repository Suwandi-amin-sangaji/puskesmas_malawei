<?php
include "config/koneksi.php";

// Mendapatkan nomor rekam medis terakhir yang ada di database
function getLastRegistrationNumber() {
  global $koneksi;
  
  $query = mysqli_query($koneksi, "SELECT MAX(no_rekamedis) as last_number FROM tb_pasien");
  $row = mysqli_fetch_assoc($query);
  
  return $row['last_number'];
}

// Menghasilkan nomor rekam medis berikutnya
function generateNextRegistrationNumber() {
  $lastNumber = getLastRegistrationNumber();
  
  if (empty($lastNumber)) {
    // Jika belum ada nomor rekam medis di database, dimulai dari "00001"
    $nextNumber = "00001";
  } else {
    // Mengambil angka dari nomor rekam medis terakhir dan menambahkannya
    $lastNumber = intval($lastNumber);
    $nextNumber = str_pad($lastNumber + 1, 5, "0", STR_PAD_LEFT);
  }
  
  return $nextNumber;
}

// Fungsi untuk menghasilkan nomor registrasi
function generateNomorRegistrasi($koneksi) {
  // Query untuk mendapatkan nomor registrasi terakhir
  $query = mysqli_query($koneksi, "SELECT MAX(no_registrasi) as max_registrasi FROM tb_pendaftaran");
  $row = mysqli_fetch_assoc($query);

  if ($row['max_registrasi']) {
    // Jika sudah ada nomor registrasi sebelumnya
    $maxRegistrasi = $row['max_registrasi'];

    // Ambil angka dari nomor registrasi terakhir
    $number = (int) substr($maxRegistrasi, 3);

    // Tambahkan 1 ke angka tersebut
    $number++;

    // Format angka dengan prefix REG dan padding 6 digit
    $newRegistrasi = 'REG' . str_pad($number, 6, '0', STR_PAD_LEFT);
  } else {
    // Jika belum ada nomor registrasi sebelumnya
    $newRegistrasi = 'REG000001';
  }

  return $newRegistrasi;
}



// Fungsi untuk membuat nomor rawat baru
function generateNomorRawat($koneksi) {
  global $koneksi;
  // Mendapatkan tanggal saat ini
  $tanggal = date("Ymd");

  // Mengambil nomor rawat terakhir dari database
  $query = "SELECT MAX(no_rawat) AS max_no_rawat FROM tb_pendaftaran";
  $result = mysqli_query($koneksi, $query);
  $data = mysqli_fetch_assoc($result);
  $no_rawat_terakhir = $data['max_no_rawat'];

  // Mengecek apakah sudah ada nomor rawat sebelumnya
  if ($no_rawat_terakhir) {
      // Mengekstrak tanggal dari nomor rawat terakhir
      $tanggal_terakhir = substr($no_rawat_terakhir, 0, 8);

      // Mengecek apakah tanggal hari ini sama dengan tanggal terakhir
      if ($tanggal == $tanggal_terakhir) {
          // Mengekstrak angka urutan dari nomor rawat terakhir
          $urutan_terakhir = substr($no_rawat_terakhir, -4);

          // Membuat angka urutan baru dengan increment 1
          $urutan_baru = intval($urutan_terakhir) + 1;

          // Menggabungkan tanggal dan angka urutan baru
          $no_rawat_baru = $tanggal . sprintf("%04d", $urutan_baru);
      } else {
          // Jika tanggal hari ini berbeda dengan tanggal terakhir,
          // maka nomor rawat baru dimulai dari 0001
          $no_rawat_baru = $tanggal . "0001";
      }
  } else {
      // Jika belum ada nomor rawat sebelumnya,
      // maka nomor rawat baru dimulai dari 0001
      $no_rawat_baru = $tanggal . "0001";
  }

  return $no_rawat_baru;
}


// function generateNomorTerimaObat($koneksi) {
//   include "config/koneksi.php";
//   // Mendapatkan nomor terima obat terakhir dari database
//   $query_last_number = mysqli_query($koneksi, "SELECT MAX(id) AS last_id FROM tb_pengeluaran_obat");
//   $row_last_number = mysqli_fetch_assoc($query_last_number);
//   $last_number = $row_last_number['last_id'];

//   // Membuat nomor terima obat baru
//   $new_number = $last_number + 1;
//   $nomor_terima_obat = 'TRM' . str_pad($new_number, 6, '0', STR_PAD_LEFT); // Format nomor terima obat: TRM000001

//   return $nomor_terima_obat;
// }






