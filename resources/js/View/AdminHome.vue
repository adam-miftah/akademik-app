<template>
  <div>
    <h1>Dashboard Admin</h1>
    <p>Selamat datang, {{ user.name }}!</p>
    
    <!-- Tambahan tombol logout -->
    <button @click="logout" class="btn btn-danger">Logout</button>

    <div class="stats">
      <p><strong>Jumlah Pengguna:</strong> {{ stats.userCount }}</p>
      <p><strong>Jumlah Dosen:</strong> {{ stats.dosenCount }}</p>
      <p><strong>Jumlah Mahasiswa:</strong> {{ stats.mahasiswaCount }}</p>
    </div>
  </div>
</template>

<script>
import api from '/resources/js/axios';  // pastikan import axios yang sudah dikonfigurasi

export default {
  name: 'AdminHome',
  data() {
    return {
      user: JSON.parse(localStorage.getItem('user')) || {},  // Menyimpan informasi user dari localStorage
      stats: {
        userCount: 0,
        dosenCount: 0,
        mahasiswaCount: 0,
      }
    };
  },
  mounted() {
    this.getDashboardData();  // Ambil data dashboard saat komponen dimuat
  },
  methods: {
    // Fungsi logout
    logout() {
      localStorage.removeItem('token');
      localStorage.removeItem('role');
      localStorage.removeItem('user');
      this.$router.push('/');  // Redirect ke halaman login setelah logout
    },
    async getDashboardData() {
      try {
        // Mengambil data statistik dashboard (contoh API)
        const response = await api.get('/admin/dashboard');
        this.stats = response.data;  // Sesuaikan sesuai response dari backend
      } catch (error) {
        console.error('Gagal memuat data dashboard:', error);
      }
    }
  }
};
</script>

<style scoped>
h1 {
  color: #007bff;
}

button {
  margin-top: 20px;
}

.stats {
  margin-top: 30px;
}

.stats p {
  font-size: 18px;
}

</style>
