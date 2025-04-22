<template>
  <div>
    <h1>Selamat datang, Dosen {{ user.name }}!</h1>
    
    <!-- Tombol logout -->
    <button @click="logout" class="btn btn-danger">Logout</button>

    <!-- Fitur statistik (misalnya, jumlah kelas atau jumlah mahasiswa yang diajar) -->
    <div class="stats">
      <p><strong>Jumlah Kelas yang Diajar:</strong> {{ stats.classCount }}</p>
      <p><strong>Jumlah Mahasiswa yang Dibimbing:</strong> {{ stats.studentCount }}</p>
    </div>
  </div>
</template>

<script>
import api from '/resources/js/axios';  // Pastikan axios diimport dengan benar

export default {
  name: 'DosenHome',
  data() {
    return {
      user: JSON.parse(localStorage.getItem('user')) || {},  // Ambil data user dari localStorage
      stats: {
        classCount: 0,
        studentCount: 0,
      }
    };
  },
  mounted() {
    this.getDosenDashboardData();  // Ambil data dashboard Dosen saat komponen dimuat
  },
  methods: {
    // Fungsi untuk logout
    logout() {
      localStorage.removeItem('token');
      localStorage.removeItem('role');
      localStorage.removeItem('user');
      this.$router.push('/');  // Redirect ke halaman login setelah logout
    },
    async getDosenDashboardData() {
      try {
        // Ambil data dashboard Dosen (contoh API endpoint)
        const response = await api.get('/dosen/dashboard');
        this.stats = response.data;  // Sesuaikan dengan response API
      } catch (error) {
        console.error('Gagal memuat data dashboard:', error);
      }
    }
  }
};
</script>

<style scoped>
h1 {
  color: #28a745;
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
