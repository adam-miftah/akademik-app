<template>
  <div>
    <MainHeader/>

    <!-- KHS & KRS Section -->
    <div class="container">
      <h2 class="text-center mb-4" style="font-size: 20px;">
        📊 Kartu Hasil Studi (KHS) dan Kartu Rencana Studi (KRS)
      </h2>

      <!-- Tabs for KHS and KRS -->
      <div class="d-flex justify-content-center mb-3">
        <button class="btn btn-outline-primary me-2" @click="activeTab = 'khs'" :class="{ 'active-tab': activeTab === 'khs' }" style="width: 80px;">
          KHS
        </button>
        <button class="btn btn-outline-primary" @click="activeTab = 'krs'" :class="{ 'active-tab': activeTab === 'krs' }" style="width: 80px;">
          KRS
        </button>
      </div>

      <!-- Tombol Unduh PDF -->
      <div class="d-flex justify-content-end">
        <button class="btn btn-success" @click="unduhPDF">Cetak</button>
      </div>

      <!-- KHS Tab -->
      <div v-if="activeTab === 'khs'" class="tab-content" id="pdf-content">
        <div class="table-responsive" style="text-transform: uppercase;">
          <table class="table table-bordered table-hover text-white">
            <thead class="table-dark">
              <tr>
                <th>Kode Mata Kuliah</th>
                <th>Mata Kuliah</th>
                <th>Kehadiran</th>
                <th>Nilai</th>
                <th>SKS</th>
                <th>Mutu</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(khs, index) in khs" :key="index">
                <td>{{ khs.kode }}</td>
                <td>{{ khs.mataKuliah }}</td>
                <td>{{ khs.kehadiran }}</td>
                <td>{{ khs.nilai }}</td>
                <td>{{ khs.sks }}</td>
                <td>{{ hitungMutu(khs) }}</td>
              </tr>
              <tr class="table-success text-dark fw-bold border-2">
                <td colspan="5" class="text-center">IPS</td>
                <td>{{ getIPS() }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- KRS Tab -->
      <div v-if="activeTab === 'krs'" class="tab-content" id="pdf-content">
        <div class="table-responsive" style="text-transform: uppercase;">
          <table class="table table-bordered table-hover text-white">
            <thead class="table-dark">
              <tr>
                <th>Kode Mata Kuliah</th>
                <th>Mata Kuliah</th>
                <th>Kelas</th>
                <th>SKS</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(krs, index) in krs" :key="index">
                <td>{{ krs.kode }}</td>
                <td>{{ krs.mataKuliah }}</td>
                <td>{{ krs.kelas }}</td>
                <td>{{ krs.sks }}</td>
              </tr>
              <tr class="table-success text-dark fw-bold border-2">
                <td colspan="2" class="text-center">Total SKS</td>
                <td colspan="2" class="text-center">{{ totalSks() }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <TheFooter/>
  </div>
</template>

<script>
import MainHeader from '../components/MainHeader.vue';
import TheFooter from '../components/TheFooter.vue';
import html2pdf from 'html2pdf.js';

export default {
  name: "KhsKrsView",
  components: {
    MainHeader,
    TheFooter
  },
  data() {
    return {
      activeTab: 'khs',
      khs: [
        { kode: "22TIF2012", mataKuliah: "SISTEM PENDUKUNG KEPUTUSAN", kehadiran: 12, nilai: "B", sks: 2 },
        { kode: "22TIF0342", mataKuliah: "TEKNOLOGI INTERNET OF THINGS", kehadiran: 14, nilai: "A", sks: 2 },
        { kode: "22TIF3012", mataKuliah: "TEKNIK KOMPILASI", kehadiran: 13, nilai: "A", sks: 2 },
        { kode: "22TIF0363", mataKuliah: "BASIS DATA II", kehadiran: 20, nilai: "A", sks: 3 },
        { kode: "22TIF0353", mataKuliah: "PEMROGRAMAN II", kehadiran: 21, nilai: "A", sks: 3 },
        { kode: "22TIF0323", mataKuliah: "REKAYASA PERANGKAT LUNAK", kehadiran: 21, nilai: "A", sks: 3 },
        { kode: "22TIF0332", mataKuliah: "KERJA PRAKTEK", kehadiran: 12, nilai: "B", sks: 2 },
        { kode: "22TIF0443", mataKuliah: "MOBILE PROGRAMMING", kehadiran: 20, nilai: "A", sks: 3 }
      ],
      krs: [
        { kode: "22TIF2012", mataKuliah: "SISTEM PENDUKUNG KEPUTUSAN",kelas: "06TPLP009", sks: "2" },
        { kode: "22TIF0342", mataKuliah: "TEKNOLOGI INTERNET OF THINGS",kelas: "06TPLP009", sks: "2" },
        { kode: "22TIF3012", mataKuliah: "TEKNIK KOMPILASI",kelas: "06TPLP009", sks: "2" },
        { kode: "22TIF0363", mataKuliah: "BASIS DATA II",kelas: "06TPLP009", sks: "3" },
        { kode: "22TIF0353", mataKuliah: "PEMROGRAMAN II",kelas: "06TPLP009", sks: "3" },
        { kode: "22TIF0323", mataKuliah: "REKAYASA PERANGKAT LUNAK",kelas: "06TPLP009", sks: "3" },
        { kode: "22TIF0332", mataKuliah: "KERJA PRAKTEK",kelas: "06TPLP009", sks: "2" },
        { kode: "22TIF0443", mataKuliah: "MOBILE PROGRAMMING",kelas: "06TPLP009", sks: "3" }
      ]
    };
  },
  methods: {
    hitungMutu(item) {
      let bobot = 0;
      switch (item.nilai.toUpperCase()) {
        case 'A': bobot = 4; break;
        case 'B': bobot = 3; break;
        case 'C': bobot = 2; break;
        case 'D': bobot = 1; break;
        case 'E': bobot = 0; break;
      }

      const maxPertemuan = item.sks == 2 ? 14 : 21;
      const persenKehadiran = (item.kehadiran / maxPertemuan) * 100;

      if (persenKehadiran < 75) {
        bobot -= 0.5;
        if (bobot < 0) bobot = 0;
      }

      return (bobot * parseInt(item.sks)).toFixed(2);
    },
    getIPS() {
      let totalMutu = 0;
      let totalSks = 0;

      this.khs.forEach((item) => {
        const mutu = parseFloat(this.hitungMutu(item));
        totalMutu += mutu;
        totalSks += parseInt(item.sks);
      });

      if (totalSks === 0) return "0.00";
      return (totalMutu / totalSks).toFixed(2);
    },
    totalSks() {
      return this.krs.reduce((total, krsItem) => total + parseInt(krsItem.sks), 0);
    },
    unduhPDF() {
      const element = document.getElementById('pdf-content');

      const opt = {
        margin: 0.5,
        filename: `data-${this.activeTab}.pdf`,
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 2 },
        jsPDF: { unit: 'in', format: 'a4', orientation: 'portrait' }
      };

      html2pdf().set(opt).from(element).save();
    }
  }
};
</script>

<style scoped>
.container {
  margin: 80px auto;
}
.tab-content {
  background-color: #f8f9fa;
  border-radius: 5px;
  font-size: 14px;
}

button.active-tab {
  background-color: var(--bs-primary);
  color: white;
}

.table td {
  color: black;
  vertical-align: middle;
}

.table {
  background-color: rgba(255, 255, 255, 0.1);
}

.table-responsive {
  margin-top: 20px;
}

h2 {
  font-size: 24px;
  font-weight: bold;
}
</style>
