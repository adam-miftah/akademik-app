import { createRouter, createWebHashHistory } from 'vue-router';
import Login from '../js/View/LoginView.vue';
import AdminHome from '../js/View/AdminHome.vue';
import DosenHome from '../js/View/DosenHome.vue';
import MahasiswaHome from '../js/View/MahasiswaHome.vue';
import About from '../js/View/AboutView.vue';
import Contact from '../js/View/ContactView.vue';
import Profile from '../js/View/ProfileView.vue';
import Jadwal from '../js/View/JadwalView.vue';
import KhsKrs from '../js/View/KhsKrsView.vue';
import Dokumen from '../js/View/DokumenView.vue';
import Keuangan from '../js/View/KeuanganView.vue';
import Dosen from '../js/View/DosenView.vue';

// Router setup
const routes = [
  { path: '/login', component: Login, name: 'login' },
  { path: '/Mahasiswahome', component: MahasiswaHome, name: 'mahasiswaHome' },
  { path: '/Adminhome', component: AdminHome, name: 'adminHome' },
  { path: '/Dosenhome', component: DosenHome, name: 'dosenHome' },
  { path: '/about', component: About, name: 'about' },
  { path: '/contact', component: Contact, name: 'contact' },
  { path: '/profile', component: Profile, name: 'profile' },
  { path: '/jadwal', component: Jadwal, name: 'jadwal' },
  { path: '/khskrs', component: KhsKrs, name: 'khskrs' },
  { path: '/dokumen', component: Dokumen, name: 'dokumen' },
  { path: '/keuangan', component: Keuangan, name: 'keuangan' },
  { path: '/dosen', component: Dosen, name: 'dosen' },
];

// Create router
const router = createRouter({
  history: createWebHashHistory(),
  routes,
});

// Route guard to protect routes
router.beforeEach((to, from, next) => {
  const token = localStorage.getItem('token');
  const role = localStorage.getItem('role');

  // Check if the user is trying to access a protected route without being logged in
  if ((to.name === 'adminHome' && role !== 'admin') || 
      (to.name === 'dosenHome' && role !== 'dosen') || 
      (to.name === 'mahasiswaHome' && role !== 'mahasiswa')) {
    if (!token) {
      next({ name: 'login' });
    } else {
      next();
    }
  } else {
    next(); // Allow the user to navigate to the route
  }
});

export default router;
