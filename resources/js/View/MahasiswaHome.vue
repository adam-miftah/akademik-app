<template>
  <div>
    <MainHeader/>

    <div class="container text-center" style="margin-top: 100px;">
      <h2 class="fs-6">Selamat Datang, {{ user.name }}</h2>  <!-- Tampilkan Nama Pengguna -->
    </div>

    <!-- Tombol Logout -->
    <div class="container text-center mt-3">
      <button @click="logout" class="btn btn-danger">Logout</button>
    </div>

    <div class="container text-center bg-transparent py-3 mt-4">
      <div class="row">
        <div class="col-6 col-md-4 mb-3">
          <router-link to="/jadwal" class="text-decoration-none">
            <div class="card small-card h-100">
              <div class="card-body">
                <img src="/public/image/calendar.png" alt="jadwal" width="40">
                <p class="mt-2 text-dark card-text">Jadwal Kuliah</p>
              </div>
            </div>
          </router-link>
        </div>

        <div class="col-6 col-md-4 mb-3">
          <router-link to="/khskrs" class="text-decoration-none">       
            <div class="card small-card h-100">
              <div class="card-body">
                <img src="/public/image/script.png" alt="khs" width="40">
                <p class="mt-2 text-dark card-text">KHS & KRS</p>
              </div>
            </div>
          </router-link>
        </div>

        <div class="col-6 col-md-4 mb-3">
          <router-link to="/dokumen" class="text-decoration-none">
            <div class="card small-card h-100">
              <div class="card-body">
                <img src="/public/image/folder.png" alt="dokumen" width="40">
                <p class="mt-2 text-dark card-text">Dokumen</p>
              </div>
            </div>
          </router-link>
        </div>
        
        <div class="col-6 col-md-4 mb-3">
          <router-link to="/keuangan" class="text-decoration-none">
            <div class="card small-card h-100">
              <div class="card-body">
                <img src="/public/image/bank.png" alt="keuangan" width="40">
                <p class="mt-2 text-dark card-text">Keuangan</p>
              </div>
            </div>
          </router-link>
        </div>

        <div class="col-6 col-md-4 mb-3">
          <router-link to="/dosen" class="text-decoration-none">
            <div class="card small-card h-100">
              <div class="card-body">
                <img src="/public/image/consulting.png" alt="dosen" width="40">
                <p class="mt-2 text-dark card-text">Daftar Dosen</p>
              </div>
            </div>
          </router-link>
        </div>
      </div>
    </div>

    <TheFooter/>
  </div>
</template>

<script>
import MainHeader from '../components/MainHeader.vue';
import TheFooter from '../components/TheFooter.vue';

export default {
  name: "MahasiswaHome",
  components: {
    MainHeader,
    TheFooter
  },
  data() {
    return {
      user: JSON.parse(localStorage.getItem('user')) || {},  // Menyimpan data user dari localStorage
    };
  },
  methods: {
    // Fungsi logout
    logout() {
      localStorage.removeItem('token');
      localStorage.removeItem('role');
      localStorage.removeItem('user');
      this.$router.push('/');  // Redirect ke halaman login setelah logout
    }
  }
};
</script>

<style scoped>
.card-text {
  font-weight: bold;
  font-size: 1.1rem;
}

.card {
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
  transition: transform 0.2s ease-in-out;
}

.card:hover {
  background-color: rgb(218, 218, 218);
  transform: translateY(-5px);
}

h2.fs-6 {
  font-size: 16px;
}

button {
  margin-top: 20px;
}
</style>
