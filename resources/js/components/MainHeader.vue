<template>
  <div class="header d-flex align-items-center text-white">
    <img src="/public/image/LogoUnpam.png" alt="logo" class="logo" />
    <div class="text ms-3">
      <h1 class="mb-0 fw-bold" style="font-size: 20px;">SITIKIMAK</h1>
      <span>Sistem Informasi Teknik Informatika Mahasiswa Akademik</span>
    </div>

    <!-- Toggle button for mobile -->
    <button class="menu-toggle d-md-none ms-auto me-3" @click="isMenuOpen = !isMenuOpen">
      ☰
    </button>

    <!-- Navigation menu -->
    <nav class="nav ms-auto me-3" :class="{ 'show': isMenuOpen }">
      <router-link to="/home" class="nav-item" :class="{ active: isActive('/home') }">Beranda</router-link>
      <router-link to="/about" class="nav-item" :class="{ active: isActive('/about') }">About</router-link>
      <router-link to="/contact" class="nav-item" :class="{ active: isActive('/contact') }">Contact</router-link>

      <!-- Profil untuk layar besar -->
<div class="profile-container d-none d-md-inline-block" @mouseover="showDropdown = true" @mouseleave="showDropdown = false">
  <img src="/public/image/Profil.jpeg" alt="Profile" class="profile-img" />

  <transition name="fade">
    <div v-if="showDropdown" class="dropdown-menu">
      <router-link to="/profile" class="dropdown-item fw-medium">
        <img src="/public/image/user.png" alt="user" class="me-3" width="20px" height="20px" />
        DETAIL PROFILE
      </router-link>
      <hr />
      <a href="#" class="dropdown-item logout" @click="logout">
        <img src="/public/image/logout.png" alt="logout" class="me-3" width="20px" height="20px" />
        LOGOUT
      </a>
    </div>
  </transition>
</div>

<!-- Tombol logout untuk mobile -->
<button class="btn btn-danger btn-sm d-block d-md-none" @click="logout">
  Logout
</button>

    </nav>
  </div>
</template>

<script>
import Swal from 'sweetalert2';

export default {
  name: 'MainHeader',
  data() {
    return {
      showDropdown: false,
      isMenuOpen: false
    };
  },
  methods: {
    logout() {
      Swal.fire({
        title: 'Yakin ingin logout?',
        text: 'Kamu akan keluar dari akun ini.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Logout',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          this.$router.push('/');
          Swal.fire({
            title: 'Logout Berhasil!',
            text: 'Sampai jumpa kembali.',
            icon: 'success',
            timer: 2000,
            showConfirmButton: false
          });
        }
      });
    },
    isActive(menuPath) {
      return this.$route.path === menuPath;
    }
  }
};
</script>

<style scoped>
.header{
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  z-index: 999;
  height: 50px;
  background-color: #1B0357;
  box-shadow: 0px 3px 2px rgba(0, 0, 0, 0.5);
  display: flex;
  align-items: center;
  padding: 30px;
}

.text, h1 {
  font-size: 12px;
}

.logo {
  width: 30px;
}

.menu-toggle {
  font-size: 24px;
  background: none;
  border: none;
  color: white;
  cursor: pointer;
  display: none;
}

.nav {
  display: flex;
  gap: 20px;
  justify-content: center;
  align-items: center;
}

.nav-item {
  color: white;
  text-decoration: none;
  font-size: 14px;
  font-weight: 500;
  transition: 0.3s;
}

.nav-item:hover {
  color: #FFD700;
}

.nav-item.active {
  color: #FFD700 !important;
}

.profile-container {
  position: relative;
  display: inline-block;
}

.profile-img {
  width: 30px;
  border-radius: 50%;
  cursor: pointer;
}

.dropdown-menu {
  position: absolute;
  top: 50px;
  right: 0;
  background: white;
  color: black;
  border-radius: 5px;
  font-size: 13px;
  box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
  padding: 5px;
  width: 200px;
  z-index: 100;
  display: block;
}

.dropdown-item {
  padding: 8px;
  display: block;
  text-decoration: none;
  color: black;
}

.dropdown-item.logout {
  color: red;
  font-weight: bold;
  cursor: pointer;
}

.dropdown-item:hover {
  background-color: #DCDCDCFF;
  border-radius: 5px;
}

.dropdown-item.logout:hover {
  background-color: rgba(255, 0, 0, 0.1);
}

.fade-enter-active, .fade-leave-active {
  transition: opacity 0.3s;
}

.fade-enter, .fade-leave-to {
  opacity: 0;
}

/* Responsive styles */
@media (max-width: 768px) {
  .menu-toggle {
    display: block;
  }

  .nav {
    display: none;
    width: 100%;
    flex-direction: column;
    position: absolute;
    top: 100%;
    left: 0;
    background-color: #1B0357;
    padding: 8px;
    border-radius: 0px 0px 10px 10px;
    align-items: flex-start;
  }

  .nav.show {
    display: flex;
  }

  .nav-item {
    margin-bottom: 10px;
  }

  .profile-container {
    margin-top: 10px;
  }
  .btn-sm {
    margin-top: 5px;
    font-size: 14px;
  }
}
</style>
