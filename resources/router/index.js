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

const routes = [
  { path: '/', component: Login },
  { path: '/Mahasiswahome', component: MahasiswaHome }, 
  { path: '/Adminhome', component: AdminHome }, 
  { path: '/Dosenhome', component: DosenHome }, 
  { path: '/about', component: About },
  { path: '/contact', component: Contact },
  { path: '/profile', component: Profile },
  { path: '/jadwal', component: Jadwal },
  { path: '/khskrs', component: KhsKrs },
  { path: '/dokumen', component: Dokumen },
  { path: '/keuangan', component: Keuangan },
  { path: '/dosen', component: Dosen },
];

const router = createRouter({
  history: createWebHashHistory(),
  routes
});

export default router;
